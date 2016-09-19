<?php 

namespace App\Repositories;

use Auth;
use App\Article;
use Illuminate\Http\Request;

class ArticleRepository {

	/*
	|--------------------------------------------------------------------------
	| Article Repository
	|--------------------------------------------------------------------------
	|
	| This repository is available only for every User.
	| Each User has access ONLY to his Article repository.
	|
	*/

	/**
	 * Check if the user is authorized to access this resource.
	 *
	 * @return void
	 */
	private function isAuthorized()
	{
		if (Auth::guest()) {
			throw new \Exception('Unauthorized acces here!');
		}
	}

	/**
	 * Get the all the Article's associated with the authenticated user.
	 *
	 * @param array $query // array with query string search params
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	private function allForUser(array $query)
	{
		if (count($query) === 0) {		
			// Get all the Articles belonging to the current User
			$articles = Auth::user()->articles()
									->orderByRaw('updated_at desc, created_at desc')
									->paginate(Article::ITEMS_PER_PAGE);
		}else{
			// If the user did not select a specific category it means we must search through all categories
			if (empty($query['category'])) {
				// If no status filtering has been applied search through all articles
				if (empty($query['status'])) {
					$articles = Article::search($query['keywords'])->where('user_id', Auth::id())
																   ->orderByRaw('updated_at desc, created_at desc')
																   ->paginate(Article::ITEMS_PER_PAGE);
				}else{
					$articles = Article::search($query['keywords'])->where('user_id', Auth::id())
																   ->where('status', $query['status'])
																   ->orderByRaw('updated_at desc, created_at desc')
																   ->paginate(Article::ITEMS_PER_PAGE);					
				}
			}else{
				if (empty($query['status'])) {				
					$articles = Article::search($query['keywords'])->where('user_id', Auth::id())
																   ->where('category_id', $query['category'])
																   ->orderByRaw('updated_at desc, created_at desc')
																   ->paginate(Article::ITEMS_PER_PAGE);				
				}else{
					$articles = Article::search($query['keywords'])->where('user_id', Auth::id())
																   ->where('category_id', $query['category'])
																   ->where('status', $query['status'])
																   ->orderByRaw('updated_at desc, created_at desc')
																   ->paginate(Article::ITEMS_PER_PAGE);						
				}
			}
		}

		// Eager load all the relations
		$articles->load('category', 'user');

		return $articles;
	}

	/**
	 * Get the all the Articles. ADMIN ONLY!!!
	 *
	 * @param array $query // array with query string search params
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	private function allForAdmin(array $query)
	{
		if (count($query) === 0) {		
			// Get all the Articles
			$articles = Article::orderByRaw('updated_at desc, created_at desc')->paginate(Article::ITEMS_PER_PAGE);
		}else{
			// If the user did not select a specific category it means we must search through all categories
			if (empty($query['category'])) {
				// If no status filtering has been applied search through all articles
				if (empty($query['status'])) {
					$articles = Article::search($query['keywords'])->orderByRaw('updated_at desc, created_at desc')
																   ->paginate(Article::ITEMS_PER_PAGE);
				}else{
					$articles = Article::search($query['keywords'])->where('status', $query['status'])
																   ->orderByRaw('updated_at desc, created_at desc')
																   ->paginate(Article::ITEMS_PER_PAGE);					
				}
			}else{
				if (empty($query['status'])) {				
					$articles = Article::search($query['keywords'])->where('category_id', $query['category'])
																   ->orderByRaw('updated_at desc, created_at desc')
																   ->paginate(Article::ITEMS_PER_PAGE);				
				}else{
					$articles = Article::search($query['keywords'])->where('category_id', $query['category'])
																   ->where('status', $query['status'])
																   ->orderByRaw('updated_at desc, created_at desc')
																   ->paginate(Article::ITEMS_PER_PAGE);						
				}
			}
		}

		// Eager load all the relations
		$articles->load('category', 'user');

		return $articles;
	}

	/**
	 * Get the all the Articles depending on the context (normal User vs Admin).
	 *
	 * @param array $query // array with query string search params
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function all(array $query)
	{
		// This is superfluous because of the middleware.
		// But another security check does no harm. :)
		$this->isAuthorized();

		if (Auth::user()->isAdmin()) {
			return $this->allForAdmin($query);
		}

		return $this->allForUser($query);
	}

	/**
	 * Get the Article model with the given id.
	 * Practically get the Article with the given id for the normal User.
	 *
	 * @param int $id
	 * @return App\Article
	 */
	private function findForUser($id)
	{	
		// Get the Article belonging to the current User with a given $id
		$article = Auth::user()->articles()->findOrFail($id);
		// Eager load all the relations
		$article->load('category', 'user');

		return $article;
	}

	/**
	 * Get the Article model with the given id.
	 * Practically get the Article with the given id for the normal Admin.
	 *
	 * @param int $id
	 * @return App\Article
	 */
	private function findForAdmin($id)
	{	
		// Get the Article belonging to the current User with a given $id
		$article = Article::findOrFail($id);
		// Eager load all the relations
		$article->load('category', 'user');

		return $article;
	}

	/**
	 * Get the Article with the given id depending on the context (normal User vs Admin).
	 *
	 * @param int $id
	 * @return App\Article
	 */
	public function find($id)
	{
		// This is superfluous because of the middleware.
		// But another security check does no harm. :)
		$this->isAuthorized();

		if (Auth::user()->isAdmin()) {
			return $this->findForAdmin($id);
		}

		return $this->findForUser($id);
	}

	/**
	 * Save a new Article to User's repository.
	 *
	 * @param Request $request
	 * @return void
	 */
	public function create(Request $request)
	{
		// This is superfluous because of the middleware.
		// But another security check does no harm. :)
		$this->isAuthorized();

		$data = $request->except(['category', 'status', 'score']);
		// The form sends the category field and we translate it to category_id
		// This is done because we need to insert category_id into the DB but keep category in the form for proper validation messages
		$data['category_id'] = (int) $request->input('category');

		$article = new Article($data);

		$author = Auth::user();

		$author->articles()->save($article);
	}

	/**
	 * Update an existing Article from the User's repository.
	 *
	 * @param Request $request
	 * @param int $id
	 * @return void
	 */
	public function update(Request $request, $id)
	{
		// This is superfluous because of the middleware.
		// But another security check does no harm. :)
		$this->isAuthorized();

		$data = $request->except(['category', 'status', 'score']);
		// The form sends the category field and we translate it to category_id
		// This is done because we need to insert category_id into the DB but keep category in the form for proper validation messages
		$data['category_id'] = (int) $request->input('category');

		$id = (int) $id;

		$article = $this->find($id);
		// We put the article in pending state to revalidate it 
		$data['status'] = 'pending';

		$article->update($data);
	}

}