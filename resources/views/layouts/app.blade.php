<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>សាលាបឋមសិក្សាតាម៉ា</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon_io/favicon.ico') }}">
    <link rel="shortcut icon" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="shortcut icon" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('favicon_io/android-chrome-192x192.png') }}" sizes="192x192">
    <link rel="icon" href="{{ asset('favicon_io/android-chrome-512x512.png') }}" sizes="512x512">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        @font-face {
            font-family: 'Khmer OS Battambang';
            src: url('../fonts/Khmer-OS-BTB.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1e40af;
            --secondary-color: #f3f4f6;
            --accent-color: #3b82f6;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --white: #ffffff;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
        }

        body {
            font-family: 'Khmer OS Battambang', 'Inter', sans-serif;
            background-color: var(--white);
            color: var(--text-dark);
            line-height: 1.6;
        }

        .navbar {
            background-color: var(--white);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--text-dark) !important;
        }

        .navbar-brand:hover {
            color: var(--primary-color) !important;
        }

        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            color: var(--text-dark) !important;
        }

        .dropdown-item:hover {
            background-color: var(--secondary-color);
        }

        .badge {
            font-weight: 500;
        }

        #watermark {
            position: fixed;
            bottom: 10px;
            right: 10px;
            opacity: 0.2;
            font-size: 12px;
            color: var(--text-dark);
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom">
            <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('favicon_io/school.png') }}" alt="Edu-School Logo" loading="lazy" style="width: 38px; height: 40px;">
                សាលាបឋមសិក្សាតាម៉ា
            </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        @php
                            $latest_school_session = \App\Models\SchoolSession::latest()->first();
                            $current_school_session_name = $latest_school_session ? $latest_school_session->session_name : null;
                        @endphp
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                @if (session()->has('browse_session_name') && session('browse_session_name') !== $current_school_session_name)
                                    <a class="nav-link text-danger disabled" href="#" tabindex="-1" aria-disabled="true">
                                        <i class="fas fa-exclamation-circle me-2"></i> Browsing as Academic Session {{ session('browse_session_name') }}
                                    </a>
                                @elseif($latest_school_session)
                                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">
                                        Current Academic Session {{ $current_school_session_name }}
                                    </a>
                                @else
                                    <a class="nav-link text-danger disabled" href="#" tabindex="-1" aria-disabled="true">
                                        <i class="fas fa-exclamation-circle me-2"></i> Create an Academic Session.
                                    </a>
                                @endif
                            </li>
                        </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="badge bg-light text-dark">{{ ucfirst(Auth::user()->role) }}</span>
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('password.edit') }}">
                                        <i class="fas fa-key me-2"></i> Change Password
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Watermark -->
    <div id="watermark">
        <p>School Management System</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>