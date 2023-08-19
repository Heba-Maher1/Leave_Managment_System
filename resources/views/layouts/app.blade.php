<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>
            .nav-link:hover {
              background-color: #799ca9;
              border-radius: 5px;
            }

            .nav-link.active {
                background-color: #90afbb;
                border-radius: 5px;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Sidebar -->
            <aside class="w-64 bg-gradient-to-b from-purple-500 via-pink-500 to-red-500 border-r border-gray-100 dark:border-gray-700">
                <div class="d-flex flex-column h-100 p-4" style="background: #41768a;">
                    <div class="mb-4">
                        <a href="{{ route('dashboard') }}" class="text-xl font-bold text-white">
                            ELMS
                        </a>
                    </div>
                    <nav class="nav flex-column">
                        @if(Auth::user()->role === 'admin')
                            <!-- Navigation Links -->
                            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white my-2 @if(request()->routeIs('admin.dashboard')) active @endif">
                                <i class="fa-solid fa-house me-2"></i> Home
                            </a>
                            <a href="{{ route('admin.employee') }}" class="nav-link text-white my-2 @if(request()->routeIs('admin.employee')) active @endif">
                                <i class="fa-solid fa-users me-2"></i> Employee
                            </a>
                            <a href="{{ route('admin.leaveType') }}" class="nav-link text-white my-2 @if(request()->routeIs('admin.leaveType')) active @endif">
                                <i class="fa-regular fa-calendar-days me-2"></i> Leave Type
                            </a>
                        @elseif(Auth::user()->role === 'employee')
                            <!-- Navigation Links -->
                            <a href="{{ route('employee.dashboard') }}" class="nav-link text-white my-2 @if(request()->routeIs('employee.dashboard')) active @endif">
                                <i class="fa-solid fa-house me-2"></i>  Home
                            </a>
                        @endif
            
                        <!-- Profile -->
                        <a href="{{ route('profile.edit') }}" class="nav-link text-white my-2 @if(request()->routeIs('profile.edit')) active @endif">
                            <i class="fa-solid fa-user me-2"></i> Profile
                        </a>
            
                        <!-- Settings Dropdown -->
                            <a href="#" class="nav-link text-white my-2">
                                <i class="fa-solid fa-gear me-2"></i> Settings
                            </a>
            
                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link text-white my-2 @if(request()->routeIs('logout')) active @endif">
                                <i class="fa-solid fa-right-from-bracket me-2"></i> Log Out
                            </button>
                        </form>
                    </nav>
                </div>
            </aside>
            
            
            
    
            <div class="flex-1 min-h-screen bg-gray-100 dark:bg-gray-900">
                @include('layouts.navigation')
    
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif
    
                <!-- Page Content -->
                <main class="py-8 px-4">
                    {{ $slot }}
                </main>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    </body>
</html>
