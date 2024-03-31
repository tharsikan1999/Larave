<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
    <style>
        /* Your existing CSS styles */
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure the body fills the viewport height */
            background-color: #f0f0f0; /* Set a background color in case the image doesn't cover the entire viewport */
            position: relative;
            background-color: #333;
        }
        
        h1 {
            text-align: center;
            color: #fff;
            z-index: 1;
            position: relative; /* Ensure the heading appears above the background images */
            margin-top: auto; /* Center the heading vertically */
            margin-bottom: auto; /* Center the heading vertically */
        }
        
        .background-left-top,
        .background-right-bottom {
            position: absolute;
            z-index: 0;
            height: 100vh;
            max-width: 50vw; /* Set maximum width to 50% of viewport width */
        }
        
        .background-left-top {
            left: 0;
            top: 0;
            width: auto;
        }
        
        .background-right-bottom {
            right: 0;
            bottom: 0;
            transform: rotate(180deg); /* Flip the image horizontally */
            width: auto;
        }
        
        /* Responsive adjustments */
        @media screen and (max-width: 768px) {
            .background-left-top,
            .background-right-bottom {
                max-width: 100vw; /* Set maximum width to 100% of viewport width for smaller screens */
            }
        }
        
        /* Mobile devices */
        @media screen and (max-width: 480px) {
            .background-left-top,
            .background-right-bottom {
                display: none; /* Hide background images on mobile devices */
            }
        }
        
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            padding: 16px;
            text-align: center;
            font-size: 14px;
            color: #fff;
            z-index: 1;
        }
        
        /* Adjustments for header items */
        .header-items {
            display: flex;
            align-items: center;
            justify-content: flex-end; /* Align items to the right */
            padding: 20px;
            z-index: 2; /* Ensure header items appear above background images */
            position: relative;
        }

        .header-items a {
            padding: 8px 16px;
            border-radius: 5px;
            margin-left: 10px;
            text-decoration: none;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .header-items a:hover {
            background-color: #555;
        }

        /* Center footer content */
        footer div {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 16px;
            text-align: center;
            font-size: 14px;
            color: #fff;
            z-index: 1;
        }
    </style>
</head>
<body>
    <!-- Background images -->
    <img class="background-left-top" src="https://laravel.com/assets/img/welcome/background.svg" />
    <img class="background-right-bottom" src="https://laravel.com/assets/img/welcome/background.svg" />

    <!-- Header items -->
    <div class="header-items">
        @if (Route::has('login'))
        <nav class="-mx-3 flex flex-1 justify-end">
            @auth
            <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Dashboard
            </a>
            @else
            <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Log in
            </a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Register
            </a>
            @endif
            @endauth
        </nav>
        @endif
    </div>

    <!-- Main content -->
    <h1>Student Management System</h1>
    
    <!-- Footer -->
    
        <div class="footer">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </div>
   
</body>
</html>
