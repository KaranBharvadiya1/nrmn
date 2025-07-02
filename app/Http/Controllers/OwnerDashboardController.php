<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class OwnerDashboardController extends Controller
{
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
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Profile picture upload/update
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->email      = $request->email;
        $user->phone      = $request->phone;
        $user->save();

        return response()->json([
            'message' => 'Profile updated successfully!',
            'profile_picture_url' => $user->profile_picture ? asset('storage/' . $user->profile_picture) : null
        ]);
    }
}

