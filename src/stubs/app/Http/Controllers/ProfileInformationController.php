<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class ProfileInformationController extends Controller
{
    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $input = $request->all();
        $v = Validator::make($request->all(), [
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'username' => ['required','string', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'photo' => ['nullable', 'image', 'max:1024'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
            'city' => ['nullable'],
            'state' => ['nullable'],
            'zip' => ['required', 'max:5']
        ])->validateWithBag('updateProfileInformation');

            dump($user);
            dump($request->all());

        $user->username = $input['username'];
        $user->email = $input['email'];
        $user->save();
    }
}
