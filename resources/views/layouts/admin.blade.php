<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen bg-gray-100 flex-col">
        <!-- Top Bar -->
        <header class="fixed top-0 left-0 right-0 flex items-center justify-between bg-gray-800 shadow px-4 lg:px-6 h-16 z-50">
            <div class="flex items-center">
                <!-- Mobile menu button -->
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden mr-4 p-2 rounded-md text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <span class="text-xl lg:text-2xl font-bold text-white">Admin Panel</span>
            </div>
            <!-- User Dropdown at Top Right -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center px-3 lg:px-4 py-2 text-white hover:bg-gray-700 rounded focus:outline-none">
                    <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                    <span class="sm:hidden">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 w-48 bg-white text-gray-800 rounded shadow mt-2 z-10">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Edit Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </header>
        <!-- Content wrapper with top padding to account for fixed header -->
        <div class="flex flex-1 relative pt-16">
            <!-- Mobile overlay -->
            <div class="lg:hidden fixed top-16 left-0 right-0 bottom-0 bg-black bg-opacity-50 z-30" 
                 x-show="sidebarOpen" 
                 @click="sidebarOpen = false"
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
            </div>
            
            <!-- Sidebar -->
            <aside class="fixed top-16 left-0 bottom-0 lg:static lg:h-auto transform lg:transform-none lg:translate-x-0 transition-transform duration-300 ease-in-out bg-gray-800 text-white flex flex-col py-8 px-4 w-64 z-40 lg:z-auto overflow-y-auto" 
                   :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
                
                <nav class="flex-1">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('dashboard') }}" 
                               @click="window.innerWidth < 1024 && (sidebarOpen = false)"
                               class="block py-3 px-4 rounded hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-gray-900' : '' }}">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                                    </svg>
                                    Dashboard
                                </div>
                            </a>
                        </li>
                        <li><hr class="my-4 border-gray-700"></li>
                        @can('view-universities')
                        <li>
                            <a href="{{ route('universities.index') }}" 
                               @click="window.innerWidth < 1024 && (sidebarOpen = false)"
                               class="block py-3 px-4 rounded hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('universities.index') ? 'bg-gray-900' : '' }}">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Universities
                                </div>
                            </a>
                            <ul class="ml-4 mt-2 space-y-1">
                                <li>
                                    <a href="{{ route('universities.create') }}" 
                                       @click="window.innerWidth < 1024 && (sidebarOpen = false)"
                                       class="block py-2 px-4 rounded hover:bg-green-700 bg-green-600 text-white transition-colors duration-200 {{ request()->routeIs('universities.create') ? 'bg-green-800' : '' }}">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Add University
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @if(auth()->user()->role === 'admin')
                        <li>
                            <a href="#" class="block py-3 px-4 rounded hover:bg-gray-700 transition-colors duration-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    Admin Only
                                </div>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->role === 'manager')
                        <li>
                            <a href="#" class="block py-3 px-4 rounded hover:bg-gray-700 transition-colors duration-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Manager Only
                                </div>
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="#" class="block py-3 px-4 rounded hover:bg-gray-700 transition-colors duration-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    Student Area
                                </div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>
            <!-- Main Content -->
            <main class="flex-1 bg-gray-100 lg:ml-0 transition-all duration-300 ease-in-out pt-16 lg:pt-0">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
