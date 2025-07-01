@extends('layouts.owner')

@section('title', 'Projects')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header with Add Button -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Project Portfolio</h1>
            <p class="text-gray-600 mt-1">Manage all your construction projects</p>
        </div>
        <a href="{{ route('add-project') }}" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <i class="fas fa-plus mr-2"></i> New Project
        </a>
    </div>

    <!-- Filters and Search -->
    <div class="mb-6 bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <!-- Search -->
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" id="search" placeholder="Search projects..."
                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    onkeyup="searchTable()">
            </div>
            
            <!-- Status Filter -->
            <div class="flex-1">
                <select id="statusFilter" onchange="filterTable()"
                    class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Statuses</option>
                    <option value="Planning">Planning</option>
                    <option value="Active">Active</option>
                    <option value="On Hold">On Hold</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            
            <!-- Date Range -->
            <div class="flex-1 grid grid-cols-2 gap-2">
                <input type="date" id="startDateFilter" onchange="filterTable()"
                    class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <input type="date" id="endDateFilter" onchange="filterTable()"
                    class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>
    </div>

    <!-- Projects Table -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table id="projectsTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider cursor-pointer" onclick="sortTable(0)">
                            # <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider cursor-pointer" onclick="sortTable(1)">
                            Project Name <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Location
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider cursor-pointer" onclick="sortTable(3, 'date')">
                            Start Date <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider cursor-pointer" onclick="sortTable(4, 'date')">
                            End Date <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($projects as $project)
                    <tr class="hover:bg-indigo-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $project->name }}</div>
                            <div class="text-sm text-gray-500">{{ $project->type }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $project->location }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d M Y') : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusClasses = [
                                    'Planning' => 'bg-blue-100 text-blue-800',
                                    'Active' => 'bg-green-100 text-green-800',
                                    'On Hold' => 'bg-yellow-100 text-yellow-800',
                                    'Completed' => 'bg-purple-100 text-purple-800',
                                ];
                                $statusClass = $statusClasses[$project->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                {{ $project->status ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-3">
                                <a href="{{ route('projects', $project->id) }}" class="text-indigo-600 hover:text-indigo-900" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('edit-project', $project->id) }}" class="text-blue-600 hover:text-blue-900" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('delete-project', $project->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this project?')" 
                                            class="text-red-600 hover:text-red-900" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <tr class="bg-gray-50">
                        <td colspan="7" class="px-6 py-3">
                            @if ($project->contractors->isEmpty())
                                <p class="text-sm text-gray-500 italic">No contractors have applied yet.</p>
                            @else
                                <div class="text-sm text-gray-700 font-semibold mb-1">Applicants:</div>
                                <ul class="list-disc ml-6 space-y-1 text-sm text-gray-700">
                                    @foreach ($project->contractors as $contractor)
                                        <li>
                                            {{ $contractor->first_name }} {{ $contractor->last_name }}
                                            <span class="text-gray-500 text-xs">({{ $contractor->email }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                            <div class="flex flex-col items-center justify-center py-8">
                                <i class="fas fa-folder-open text-4xl text-gray-400 mb-2"></i>
                                <p>No projects found</p>
                                <a href="{{ route('add-project') }}" class="mt-2 text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    Create your first project
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if(method_exists($projects, 'hasPages') && $projects->hasPages())
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $projects->links() }}
        </div>
        @endif
    </div>
</div>

<script>
    // Enhanced search functionality
    function searchTable() {
        const input = document.getElementById("search").value.toLowerCase();
        const statusFilter = document.getElementById("statusFilter").value;
        const startDate = document.getElementById("startDateFilter").value;
        const endDate = document.getElementById("endDateFilter").value;
        
        const rows = document.querySelectorAll("#projectsTable tbody tr");
        
        rows.forEach(row => {
            const cells = row.querySelectorAll("td");
            const rowStatus = cells[5]?.querySelector("span")?.textContent.trim();
            const rowStartDate = cells[3]?.textContent.trim();
            const rowEndDate = cells[4]?.textContent.trim();
            
            // Convert dates to comparable format
            const rowStartDateObj = rowStartDate ? new Date(rowStartDate) : null;
            const rowEndDateObj = rowEndDate !== '-' ? new Date(rowEndDate) : null;
            const filterStartDateObj = startDate ? new Date(startDate) : null;
            const filterEndDateObj = endDate ? new Date(endDate) : null;
            
            let matchSearch = true;
            let matchStatus = true;
            let matchStartDate = true;
            let matchEndDate = true;
            
            // Search text matching
            if (input) {
                matchSearch = false;
                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(input)) matchSearch = true;
                });
            }
            
            // Status filter
            if (statusFilter && rowStatus !== statusFilter) {
                matchStatus = false;
            }
            
            // Date range filters
            if (filterStartDateObj && rowStartDateObj && rowStartDateObj < filterStartDateObj) {
                matchStartDate = false;
            }
            if (filterEndDateObj && rowEndDateObj && rowEndDateObj > filterEndDateObj) {
                matchEndDate = false;
            }
            
            row.style.display = (matchSearch && matchStatus && matchStartDate && matchEndDate) ? "" : "none";
        });
    }
    
    // Filter by status (called when status dropdown changes)
    function filterTable() {
        searchTable(); // Reuse the search function which now handles all filters
    }
    
    // Sorting functionality
    function sortTable(columnIndex, type = 'text') {
        const table = document.getElementById("projectsTable");
        const tbody = table.querySelector("tbody");
        const rows = Array.from(tbody.querySelectorAll("tr"));
        const headers = table.querySelectorAll("th");
        const header = headers[columnIndex];
        const isAscending = !header.classList.contains("asc");
        
        // Reset all headers
        headers.forEach(h => {
            h.classList.remove("asc", "desc");
            const icon = h.querySelector("i");
            if (icon) icon.className = "fas fa-sort ml-1";
        });
        
        // Set current header state
        header.classList.add(isAscending ? "asc" : "desc");
        const icon = header.querySelector("i");
        if (icon) icon.className = isAscending ? "fas fa-sort-up ml-1" : "fas fa-sort-down ml-1";
        
        // Sort rows
        rows.sort((a, b) => {
            const aCell = a.cells[columnIndex];
            const bCell = b.cells[columnIndex];
            let aValue = aCell.textContent.trim();
            let bValue = bCell.textContent.trim();
            
            if (type === 'date') {
                aValue = aValue === '-' ? 0 : new Date(aValue).getTime();
                bValue = bValue === '-' ? 0 : new Date(bValue).getTime();
            } else if (type === 'number') {
                aValue = parseFloat(aValue) || 0;
                bValue = parseFloat(bValue) || 0;
            } else {
                aValue = aValue.toLowerCase();
                bValue = bValue.toLowerCase();
            }
            
            return isAscending 
                ? (aValue > bValue ? 1 : -1)
                : (aValue < bValue ? 1 : -1);
        });
        
        // Reattach sorted rows
        rows.forEach(row => tbody.appendChild(row));
    }
    
    // Initialize date filters to current month
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
        const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
        
        document.getElementById('startDateFilter').valueAsDate = firstDay;
        document.getElementById('endDateFilter').valueAsDate = lastDay;
    });
</script>

<style>
    [x-cloak] { display: none !important; }
    .asc .fa-sort-up { display: inline; }
    .asc .fa-sort-down, .asc .fa-sort { display: none; }
    .desc .fa-sort-down { display: inline; }
    .desc .fa-sort-up, .desc .fa-sort { display: none; }
</style>
@endsection