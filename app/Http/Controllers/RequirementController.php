<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class RequirementController extends Controller
{
    public function index()
    {
        $projects = Project::with('owner')->latest()->get();
        return view('contractor.requirements', compact('projects'));
    }

    public function show(Project $project)
    {
        $appliedContractors = $project->contractors; // Assuming relationship is defined
        return view('contractor.show', compact('project', 'appliedContractors'));
    }

    public function apply(Project $project)
    {
        $contractorId = auth()->id();

        // Check if already applied
        if ($project->contractors()->where('contractor_id', $contractorId)->exists()) {
            return back()->with('success', 'You already applied to this project!');
        }

        // Apply
        $project->contractors()->attach($contractorId);

        return back()->with('success', 'You have successfully applied for this project!');
    }

}
