<?php

namespace App\Http\Controllers\Client\TwoFactorAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\TwoFactorAuthRequest;
use App\Models\ActiveCode;
use App\Notifications\SendActiveCodeMail;
use App\Notifications\SendActiveCodeSMS;
use Illuminate\Http\Request;

class TwoFactorAuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function postType(TwoFactorAuthRequest $request)
    {

        $code = ActiveCode::generateCode($request->user());

        if ($request['type'] == 'sms') {

            # Set new phone number in session
            $request->session()->flash('phone', $request['phone']);
            # Send SMS
            $request->user()->notify(new SendActiveCodeSMS($code, $request['phone']));

        } elseif ($request['type'] == 'email') {

            # Set new email in session
            $request->session()->flash('email', $request['email']);
            # Send Email
            $request->user()->notify(new SendActiveCodeMail($code, $request['email']));

        } else {
            return redirect(\route('home'));
        }

        return view('2factor-auth.inter-token-form');
    }

    public function postToken(Request $request)
    {

        $request->validate([
            'token' => 'required'
        ]);

        # If not set any session return back.
        if (!$request->session()->has('phone') && !$request->session()->has('email')) {
            return redirect()->route('profile.twoFactorAuth', $request->user());
        }

        # Check Code.
        $status = ActiveCode::verifyCode($request->user(), $request->token);

        if ($status) {  
            $request->user()->activeCodes()->delete();

            if ($request->session()->has('phone')) {
                $request->user()->update([
                    'two_factor_type' => 'sms',
                    'phone' => $request->session()->get('phone'),
                ]);
            } elseif ($request->session()->has('email')) {
                $request->user()->update([
                    'two_factor_type' => 'email',
                    'email' => $request->session()->get('email'),
                ]);
            }

            return \redirect()->route('profile.show', $request->user())->with('success', 'Two factore authentication done.');
        } else {
            return \redirect()->route('profile.twoFactorAuth', $request->user())->with('error', 'Try again.');

        }

    }
}
