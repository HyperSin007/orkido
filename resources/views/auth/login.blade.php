<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center px-6 py-12">
        <!-- Modern Title with Stylish Fonts -->
        <div class="text-center mb-32">
            <div class="space-y-6">
                <h1 class="text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-black text-white drop-shadow-2xl tracking-tight leading-none transform hover:scale-105 transition-transform duration-300" 
                    style="font-family: 'Poppins', 'Inter', sans-serif; 
                           text-shadow: 0 8px 32px rgba(0,0,0,0.4), 0 4px 16px rgba(0,0,0,0.2);
                           background: linear-gradient(135deg, #ffffff 0%, #e0e7ff 50%, #c7d2fe 100%);
                           -webkit-background-clip: text;
                           -webkit-text-fill-color: transparent;
                           background-clip: text;">
                    ORKIDO
                </h1>
                <div class="flex justify-center">
                    <div class="h-1.5 w-32 bg-gradient-to-r from-blue-400 via-purple-500 to-pink-400 rounded-full shadow-lg"></div>
                </div>
                <p class="text-lg md:text-xl text-white/80 font-light tracking-wider uppercase" 
                   style="font-family: 'Inter', sans-serif; 
                          letter-spacing: 0.15em;
                          text-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                    Educational Consultancy
                </p>
            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 w-full max-w-md" :status="session('status')" />

        <!-- Glass Morphism Login Card -->
        <div class="w-full max-w-md bg-white/10 backdrop-blur-md rounded-2xl shadow-2xl border border-white/20 p-8 login-card">
            <div class="text-center mb-6">
                <h2 class="text-xl font-bold text-white mb-2">Welcome Back</h2>
                <p class="text-white/70 text-sm">Sign in to your account</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email Address -->
                <div class="space-y-1">
                    <x-input-label for="email" :value="__('Email')" class="text-white font-medium text-sm" />
                    <x-text-input id="email" 
                        class="block w-full bg-white/10 border border-white/20 rounded-lg px-4 py-2.5 text-white placeholder-white/50 focus:border-white/40 focus:ring-2 focus:ring-white/20 backdrop-blur-sm transition-all duration-300 text-sm" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
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
                        autocomplete="current-password"
                        placeholder="Enter your password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-300 text-xs" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between pt-2">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-white/30 bg-white/10 text-blue-400 shadow-sm focus:ring-blue-400 focus:ring-offset-0" name="remember">
                        <span class="ml-2 text-xs text-white/80">{{ __('Remember me') }}</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a class="text-xs text-white/80 hover:text-white transition-colors duration-200 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300/50 shadow-lg mt-6">
                    {{ __('Sign In') }}
                </button>
            </form>
            
            <!-- Register Link -->
            <div class="mt-6 text-center">
                <p class="text-white/70 text-sm">Don't have an account? 
                    <a href="{{ route('register') }}" class="text-white hover:text-blue-200 font-medium transition-colors duration-200 hover:underline">
                        Create one here
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
        input:focus {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
        }

        /* Hover effects for the card */
        .login-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
        }
    </style>
</x-guest-layout>
