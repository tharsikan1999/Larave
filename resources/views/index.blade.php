<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <style>
        /* Global styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            min-height: 100vh;
            background: linear-gradient(to top right, #000000, #ff0000, #000000, #ff0000); /* Gradient colors */
            color: #fff; /* Text color */
            overflow: hidden; /* Hide overflow during loading */
        }

        /* Loading animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeIn 2s ease-in-out forwards; /* Fade in animation */
        }

        @keyframes fadeIn {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
                visibility: hidden;
            }
        }

        /* Main content */
        main {
            text-align: center;
        }

        main h1 {
            font-size: 3em;
            margin-bottom: 50px; /* Reduce margin for smaller screens */
            color: transparent;
            animation: colorChange 2s infinite alternate;
        }

        .tharsikan {
            color: transparent;
            animation: colorChange 2s infinite alternate;
        }

        main p {
            font-size: 1.3em;
            margin-bottom: 50px; /* Reduce margin for smaller screens */
        }

        .login, .register , .dashboard {
            font-weight: 900;
            font-size: 1.5em;
        }

        @keyframes colorChange {
            0% {
                color: #ff0000; /* Red */
            }
            25% {
                color: #ffffff; /* White */
            }
            50% {
                color: #000000; /* Black */
            }
            75% {
                color: #ffffff; /* White */
            }
            100% {
                color: #ff0000; /* Red */
            }
        }

        /* Header items */
        .header-items {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .header-items a {
            color: #fff;
            text-decoration: none;
            margin-left: 10px;
        }

        .header-items a:hover {
            color: #ff2d20;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 10px 0;
            color: #fff;
            width: 100%; /* Full width */
            position: absolute;
            bottom: 0; 
            color: #000000;
        }

        /* Footer link */
        footer a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #ff2d20;
        }

        /* Responsive styles */
        @media only screen and (max-width: 768px) {
            main h1 {
                font-size: 2.5em; /* Decrease font size for smaller screens */
                margin-bottom: 30px; /* Reduce margin for smaller screens */
            }
            main p {
                font-size: 1em; /* Decrease font size for smaller screens */
                margin-bottom: 30px; /* Reduce margin for smaller screens */
            }
        }

        @media only screen and (max-width: 480px) {
            main h1 {
                font-size: 2em; /* Further decrease font size for smaller screens */
                margin-bottom: 20px; /* Reduce margin further for smaller screens */
            }
            main p {
                font-size: 0.9em; /* Further decrease font size for smaller screens */
                margin-bottom: 20px; /* Reduce margin further for smaller screens */
            }
        }
    </style>
</head>
<body>
    <!-- Loading overlay -->
    <div class="loading-overlay">
        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
            <rect x="15" y="30" width="10" height="40" fill="#fff">
                <animate attributeName="y" values="30; 50; 30" dur="1s" repeatCount="indefinite" />
                <animate attributeName="height" values="40; 20; 40" dur="1s" repeatCount="indefinite" />
            </rect>
            <rect x="35" y="30" width="10" height="40" fill="#fff">
                <animate attributeName="y" values="30; 50; 30" dur="1s" repeatCount="indefinite" />
                <animate attributeName="height" values="40; 20; 40" dur="1s" repeatCount="indefinite" />
            </rect>
            <rect x="55" y="30" width="10" height="40" fill="#fff">
                <animate attributeName="y" values="30; 50; 30" dur="1s" repeatCount="indefinite" />
                <animate attributeName="height" values="40; 20; 40" dur="1s" repeatCount="indefinite" />
            </rect>
            <rect x="75" y="30" width="10" height="40" fill="#fff">
                <animate attributeName="y" values="30; 50; 30" dur="1s" repeatCount="indefinite" />
                <animate attributeName="height" values="40; 20; 40" dur="1s" repeatCount="indefinite" />
            </rect>
        </svg>
    </div>

    <!-- Header items -->
    <div class="header-items">
        @if (Route::has('login'))
        <nav>
            @auth
            <a class="dashboard" href="{{ url('/dashboard') }}">Dashboard</a>
            @else
            <a class="login" href="{{ route('login') }}">Log in</a>

            @if (Route::has('register'))
            <a class="register" href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </nav>
        @endif
    </div>

    <!-- Main content -->
    <main>
        <h1>Student Management System</h1>
        <p>Welcome to the Student Management System. Log in or register to get started with managing your students.</p>
    </main>

    <!-- Footer -->
    <footer>
        <p>Developed with ❤️ by <span class="tharsikan">Tharsikan</span>. Powered by Laravel v{{ Illuminate\Foundation\Application::VERSION }}.</p>
    </footer>
</body>
</html>
