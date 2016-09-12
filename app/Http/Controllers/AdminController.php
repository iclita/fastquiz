<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use App\Repositories\ArticleRepository;
use App\Repositories\QuestionRepository;

class AdminController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @param QuestionRepository $repository
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth', ['except' => ['getLogin', 'postLogin']]);
		$this->middleware('admin', ['except' => ['getLogin', 'postLogin']]);
	}

	/**
     * Show the login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('admin.login');
    }

	/**
     * Process the login request.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $user = User::findByName($request->name);

        if (is_null($user)) {
        	return back()->with('error', 'Invalid credentials!');
        }

        if ( ! $user->isAdmin()) {
        	return back()->with('error', 'You are not the Admin!');
        }

        Auth::login($user, true);

        return redirect()->route('admin.get.dashboard');
    }

	/**
	 * Show the admin dashboard.
	 *
	 * @return Response
	 */
	public function dashboard(Request $request)
	{
		$total = [];

		$total['articles'] = DB::table('articles')->count();
		$total['pending-articles'] = DB::table('articles')->where('status', 'pending')->count();
		$total['approved-articles'] = DB::table('articles')->where('status', 'approved')->count();
		$total['rejected-articles'] = DB::table('articles')->where('status', 'rejected')->count();

		$total['questions'] = DB::table('questions')->count();
		$total['pending-questions'] = DB::table('questions')->where('status', 'pending')->count();
		$total['approved-questions'] = DB::table('questions')->where('status', 'approved')->count();
		$total['rejected-questions'] = DB::table('questions')->where('status', 'rejected')->count();

		return view('admin.dashboard', compact('total'));
	}

	/**
     * Show all articles to the Admin.
     *
     * @param Request $request
     * @return Response
     */
	public function getArticles(Request $request, ArticleRepository $repository)
	{
    	$query = getSearchParams($request);

    	$articles = $repository->all($query);

    	return view('admin.articles', compact('articles', 'query'));
	}

	/**
     * Change article status.
     *
     * @param Request $request
     * @param ArticleRepository $repository
     * @param int $id
     * @return RedirectResponse
     */
	public function changeArticleStatus(Request $request, ArticleRepository $repository, $id)
	{
		$article = $repository->find($id);

		$status = $request->status;

		$article->update(['status' => $status]);

		return back()->with('success', "Article status is now $status");
	}   

	/**
	 * Log the user out of the admin area.
	 *
	 * @return RedirectResponse
	 */
	public function getLogout()
	{
		Auth::logout();

		return redirect()->route('admin.get.login');
	}
}
