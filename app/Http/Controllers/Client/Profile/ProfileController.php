<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','can:profile-options,user']);
    }

    public function show(User $user)
    {
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'firstname' => ['string', 'max:255', 'nullable'],
            'lastname' => ['string', 'max:255', 'nullable'],
            'email' => ['string', 'email', 'max:255', 'unique:users,email,' . $user->id, 'nullable'],
            // TODO : validate phone number
            'phone' => ['nullable', 'numeric', 'unique:users,phone,' . $user->id], 'nullable',
            'address' => ['string', 'max:255', 'nullable'],
            'jobe' => ['string', 'max:255', 'nullable'],
        ]);

        if ($request->password) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $data['password'] = $request->password;
        }

        $user->update($data);

        return redirect(route('profile.show', $user))->with('success', 'Profile edited.');
    }

    public function twoFactorAuth()
    {
        return view('profile.two-factor-auth');
    }

    public function confirmPassword(User $user)
    {
        return \view('profile.confirm-password');
    }

    public function emailVerify(User $user)
    {
        if (!empty($user->email)) {
            $this->emptyEmailMsg($user);
        }else{
            $this->verifyEmailDone();
        }

    }
    public function emptyEmailMsg(User $user)
    {
        return view('profile.email-verify.empty-email-message',\compact('user'));
    }
    public function verifyEmailDone()
    {
        return view('profile.email-verify.done-message');
    }
}
