<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with('roles')->get();
        $roles = Role::all();
        return view('pages.account', compact('user', 'roles'));

    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
            'role' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('user')
                         ->with('success','User created successfully');
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|string|exists:roles,name',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->route('user')
                         ->with('success','User updated successfully');
    }


    public function destroy($id)
    {
        try {
            // Find the user to delete
            $siswa = User::findOrFail($id);

            // Detach all permissions associated with the user
            $siswa->permissions()->detach();

            // Delete the user
            $siswa->delete();

            return redirect()->route('user')->with('success', 'Data siswa berhasil dihapus.');
        } catch (\Exception $e) {
            // Handle any errors
            ddd($e);
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data siswa.']);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show()
    {
    // Get the currently authenticated user
    $user = Auth::user();
    // Check if a user is authenticated
    if (!$user) {
        return redirect()->route('login')->withErrors(['error' => 'You need to log in to view your profile']);
    }
    // Return a view with the user's details
    return view('layout.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */


    public function changePassword(Request $request)
{
    // Validate the form data
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|string|min:8|confirmed',
    ]);

    // Get the current authenticated user
    $user = Auth::user();

    // Check if the provided current password matches the stored password
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password does not match']);
    }

    // Update the user's password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->route('password.change')->with('success', 'Password successfully changed');
}


public function showChangePassword (){
    return view('layout.changepassword');
}
}