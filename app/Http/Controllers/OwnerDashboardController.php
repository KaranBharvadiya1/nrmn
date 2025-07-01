<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;

class OwnerDashboardController extends Controller
{
    // OwnerDashboardController.php
    public function index()
    {
        return view('owner.dashboard', [
            'projectCount' => Project::where('owner_id', Auth::id())->count(),
            'notificationCount' => 5,
        ]);
    }


    public function projects() {
        return view('owner.projects');
    }

    public function addProject() {
        return view('owner.add-project');
    }

    public function help() {
        return view('owner.help');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'phone'      => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $user->profile_picture = $path;
        }

        $user->update($request->only('first_name', 'last_name', 'email', 'phone'));

        return response()->json(['status' => 'success']);
    }
}
