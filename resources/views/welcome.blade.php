<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edu-School-Management</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('favicon_io/favicon.ico')}}">
    <link rel="shortcut icon" sizes="16x16" href="{{asset('favicon_io/favicon-16x16.png')}}">
    <link rel="shortcut icon" sizes="32x32" href="{{asset('favicon_io/favicon-32x32.png')}}">
    <link rel="apple-touch-icon" href="{{asset('favicon_io/apple-touch-icon.png')}}">
    <link rel="icon" href="{{asset('favicon_io/android-chrome-192x192.png')}}" sizes="192x192">
    <link rel="icon" href="{{asset('favicon_io/android-chrome-512x512.png')}}" sizes="512x512">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="សាលាបឋមសិក្សាតាម៉ា - ដំណោះស្រាយមួយសម្រាប់ការគ្រប់គ្រងស្ថាប័នអប់រំប្រកបដោយប្រសិទ្ធភាព និងទំនើបកម្ម។">
    <meta name="keywords" content="school management, education, សាលាបឋមសិក្សាតាម៉ា, គ្រប់គ្រងសាលា">
    <meta name="author" content="Edu-School Management">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Khmer OS Battambang', 'Inter', sans-serif;
            background-color: var(--white);
            color: var(--text-dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Improved Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: var(--white);
            padding: 1rem 0;
            z-index: 1000;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            height: 40px;
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        .nav-links {
            display: flex;
            list-style: none;
            align-items: center;
            gap: 2rem;
        }

        .nav-links a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        .login-btn, .register-btn {
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .login-btn {
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .register-btn {
            background-color: var(--primary-color);
            color: var(--white) !important;
            border: 2px solid var(--primary-color);
        }

        .login-btn:hover {
            background-color: var(--primary-color);
            color: var(--white) !important;
        }

        .register-btn:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        /* Improved Hero Section */
        .hero-section {
            padding-top: 80px;
            min-height: calc(100vh - 80px);
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        }

        .hero-content {
            flex: 1;
            padding: 4rem 0;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-content p {
            font-size: 1.25rem;
            color: var(--text-light);
            margin-bottom: 2rem;
            max-width: 600px;
        }

        .btn-primary {
            display: inline-block;
            background-color: var(--primary-color);
            color: var(--white);
            padding: 1rem 2rem;
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* Improved Features Section */
        .features-section {
            padding: 6rem 0;
            background-color: var(--white);
        }

        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .section-title p {
            color: var(--text-light);
            max-width: 600px;
            margin: 0 auto;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .feature-card {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 1rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
        }

        .feature-card i {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            color: var(--text-dark);
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }

        .feature-card p {
            color: var(--text-light);
        }

        /* Footer */
        footer {
            background-color: var(--text-dark);
            color: var(--white);
            padding: 2rem 0;
            text-align: center;
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--text-dark);
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background-color: var(--white);
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }

            .nav-links.active {
                display: flex;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .hero-content h1 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Loading Animation -->
    <div id="loading" class="fixed inset-0 bg-white flex items-center justify-center z-50">
        <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
    </div>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="container navbar-content">
            <a href="#" class="logo">
                <img src="{{asset('favicon_io/school.png')}}" alt="Edu-School Logo" loading="lazy">
            </a>
            <button class="mobile-menu-btn" aria-label="Toggle Menu">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-links">
                <li><a href="#home"><i class="fas fa-home"></i> ទំព័រដើម</a></li>
                <li><a href="#features"><i class="fas fa-tasks"></i> មុខងារ</a></li>
                <li><a href="#about"><i class="fas fa-info-circle"></i> អំពីយើង</a></li>
                <li><a href="#contact"><i class="fas fa-envelope"></i> ទំនាក់ទំនង</a></li> 
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ url('/home') }}" class="login-btn"><i class="fas fa-user"></i> Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="login-btn"><i class="fas fa-sign-in-alt"></i> ចូលប្រើប្រាស់</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" class="register-btn"><i class="fas fa-user-plus"></i> ចុះឈ្មោះ</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container hero-content">
            <h1>សាលាបឋមសិក្សាតាម៉ា</h1>
            <p>ដំណោះស្រាយមួយសម្រាប់ការគ្រប់គ្រងស្ថាប័នអប់រំប្រកបដោយប្រសិទ្ធភាព និងទំនើបកម្ម។</p>
            <a href="#features" class="btn-primary">ស្វែងយល់បន្ថែម <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="features">
        <div class="container">
            <div class="section-title">
                <h2>មុខងារសំខាន់ៗ</h2>
                <p>ប្រព័ន្ធគ្រប់គ្រងការអប់រំដែលមានមុខងារពេញលេញសម្រាប់គ្រប់គ្រងសាលារៀន។</p>
            </div>
            <div class="feature-grid">
                <div class="feature-card">
                    <i class="fas fa-users"></i>
                    <h3>ការគ្រប់គ្រងសិស្ស</h3>
                    <p>គ្រប់គ្រងព័ត៌មានសិស្ស ការចុះឈ្មោះ និងការតាមដានវឌ្ឍនភាព។</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h3>ការគ្រប់គ្រងគ្រូ</h3>
                    <p>គ្រប់គ្រងព័ត៌មានគ្រូ កាលវិភាគបង្រៀន និងការវាយតម្លៃ។</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-calendar-alt"></i>
                    <h3>កាលវិភាគ</h3>
                    <p>រៀបចំកាលវិភាគសិក្សា និងការប្រជុំផ្សេងៗ។</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Edu-School Management. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navLinks = document.querySelector('.nav-links');
        
        mobileMenuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    </script>
</body>
</html>