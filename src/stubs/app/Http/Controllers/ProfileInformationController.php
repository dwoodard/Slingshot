<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


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
            'first_name' => ['nullable', 'string'],
            'last_name' => ['nullable', 'string'],
            'username' => ['required','string', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone' => ['nullable', 'string'],
            'address' => ['nullable'],
            'city' => ['nullable'],
            'state' => ['nullable'],
            'zip' => ['nullable', 'regex:/^\d{5}(?:[-\s]\d{4})?$/'],
        ])->validateWithBag('updateProfileInformation');

        User::where('email', '=', $request->email)->update($request->all());

        return Redirect::route('profile.show');
//        return response('', 409)->header('X-Inertia-Location', URL::route('profile.show'));
//        return Inertia::render('profile/Show', ['create_url' => url('user/profile')]);
    }
}
