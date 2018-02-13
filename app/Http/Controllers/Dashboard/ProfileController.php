<?php

namespace App\Http\Controllers\Dashboard;

use App\Utils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @return Response
     */
    public function showProfile()
    {
        return view('dashboard.profile.index');
    }

    /**
     * Edit the user's profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|confirmed|min:6',
            'logo_number' => 'required|in:' . implode(',', Utils::getLogosNumber()),
        ]);

        $updateValues = [
            'name' => $request->input('name', $user->name),
            'email' => $request->input('email', $user->email),
            'logo_number' => Utils::getValidLogoNumber($request->input('logo_number', $user->logo_number)),
        ];
        $password = $request->input('password', null);
        if (!empty($password)) {
            $updateValues['password'] = Hash::make($password);
        }

        if ($user->update($updateValues)) {
            flash()->success('Profile updated successfully.');
        } else {
            flash()->info('Profile was not updated.');
        }

        return redirect(route('dashboard::profile'));
    }
}
