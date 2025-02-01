<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Interfaces\UserInterface;
use App\Interfaces\SectionInterface;
use App\Interfaces\SchoolClassInterface;
use App\Repositories\PromotionRepository;
use App\Http\Requests\StudentStoreRequest;
use App\Interfaces\SchoolSessionInterface;
use App\Repositories\StudentParentInfoRepository;

class StudentAcademicInfoController extends Controller
{
    use SchoolSession;

    protected $userRepository;
    protected $schoolSessionRepository;
    protected $schoolClassRepository;
    protected $schoolSectionRepository;

    public function __construct(
        UserInterface $userRepository,
        SchoolSessionInterface $schoolSessionRepository,
        SchoolClassInterface $schoolClassRepository,
        SectionInterface $schoolSectionRepository
    ) {
        $this->middleware(['can:view users']);
        $this->userRepository = $userRepository;
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->schoolClassRepository = $schoolClassRepository;
        $this->schoolSectionRepository = $schoolSectionRepository;
    }

    /**
     * Display a listing of students.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function getStudentList(Request $request)
    {
        $current_school_session_id = $this->getSchoolCurrentSession();
        $class_id = $request->query('class_id', 0);
        $section_id = $request->query('section_id', 0);

        try {
            $school_classes = $this->schoolClassRepository->getAllBySession($current_school_session_id);
            $studentList = $this->userRepository->getAllStudents($current_school_session_id, $class_id, $section_id);

            $data = [
                'studentList'    => $studentList,
                'school_classes' => $school_classes,
            ];

            return view('students.list', $data);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new student.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStudent()
    {
        $current_school_session_id = $this->getSchoolCurrentSession();
        $school_classes = $this->schoolClassRepository->getAllBySession($current_school_session_id);

        $data = [
            'current_school_session_id' => $current_school_session_id,
            'school_classes'            => $school_classes,
        ];

        return view('students.add', $data);
    }

    /**
     * Store a newly created student in storage.
     *
     * @param  StudentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storeStudent(StudentStoreRequest $request)
    {
        try {
            $this->userRepository->createStudent($request->validated());
            return back()->with('status', 'Student creation was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Display the specified student's profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showStudentProfile($id)
    {
        $student = $this->userRepository->findStudent($id);
        $current_school_session_id = $this->getSchoolCurrentSession();
        $promotionRepository = new PromotionRepository();
        $promotion_info = $promotionRepository->getPromotionInfoById($current_school_session_id, $id);

        $data = [
            'student'        => $student,
            'promotion_info' => $promotion_info,
        ];

        return view('students.profile', $data);
    }

    /**
     * Show the form for editing the specified student.
     *
     * @param  int  $student_id
     * @return \Illuminate\Http\Response
     */
    public function editStudent($student_id)
    {
        $student = $this->userRepository->findStudent($student_id);
        $studentParentInfoRepository = new StudentParentInfoRepository();
        $parent_info = $studentParentInfoRepository->getParentInfo($student_id);
        $promotionRepository = new PromotionRepository();
        $current_school_session_id = $this->getSchoolCurrentSession();
        $promotion_info = $promotionRepository->getPromotionInfoById($current_school_session_id, $student_id);

        $data = [
            'student'        => $student,
            'parent_info'    => $parent_info,
            'promotion_info' => $promotion_info,
        ];

        return view('students.edit', $data);
    }

    /**
     * Update the specified student in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateStudent(Request $request)
    {
        try {
            $this->userRepository->updateStudent($request->toArray());
            return back()->with('status', 'Student update was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
}