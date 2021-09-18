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

    public function create(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'email' => 'required|unique:users|email',
            'username' => 'required|min:3',
            'password' => 'required|min:8'
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return Redirect::back();
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
        ]);

        User::find($request->id)->update( $request->all());

        return Redirect::back();
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => ['required', 'min:3', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable']
        ]);

        $user->update($request->only(OnlyColumns($user)));

        return Redirect::back();
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();
        return Redirect::back();
    }

}
