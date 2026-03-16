<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Create Account</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|instrument-sans:400,500,600&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.08); }
            66% { transform: translate(-20px, 20px) scale(0.94); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes pulse-ring {
            0% { transform: scale(0.96); opacity: 0.40; }
            50% { transform: scale(1); opacity: 0.16; }
            100% { transform: scale(0.96); opacity: 0.40; }
        }
        
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .animate-blob {
            animation: blob 10s infinite ease-in-out;
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-pulse-ring {
            animation: pulse-ring 2.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient-shift 5s ease infinite;
        }
        
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        
        .bg-grid-pattern {
            background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.08) 1px, transparent 0);
            background-size: 36px 36px;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.70);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.28);
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.12);
        }
        
        .dark .glass-effect {
            background: rgba(15, 23, 42, 0.72);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
        }
        
        .input-focus-effect {
            position: relative;
            border-radius: 1rem;
        }
        
        .input-focus-effect:focus-within::after {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(90deg, #2563eb, #7c3aed, #db2777);
            border-radius: 1rem;
            z-index: -1;
            opacity: 0.18;
            filter: blur(8px);
        }
        
        .password-strength-bar {
            transition: width 0.3s ease, background-color 0.3s ease;
        }
        
        .feature-icon {
            transition: all 0.3s ease;
        }
        
        .feature-icon:hover {
            transform: translateY(-4px) rotate(4deg);
        }

        .soft-ring {
            box-shadow: 0 0 0 1px rgba(255,255,255,0.16) inset;
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-950 dark:via-purple-950 dark:to-violet-950 text-slate-900 dark:text-white">
    <!-- Animated background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-[560px] h-[560px] bg-gradient-to-r from-blue-500 to-purple-500 dark:from-blue-700 dark:to-purple-700 rounded-full blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-[560px] h-[560px] bg-gradient-to-r from-purple-500 to-pink-500 dark:from-purple-700 dark:to-pink-700 rounded-full blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[680px] h-[680px] bg-gradient-to-r from-indigo-400 to-violet-400 dark:from-indigo-800 dark:to-violet-800 rounded-full blur-3xl opacity-10 animate-blob animation-delay-4000"></div>
        <div class="absolute inset-0 bg-grid-pattern opacity-20 dark:opacity-[0.07]"></div>
    </div>

    <!-- Header -->
    <header class="fixed inset-x-0 top-0 z-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-4">
            <div class="glass-effect rounded-2xl soft-ring">
                <div class="flex justify-between items-center h-16 px-4 sm:px-6">
                    <a href="/" class="flex items-center space-x-3 group">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl blur opacity-40 group-hover:opacity-70 transition"></div>
                            <div class="relative w-10 h-10 rounded-xl bg-white/70 dark:bg-slate-900/70 flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 transform group-hover:rotate-6 group-hover:scale-110 transition-all duration-300" viewBox="0 0 24 24" fill="none">
                                    <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            {{ config('app.name', 'Laravel Blog') }}
                        </span>
                    </a>
                    
                    <div class="flex items-center space-x-3">
                        <a href="/" class="hidden sm:inline-flex items-center px-4 py-2 rounded-xl text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-white/60 dark:hover:bg-slate-800/60 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Home
                        </a>
                        
                        <a href="{{ route('login') }}" class="text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors px-4 py-2 rounded-xl hover:bg-white/60 dark:hover:bg-slate-800/60">
                            Sign In
                        </a>
                        
                        <button id="theme-toggle" class="p-2 rounded-xl hover:bg-white/60 dark:hover:bg-slate-800/60 transition-colors">
                            <svg class="w-5 h-5 text-slate-700 dark:text-slate-300 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                            <svg class="w-5 h-5 text-slate-300 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="relative min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 pt-28 pb-16">
        <div class="w-full max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-8 items-start">
                <!-- Left Column -->
                <div class="hidden lg:block space-y-8">
                    <div class="glass-effect rounded-3xl p-8">
                        <h1 class="text-4xl font-bold mb-4 leading-tight">
                            <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Start your journey</span>
                            <br>with us today
                        </h1>
                        <p class="text-lg text-slate-600 dark:text-slate-400 mb-8 leading-8">
                            Join thousands of writers and readers who are already part of our community.
                        </p>
                        
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4 group">
                                <div class="feature-icon w-12 h-12 bg-gradient-to-br from-blue-100 to-purple-100 dark:from-slate-800 dark:to-slate-700 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:shadow-xl">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-slate-900 dark:text-white text-lg">Write & Publish</h3>
                                    <p class="text-slate-600 dark:text-slate-400">Share your thoughts with the world through beautiful blog posts.</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4 group">
                                <div class="feature-icon w-12 h-12 bg-gradient-to-br from-blue-100 to-purple-100 dark:from-slate-800 dark:to-slate-700 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:shadow-xl">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-slate-900 dark:text-white text-lg">Connect with Readers</h3>
                                    <p class="text-slate-600 dark:text-slate-400">Build an audience and engage through comments and discussions.</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4 group">
                                <div class="feature-icon w-12 h-12 bg-gradient-to-br from-blue-100 to-purple-100 dark:from-slate-800 dark:to-slate-700 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:shadow-xl">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-slate-900 dark:text-white text-lg">Track Your Growth</h3>
                                    <p class="text-slate-600 dark:text-slate-400">Get insights into your content's performance with analytics.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="glass-effect rounded-3xl p-6 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-purple-500/10 rounded-full -mr-16 -mt-16"></div>
                        <div class="relative">
                            <svg class="w-10 h-10 text-blue-500/30 mb-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                            <p class="text-slate-700 dark:text-slate-300 italic mb-4 leading-7">
                                "This platform has transformed how I share my ideas. The community is supportive and the experience feels modern and easy to use."
                            </p>
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                    S
                                </div>
                                <div class="ml-3">
                                    <p class="font-semibold text-slate-900 dark:text-white">Sarah Johnson</p>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Writer & Content Creator</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="glass-effect rounded-3xl shadow-2xl p-8 relative overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-32 bg-gradient-to-b from-blue-500/10 to-transparent"></div>
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 animate-gradient"></div>
                    
                    <div class="absolute -top-20 -right-20 w-40 h-40 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full opacity-10 animate-pulse-ring"></div>
                    <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full opacity-10 animate-pulse-ring animation-delay-2000"></div>
                    
                    <div class="relative">
                        <div class="text-center mb-8">
                            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-blue-100 to-purple-100 dark:from-slate-800 dark:to-slate-700 rounded-3xl mb-4 shadow-xl transform hover:scale-110 hover:rotate-3 transition-all duration-300 group">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl blur opacity-0 group-hover:opacity-50 transition-opacity"></div>
                                    <svg class="relative w-12 h-12 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                </div>
                            </div>
                            <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Create account</h2>
                            <p class="text-slate-600 dark:text-slate-400 mt-2">Join our community today</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="space-y-5">
                            @csrf

                            <div class="input-focus-effect">
                                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                    Full name
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <input id="name" 
                                           type="text" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           required 
                                           autofocus 
                                           autocomplete="name"
                                           class="block w-full pl-10 pr-3 py-3.5 border border-slate-200 dark:border-slate-700 rounded-2xl bg-white/70 dark:bg-slate-900/60 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                           placeholder="John Doe">
                                </div>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="input-focus-effect">
                                <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                    Email address
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <input id="email" 
                                           type="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required 
                                           autocomplete="username"
                                           class="block w-full pl-10 pr-3 py-3.5 border border-slate-200 dark:border-slate-700 rounded-2xl bg-white/70 dark:bg-slate-900/60 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                           placeholder="you@example.com">
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="input-focus-effect">
                                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                    Password
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <input id="password" 
                                           type="password" 
                                           name="password" 
                                           required 
                                           autocomplete="new-password"
                                           class="block w-full pl-10 pr-10 py-3.5 border border-slate-200 dark:border-slate-700 rounded-2xl bg-white/70 dark:bg-slate-900/60 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                           placeholder="••••••••">
                                    
                                    <button type="button" 
                                            onclick="togglePassword('password')" 
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg id="eyeIcon-password" class="h-5 w-5 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                                
                                <div class="mt-2">
                                    <div class="flex space-x-1 h-1">
                                        <div class="password-strength-bar flex-1 bg-slate-200 dark:bg-slate-700 rounded-full" id="strength-1"></div>
                                        <div class="password-strength-bar flex-1 bg-slate-200 dark:bg-slate-700 rounded-full" id="strength-2"></div>
                                        <div class="password-strength-bar flex-1 bg-slate-200 dark:bg-slate-700 rounded-full" id="strength-3"></div>
                                    </div>
                                    <p id="strength-text" class="text-xs text-slate-500 dark:text-slate-400 mt-1">Enter a strong password</p>
                                </div>
                            </div>

                            <div class="input-focus-effect">
                                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                    Confirm password
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                    </div>
                                    <input id="password_confirmation" 
                                           type="password" 
                                           name="password_confirmation" 
                                           required 
                                           autocomplete="new-password"
                                           class="block w-full pl-10 pr-10 py-3.5 border border-slate-200 dark:border-slate-700 rounded-2xl bg-white/70 dark:bg-slate-900/60 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                           placeholder="••••••••">
                                    
                                    <button type="button" 
                                            onclick="togglePassword('password_confirmation')" 
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg id="eyeIcon-password_confirmation" class="h-5 w-5 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="terms" name="terms" type="checkbox" required class="w-4 h-4 border border-slate-300 dark:border-slate-600 rounded bg-white/70 dark:bg-slate-900/60 text-blue-600 focus:ring-blue-500">
                                </div>
                                <label for="terms" class="ml-3 text-sm text-slate-600 dark:text-slate-400">
                                    I agree to the 
                                    <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Terms of Service</a> 
                                    and 
                                    <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Privacy Policy</a>
                                </label>
                            </div>

                            <button type="submit" 
                                    class="group relative w-full bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 text-white py-3.5 px-4 rounded-2xl font-semibold hover:shadow-2xl transform hover:-translate-y-0.5 transition-all duration-300 overflow-hidden">
                                <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity"></span>
                                <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></span>
                                <span class="relative flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                    Create free account
                                </span>
                            </button>

                            <div class="relative my-6">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-slate-300 dark:border-slate-700"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white/70 dark:bg-slate-900/70 text-slate-500 dark:text-slate-400 rounded-full">
                                        Or sign up with
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <button type="button" 
                                        class="flex items-center justify-center px-4 py-3 border border-slate-300 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-300 bg-white/70 dark:bg-slate-900/60 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"/>
                                    </svg>
                                    Google
                                </button>
                                <button type="button" 
                                        class="flex items-center justify-center px-4 py-3 border border-slate-300 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-300 bg-white/70 dark:bg-slate-900/60 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.463-1.11-1.463-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.03-2.682-.103-.253-.446-1.27.098-2.646 0 0 .84-.269 2.75 1.025.8-.222 1.66-.334 2.51-.334.86 0 1.72.112 2.52.334 1.91-1.294 2.75-1.025 2.75-1.025.544 1.376.201 2.393.099 2.646.64.698 1.03 1.591 1.03 2.682 0 3.841-2.34 4.687-4.57 4.933.36.31.68.92.68 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.48 3.97-1.325 6.832-5.07 6.832-9.49C22 6.477 17.523 2 12 2z"/>
                                    </svg>
                                    GitHub
                                </button>
                            </div>
                        </form>

                        <p class="mt-6 text-center text-sm text-slate-600 dark:text-slate-400">
                            Already have an account?
                            <a href="{{ route('login') }}" class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors ml-1">
                                Sign in here
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function togglePassword(fieldId) {
            const input = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(`eyeIcon-${fieldId}`);
            
            if (input.type === 'password') {
                input.type = 'text';
                if (eyeIcon) {
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                    `;
                }
            } else {
                input.type = 'password';
                if (eyeIcon) {
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    `;
                }
            }
        }

        document.getElementById('password')?.addEventListener('input', function(e) {
            const password = e.target.value;
            const strengthBars = [
                document.getElementById('strength-1'),
                document.getElementById('strength-2'),
                document.getElementById('strength-3')
            ];
            const strengthText = document.getElementById('strength-text');
            
            strengthBars.forEach(bar => {
                bar.classList.remove('bg-red-500', 'bg-yellow-500', 'bg-green-500');
                bar.classList.add('bg-slate-200', 'dark:bg-slate-700');
            });
            
            if (password.length === 0) {
                strengthText.textContent = 'Enter a strong password';
                return;
            }
            
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/\d/.test(password)) strength++;
            if (/[!@#$%^&*(),.?":{}|<>]|[A-Z]/.test(password)) strength++;
            
            for (let i = 0; i < strength; i++) {
                strengthBars[i].classList.remove('bg-slate-200', 'dark:bg-slate-700');
                if (strength === 1) {
                    strengthBars[i].classList.add('bg-red-500');
                    strengthText.textContent = 'Weak password';
                } else if (strength === 2) {
                    strengthBars[i].classList.add('bg-yellow-500');
                    strengthText.textContent = 'Medium password';
                } else if (strength === 3) {
                    strengthBars[i].classList.add('bg-green-500');
                    strengthText.textContent = 'Strong password';
                }
            }
        });

        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        
        document.getElementById('theme-toggle')?.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    </script>
</body>
</html>