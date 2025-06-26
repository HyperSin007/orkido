<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center px-6 py-8">
        <!-- Modern Title with Stylish Fonts -->
        <div class="text-center mb-28">
            <div class="space-y-6">
                <h1 class="text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-black text-white drop-shadow-2xl tracking-tight leading-none transform hover:scale-105 transition-transform duration-300" 
                    style="font-family: 'Poppins', 'Inter', sans-serif; 
                           text-shadow: 0 8px 32px rgba(0,0,0,0.4), 0 4px 16px rgba(0,0,0,0.2);
                           background: linear-gradient(135deg, #ffffff 0%, #dcfce7 50%, #bbf7d0 100%);
                           -webkit-background-clip: text;
                           -webkit-text-fill-color: transparent;
                           background-clip: text;">
                    ORKIDO
                </h1>
                <div class="flex justify-center">
                    <div class="h-1.5 w-28 bg-gradient-to-r from-green-400 via-emerald-500 to-teal-400 rounded-full shadow-lg"></div>
                </div>
                <p class="text-lg md:text-xl text-white/80 font-light tracking-wider" 
                   style="font-family: 'Inter', sans-serif;
                          text-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                    Create your account
                </p>
            </div>
        </div>

        <!-- Glass Morphism Register Card -->
        <div class="w-full max-w-md bg-white/10 backdrop-blur-md rounded-2xl shadow-2xl border border-white/20 p-8 login-card">
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div class="space-y-1">
                    <x-input-label for="name" :value="__('Full Name')" class="text-white font-medium text-sm" />
                    <x-text-input id="name" 
                        class="block w-full bg-white/10 border border-white/20 rounded-lg px-4 py-2.5 text-white placeholder-white/50 focus:border-white/40 focus:ring-2 focus:ring-white/20 backdrop-blur-sm transition-all duration-300 text-sm" 
                        type="text" 
                        name="name" 
                        :value="old('name')" 
                        required 
                        autofocus 
                        autocomplete="name"
                        placeholder="Enter your full name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-300 text-xs" />
                </div>

                <!-- Email Address -->
                <div class="space-y-1">
                    <x-input-label for="email" :value="__('Email')" class="text-white font-medium text-sm" />
                    <x-text-input id="email" 
                        class="block w-full bg-white/10 border border-white/20 rounded-lg px-4 py-2.5 text-white placeholder-white/50 focus:border-white/40 focus:ring-2 focus:ring-white/20 backdrop-blur-sm transition-all duration-300 text-sm" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autocomplete="username"
                        placeholder="Enter your email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-300 text-xs" />
                </div>

                <!-- Password -->
                <div class="space-y-1">
                    <x-input-label for="password" :value="__('Password')" class="text-white font-medium text-sm" />
                    <x-text-input id="password" 
                        class="block w-full bg-white/10 border border-white/20 rounded-lg px-4 py-2.5 text-white placeholder-white/50 focus:border-white/40 focus:ring-2 focus:ring-white/20 backdrop-blur-sm transition-all duration-300 text-sm"
                        type="password"
                        name="password"
                        required 
                        autocomplete="new-password"
                        placeholder="Create a password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-300 text-xs" />
                </div>

                <!-- Confirm Password -->
                <div class="space-y-1">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white font-medium text-sm" />
                    <x-text-input id="password_confirmation" 
                        class="block w-full bg-white/10 border border-white/20 rounded-lg px-4 py-2.5 text-white placeholder-white/50 focus:border-white/40 focus:ring-2 focus:ring-white/20 backdrop-blur-sm transition-all duration-300 text-sm"
                        type="password"
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password"
                        placeholder="Confirm your password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-300 text-xs" />
                </div>

                <!-- User Role -->
                <div class="space-y-1">
                    <x-input-label for="role" :value="__('Register as')" class="text-white font-medium text-sm" />
                    <select id="role" name="role" 
                        class="block w-full bg-white/10 border border-white/20 rounded-lg px-4 py-2.5 text-white focus:border-white/40 focus:ring-2 focus:ring-white/20 backdrop-blur-sm transition-all duration-300 text-sm" 
                        required>
                        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }} class="bg-gray-800">Student</option>
                        <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }} class="bg-gray-800">Manager</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }} class="bg-gray-800">Admin</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-1 text-red-300 text-xs" />
                </div>

                <!-- Register Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-blue-600 hover:from-green-600 hover:to-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-green-300/50 shadow-lg mt-6">
                    {{ __('Create Account') }}
                </button>
            </form>
            
            <!-- Login Link -->
            <div class="mt-4 text-center">
                <p class="text-white/70 text-sm">Already have an account? 
                    <a href="{{ route('login') }}" class="text-white hover:text-green-200 font-medium transition-colors duration-200 hover:underline">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>
    </div>

    <style>
        .login-card {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom input focus effects */
        input:focus, select:focus {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
        }

        /* Hover effects for the card */
        .login-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
        }

        /* Style select dropdown */
        select option {
            background: #1f2937;
            color: white;
        }
    </style>
</x-guest-layout>
