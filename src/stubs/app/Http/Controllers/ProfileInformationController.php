<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;


class ProfileInformationController extends Controller
{
    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->request->remove('_method');

        Validator::make($request->all(), [
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'username' => ['required','string', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone' => ['nullable'],
            'address' => ['nullable'],
            'city' => ['nullable'],
            'state' => ['nullable'],
            'zip' => ['required', 'max:5']
        ])->validateWithBag('updateProfileInformation');

        User::where('email', '=', $request->email)->update($request->all());

        return Redirect::route('profile.show');
    }
}
