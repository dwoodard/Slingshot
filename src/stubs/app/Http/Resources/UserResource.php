<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();
        return [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'username' => $user->username,
            'email' => $user->email,
            'phone' => $user->phone,
            'password' => $user->password,
            'address' => $user->address,
            'city' => $user->city,
            'state' => $user->state,
            'zip' => $user->zip,
            'isAdmin'=> $user->isAdmin,
            'roles' => $user->getRoleNames()
        ];
    }

    public function with($request)
    {
        return [];
    }
}
