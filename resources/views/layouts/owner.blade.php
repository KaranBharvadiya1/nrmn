{{-- resources/views/layouts/owner-dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Owner Dashboard')</title>
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

        document.addEventListener('DOMContentLoaded', function () {
            markActiveNavItem();
            document.getElementById('sidebarOverlay').addEventListener('click', toggleSidebar);
        });

        function openProfileModal() {
            document.getElementById('profileModal').classList.remove('hidden');
            document.getElementById('profileModal').classList.add('flex');
        }

        function closeProfileModal() {
            document.getElementById('profileModal').classList.remove('flex');
            document.getElementById('profileModal').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Close on background click
            document.getElementById('profileModal').addEventListener('click', function (e) {
                if (e.target === this) closeProfileModal();
            });

            // Close on ESC key
            document.addEventListener('keydown', function (e) {
                if (e.key === "Escape") closeProfileModal();
            });

            // Preview Image
            document.getElementById('profile_picture').addEventListener('change', function (e) {
                const reader = new FileReader();
                reader.onload = function () {
                    document.getElementById('profilePreview').src = reader.result;
                };
                if (e.target.files[0]) reader.readAsDataURL(e.target.files[0]);
            });

            // AJAX Submit
            document.getElementById('profileForm').addEventListener('submit', async function (e) {
                e.preventDefault();
                const formData = new FormData(this);

                try {
                    const response = await fetch("{{ route('profile.update') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    if (response.ok) {
                        const data = await response.json();
                        alert("Profile updated successfully!");
                        closeProfileModal();
                        if (data.profile_picture_url) {
                            document.querySelectorAll('.user-profile-img').forEach(img => {
                                img.src = data.profile_picture_url;
                            });
                        }
                    } else {
                        throw new Error("Update failed");
                    }
                } catch (err) {
                    alert("Something went wrong: " + err.message);
                }
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

<!-- Sidebar Overlay -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden md:hidden"></div>

<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside id="mobileSidebar" class="w-64 bg-gradient-to-b from-blue-50 to-white shadow-xl p-5 flex flex-col justify-between fixed top-0 left-0 h-full z-30 transform md:translate-x-0 transition-transform duration-300 ease-in-out hidden md:flex sidebar-transition">
        <div>
            <a href="/" class="flex items-center mb-10">
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center mr-3">
                    <span class="text-white font-bold italic text-xl">N</span>
                </div>
                <span class="text-2xl font-bold text-blue-600 italic">irmaan</span>
            </a>

            <div onclick="openProfileModal()" class="flex items-center space-x-3 mb-8 p-3 bg-white rounded-lg shadow-sm cursor-pointer hover:bg-gray-100">
    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->first_name.'+'.Auth::user()->last_name).'&background=random' }}"
         alt="User"
         class="w-12 h-12 rounded-full border-2 border-white shadow-md user-profile-img">
    <div>
        <h2 class="text-base font-semibold text-gray-800">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
        <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full">Project Owner</span>
        <div class="mt-2 flex items-center text-sm text-blue-600 hover:underline space-x-1">
            <i class="fas fa-user-edit text-xs"></i>
            <span>Edit Profile</span>
        </div>
    </div>
</div>



            <nav class="space-y-1 mt-6">
                <a href="{{ route('owner.dashboard') }}" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">
                    <i class="fas fa-tachometer-alt w-6 text-center mr-3 text-gray-500"></i>
                    Dashboard
                </a>
                <a href="{{ route('projects') }}" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">
                    <i class="fas fa-folder-open w-6 text-center mr-3 text-gray-500"></i>
                    Projects
                </a>
                <a href="{{ route('add-project') }}" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">
                    <i class="fas fa-plus-circle w-6 text-center mr-3 text-gray-500"></i>
                    Add Project
                </a>
                <a href="#" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">
                    <i class="fas fa-bell w-6 text-center mr-3 text-gray-500"></i>
                    Notifications
                </a>
                <a href="{{ route('help') }}" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">
                    <i class="fas fa-question-circle w-6 text-center mr-3 text-gray-500"></i>
                    Help Center
                </a>
            </nav>
        </div>

        <div class="mt-auto">
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
        <div class="hidden md:flex justify-between items-center p-4 bg-white shadow-sm border-b">
            <div class="flex items-center">
                <h1 class="text-xl font-semibold text-gray-800">@yield('header', 'Dashboard Overview')</h1>
                <div class="ml-4 text-sm text-gray-500">
                    <i class="far fa-calendar-alt mr-1"></i>
                    <span>{{ now()->format('l, F j, Y') }}</span>
                </div>
            </div>
        </div>

        <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
            <div class="flex items-center text-sm text-gray-600 mb-6">
                <a href="{{ route('owner.dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <span class="text-gray-800 font-medium">@yield('title')</span>
            </div>

            @yield('content')
        </main>
    </div>
</div>

<!-- Profile Modal -->
<div id="profileModal" class="fixed inset-0 bg-black bg-opacity-40 items-center justify-center z-50 hidden modal-transition">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 relative">
        <button onclick="closeProfileModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <i class="fas fa-times"></i>
        </button>

        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Edit Profile</h3>

            <form id="profileForm" enctype="multipart/form-data" method="POST" class="space-y-4">
                @csrf
                <div class="flex flex-col items-center">
                    <!-- Profile Image Preview -->
                    <div class="relative mb-4">
                        <img id="profilePreview"
                             src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->first_name.'+'.Auth::user()->last_name).'&background=random' }}"
                             class="w-24 h-24 rounded-full border-4 border-blue-100 object-cover shadow-md">
                        <label for="profile_picture"
                               class="absolute bottom-0 right-0 bg-blue-500 text-white p-2 rounded-full cursor-pointer hover:bg-blue-600">
                            <i class="fas fa-camera"></i>
                            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="hidden">
                        </label>
                    </div>

                    <!-- Profile Fields -->
                    <div class="w-full space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" name="first_name" class="w-full border rounded-lg px-4 py-2"
                                   value="{{ Auth::user()->first_name }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" name="last_name" class="w-full border rounded-lg px-4 py-2"
                                   value="{{ Auth::user()->last_name }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" class="w-full border rounded-lg px-4 py-2"
                                   value="{{ Auth::user()->email }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="tel" name="phone" class="w-full border rounded-lg px-4 py-2"
                                   value="{{ Auth::user()->phone ?? '' }}">
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                <i class="fas fa-save mr-2"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


</body>
</html>
