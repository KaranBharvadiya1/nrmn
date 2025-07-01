<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // Show add project form
    public function index()
    {
        return view('owner.add-project');
    }

    // Store project
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'budget' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'blueprint' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'contact_details' => 'nullable|string|max:255',
        ]);

        // Create project through relationship - automatically sets owner_id
        $project = Auth::user()->projects()->create($validated);

        if ($request->hasFile('blueprint')) {
            $project->update([
                'blueprint' => $request->file('blueprint')->store('blueprints', 'public')
            ]);
        }

        return redirect()->route('projects')->with('success', '✅ Project added successfully!');
    }

    // View all projects
    public function showAll()
    {
        $projects = Project::where('owner_id', auth()->id())->get();
        return view('owner.projects', compact('projects'));
    }


    // Show edit form
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('owner.edit-project', compact('project'));
    }

    // Update project
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|string'
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->all());

        return redirect()->route('projects')->with('success', '✅ Project updated successfully!');
    }

    // Delete project
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects')->with('success', '🗑️ Project deleted successfully!');
    }
}

