<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }} - Админ-панель</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <style>
            .sidebar-link {
                position: relative;
                transition: all 0.3s ease;
            }
            .sidebar-link::after {
                content: '';
                position: absolute;
                left: 0;
                bottom: 0;
                height: 2px;
                width: 0;
                background-color: #4f46e5;
                transition: width 0.3s ease;
            }
            .sidebar-link:hover::after {
                width: 100%;
            }
            .sidebar-link.active {
                background-color: #eef2ff;
                color: #4f46e5;
                border-right: 3px solid #4f46e5;
            }
            .card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }
        </style>
    </head>
    <body class="min-h-screen bg-gray-50">
        <div class="flex h-screen overflow-hidden">
            <!-- Боковая панель -->
            <div class="w-64 bg-white border-r border-gray-200 shadow-sm flex-shrink-0">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-cube text-white text-xl"></i>
                        </div>
                        <h1 class="text-xl font-bold text-gray-800">Админ-панель</h1>
                    </div>
                </div>
                <nav class="mt-4 space-y-1 px-3">
                    <a href="{{ route('home') }}" 
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="fas fa-home w-5 h-5 mr-3"></i>
                        <span>Главная</span>
                    </a>
                    <a href="{{ route('admin.analytics') }}" 
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
                        <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                        <span>Аналитика</span>
                    </a>
                    <a href="{{ route('admin.post') }}" 
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg {{ request()->routeIs('admin.post') ? 'active' : '' }}">
                        <i class="fas fa-project-diagram w-5 h-5 mr-3"></i>
                        <span>Проекты</span>
                    </a>
                    <a href="{{ route('admin.content') }}" 
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg {{ request()->routeIs('admin.content') ? 'active' : '' }}">
                        <i class="fas fa-file-alt w-5 h-5 mr-3"></i>
                        <span>Контент</span>
                    </a>
                </nav>
            </div>
            
            <!-- Основной контент -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Верхняя панель -->
                <div class="bg-white border-b border-gray-200 shadow-sm">
                    <div class="px-6 py-4 flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800">@yield('title', 'Панель управления')</h2>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-2">
                                    <i class="fas fa-user text-indigo-600"></i>
                                </div>
                                <span class="text-gray-600">{{ Auth::user()->name }}</span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                    <i class="fas fa-sign-out-alt mr-2"></i>
                                    Выйти
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Содержимое страницы -->
                <div class="flex-1 overflow-auto bg-gray-50 p-6">
                    <div class="max-w-7xl mx-auto">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
        
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html> 