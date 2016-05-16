<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Privates\ArticleRepository;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
	/**
	 * The Article repository instance .
	 *
	 * @var ArticleRepository
	 */
	private $repository;

	/**
	 * Create a new controller instance.
	 *
	 * @param ArticleRepository $repository
	 * @return void
	 */
	public function __construct(ArticleRepository $repository)
	{
		$this->middleware('auth');

		$this->repository = $repository;
	}

    /**
     * Fetch all the Articles and show them to the authenticated User.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$query = getSearchParams($request);

    	$articles = $this->repository->all($query);
        
        return view('articles.index', compact('articles', 'query'));
    }

    /**
     * Show the Form for creating a new Article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('articles.create');
    }

    /**
     * Store a new Article.
     *
	 * @param ArticleRequest $request
     * @return RedirectResponse
     */
    public function store(ArticleRequest $request)
    {
    	$this->repository->create($request);
        
        return redirect()->route('articles')->with('success', 'Article succesfully created');
    }

    /**
     * Show the Form for editing an existing Article.
     *
	 * @param Request $request
	 * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
    	$id = (int) $id;

    	$article = $this->repository->find($id);

    	return view('articles.edit', compact('article'));
    }

    /**
     * Update an existing Article.
     *
	 * @param ArticleRequest $request
     * @return RedirectResponse
     */
    public function update(ArticleRequest $request, $id)
    {
    	$this->repository->update($request, $id);
        
        return redirect()->route('articles')->with('success', 'Article succesfully updated');
    }

    /**
     * Delete an existing Article.
     *
	 * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request)
    {
    	$id = (int) $request->input('id');

    	$article = $this->repository->find($id);

    	$article->delete();
        
        return redirect()->route('articles')->with('success', 'Article succesfully deleted');
    }

}
