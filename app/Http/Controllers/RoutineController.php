<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoutineStoreRequest;
use App\Models\Routine;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Repositories\RoutineRepository;
use App\Interfaces\SchoolClassInterface;
use App\Interfaces\SchoolSessionInterface;

class RoutineController extends Controller
{
    use SchoolSession;
    protected $schoolSessionRepository;
    protected $schoolClassRepository;

    public function __construct(SchoolSessionInterface $schoolSessionRepository, SchoolClassInterface $schoolClassRepository)
    {
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->schoolClassRepository = $schoolClassRepository;
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

        $data = [
            'current_school_session_id' => $current_school_session_id,
            'classes'                   => $school_classes,
        ];

        return response()->view('routines.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoutineStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoutineStoreRequest $request)
    {
        try {
            $routineRepository = new RoutineRepository();
            $routineRepository->saveRoutine($request->validated());

            return back()->with('status', 'Routine save was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $routine
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $class_id = $request->query('class_id', 0);
        $section_id = $request->query('section_id', 0);
        $current_school_session_id = $this->getSchoolCurrentSession();
        $routineRepository = new RoutineRepository();
        $routines = $routineRepository->getAll($class_id, $section_id, $current_school_session_id);
        $routines = $routines->sortBy('weekday')->groupBy('weekday');

        $data = [
            'routines' => $routines
        ];

        return response()->view('routines.show', $data);
    }
}
