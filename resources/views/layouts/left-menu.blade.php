<div class="col-xs-1 col-sm-1 col-md-1 col-lg-2 col-xl-2 col-xxl-2 border-end px-0">
    <div class="d-flex flex-column align-items-center align-items-sm-start">
        <ul class="nav flex-column pt-2 w-100">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ url('home') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    <span class="d-none d-xl-inline">{{ __('Dashboard') }}</span>
                </a>
            </li>

            <!-- Classes -->
            @can('view classes')
                <li class="nav-item">
                    @php
                        if (session()->has('browse_session_id')) {
                            $classCount = \App\Models\SchoolClass::where('session_id', session('browse_session_id'))->count();
                        } else {
                            $latest_session = \App\Models\SchoolSession::latest()->first();
                            $classCount = $latest_session ? \App\Models\SchoolClass::where('session_id', $latest_session->id)->count() : 0;
                        }
                    @endphp
                    <a class="nav-link d-flex {{ request()->is('classes') ? 'active' : '' }}" href="{{ url('classes') }}">
                        <i class="fas fa-layer-group me-2"></i>
                        <span class="d-none d-xl-inline">Classes</span>
                        <span class="badge bg-secondary ms-auto">{{ $classCount }}</span>
                    </a>
                </li>
            @endcan

            <!-- Students -->
            @if(Auth::user()->role != "student")
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('students*') ? 'active' : '' }}" href="#student-submenu" data-bs-toggle="collapse">
                        <i class="fas fa-users me-2"></i>
                        <span class="d-none d-xl-inline">Students</span>
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <ul class="nav collapse {{ request()->is('students*') ? 'show' : '' }}" id="student-submenu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('student.list.show') ? 'active' : '' }}" href="{{ route('student.list.show') }}">
                                <i class="fas fa-list me-2"></i> View Students
                            </a>
                        </li>
                        @if (!session()->has('browse_session_id') && Auth::user()->role == "admin")
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('student.create.show') ? 'active' : '' }}" href="{{ route('student.create.show') }}">
                                    <i class="fas fa-user-plus me-2"></i> Add Student
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            <!-- Teachers -->
            @if(Auth::user()->role != "student")
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('teachers*') ? 'active' : '' }}" href="#teacher-submenu" data-bs-toggle="collapse">
                        <i class="fas fa-chalkboard-teacher me-2"></i>
                        <span class="d-none d-xl-inline">Teachers</span>
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <ul class="nav collapse {{ request()->is('teachers*') ? 'show' : '' }}" id="teacher-submenu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('teacher.list.show') ? 'active' : '' }}" href="{{ route('teacher.list.show') }}">
                                <i class="fas fa-list me-2"></i> View Teachers
                            </a>
                        </li>
                        @if (!session()->has('browse_session_id') && Auth::user()->role == "admin")
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('teacher.create.show') ? 'active' : '' }}" href="{{ route('teacher.create.show') }}">
                                    <i class="fas fa-user-plus me-2"></i> Add Teacher
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            <!-- My Courses (Teacher) -->
            @if(Auth::user()->role == "teacher")
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('courses/teacher*') || request()->is('courses/assignments*')) ? 'active' : '' }}" href="{{ route('course.teacher.list.show', ['teacher_id' => Auth::user()->id]) }}">
                        <i class="fas fa-book me-2"></i>
                        <span class="d-none d-xl-inline">My Courses</span>
                    </a>
                </li>
            @endif

            <!-- Student-Specific Menu -->
            @if(Auth::user()->role == "student")
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('student.attendance.show') ? 'active' : '' }}" href="{{ route('student.attendance.show', ['id' => Auth::user()->id]) }}">
                        <i class="fas fa-calendar-check me-2"></i>
                        <span class="d-none d-xl-inline">Attendance</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('course.student.list.show') ? 'active' : '' }}" href="{{ route('course.student.list.show', ['student_id' => Auth::user()->id]) }}">
                        <i class="fas fa-book me-2"></i>
                        <span class="d-none d-xl-inline">Courses</span>
                    </a>
                </li>
                <li class="nav-item border-bottom">
                    @php
                        if (session()->has('browse_session_id')) {
                            $class_info = \App\Models\Promotion::where('session_id', session('browse_session_id'))->where('student_id', Auth::user()->id)->first();
                        } else {
                            $latest_session = \App\Models\SchoolSession::latest()->first();
                            $class_info = $latest_session ? \App\Models\Promotion::where('session_id', $latest_session->id)->where('student_id', Auth::user()->id)->first() : [];
                        }
                    @endphp
                    <a class="nav-link" href="{{ route('section.routine.show', ['class_id' => $class_info->class_id, 'section_id' => $class_info->section_id]) }}">
                        <i class="fas fa-calendar-alt me-2"></i>
                        <span class="d-none d-xl-inline">Routine</span>
                    </a>
                </li>
            @endif

            <!-- Exams / Grades -->
            @if(Auth::user()->role != "student")
                <li class="nav-item border-bottom">
                    <a class="nav-link {{ request()->is('exams*') ? 'active' : '' }}" href="#exam-grade-submenu" data-bs-toggle="collapse">
                        <i class="fas fa-file-alt me-2"></i>
                        <span class="d-none d-xl-inline">Exams / Grades</span>
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <ul class="nav collapse {{ request()->is('exams*') ? 'show' : '' }}" id="exam-grade-submenu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('exam.list.show') ? 'active' : '' }}" href="{{ route('exam.list.show') }}">
                                <i class="fas fa-list me-2"></i> View Exams
                            </a>
                        </li>
                        @if (Auth::user()->role == "admin" || Auth::user()->role == "teacher")
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('exam.create.show') ? 'active' : '' }}" href="{{ route('exam.create.show') }}">
                                    <i class="fas fa-plus-circle me-2"></i> Create Exams
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->role == "admin")
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('exam.grade.system.create') ? 'active' : '' }}" href="{{ route('exam.grade.system.create') }}">
                                    <i class="fas fa-plus-circle me-2"></i> Add Grade Systems
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('exam.grade.system.index') ? 'active' : '' }}" href="{{ route('exam.grade.system.index') }}">
                                <i class="fas fa-list-alt me-2"></i> View Grade Systems
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Admin-Specific Menu -->
            @if (Auth::user()->role == "admin")
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('notice*') ? 'active' : '' }}" href="{{ route('notice.create') }}">
                        <i class="fas fa-bullhorn me-2"></i>
                        <span class="d-none d-xl-inline">Notice</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('calendar-event*') ? 'active' : '' }}" href="{{ route('events.show') }}">
                        <i class="fas fa-calendar-day me-2"></i>
                        <span class="d-none d-xl-inline">Event</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('syllabus*') ? 'active' : '' }}" href="{{ route('class.syllabus.create') }}">
                        <i class="fas fa-book-open me-2"></i>
                        <span class="d-none d-xl-inline">Syllabus</span>
                    </a>
                </li>
                <li class="nav-item border-bottom">
                    <a class="nav-link {{ request()->is('routine*') ? 'active' : '' }}" href="{{ route('section.routine.create') }}">
                        <i class="fas fa-calendar-alt me-2"></i>
                        <span class="d-none d-xl-inline">Routine</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('academics*') ? 'active' : '' }}" href="{{ url('academics/settings') }}">
                        <i class="fas fa-tools me-2"></i>
                        <span class="d-none d-xl-inline">Academic</span>
                    </a>
                </li>
                @if (!session()->has('browse_session_id'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('promotions*') ? 'active' : '' }}" href="{{ url('promotions/index') }}">
                            <i class="fas fa-sort-numeric-up-alt me-2"></i>
                            <span class="d-none d-xl-inline">Promotion</span>
                        </a>
                    </li>
                @endif
            @endif

            <!-- Disabled Menu Items -->
            <li class="nav-item">
                <a class="nav-link disabled" href="#" aria-disabled="true">
                    <i class="fas fa-money-bill-wave me-2"></i>
                    <span class="d-none d-xl-inline">Payment</span>
                </a>
            </li>
            @if (Auth::user()->role == "admin")
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" aria-disabled="true">
                        <i class="fas fa-users-cog me-2"></i>
                        <span class="d-none d-xl-inline">Staff</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" aria-disabled="true">
                        <i class="fas fa-book-reader me-2"></i>
                        <span class="d-none d-xl-inline">Library</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>