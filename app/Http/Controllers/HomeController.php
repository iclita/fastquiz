<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RedirectRequest;
use Auth;
use Cookie;
use Socialite;
use App\User;
use App\Article;

class HomeController extends Controller
{
    /**
     * The languages accepted by the application.
     *
     * @var array
     */
    private $acceptedLanguages = ['en', 'de', 'ro'];

	/**
     * Home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $articles = Article::latest()->take(8)->get();

        $articles->load('user');

        return view('home', compact('articles'));
    }
    
	/**
     * Log in form does not exist so we redirect the user to the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return redirect()->route('home')->with('error', 'You must log in first');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        
        return redirect()->route('home');
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
            return redirect()->route('home');
        }

        $authUser = User::findOrCreate($user);

        Auth::login($authUser, true);

        return redirect()->route('home');
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
            return redirect()->route('home');
        }
        
        Cookie::queue('fastquiz-lang', $request->input('lang'), 2628000);
        return redirect()->to($request->input('url'));
    }
}
