@extends('layouts.owner')
@section('title', 'Add Project')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header with Progress Steps -->
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Create New Project</h2>
        <p class="text-gray-600 mb-6">Complete all sections to list your construction project</p>
        
        <div class="flex items-center justify-between mb-6">
            <div class="flex-1 flex items-center">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white">
                    1
                </div>
                <div class="ml-2 text-sm font-medium text-gray-700">Basic Info</div>
            </div>
            <div class="flex-1 border-t-2 border-gray-300 mx-2"></div>
            <div class="flex-1 flex items-center">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-300 text-gray-600">
                    2
                </div>
                <div class="ml-2 text-sm text-gray-500">Details</div>
            </div>
            <div class="flex-1 border-t-2 border-gray-300 mx-2"></div>
            <div class="flex-1 flex items-center">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-300 text-gray-600">
                    3
                </div>
                <div class="ml-2 text-sm text-gray-500">Review</div>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-md shadow-sm flex items-start">
            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
            <div>
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                <a href="{{ route('projects.show', session('project_id')) }}" class="mt-1 inline-flex items-center text-sm text-green-600 hover:text-green-700">
                    View project <i class="fas fa-external-link-alt ml-1 text-xs"></i>
                </a>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-md shadow-sm">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                <h3 class="text-sm font-medium text-red-800">There were {{ $errors->count() }} errors with your submission</h3>
            </div>
            <div class="mt-2 text-sm text-red-700 pl-8">
                <ul class="list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Multi-step Form -->
    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" 
          class="bg-white shadow-xl rounded-xl overflow-hidden" id="projectForm">
        @csrf

        <!-- Step 1: Basic Information -->
        <div class="p-6 sm:p-8 space-y-6" id="step1">
            <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                <span class="bg-blue-100 text-blue-800 w-8 h-8 flex items-center justify-center rounded-full mr-3">1</span>
                Basic Information
            </h3>
            
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Project Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Project Name *</label>
                    <input type="text" id="name" name="name" required
                           class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           placeholder="e.g. Luxury Apartment Complex" value="{{ old('name') }}">
                </div>

                <!-- Project Type -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Project Type *</label>
                    <select id="type" name="type" required
                            class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select project type</option>
                        <option value="Residential" {{ old('type') == 'Residential' ? 'selected' : '' }}>Residential</option>
                        <option value="Commercial" {{ old('type') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                        <option value="Industrial" {{ old('type') == 'Industrial' ? 'selected' : '' }}>Industrial</option>
                        <option value="Infrastructure" {{ old('type') == 'Infrastructure' ? 'selected' : '' }}>Infrastructure</option>
                        <option value="Institutional" {{ old('type') == 'Institutional' ? 'selected' : '' }}>Institutional</option>
                    </select>
                </div>
            </div>

            <!-- Location with Map -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location *</label>
                <div class="relative">
                    <input type="text" id="location" name="location" required
                           class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Search address or drop pin on map" value="{{ old('location') }}">
                    <button type="button" id="useCurrentLocation" class="absolute right-2 top-2 p-1 text-gray-500 hover:text-blue-600">
                        <i class="fas fa-location-arrow"></i>
                    </button>
                </div>
                <div id="map" class="mt-2 h-48 rounded-md border border-gray-300 hidden"></div>
                <div class="mt-1 text-xs text-gray-500">Click on the map to set exact location coordinates</div>
                <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
                <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">
            </div>

            <!-- Dates -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date *</label>
                    <input type="date" id="start_date" name="start_date" required
                           class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           value="{{ old('start_date') }}">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date (Optional)</label>
                    <input type="date" id="end_date" name="end_date"
                           class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           value="{{ old('end_date') }}">
                </div>
            </div>

            <!-- Budget -->
            <div>
                <label for="budget" class="block text-sm font-medium text-gray-700 mb-1">Budget (₹) *</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">₹</span>
                    </div>
                    <input type="number" step="0.01" id="budget" name="budget" required
                           class="block w-full pl-8 pr-12 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                           placeholder="0.00" value="{{ old('budget') }}">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">INR</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="button" onclick="nextStep(2)" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Next: Project Details <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>

        <!-- Step 2: Project Details -->
        <div class="p-6 sm:p-8 space-y-6 hidden" id="step2">
            <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                <span class="bg-blue-100 text-blue-800 w-8 h-8 flex items-center justify-center rounded-full mr-3">2</span>
                Project Details
            </h3>
            
            <!-- Description with Rich Text Editor -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea id="description" name="description" rows="4"
                          class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Detailed project description...">{{ old('description') }}</textarea>
                <div class="mt-1 flex space-x-2">
                    <button type="button" class="text-xs text-blue-600 hover:text-blue-800" onclick="document.execCommand('bold',false,null);">
                        <i class="fas fa-bold"></i>
                    </button>
                    <button type="button" class="text-xs text-blue-600 hover:text-blue-800" onclick="document.execCommand('italic',false,null);">
                        <i class="fas fa-italic"></i>
                    </button>
                    <button type="button" class="text-xs text-blue-600 hover:text-blue-800" onclick="document.execCommand('insertUnorderedList',false,null);">
                        <i class="fas fa-list-ul"></i>
                    </button>
                </div>
            </div>

            <!-- Blueprint Upload with Preview -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Blueprint (PDF/JPG/PNG) *</label>
                <div class="mt-1 flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative group">
                            <div id="dropZone" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-400 transition">
                                <input type="file" id="blueprint" name="blueprint" accept=".pdf,.jpg,.jpeg,.png" class="hidden" required>
                                <div id="uploadContent">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-600">Drag & drop files here or click to browse</p>
                                    <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG up to 10MB</p>
                                </div>
                                <div id="fileNameDisplay" class="hidden text-sm font-medium text-gray-700 mt-2"></div>
                            </div>
                            <div class="absolute inset-0 bg-blue-50 bg-opacity-50 flex items-center justify-center rounded-lg opacity-0 group-hover:opacity-100 transition hidden" id="replaceButton">
                                <button type="button" class="px-3 py-1 bg-white border border-blue-300 rounded-md text-blue-600 text-sm shadow-sm">
                                    Replace File
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div id="filePreview" class="border border-gray-200 rounded-lg p-4 h-full flex items-center justify-center bg-gray-50 hidden">
                            <div class="text-center">
                                <i class="fas fa-file-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-600">File preview will appear here</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project Images (Multiple Upload) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Project Images (Optional)</label>
                <div class="mt-1">
                    <input type="file" id="project_images" name="project_images[]" multiple accept="image/*" class="hidden">
                    <div id="imageDropZone" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-400 transition">
                        <i class="fas fa-images text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-600">Drag & drop images here or click to browse</p>
                        <p class="text-xs text-gray-500 mt-1">JPG, PNG up to 5MB each</p>
                    </div>
                    <div id="imagePreviews" class="grid grid-cols-2 sm:grid-cols-3 gap-3 mt-3 hidden"></div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <label for="contact_name" class="block text-sm font-medium text-gray-700 mb-1">Contact Person</label>
                    <input type="text" id="contact_name" name="contact_name"
                           class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Name" value="{{ old('contact_name') }}">
                </div>
                <div>
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                    <input type="tel" id="contact_phone" name="contact_phone"
                           class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Phone number" value="{{ old('contact_phone') }}">
                </div>
                <div class="sm:col-span-2">
                    <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-1">Contact Email</label>
                    <input type="email" id="contact_email" name="contact_email"
                           class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Email address" value="{{ old('contact_email') }}">
                </div>
            </div>

            <div class="flex justify-between pt-4">
                <button type="button" onclick="prevStep(1)" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </button>
                <button type="button" onclick="nextStep(3)" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Next: Review <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>

        <!-- Step 3: Review and Submit -->
        <div class="p-6 sm:p-8 space-y-6 hidden" id="step3">
            <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                <span class="bg-blue-100 text-blue-800 w-8 h-8 flex items-center justify-center rounded-full mr-3">3</span>
                Review Project Details
            </h3>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Project Summary</h4>
                
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-sm text-gray-500">Project Name</p>
                        <p class="font-medium" id="review_name"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Project Type</p>
                        <p class="font-medium" id="review_type"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Location</p>
                        <p class="font-medium" id="review_location"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Budget</p>
                        <p class="font-medium" id="review_budget"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Start Date</p>
                        <p class="font-medium" id="review_start_date"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">End Date</p>
                        <p class="font-medium" id="review_end_date"></p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-sm text-gray-500">Description</p>
                        <p class="font-medium whitespace-pre-line" id="review_description"></p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-6 mt-4">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h4>
                
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-sm text-gray-500">Contact Person</p>
                        <p class="font-medium" id="review_contact_name"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Contact Number</p>
                        <p class="font-medium" id="review_contact_phone"></p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-sm text-gray-500">Contact Email</p>
                        <p class="font-medium" id="review_contact_email"></p>
                    </div>
                </div>
            </div>

            <div class="flex justify-between pt-4">
                <button type="button" onclick="prevStep(2)" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </button>
                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fas fa-check-circle mr-2"></i> Submit Project
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Include required libraries -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>

<script>
    // Multi-step form navigation
    function nextStep(step) {
        document.querySelectorAll('[id^="step"]').forEach(el => el.classList.add('hidden'));
        document.getElementById(`step${step}`).classList.remove('hidden');
        updateProgress(step);
        if(step === 3) {
            updateReview();
        }
    }

    function prevStep(step) {
        document.querySelectorAll('[id^="step"]').forEach(el => el.classList.add('hidden'));
        document.getElementById(`step${step}`).classList.remove('hidden');
        updateProgress(step);
    }

    function updateProgress(currentStep) {
        document.querySelectorAll('[id^="step"]').forEach((el, index) => {
            const stepNum = index + 1;
            const stepIndicator = document.querySelector(`.flex-1:nth-child(${stepNum * 2 - 1}) div:first-child`);
            const stepText = document.querySelector(`.flex-1:nth-child(${stepNum * 2 - 1}) div:last-child`);
            
            if (stepNum < currentStep) {
                stepIndicator.className = 'flex items-center justify-center w-8 h-8 rounded-full bg-green-500 text-white';
                stepText.className = 'ml-2 text-sm font-medium text-gray-700';
            } else if (stepNum === currentStep) {
                stepIndicator.className = 'flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white';
                stepText.className = 'ml-2 text-sm font-medium text-gray-700';
            } else {
                stepIndicator.className = 'flex items-center justify-center w-8 h-8 rounded-full bg-gray-300 text-gray-600';
                stepText.className = 'ml-2 text-sm text-gray-500';
            }
        });
    }

    // Update review section with form values
    function updateReview() {
        document.getElementById('review_name').textContent = document.getElementById('name').value;
        document.getElementById('review_type').textContent = document.getElementById('type').value;
        document.getElementById('review_location').textContent = document.getElementById('location').value;
        document.getElementById('review_budget').textContent = '₹' + document.getElementById('budget').value;
        document.getElementById('review_start_date').textContent = document.getElementById('start_date').value;
        document.getElementById('review_end_date').textContent = document.getElementById('end_date').value || 'Not specified';
        document.getElementById('review_description').textContent = document.getElementById('description').value;
        document.getElementById('review_contact_name').textContent = document.getElementById('contact_name').value || 'Not specified';
        document.getElementById('review_contact_phone').textContent = document.getElementById('contact_phone').value || 'Not specified';
        document.getElementById('review_contact_email').textContent = document.getElementById('contact_email').value || 'Not specified';
    }

    // Initialize map
    let map;
    let marker;
    function initMap() {
        map = L.map('map').setView([20.5937, 78.9629], 5); // Default to India view
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Add click event to place marker
        map.on('click', function(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(e.latlng).addTo(map);
            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
            
            // Reverse geocode to get address
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${e.latlng.lat}&lon=${e.latlng.lng}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('location').value = data.display_name || 'Selected location';
                });
        });
    }

    // Initialize address autocomplete
    function initAutocomplete() {
        const placesAutocomplete = places({
            appId: 'YOUR_ALGOLIA_APP_ID', // Replace with your Algolia app ID
            apiKey: 'YOUR_ALGOLIA_API_KEY', // Replace with your Algolia API key
            container: document.getElementById('location')
        });
        
        placesAutocomplete.on('change', function(e) {
            if (e.suggestion && e.suggestion.latlng) {
                if (marker) {
                    map.removeLayer(marker);
                }
                marker = L.marker(e.suggestion.latlng).addTo(map);
                map.setView(e.suggestion.latlng, 15);
                document.getElementById('latitude').value = e.suggestion.latlng.lat;
                document.getElementById('longitude').value = e.suggestion.latlng.lng;
            }
        });
    }

    // Current location button
    document.getElementById('useCurrentLocation').addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                if (marker) {
                    map.removeLayer(marker);
                }
                const latlng = [position.coords.latitude, position.coords.longitude];
                marker = L.marker(latlng).addTo(map);
                map.setView(latlng, 15);
                document.getElementById('latitude').value = latlng[0];
                document.getElementById('longitude').value = latlng[1];
                
                // Reverse geocode to get address
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latlng[0]}&lon=${latlng[1]}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('location').value = data.display_name || 'Current location';
                    });
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    });

    // File upload handling
    document.getElementById('dropZone').addEventListener('click', function() {
        document.getElementById('blueprint').click();
    });
    
    document.getElementById('blueprint').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            document.getElementById('uploadContent').classList.add('hidden');
            document.getElementById('fileNameDisplay').textContent = file.name;
            document.getElementById('fileNameDisplay').classList.remove('hidden');
            document.getElementById('replaceButton').classList.remove('hidden');
            
            // Show preview if image
            if (file.type.match('image.*')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('filePreview').innerHTML = `
                        <img src="${e.target.result}" class="max-h-64 mx-auto rounded">
                    `;
                    document.getElementById('filePreview').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else if (file.name.endsWith('.pdf')) {
                document.getElementById('filePreview').innerHTML = `
                    <div class="text-center p-4">
                        <i class="fas fa-file-pdf text-5xl text-red-500 mb-2"></i>
                        <p class="text-sm font-medium">${file.name}</p>
                        <p class="text-xs text-gray-500 mt-1">PDF Document</p>
                    </div>
                `;
                document.getElementById('filePreview').classList.remove('hidden');
            }
        }
    });
    
    // Drag and drop for blueprint
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        document.getElementById('dropZone').addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
        document.getElementById('dropZone').addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        document.getElementById('dropZone').addEventListener(eventName, unhighlight, false);
    });
    
    function highlight() {
        document.getElementById('dropZone').classList.add('border-blue-400', 'bg-blue-50');
    }
    
    function unhighlight() {
        document.getElementById('dropZone').classList.remove('border-blue-400', 'bg-blue-50');
    }
    
    document.getElementById('dropZone').addEventListener('drop', handleDrop, false);
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        document.getElementById('blueprint').files = files;
        const event = new Event('change');
        document.getElementById('blueprint').dispatchEvent(event);
    }

    // Multiple image upload handling
    document.getElementById('imageDropZone').addEventListener('click', function() {
        document.getElementById('project_images').click();
    });
    
    document.getElementById('project_images').addEventListener('change', function(e) {
        const files = e.target.files;
        if (files.length > 0) {
            document.getElementById('imagePreviews').innerHTML = '';
            document.getElementById('imagePreviews').classList.remove('hidden');
            
            Array.from(files).forEach(file => {
                if (file.type.match('image.*')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewDiv = document.createElement('div');
                        previewDiv.className = 'relative';
                        previewDiv.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-32 object-cover rounded border border-gray-200">
                            <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                                ×
                            </button>
                        `;
                        previewDiv.querySelector('button').addEventListener('click', function() {
                            previewDiv.remove();
                            if (document.getElementById('imagePreviews').children.length === 0) {
                                document.getElementById('imagePreviews').classList.add('hidden');
                            }
                        });
                        document.getElementById('imagePreviews').appendChild(previewDiv);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });

    // Initialize map when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
        initAutocomplete();
        document.getElementById('map').classList.remove('hidden');
    });
</script>
@endsection