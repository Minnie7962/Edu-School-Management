<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GradingSystem;
use App\Traits\SchoolSession;
use App\Interfaces\SemesterInterface;
use App\Interfaces\SchoolClassInterface;
use App\Interfaces\SchoolSessionInterface;
use App\Http\Requests\GradingSystemStoreRequest;
use App\Repositories\GradingSystemRepository;

class GradingSystemController extends Controller
{
    use SchoolSession;

    protected $schoolClassRepository;
    protected $schoolSessionRepository;
    protected $semesterRepository;

    public function __construct(
        SchoolSessionInterface $schoolSessionRepository,
        SchoolClassInterface $schoolClassRepository,
        SemesterInterface $semesterRepository)
    {
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->schoolClassRepository = $schoolClassRepository;
        $this->semesterRepository = $semesterRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gradingSystemRepository = new GradingSystemRepository();
        $current_school_session_id = $this->getSchoolCurrentSession();
        $gradingSystems = $gradingSystemRepository->getAll($current_school_session_id);

        $data = [
            'gradingSystems'            => $gradingSystems,
            'current_school_session_id' => $current_school_session_id,
        ];

        return response()->view('exams.grade.view', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $current_school_session_id = $this->getSchoolCurrentSession();
        $school_classes = $this->schoolClassRepository->getAllBySession($current_school_session_id);
        $semesters = $this->semesterRepository->getAll($current_school_session_id);

        $data = [
            'current_school_session_id' => $current_school_session_id,
            'school_classes'            => $school_classes,
            'semesters'                 => $semesters,
        ];

        return response()->view('exams.grade.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GradingSystemStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradingSystemStoreRequest $request)
    {
        try {
            $gradingSystemRepository = new GradingSystemRepository();
            $gradingSystemRepository->store($request->validated());

            return back()->with('status', 'Creating grading system was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
}
