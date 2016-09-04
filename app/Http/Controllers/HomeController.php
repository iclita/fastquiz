<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RedirectRequest;
use Auth;
use Cookie;
use Socialite;
use App\User;

class HomeController extends Controller
{
    /**
     * The languages accepted by the application.
     *
     * @var array
     */
    private $acceptedLanguages = ['en', 'de'];

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
        return redirect('/')->with('error', 'You must log in first');
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

    /**
     * Change the language according to the user preference
     *
     * @param Request  $request
     * @return Response
     */
    public function changeLanguage(Request $request)
    {
        if(is_null($request->input('lang')) || !in_array($request->input('lang'), $this->acceptedLanguages)) {
            return redirect('/');
        }
        
        Cookie::queue('fastquiz-lang', $request->input('lang'), 2628000);
        return redirect()->to($request->input('url'));
    }
}
