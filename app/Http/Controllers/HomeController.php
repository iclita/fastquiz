<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RedirectRequest;
use Auth;
use Socialite;
use App\User;

class HomeController extends Controller
{
	/**
     * Home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('home');
    }
    
	/**
     * Log in form does not exist so we redirect the user to the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return redirect('/');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        
        return redirect('/');
    }
	/**
     * Redirect the user to the OAuth authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from OAuth service.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            return redirect('/');
        }

        $authUser = User::findOrCreate($user);

        Auth::login($authUser, true);

        return redirect('/');
    }
}
