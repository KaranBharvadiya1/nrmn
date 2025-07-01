@extends('layouts.owner')
@section('title', 'Dashboard')

@section('content')
<div class="text-gray-700">
    <h1 class="text-3xl font-bold mb-4">Welcome back, {{ Auth::user()->first_name }}! 👋</h1>

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <!-- Total Projects -->
        <div class="bg-gradient-to-tr from-blue-500 to-blue-700 text-white p-5 rounded-lg shadow-md hover:scale-105 hover:shadow-xl transition-transform duration-300 cursor-pointer w-full">
            <h2 class="text-lg font-semibold mb-2">Total Projects</h2>
            <p class="text-3xl font-bold">{{ $projectCount ?? 12 }}</p>
        </div>

        <!-- Notifications -->
        <div class="bg-gradient-to-tr from-yellow-400 to-yellow-600 text-white p-5 rounded-lg shadow-md hover:scale-105 hover:shadow-xl transition-transform duration-300 cursor-pointer w-full">
            <h2 class="text-lg font-semibold mb-2">New Notifications</h2>
            <p class="text-3xl font-bold">{{ $notificationCount ?? 5 }}</p>
        </div>

        <!-- Role -->
        <div class="bg-gradient-to-tr from-green-400 to-green-600 text-white p-5 rounded-lg shadow-md hover:scale-105 hover:shadow-xl transition-transform duration-300 cursor-pointer w-full">
            <h2 class="text-lg font-semibold mb-2">Your Role</h2>
            <p class="text-3xl font-bold">{{ Auth::user()->role }}</p>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="mt-10">
        <h2 class="text-xl font-semibold mb-4">Recent Activities</h2>
        <ul class="space-y-3">
            <li class="p-3 bg-gray-100 rounded-md shadow-sm">✅ Project "XYZ Tower" was updated.</li>
            <li class="p-3 bg-gray-100 rounded-md shadow-sm">📝 You added a new project yesterday.</li>
            <li class="p-3 bg-gray-100 rounded-md shadow-sm">📩 You received a new message.</li>
        </ul>
    </div>
</div>
@endsection
