@extends('layouts.owner')

@section('title', 'Edit Project')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">✏️ Edit Project</h2>

    @if ($errors->any())
        <div class="mb-4 px-4 py-2 bg-red-100 text-red-700 rounded-md">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded-md text-center shadow">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('update-project', $project->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Project Name:</label>
            <input type="text" name="name" value="{{ old('name', $project->name) }}" required
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 outline-none">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Location:</label>
            <input type="text" name="location" value="{{ old('location', $project->location) }}" required
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 outline-none">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Start Date:</label>
                <input type="date" name="start_date" value="{{ old('start_date', $project->start_date) }}" required
                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 outline-none">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">End Date:</label>
                <input type="date" name="end_date" value="{{ old('end_date', $project->end_date) }}"
                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 outline-none">
            </div>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Status:</label>
            <select name="status" required
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 outline-none bg-white">
                <option value="Ongoing" {{ old('status', $project->status) == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="Completed" {{ old('status', $project->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Pending" {{ old('status', $project->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
            </select>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-md transition-all duration-200">
                💾 Update Project
            </button>
        </div>
    </form>
</div>
@endsection
