<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">

        <title>{{  $title ?? config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="bg-gray-900 min-h-screen flex">
        <!-- Left Side - App Description -->
        <div class="hidden lg:flex lg:w-1/2 bg-gray-800 items-center justify-center p-12">
            <div class="max-w-lg text-center">
                <h1 class="text-4xl font-bold text-white mb-6 font-oswald">EasyMoney</h1>
                <div class="w-16 h-1 bg-green-500 mx-auto mb-6"></div>
                <p class="text-gray-300 text-lg mb-8 leading-relaxed">
                    Join thousands of users who have already taken control of their financial future with our comprehensive money management tools.
                </p>
                <div class="space-y-4 text-left">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span class="text-gray-300">Create your personalized budget</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span class="text-gray-300">Get detailed financial insights</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span class="text-gray-300">Secure and private data protection</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-900">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    <h1 class="text-3xl font-bold text-white font-oswald">EasyMoney</h1>
                    <div class="w-12 h-1 bg-green-500 mx-auto mt-2"></div>
                </div>

                <div class="bg-gray-800 rounded-lg shadow-xl p-8 border border-gray-700">
                    <h2 class="text-2xl font-bold text-white mb-6 text-center">Create Account</h2>
                    
                    <form action="{{ route('register') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <input type="text" 
                                   name="name" 
                                   placeholder="Full Name" 
                                   value="{{ old('name') }}" 
                                   required
                                   class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                            @error('name')
                                <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <input type="email" 
                                   name="email" 
                                   placeholder="E-mail" 
                                   value="{{ old('email') }}" 
                                   required
                                   class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                            @error('email')
                                <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <input type="password" 
                                   name="password" 
                                   placeholder="Password" 
                                   required
                                   class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                            @error('password')
                                <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        @error('auth')
                            <div class="bg-red-900 border border-red-700 text-red-300 px-4 py-3 rounded-md text-sm">
                                {{ $message }}
                            </div>
                        @enderror

                        <button type="submit" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                            Create Account
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <span class="text-gray-400">Already have an account? </span>
                        <a href="{{ route('login.view') }}" 
                           class="text-green-400 hover:text-green-300 font-medium transition-colors">
                            Sign in
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>