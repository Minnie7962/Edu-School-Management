<?php

namespace App\Repositories;

use App\Models\User;
use App\Traits\Base64ToFile;
use App\Interfaces\UserInterface;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\PromotionRepository;
use App\Repositories\StudentParentInfoRepository;
use App\Repositories\StudentAcademicInfoRepository;

class UserRepository implements UserInterface {
    use Base64ToFile;

    /**
     * @param mixed $request
     * @return string
    */
    public function createTeacher($request) {
        try {
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'first_name'    => $request['first_name'],
                    'last_name'     => $request['last_name'],
                    'email'         => $request['email'],
                    'gender'        => $request['gender'],
                    'nationality'   => $request['nationality'],
                    'phone'         => $request['phone'],
                    'address'       => $request['address'],
                    'address2'      => $request['address2'],
                    'city'          => $request['city'],
                    'zip'           => $request['zip'],
                    'photo'         => (!empty($request['photo']))?$this->convert($request['photo']):null,
                    'role'          => 'teacher',
                    'password'      => Hash::make($request['password']),
                ]);
                $user->givePermissionTo(
                    'create exams',
                    'view exams',
                    'create exams rule',
                    'view exams rule',
                    'edit exams rule',
                    'delete exams rule',
                    'take attendances',
                    'view attendances',
                    'create assignments',
                    'view assignments',
                    'save marks',
                    'view users',
                    'view routines',
                    'view syllabi',
                    'view events',
                    'view notices',
                );
            });
        } catch (\Exception $e) {
            throw new \Exception('Failed to create Teacher. '.$e->getMessage());
        }
    }

    /**
     * @param mixed $request
     * @return string
    */
    public function createStudent($request) {
        try {
            DB::transaction(function () use ($request) {
                $student = User::create([
                    'first_name'    => $request['first_name'],
                    'last_name'     => $request['last_name'],
                    'email'         => $request['email'],
                    'gender'        => $request['gender'],
                    'nationality'   => $request['nationality'],
                    'phone'         => $request['phone'],
                    'address'       => $request['address'],
                    'address2'      => $request['address2'],
                    'city'          => $request['city'],
                    'zip'           => $request['zip'],
                    'photo'         => (!empty($request['photo']))?$this->convert($request['photo']):null,
                    'birthday'      => $request['birthday'],
                    'religion'      => $request['religion'],
                    'blood_type'    => $request['blood_type'],
                    'role'          => 'student',
                    'password'      => Hash::make($request['password']),
                ]);

                // Store Parents' information
                $studentParentInfoRepository = new StudentParentInfoRepository();
                $studentParentInfoRepository->store($request, $student->id);

                // Store Academic information
                $studentAcademicInfoRepository = new StudentAcademicInfoRepository();
                $studentAcademicInfoRepository->store($request, $student->id);

                // Assign student to a Class and a Section
                $promotionRepository = new PromotionRepository();
                $promotionRepository->assignClassSection($request, $student->id);

                $student->givePermissionTo(
                    'view attendances',
                    'view assignments',
                    'submit assignments',
                    'view exams',
                    'view marks',
                    'view users',
                    'view routines',
                    'view syllabi',
                    'view events',
                    'view notices',
                );
            });
        } catch (\Exception $e) {
            throw new \Exception('Failed to create Student. '.$e->getMessage());
        }
    }

    public function updateStudent($request) {
        try {
            DB::transaction(function () use ($request) {
                User::where('id', $request['student_id'])->update([
                    'first_name'    => $request['first_name'],
                    'last_name'     => $request['last_name'],
                    'email'         => $request['email'],
                    'gender'        => $request['gender'],
                    'nationality'   => $request['nationality'],
                    'phone'         => $request['phone'],
                    'address'       => $request['address'],
                    'address2'      => $request['address2'],
                    'city'          => $request['city'],
                    'zip'           => $request['zip'],
                    'birthday'      => $request['birthday'],
                    'religion'      => $request['religion'],
                    'blood_type'    => $request['blood_type'],
                ]);

                // Update Parents' information
                $studentParentInfoRepository = new StudentParentInfoRepository();
                $studentParentInfoRepository->update($request, $request['student_id']);

                // Update Student's ID card number
                $promotionRepository = new PromotionRepository();
                $promotionRepository->update($request, $request['student_id']);
            });
        } catch (\Exception $e) {
            throw new \Exception('Failed to update Student. '.$e->getMessage());
        }
    }

    public function updateTeacher($request) {
        try {
            DB::transaction(function () use ($request) {
                User::where('id', $request['teacher_id'])->update([
                    'first_name'    => $request['first_name'],
                    'last_name'     => $request['last_name'],
                    'email'         => $request['email'],
                    'gender'        => $request['gender'],
                    'nationality'   => $request['nationality'],
                    'phone'         => $request['phone'],
                    'address'       => $request['address'],
                    'address2'      => $request['address2'],
                    'city'          => $request['city'],
                    'zip'           => $request['zip'],
                ]);
            });
        } catch (\Exception $e) {
            throw new \Exception('Failed to update Teacher. '.$e->getMessage());
        }
    }

    

    public function findTeacher($id) {
        try {
            return User::where('id', $id)->where('role', 'teacher')->first();
        } catch (\Exception $e) {
            throw new \Exception('Failed to get Teacher. '.$e->getMessage());
        }
    }

    public function getAllTeachers() {
        try {
            return User::where('role', 'teacher')->get();
        } catch (\Exception $e) {
            throw new \Exception('Failed to get all Teachers. '.$e->getMessage());
        }
    }

    public function findStudent($id) {
        try {
            return User::where('id', $id)->where('role', 'student')->first();
        } catch (\Exception $e) {
            throw new \Exception('Failed to get Student. '.$e->getMessage());
        }
    }

    public function getAllStudents($current_session, $class_id, $section_id) {
        try {
            return User::where('role', 'student')
                        ->whereHas('studentAcademicInfo', function($query) use ($current_session, $class_id, $section_id) {
                            $query->where('session_id', $current_session)
                                  ->where('class_id', $class_id)
                                  ->where('section_id', $section_id);
                        })->get();
        } catch (\Exception $e) {
            throw new \Exception('Failed to get all Students. '.$e->getMessage());
        }
    }

    public function getAllStudentsBySession($session_id) {
        try {
            return User::where('role', 'student')
                        ->whereHas('studentAcademicInfo', function($query) use ($session_id) {
                            $query->where('session_id', $session_id);
                        })->get();
        } catch (\Exception $e) {
            throw new \Exception('Failed to get all Students by session. '.$e->getMessage());
        }
    }

    public function getAllStudentsBySessionCount($session_id) {
        try {
            return User::where('role', 'student')
                        ->whereHas('studentAcademicInfo', function($query) use ($session_id) {
                            $query->where('session_id', $session_id);
                        })->count();
        } catch (\Exception $e) {
            throw new \Exception('Failed to get all Students count by session. '.$e->getMessage());
        }
    }

    public function changePassword($new_password) {
        try {
            return User::where('id', auth()->user()->id)->update([
                'password'  => Hash::make($new_password)
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to change password. '.$e->getMessage());
        }
    }
}