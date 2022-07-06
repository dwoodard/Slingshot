<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Inertia\Controller;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(Request $request):Response
    {
        $data = [
            'users' => UserResource::collection(User::all())
        ];

        return Inertia::render('Admin/Users/index', $data);
    }

    public function edit(User $user):Response
    {
        $data = [
            'user' => UserResource::make($user)
        ];

        return Inertia::render('Admin/Users/edit', $data);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'email' => ['required','email', Rule::unique('users')->ignore($request->id)],
            'username' => 'required|min:3',
            'password' => 'required|min:8',
            'role' => 'required|exists:roles,name'
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole($request->role);

        return Redirect::back();
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => ['required', 'min:3', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|min:8',
            'roles' => 'required|exists:roles,name'
        ]);

        $user->update($request->only(OnlyColumns($user)));

        $user->syncRoles($request->roles);


        return Redirect::back();
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();
        return Redirect::back();
    }

}
