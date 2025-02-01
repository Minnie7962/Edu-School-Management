<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\UserInterface;
use App\Http\Requests\TeacherStoreRequest;

class TeacherController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->middleware(['can:view users']);
        $this->userRepository = $userRepository;
    }

    /**
     * Store a newly created teacher in storage.
     *
     * @param  TeacherStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storeTeacher(TeacherStoreRequest $request)
    {
        try {
            $this->userRepository->createTeacher($request->validated());
            return back()->with('status', 'Teacher creation was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified teacher.
     *
     * @param  int  $teacher_id
     * @return \Illuminate\Http\Response
     */
    public function editTeacher($teacher_id)
    {
        $teacher = $this->userRepository->findTeacher($teacher_id);
        $data = [
            'teacher' => $teacher,
        ];
        return response()->view('teachers.edit', $data);
    }

    /**
     * Update the specified teacher in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateTeacher(Request $request)
    {
        try {
            $this->userRepository->updateTeacher($request->toArray());
            return back()->with('status', 'Teacher update was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Display a listing of teachers.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTeacherList()
    {
        $teachers = $this->userRepository->getAllTeachers();
        $data = [
            'teachers' => $teachers,
        ];
        return response()->view('teachers.list', $data);
    }

    /**
     * Display the specified teacher's profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTeacherProfile($id)
    {
        $teacher = $this->userRepository->findTeacher($id);
        $data = [
            'teacher' => $teacher,
        ];
        return response()->view('teachers.profile', $data);
    }
}
