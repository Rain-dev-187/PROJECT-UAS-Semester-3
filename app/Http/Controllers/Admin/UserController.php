<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('Admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('Admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'nickname' => 'nullable|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $data = [
            'name' => $request->name,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('avatars', 'public');
            $data['photo'] = $path;
        }

        $user = User::create($data);

        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('Admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:255',
            'nickname' => 'nullable|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $update = [
            'name' => $request->name,
            'nickname' => $request->nickname,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $update['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('avatars', 'public');
            $update['photo'] = $path;
        }

        $user->update($update);

        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
