<?php

namespace App\Http\Controllers;


class SessionController extends Controller
{

    public function create()
    {
        return view('sessions.create');
    }

    /**
     * Destroy Auth Session
     *
     * @return redirect
     */
    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
