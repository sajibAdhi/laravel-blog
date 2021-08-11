<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{

    /**
     * Show the form for Login.
     *
     * @return View
     */
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required|min:7 ',
        ]);

        if (Auth::attempt($attributes)) {
            session()->regenerate();
            return redirect(route('home'))->with('Success', 'Welcome Back!');
        }

        throw ValidationException::withMessages([
            'email' => 'Your provided credentials could not be verified'
        ]);

        // return back()->withInput()
        //     ->withErrors(['email' => 'Your provided credentials could not be verified']);
    }

    /**
     * Destroy Auth Session
     *
     * @return redirect
     */
    public function destroy()
    {
        Auth::logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
