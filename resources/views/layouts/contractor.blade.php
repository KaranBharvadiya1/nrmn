<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Contractor Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .sidebar-transition {
            transition: all 0.3s ease;
        }
        .active-nav-item {
            background-color: #f0f7ff;
            color: #2563eb;
            border-left: 4px solid #2563eb;
        }
        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
    <script>
        function toggleSidebar() {
            document.getElementById('mobileSidebar').classList.toggle('hidden');
            document.getElementById('sidebarOverlay').classList.toggle('hidden');
        }
        
        function markActiveNavItem() {
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-item').forEach(item => {
                if (item.getAttribute('href') === currentPath) {
                    item.classList.add('active-nav-item');
                }
            });
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            markActiveNavItem();
            
            // Close mobile sidebar when clicking overlay
            document.getElementById('sidebarOverlay').addEventListener('click', function() {
                toggleSidebar();
            });
        });
    </script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <!-- Mobile topbar -->
    <div class="md:hidden flex justify-between items-center p-4 bg-white shadow-md">
        <button onclick="toggleSidebar()" class="text-gray-600 focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <div class="flex items-center">
            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center mr-2">
                <span class="text-white font-bold italic">N</span>
            </div>
            <h1 class="text-xl font-bold text-blue-600 italic">irmaan</h1>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-gray-600 hover:text-red-500">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
    </div>

    <!-- Sidebar Overlay (Mobile Only) -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden md:hidden"></div>

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside id="mobileSidebar" class="w-64 bg-gradient-to-b from-blue-50 to-white shadow-xl p-5 flex flex-col justify-between fixed top-0 left-0 h-full z-30 transform md:translate-x-0 transition-transform duration-300 ease-in-out hidden md:flex sidebar-transition">
            <div>
                <!-- Logo -->
                <a href="/" class="flex items-center mb-10">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center mr-3">
                        <span class="text-white font-bold italic text-xl">N</span>
                    </div>
                    <span class="text-2xl font-bold text-blue-600 italic">irmaan</span>
                </a>

                <!-- User Info -->
                <div class="flex items-center space-x-3 mb-8 p-3 bg-white rounded-lg shadow-sm">
                    <img src="{{ Auth::user()->profile_picture_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->first_name.'+'.Auth::user()->last_name).'&background=random' }}" 
                         alt="User" 
                         class="w-12 h-12 rounded-full border-2 border-white shadow-md">
                    <div>
                        <h2 class="text-base font-semibold text-gray-800">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
                        <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full">Contractor</span>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="space-y-1 mt-6">
                    <a href="{{ route('contractor.dashboard') }}" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">
                        <i class="fas fa-tachometer-alt w-6 text-center mr-3 text-gray-500"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('contractor.requirements') }}" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">
                        <i class="fas fa-clipboard-list w-6 text-center mr-3 text-gray-500"></i>
                        Project Requirements
                        <span class="ml-auto bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">24</span>
                    </a>
                    <a href="{{ route('contractor.mywork') }}" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">
                        <i class="fas fa-tools w-6 text-center mr-3 text-gray-500"></i>
                        My Work
                    </a>
                    <a href="{{ route('contractor.notifications') }}" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">
                        <i class="fas fa-bell w-6 text-center mr-3 text-gray-500"></i>
                        Notifications
                        <span class="ml-auto bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">3</span>
                    </a>
                    <a href="{{ route('contractor.help') }}" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">
                        <i class="fas fa-question-circle w-6 text-center mr-3 text-gray-500"></i>
                        Help
                    </a>
                    <a href="{{ route('contractor.settings') }}" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">
                        <i class="fas fa-cog w-6 text-center mr-3 text-gray-500"></i>
                        Settings
                    </a>
                </nav>
            </div>

            <!-- Bottom Section -->
            <div class="mt-auto">
                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full flex items-center px-4 py-3 text-gray-700 hover:text-red-500 rounded-lg">
                        <i class="fas fa-sign-out-alt w-6 text-center mr-3"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 ml-0 md:ml-64 flex flex-col h-full overflow-hidden">

            <!-- Topbar (Desktop Only) -->
            <div class="hidden md:flex justify-between items-center p-4 bg-white shadow-sm border-b">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h1>
                    <div class="ml-4 text-sm text-gray-500">
                        <i class="far fa-calendar-alt mr-1"></i>
                        <span id="currentDate">{{ now()->format('l, F j, Y') }}</span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Search projects..." 
                               class="pl-10 pr-4 py-2 w-64 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <button class="relative p-2 text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100">
                            <i class="far fa-bell"></i>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        
                        <div class="relative group">
                            <img src="{{ Auth::user()->profile_picture_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->first_name.'+'.Auth::user()->last_name).'&background=random' }}" 
                                 alt="User" 
                                 class="w-8 h-8 rounded-full cursor-pointer border-2 border-white shadow">
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden group-hover:block">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                                <a href="{{ route('contractor.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-500">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <!-- Breadcrumbs -->
                <div class="flex items-center text-sm text-gray-600 mb-6">
                    <a href="{{ route('contractor.dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                    <i class="fas fa-chevron-right mx-2 text-xs"></i>
                    <span class="text-gray-800 font-medium">@yield('title')</span>
                </div>
                
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>