<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>URBIX | The Future of Smart Cities</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <style>
        /* AUTH NAVIGATION */

        .nav-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            flex-wrap: wrap;
        }

        .nav-auth-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 19px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 6px;
            color: #ffffff;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 500;
            transition: 0.3s ease;
            background: transparent;
        }

        .nav-auth-button:hover {
            color: #ffffff;
            border-color: #8c7cff;
            box-shadow: 0 0 15px rgba(140, 124, 255, 0.45);
            transform: translateY(-2px);
        }

        .nav-register-button {
            background: linear-gradient(135deg, #635bff, #9b5cff);
            border: 1px solid transparent;
        }

        .nav-register-button:hover {
            box-shadow: 0 0 22px rgba(140, 92, 255, 0.6);
        }

        .nav-user-name {
            color: #ffffff;
            font-size: 12px;
            font-family: 'Poppins', sans-serif;
            white-space: nowrap;
        }

        .nav-logout-form {
            margin: 0;
            display: inline-flex;
        }

        .nav-logout-button {
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
        }

        .nav-dashboard-button {
            border-color: #8c7cff;
            color: #c5baff;
        }

        @media (max-width: 1100px) {
            .nav-actions {
                gap: 7px;
            }

            .nav-auth-button {
                padding: 8px 12px;
                font-size: 11px;
            }
        }

        @media (max-width: 768px) {
            .nav-actions {
                justify-content: center;
                margin-top: 12px;
            }
        }
    </style>

</head>

<body>

    <!-- LOADER -->

    <div class="loader">

        <h1>URBIX<span>.</span></h1>

        <div class="loader-line"></div>

        <p>BUILDING THE FUTURE...</p>

    </div>


    <!-- BACKGROUND -->

    <div class="background-glow glow-one"></div>

    <div class="background-glow glow-two"></div>


    <!-- NAVBAR -->

    <header class="navbar">

        <a href="{{ route('home') }}" class="logo">
            URBIX<span>.</span>
        </a>


        <nav>

            <a href="#home">Home</a>

            <a href="#about">About</a>

            <a href="#features">Features</a>

            <a href="#city">Explore City</a>

        </nav>


        <!-- AUTHENTICATION NAVIGATION -->

        <div class="nav-actions">

            @guest

                <!-- LOGIN -->

                <a href="{{ route('login') }}" class="nav-auth-button">
                    Login
                </a>


                <!-- REGISTER -->

                <a href="{{ route('register') }}" class="nav-auth-button nav-register-button">
                    Create Account ↗
                </a>


                <!-- REPORT ISSUE -->

                <a href="{{ route('login') }}" class="nav-button">
                    Report Issue ↗
                </a>

            @else

                <!-- USER NAME -->

                <span class="nav-user-name">
                    Hello, {{ auth()->user()->name }}
                </span>


                <!-- CITIZEN DASHBOARD -->

                @if(auth()->user()->role === 'citizen')

                    <a href="{{ route('citizen.dashboard') }}"
                       class="nav-auth-button nav-dashboard-button">

                        Citizen Dashboard

                    </a>

                    <a href="{{ route('report') }}" class="nav-button">
                        Report Issue ↗
                    </a>

                @endif


                <!-- STAFF DASHBOARD -->

                @if(auth()->user()->role === 'staff')

                    <a href="{{ route('staff.dashboard') }}"
                       class="nav-auth-button nav-dashboard-button">

                        Staff Dashboard

                    </a>

                @endif


                <!-- ADMIN DASHBOARD -->

                @if(auth()->user()->role === 'admin')

                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-auth-button nav-dashboard-button">

                        Admin Dashboard

                    </a>

                @endif


                <!-- LOGOUT -->

                <form action="{{ route('logout') }}"
                      method="POST"
                      class="nav-logout-form">

                    @csrf

                    <button type="submit"
                            class="nav-auth-button nav-logout-button">

                        Logout ↗

                    </button>

                </form>

            @endguest

        </div>

    </header>


    <!-- HERO -->

    <section class="hero" id="home">

        <div class="hero-content">

            <div class="hero-tag">

                <span class="live-dot"></span>

                SMART CITY ECOSYSTEM 2026

            </div>


            <h1>

                THE FUTURE<br>

                OF <span>SMART</span><br>

                CITIES.

            </h1>


            <p>

                A smarter world begins with a single action.

                Connect with your city, report problems and

                create a better tomorrow.

            </p>


            <div class="hero-buttons">

                <a href="#city" class="primary-button">

                    Explore City ↗

                </a>


                @guest

                    <a href="{{ route('login') }}" class="secondary-button">

                        Report a Problem

                    </a>

                @else

                    @if(auth()->user()->role === 'citizen')

                        <a href="{{ route('report') }}" class="secondary-button">

                            Report a Problem

                        </a>

                    @else

                        @if(auth()->user()->role === 'admin')

                            <a href="{{ route('admin.dashboard') }}" class="secondary-button">

                                Admin Dashboard

                            </a>

                        @elseif(auth()->user()->role === 'staff')

                            <a href="{{ route('staff.dashboard') }}" class="secondary-button">

                                Staff Dashboard

                            </a>

                        @endif

                    @endif

                @endguest

            </div>


            <!-- HERO STATS -->

            <div class="hero-stats">

                <div>

                    <h2>24<span>/7</span></h2>

                    <p>City Monitoring</p>

                </div>


                <div>

                    <h2>100<span>%</span></h2>

                    <p>Digital Connect</p>

                </div>


                <div>

                    <h2>∞</h2>

                    <p>Smart Possibilities</p>

                </div>

            </div>

        </div>


        <!-- 3D CITY -->

        <div class="city-container">

            <div class="city-label">

                <span class="live-dot"></span>

                LIVE CITY VISUALIZATION

            </div>


            <canvas id="cityCanvas"></canvas>


            <div class="city-bottom-label">

                <span>URBIX DIGITAL TWIN</span>

                <span>3D EXPERIENCE / 001</span>

            </div>

        </div>


        <div class="scroll-indicator">

            SCROLL TO EXPLORE

            <span></span>

        </div>

    </section>


    <!-- ABOUT -->

    <section class="about section" id="about">

        <div class="section-label">

            01 / ABOUT URBIX

        </div>


        <div class="about-content">

            <h2>

                A CITY THAT<br>

                <span>THINKS AHEAD.</span>

            </h2>


            <p>

                URBIX is a next-generation smart city platform

                designed to connect citizens, departments and

                urban infrastructure through intelligent technology.

            </p>

        </div>


        <div class="about-cards">

            <div class="info-card">

                <span>01</span>

                <h3>Connect</h3>

                <p>Connect citizens with city services.</p>

            </div>


            <div class="info-card">

                <span>02</span>

                <h3>Report</h3>

                <p>Report public infrastructure problems.</p>

            </div>


            <div class="info-card">

                <span>03</span>

                <h3>Transform</h3>

                <p>Build better cities through technology.</p>

            </div>

        </div>

    </section>


    <!-- FEATURES -->

    <section class="features section" id="features">

        <div class="section-label">

            02 / SMART ECOSYSTEM

        </div>


        <h2 class="section-title">

            TECHNOLOGY FOR<br>

            <span>BETTER LIVING.</span>

        </h2>


        <div class="feature-grid">

            <div class="feature-card">

                <div class="feature-icon">⌖</div>

                <h3>Smart Mapping</h3>

                <p>Explore city locations and reported issues.</p>

                <span>01 / LOCATION</span>

            </div>


            <div class="feature-card">

                <div class="feature-icon">◎</div>

                <h3>Issue Reporting</h3>

                <p>Report problems with photos and locations.</p>

                <span>02 / REPORT</span>

            </div>


            <div class="feature-card">

                <div class="feature-icon">↗</div>

                <h3>Live Tracking</h3>

                <p>Track complaints through every stage.</p>

                <span>03 / TRACK</span>

            </div>


            <div class="feature-card">

                <div class="feature-icon">◈</div>

                <h3>Smart Analytics</h3>

                <p>Understand city performance and progress.</p>

                <span>04 / ANALYTICS</span>

            </div>

        </div>

    </section>


    <!-- EXPLORE CITY -->

    <section class="city-section section" id="city">

        <div class="section-label">

            03 / EXPLORE THE FUTURE

        </div>


        <h2>

            YOUR CITY.<br>

            YOUR <span>VOICE.</span>

        </h2>


        <p>

            Be part of a smarter and more connected city.

            Every report is a step towards transformation.

        </p>


        <a href="#report" class="primary-button">

            Discover URBIX ↗

        </a>

    </section>


    <!-- REPORT -->

    <section class="report-section section" id="report">

        <div class="report-box">

            <div>

                <div class="section-label">

                    04 / TAKE ACTION

                </div>


                <h2>

                    MAKE YOUR CITY<br>

                    <span>BETTER TODAY.</span>

                </h2>


                <p>

                    See a problem? Report it.

                    Your voice can make a difference.

                </p>

            </div>


            @guest

                <a href="{{ route('login') }}" class="primary-button">

                    Login to Report ↗

                </a>

            @else

                @if(auth()->user()->role === 'citizen')

                    <a href="{{ route('report') }}" class="primary-button">

                        Report a Problem ↗

                    </a>

                @elseif(auth()->user()->role === 'staff')

                    <a href="{{ route('staff.dashboard') }}" class="primary-button">

                        Staff Dashboard ↗

                    </a>

                @elseif(auth()->user()->role === 'admin')

                    <a href="{{ route('admin.dashboard') }}" class="primary-button">

                        Admin Dashboard ↗

                    </a>

                @endif

            @endguest

        </div>

    </section>


    <!-- FOOTER -->

    <footer>

        <a href="{{ route('home') }}" class="logo">

            URBIX<span>.</span>

        </a>


        <p>Building smarter cities, together.</p>


        <span>© 2026 URBIX. All Rights Reserved.</span>

    </footer>


    <!-- 3D JAVASCRIPT -->

    <script type="module" src="{{ asset('js/city.js') }}"></script>


</body>

</html>