@extends('layouts.contractor') 
@section('title', 'My Work')

@section('content')
<div class="text-gray-700">
    <h1 class="text-3xl font-bold mb-4">Welcome back, {{ Auth::user()->first_name }}! 👋</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <!-- Projects Card -->
        <div class="bg-gradient-to-tr from-blue-500 to-blue-700 text-white p-5 rounded-lg shadow-md hover:scale-105 transition">
            <h2 class="text-lg font-semibold mb-2">Total Projects</h2>
            <p class="text-3xl font-bold">12</p>
        </div>

        <!-- Notifications Card -->
        <div class="bg-gradient-to-tr from-yellow-400 to-yellow-600 text-white p-5 rounded-lg shadow-md hover:scale-105 transition">
            <h2 class="text-lg font-semibold mb-2">New Notifications</h2>
            <p class="text-3xl font-bold">5</p>
        </div>

        <!-- Profile Info -->
        <div class="bg-gradient-to-tr from-green-400 to-green-600 text-white p-5 rounded-lg shadow-md hover:scale-105 transition">
            <h2 class="text-lg font-semibold mb-2">Your Role</h2>
            <p class="text-3xl font-bold">{{ Auth::user()->role }}</p>
        </div>
    </div>

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
