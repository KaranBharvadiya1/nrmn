@extends('layouts.contractor')

@section('title', 'Requirements')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header with Search/Actions --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Project Requirements</h2>
                <p class="text-gray-500 mt-1">Browse available construction projects</p>
            </div>
            
            <div class="flex items-center space-x-3 w-full sm:w-auto">
                <div class="relative flex-1 sm:w-64">
                    <input type="text" placeholder="Search projects..." 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-2.5" 
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <button class="p-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" 
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Empty State --}}
        @if($projects->isEmpty())
            <div class="bg-white rounded-xl shadow-sm p-8 text-center border border-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" 
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No projects available</h3>
                <p class="mt-1 text-gray-500">Check back later or create a project alert</p>
                <button class="mt-6 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Create Project Alert
                </button>
            </div>
        @else
            {{-- Project Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $project)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 overflow-hidden group">
                        {{-- Project Image/Blueprint --}}
                        <div class="relative h-48 overflow-hidden">
                            @if($project->blueprint)
                                @php
                                    $filePath = asset('storage/' . $project->blueprint);
                                    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                @endphp

                                @if(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                    <img src="{{ $filePath }}" 
                                         alt="Blueprint Preview"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                @elseif($fileExtension == 'pdf')
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                        <div class="text-center p-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" 
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                            <p class="mt-2 text-sm font-medium text-gray-600">PDF Blueprint</p>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" 
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif
                            
                            {{-- Budget Badge --}}
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full shadow-sm">
                                <span class="text-sm font-bold text-blue-600">₹{{ number_format($project->budget, 2) }}</span>
                            </div>
                            
                            {{-- Status Badge --}}
                            <div class="absolute top-4 left-4 bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium">
                                Active
                            </div>
                        </div>

                        {{-- Project Content --}}
                        <div class="p-5">
                            {{-- Owner Info --}}
                            <div class="flex items-center gap-3 mb-4">
                                @if($project->owner)
                                    <img src="{{ $project->owner->profile_picture_url ?? 'https://ui-avatars.com/api/?name='.urlencode($project->owner->first_name.'+'.$project->owner->last_name).'&background=random' }}" 
                                         alt="Owner Profile" 
                                         class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-sm" />
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">{{ $project->owner->first_name }} {{ $project->owner->last_name }}</p>
                                        <p class="text-xs text-gray-500">Project Owner</p>
                                    </div>
                                @endif
                            </div>

                            {{-- Project Info --}}
                            <div class="mb-4">
                                <h3 class="text-xl font-bold text-gray-900 mb-1 line-clamp-1">{{ $project->name }}</h3>
                                <p class="text-sm text-gray-500 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $project->location }}
                                </p>
                                <p class="text-gray-600 text-sm line-clamp-2">{{ $project->description }}</p>
                            </div>

                            {{-- Meta Info --}}
                            <div class="flex items-center justify-between text-sm text-gray-500 border-t border-gray-100 pt-4">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $project->created_at->diffForHumans() }}
                                </span>
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    24 views
                                </span>
                            </div>
                        </div>

                        {{-- View Button --}}
                        <div class="px-5 pb-5">
                            <a href="{{ route('contractor.requirements.show', $project->id) }}" 
                               class="w-full block text-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition font-medium flex items-center justify-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span>View Project</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8 flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">24</span> projects
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </button>
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        1
                    </button>
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        2
                    </button>
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </button>
                </div>
            </div>
        @endif
    </div>
@endsection
