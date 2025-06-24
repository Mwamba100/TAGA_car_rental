<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(\App\Models\User::all());
    }

    public function show(User $user)
    {
        return $user;
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user);
    }

    /**
     * Handle profile completion form submission and update the authenticated user.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone'           => 'required|string|max:255',
            'address'         => 'required|string|max:255',
            'nrc_no'          => 'required|string|max:255',
            'company'         => 'required|string|max:255',
            'job_title'       => 'required|string|max:255',
            'birth_date'      => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'city'            => 'required|string|max:255',
            'state'           => 'required|string|max:255',
            'country'         => 'required|string|max:255',
            'postal_code'     => 'required|string|max:255',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = 'storage/' . $path;
        } else {
            // Keep the old picture if not uploading a new one
            $validated['profile_picture'] = $user->profile_picture;
        }

        $user->update($validated);

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
