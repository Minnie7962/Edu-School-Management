<div class="col-xs-1 col-sm-1 col-md-1 col-lg-2 col-xl-2 col-xxl-2 border-end px-0">
    <div class="d-flex flex-column align-items-center align-items-sm-start">
        <ul class="nav flex-column pt-2 w-100">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ url('home') }}" aria-label="Dashboard">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    <span class="d-none d-xl-inline">{{ __('ទំព័រដើម') }}</span>
                </a>
            </li>

            <!-- Classes -->
            @can('view classes')
                @php
                    $latest_session = \App\Models\SchoolSession::latest()->first();
                    $classCount = session()->has('browse_session_id')
                        ? \App\Models\SchoolClass::where('session_id', session('browse_session_id'))->count()
                        : ($latest_session ? \App\Models\SchoolClass::where('session_id', $latest_session->id)->count() : 0);
                @endphp
                <li class="nav-item">
                    <a class="nav-link d-flex {{ request()->is('classes') ? 'active' : '' }}" href="{{ url('classes') }}" aria-label="Classes">
                        <i class="fas fa-layer-group me-2"></i>
                        <span class="d-none d-xl-inline">{{ __('ថ្នាក់រៀន') }}</span>
                        <span class="badge bg-secondary ms-auto">{{ $classCount }}</span>
                    </a>
                </li>
            @endcan

            <!-- Students -->
            @if(Auth::user()->role != "student")
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('students*') ? 'active' : '' }}" href="#student-submenu" data-bs-toggle="collapse" aria-label="Students">
                        <i class="fas fa-users me-2"></i>
                        <span class="d-none d-xl-inline">{{ __('សិក្សានុសិស្ស') }}</span>
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <ul class="nav collapse {{ request()->is('students*') ? 'show' : '' }}" id="student-submenu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('student.list.show') ? 'active' : '' }}" href="{{ route('student.list.show') }}" aria-label="View Students">
                                <i class="fas fa-list me-2"></i> {{ __('បញ្ជីពណ៍នាសិស្ស') }}
                            </a>
                        </li>
                        @if (!session()->has('browse_session_id') && Auth::user()->role == "admin")
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('student.create.show') ? 'active' : '' }}" href="{{ route('student.create.show') }}" aria-label="Add Student">
                                    <i class="fas fa-user-plus me-2"></i> {{ __('ចុះឈ្មោះសិស្ស') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            <!-- Teachers -->
            @if(Auth::user()->role != "student")
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('teachers*') ? 'active' : '' }}" href="#teacher-submenu" data-bs-toggle="collapse" aria-label="Teachers">
                        <i class="fas fa-chalkboard-teacher me-2"></i>
                        <span class="d-none d-xl-inline">{{ __('គ្រូបង្រៀន') }}</span>
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <ul class="nav collapse {{ request()->is('teachers*') ? 'show' : '' }}" id="teacher-submenu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('teacher.list.show') ? 'active' : '' }}" href="{{ route('teacher.list.show') }}" aria-label="View Teachers">
                                <i class="fas fa-list me-2"></i> {{ __('បញ្ជីឈ្មោះគ្រូបង្រៀន') }}
                            </a>
                        </li>
                        @if (!session()->has('browse_session_id') && Auth::user()->role == "admin")
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('teacher.create.show') ? 'active' : '' }}" href="{{ route('teacher.create.show') }}" aria-label="Add Teacher">
                                    <i class="fas fa-user-plus me-2"></i> {{ __('បន្ថែមគ្រូបង្រៀន') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            <!-- My Courses (Teacher) -->
            @if(Auth::user()->role == "teacher")
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('courses/teacher*') || request()->is('courses/assignments*')) ? 'active' : '' }}" href="{{ route('course.teacher.list.show', ['teacher_id' => Auth::user()->id]) }}" aria-label="My Courses">
                        <i class="fas fa-book me-2"></i>
                        <span class="d-none d-xl-inline">{{ __('មុខវិជ្ជា') }}</span>
                    </a>
                </li>
            @endif

            <!-- Student-Specific Menu -->
            @if(Auth::user()->role == "student")
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('student.attendance.show') ? 'active' : '' }}" href="{{ route('student.attendance.show', ['id' => Auth::user()->id]) }}" aria-label="Attendance">
                        <i class="fas fa-calendar-check me-2"></i>
                        <span class="d-none d-xl-inline">{{ __('វត្តមាន') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('course.student.list.show') ? 'active' : '' }}" href="{{ route('course.student.list.show', ['student_id' => Auth::user()->id]) }}" aria-label="Courses">
                        <i class="fas fa-book me-2"></i>
                        <span class="d-none d-xl-inline">{{ __('មុខវិជ្ជា') }}</span>
                    </a>
                </li>
                <li class="nav-item border-bottom">
                    @php
                        $class_info = session()->has('browse_session_id')
                            ? \App\Models\Promotion::where('session_id', session('browse_session_id'))->where('student_id', Auth::user()->id)->first()
                            : ($latest_session ? \App\Models\Promotion::where('session_id', $latest_session->id)->where('student_id', Auth::user()->id)->first() : []);
                    @endphp
                    <a class="nav-link" href="{{ route('section.routine.show', ['class_id' => $class_info->class_id, 'section_id' => $class_info->section_id]) }}" aria-label="Routine">
                        <i class="fas fa-calendar-alt me-2"></i>
                        <span class="d-none d-xl-inline">{{ __('កាលវិភាគ') }}</span>
                    </a>
                </li>
            @endif

            <!-- Exams / Grades -->
            @if(Auth::user()->role != "student")
                <li class="nav-item border-bottom">
                    <a class="nav-link {{ request()->is('exams*') ? 'active' : '' }}" href="#exam-grade-submenu" data-bs-toggle="collapse" aria-label="Exams / Grades">
                        <i class="fas fa-file-alt me-2"></i>
                        <span class="d-none d-xl-inline">{{ __('ប្រឡង / ពិន្ទុ') }}</span>
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <ul class="nav collapse {{ request()->is('exams*') ? 'show' : '' }}" id="exam-grade-submenu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('exam.list.show') ? 'active' : '' }}" href="{{ route('exam.list.show') }}" aria-label="View Exams">
                                <i class="fas fa-list me-2"></i> {{ __('ពណ៍នាប្រឡង') }}
                            </a>
                        </li>
                        @if (Auth::user()->role == "admin" || Auth::user()->role == "teacher")
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('exam.create.show') ? 'active' : '' }}" href="{{ route('exam.create.show') }}" aria-label="Create Exams">
                                    <i class="fas fa-plus-circle me-2"></i> {{ __('បង្កើតប្រឡង') }}
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->role == "admin")
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('exam.grade.system.create') ? 'active' : '' }}" href="{{ route('exam.grade.system.create') }}" aria-label="Add Grade Systems">
                                    <i class="fas fa-plus-circle me-2"></i> {{ __('បន្ថែមប្រព័ន្ធពិន្ទុ') }}
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('exam.grade.system.index') ? 'active' : '' }}" href="{{ route('exam.grade.system.index') }}" aria-label="View Grade Systems">
                                <i class="fas fa-list-alt me-2"></i> {{ __('ពណ៍នាប្រព័ន្ធពិន្ទុ') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Admin-Specific Menu -->
            @if (Auth::user()->role == "admin")
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('notice*') ? 'active' : '' }}" href="{{ route('notice.create') }}" aria-label="Notice">
                        <i class="fas fa-bullhorn me-2"></i>
                        <span class="d-none d-xl-inline">{{ __('សេចក្ដីជូនដំណឹង') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('calendar-event*') ? 'active' : '' }}" href="{{ route('events.show') }}" aria-label="Event">
                        <i class="fas fa-calendar-day me-2"></i>
                        <span class="d-none d-xl-inline">{{ __('ព្រឹត្តិការណ៍') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('syllabus*') ? 'active' : '' }}" href="{{ route('class.syllabus.create') }}" aria-label="Syllabus">
                        <i class="fas fa-book-open me-2"></i>
                        <span class="d-none d-xl-inline">{{ __('កម្មវិធីសិក្សា') }}</span>
                    </a>
                </li>
                <li class="nav-item border-bottom">
                    <a class="nav-link {{ request()->is('routine*') ? 'active' : '' }}" href="{{ route('section.routine.create') }}" aria-label="Routine">
                        <i class="fas fa-calendar-alt me-2"></i>
                        <span class="d-none d-xl-inline">{{ __('កាលវិភាគ') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('academics*') ? 'active' : '' }}" href="{{ url('academics/settings') }}" aria-label="Academic">
                        <i class="fas fa-tools me-2"></i>
                        <span class="d-none d-xl-inline">{{ __('Academic') }}</span>
                    </a>
                </li>

            @endif

            <!-- Disabled Menu Items -->
            <li class="nav-item">
                <a class="nav-link disabled" href="#" aria-disabled="true" aria-label="Payment">
                    <i class="fas fa-money-bill-wave me-2"></i>
                    <span class="d-none d-xl-inline">{{ __('ការទូទាត់') }}</span>
                </a>
            </li>
            @if (Auth::user()->role == "admin")
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" aria-disabled="true" aria-label="Staff">
                        <i class="fas fa-users-cog me-2"></i>
                        <span class="d-none d-xl-inline">{{ __('បុគ្គលិក') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" aria-disabled="true" aria-label="Library">
                        <i class="fas fa-book-reader me-2"></i>
                        <span class="d-none d-xl-inline">{{ __('បណ្ណាល័យ') }}</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>