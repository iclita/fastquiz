<?php 

namespace App\Repositories\Privates;

use Auth;
use DB;
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
	private function checkUser()
	{
		if (Auth::guest()) {
			throw new \Exception('Unauthorized acces here!');
		}
	}

	/**
	 * Get the all the Article's associated with the authenticated user.
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		// This is superfluous because of the middleware.
		// But another security check does no harm. :)
		$this->checkUser();

		// Get all the Articles belonging to the current User
		$articles = Auth::user()->articles()->orderByRaw('updated_at desc, created_at desc')->get();
		// Eager load all the relations
		$articles->load('category', 'user');

		return $articles;
	}

	/**
	 * Get the Article model with the given id.
	 * Practically get the Article with the given id.
	 *
	 * @param int $id
	 * @return App\Article
	 */
	public function find($id)
	{
		// This is superfluous because of the middleware.
		// But another security check does no harm. :)
		$this->checkUser();
		
		// Get the Article belonging to the current User with a given $id
		$article = Auth::user()->articles()->findOrFail($id);
		// Eager load all the relations
		$article->load('category', 'user');

		return $article;
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
		$this->checkUser();

		$data = $request->except('category');
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
		$this->checkUser();

		$data = $request->except('category');
		// The form sends the category field and we translate it to category_id
		// This is done because we need to insert category_id into the DB but keep category in the form for proper validation messages
		$data['category_id'] = (int) $request->input('category');

		$id = (int) $id;

		$article = $this->find($id);

		$article->update($data);
	}

}