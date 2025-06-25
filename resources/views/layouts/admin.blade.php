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
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <div class="flex min-h-screen bg-gray-100 flex-col">
        <!-- Top Bar -->
        <header class="flex items-center justify-between bg-white shadow px-6 h-16">
            <div class="flex items-center">
                <span class="text-2xl font-bold text-gray-800">Admin Panel</span>
            </div>
            <!-- User Dropdown at Top Right -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded focus:outline-none">
                    <span>{{ auth()->user()->name }}</span>
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
        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside class="w-64 bg-gray-800 text-white flex flex-col py-8 px-4 min-h-full">
                <nav class="flex-1">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-900' : '' }}">Dashboard</a>
                        </li>
                        <li><hr class="my-4 border-gray-700"></li>
                        @can('view-universities')
                        <li>
                            <a href="{{ route('universities.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('universities.index') ? 'bg-gray-900' : '' }}">Universities</a>
                            <ul class="ml-4 mt-1 space-y-1">
                                <li>
                                    <a href="{{ route('universities.create') }}" class="block py-2 px-4 rounded hover:bg-green-700 bg-green-600 text-white {{ request()->routeIs('universities.create') ? 'bg-green-800' : '' }}">Add University</a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @if(auth()->user()->role === 'admin')
                        <li>
                            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">Admin Only</a>
                        </li>
                        @endif
                        @if(auth()->user()->role === 'manager')
                        <li>
                            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">Manager Only</a>
                        </li>
                        @endif
                        <li>
                            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">Student Area</a>
                        </li>
                    </ul>
                </nav>
            </aside>
            <!-- Main Content -->
            <main class="flex-1 bg-gray-100">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
