@extends('layouts.contractor')

@section('title', 'Project Details')

@section('content')
    <div class="max-w-7xl mx-auto">
        {{-- Hero Header --}}
        <div class="relative bg-gradient-to-r from-blue-800 to-indigo-900 rounded-t-2xl overflow-hidden shadow-2xl">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1605106702734-205df224ecce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80')] bg-cover bg-center opacity-20"></div>
            
            <div class="relative z-10 p-8 lg:p-12">
                <div class="flex flex-col lg:flex-row justify-between items-start">
                    <div class="max-w-2xl">
                        <div class="flex items-center space-x-2 mb-4">
                            <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium text-white">Active Project</span>
                            <span class="px-3 py-1 bg-emerald-500/20 backdrop-blur-sm rounded-full text-sm font-medium text-emerald-100">Budget: ₹{{ number_format($project->budget, 2) }}</span>
                        </div>
                        
                        <h1 class="text-4xl lg:text-5xl font-bold text-white mb-2">{{ $project->name }}</h1>
                        
                        <div class="flex flex-wrap items-center gap-4 text-blue-100 mt-4">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $project->location }}
                            </span>
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Posted {{ $project->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-6 lg:mt-0 bg-white/10 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20">
                        <div class="text-center">
                            <div class="text-xs font-medium text-blue-200 mb-1">TIMELINE</div>
                            <div class="flex items-center justify-center space-x-4">
                                <div class="text-center">
                                    <div class="text-sm text-blue-100">Start</div>
                                    <div class="text-white font-bold">{{ \Carbon\Carbon::parse($project->start_date)->format('d M') }}</div>
                                </div>
                                <div class="relative">
                                    <div class="h-0.5 w-16 bg-blue-300/50"></div>
                                    <div class="absolute -top-2 left-1/2 transform -translate-x-1/2 bg-white text-blue-900 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">
                                        {{ $project->end_date ? \Carbon\Carbon::parse($project->start_date)->diffInDays($project->end_date) : '?' }}d
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="text-sm text-blue-100">End</div>
                                    <div class="text-white font-bold">{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d M') : 'TBD' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-b-2xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-0">
                {{-- Sidebar --}}
                <div class="lg:col-span-1 bg-gray-50 p-6 border-r border-gray-200">
                    {{-- Owner Card --}}
                    @if($project->owner)
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 mb-6">
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <img src="{{ $project->owner->profile_picture_url ?? 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=880&q=80' }}" 
                                         alt="Owner" 
                                         class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-md">
                                    <span class="absolute bottom-0 right-0 bg-blue-500 text-white p-1 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $project->owner->first_name }} {{ $project->owner->last_name }}</h3>
                                    <p class="text-sm text-gray-500">Project Owner</p>
                                    <div class="mt-1 flex space-x-1">
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded">Verified</span>
                                    </div>
                                </div>
                            </div>
                            <button class="mt-4 w-full flex items-center justify-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm font-medium text-gray-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <span>Contact Owner</span>
                            </button>
                        </div>
                    @endif

                    {{-- Quick Stats --}}
                    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 mb-6">
                        <h3 class="font-medium text-gray-900 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Project Stats
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Contractors Applied</span>
                                <span class="text-sm font-medium bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full">24</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Your Bid</span>
                                <span class="text-sm font-medium text-gray-900">-</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Avg. Bid</span>
                                <span class="text-sm font-medium text-gray-900">₹{{ number_format($project->budget * 0.8, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Action Card --}}
                    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
                        <h3 class="font-medium text-gray-900 mb-3">Apply for Project</h3>
                        
                        @if(!$project->contractors->contains(auth()->user()->id))
                            <form method="POST" action="{{ route('contractor.requirements.apply', $project->id) }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center justify-center space-x-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Submit Proposal</span>
                                </button>
                            </form>
                            <p class="mt-3 text-xs text-gray-500 text-center">
                                By applying, you agree to our <a href="#" class="text-blue-600 hover:underline">terms</a>
                            </p>
                        @else
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h4 class="mt-2 text-sm font-medium text-green-800">Proposal Submitted</h4>
                                <p class="mt-1 text-xs text-green-600">Your application is under review</p>
                                <button class="mt-3 w-full px-4 py-2 bg-white border border-green-200 text-green-700 rounded-lg text-sm font-medium hover:bg-green-50 transition">
                                    View Status
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="lg:col-span-3 p-8">
                    {{-- Description --}}
                    <div class="mb-10">
                        <div class="flex items-center mb-6">
                            <div class="bg-blue-100 p-3 rounded-xl mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Project Description</h2>
                        </div>
                        <div class="prose max-w-none text-gray-600">
                            {!! nl2br(e($project->description)) !!}
                        </div>
                    </div>

                    {{-- Blueprint --}}
                    <div class="mb-10">
                        <div class="flex items-center mb-6">
                            <div class="bg-indigo-100 p-3 rounded-xl mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Project Blueprint & Files</h2>
                        </div>
                        
                        @php
                            $filePath = asset('storage/' . $project->blueprint);
                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                        @endphp

                        @if($project->blueprint)
                            <div class="border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                                @if(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                    <div class="bg-gray-100 p-4 flex justify-center">
                                        <img src="{{ $filePath }}" 
                                             alt="Blueprint Image" 
                                             class="max-h-[500px] object-contain rounded-lg shadow-md transition hover:shadow-lg cursor-zoom-in"
                                             onclick="window.open('{{ $filePath }}', '_blank')">
                                    </div>
                                @elseif($fileExtension === 'pdf')
                                    <iframe src="{{ $filePath }}#toolbar=0&navpanes=0&scrollbar=0"
                                            width="100%" height="500"
                                            class="border-0">
                                    </iframe>
                                @endif
                                <div class="bg-gray-50 px-4 py-3 border-t border-gray-200 flex justify-between items-center">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-700">blueprint.{{ $fileExtension }}</span>
                                    </div>
                                    <div class="flex space-x-3">
                                        <a href="{{ $filePath }}" target="_blank" 
                                           class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Preview
                                        </a>
                                        <a href="{{ $filePath }}" download 
                                           class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-gray-50 rounded-xl p-8 text-center border-2 border-dashed border-gray-300 hover:border-blue-400 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No blueprint uploaded</h3>
                                <p class="mt-1 text-sm text-gray-500">The project owner hasn't provided any blueprint files yet.</p>
                            </div>
                        @endif
                    </div>

                    {{-- Requirements --}}
                    <div class="mb-10">
                        <div class="flex items-center mb-6">
                            <div class="bg-purple-100 p-3 rounded-xl mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Project Requirements</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                                <h3 class="font-medium text-gray-800 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    Required Skills
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">Construction</span>
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">Architecture</span>
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">Project Management</span>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                                <h3 class="font-medium text-gray-800 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Experience Level
                                </h3>
                                <div class="flex items-center">
                                    <div class="flex items-center space-x-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-700">Intermediate (3+ years)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection