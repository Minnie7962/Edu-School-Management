<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    protected $userService;

    // public function __construct(UserService $userService)
    // {
    //     $this->userService = $userService;
    // }

    /**
     * Handle common user operations like:
     * - Profile management
     * - Account settings
     * - Role-based redirections
     */
    public function profile()
    {
        $user = auth()->user();
        return view('users.profile', compact('user'));
    }

    /**
     * Update common user attributes
     */
    // public function updateProfile(UserUpdateRequest $request)
    // {
    //     $user = auth()->user();
    //     $this->userService->updateProfile($user, $request->validated());
        
    //     return redirect()->back()->with('success', 'Profile updated successfully');
    // }

    /**
     * Handle user status changes
     */
    public function toggleStatus(User $user)
    {
        $this->authorize('manage-users');
        $user->is_active = !$user->is_active;
        $user->save();
        
        return response()->json(['status' => 'success']);
    }
}
