<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Models\AcademicSetting;
use App\Interfaces\UserInterface;
use App\Interfaces\CourseInterface;
use App\Interfaces\SectionInterface;
use App\Interfaces\SemesterInterface;
use App\Interfaces\SchoolClassInterface;
use App\Interfaces\SchoolSessionInterface;
use App\Interfaces\AcademicSettingInterface;
use App\Http\Requests\AttendanceTypeUpdateRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AcademicSettingController extends Controller
{
    use SchoolSession;

    protected $academicSettingRepository;
    protected $schoolSessionRepository;
    protected $schoolClassRepository;
    protected $schoolSectionRepository;
    protected $userRepository;
    protected $courseRepository;
    protected $semesterRepository;

    /**
     * Create a new controller instance.
     */
    public function __construct(
        AcademicSettingInterface $academicSettingRepository,
        SchoolSessionInterface $schoolSessionRepository,
        SchoolClassInterface $schoolClassRepository,
        SectionInterface $schoolSectionRepository,
        UserInterface $userRepository,
        CourseInterface $courseRepository,
        SemesterInterface $semesterRepository
    ) {
        $this->middleware('auth');
        $this->middleware(['can:view-academic-settings']);

        $this->academicSettingRepository = $academicSettingRepository;
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->schoolClassRepository = $schoolClassRepository;
        $this->schoolSectionRepository = $schoolSectionRepository;
        $this->userRepository = $userRepository;
        $this->courseRepository = $courseRepository;
        $this->semesterRepository = $semesterRepository;
    }

    /**
     * Display academic settings dashboard.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            $current_school_session_id = $this->getSchoolCurrentSession();
            if (!$current_school_session_id) {
                return redirect()->back()->with('error', 'No active school session found.');
            }

            $cacheKey = "academic_settings_{$current_school_session_id}";
            
            $data = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($current_school_session_id) {
                $latest_school_session = $this->schoolSessionRepository->getLatestSession();
                
                $academic_setting = $this->academicSettingRepository->getAcademicSetting() ?? (object) [
                    'attendance_type' => 'section',
                    'marks_submission_status' => 'off',
                ];

                return [
                    'current_school_session_id' => $current_school_session_id,
                    'latest_school_session_id'  => $latest_school_session->id,
                    'academic_setting'          => $academic_setting,
                    'school_sessions'           => $this->schoolSessionRepository->getAll(),
                    'school_classes'            => $this->schoolClassRepository->getAllBySession($current_school_session_id),
                    'school_sections'           => $this->schoolSectionRepository->getAllBySession($current_school_session_id),
                    'teachers'                  => $this->userRepository->getAllTeachers(),
                    'courses'                   => $this->courseRepository->getAll($current_school_session_id),
                    'semesters'                 => $this->semesterRepository->getAll($current_school_session_id),
                ];
            });

            return view('academics.settings', $data);

        } catch (ModelNotFoundException $e) {
            Log::error('Academic Settings - Required data not found: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Required academic data not found.');
            
        } catch (\Exception $e) {
            Log::error('Academic Settings Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading academic settings.');
        }
    }

    /**
     * Update attendance type settings.
     *
     * @param AttendanceTypeUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAttendanceType(AttendanceTypeUpdateRequest $request)
    {
        try {
            $this->authorize('manage-academic-settings');
            
            $result = $this->academicSettingRepository->updateAttendanceType($request->validated());
            
            Cache::tags(['academic_settings'])->flush();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Attendance type updated successfully',
                'data' => $result
            ], 200);

        } catch (\Exception $e) {
            Log::error('Attendance Type Update Error: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update attendance type',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update final marks submission status.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateFinalMarksSubmissionStatus(Request $request)
    {
        try {
            $this->authorize('manage-academic-settings');

            $request->validate([
                'marks_submission_status' => 'required|in:on,off'
            ]);

            $this->academicSettingRepository->updateFinalMarksSubmissionStatus($request);
            
            Cache::tags(['academic_settings'])->flush();

            return redirect()->back()->with('success', 'Final marks submission status updated successfully');

        } catch (\Exception $e) {
            Log::error('Marks Submission Status Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update marks submission status');
        }
    }

    /**
     * Get current academic settings.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCurrentSettings()
    {
        try {
            $settings = $this->academicSettingRepository->getAcademicSetting();
            
            return response()->json([
                'status' => 'success',
                'data' => $settings
            ]);

        } catch (\Exception $e) {
            Log::error('Get Academic Settings Error: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve academic settings'
            ], 500);
        }
    }
}
