<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);



        event(new Registered($user));

        Auth::login($user);
        $email = $request->email;

        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect('/register')
                ->with('error', ' Email not found');
        }
        //If user exist send mail to user
        Mail::send('successfully_registered', ['email' => $email], function (Message $message) use ($email) {
            $message->subject('You are registered');
            $message->to($email);
        });

        return redirect('/dashboard')
            ->with('success', 'Registered Successfully ... Check Your Email');


//        return redirect(RouteServiceProvider::HOME);
    }
}
