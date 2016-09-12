<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Repositories\QuestionRepository;

class QuestionController extends Controller
{
	/**
	 * The Question repository instance .
	 *
	 * @var QuestionRepository
	 */
	private $repository;

	/**
	 * Create a new controller instance.
	 *
	 * @param QuestionRepository $repository
	 * @return void
	 */
	public function __construct(QuestionRepository $repository)
	{
		$this->middleware('auth');

		$this->repository = $repository;
	}

    /**
     * Fetch all the Qustions and show them to the authenticated User.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$query = getSearchParams($request);

    	$questions = $this->repository->all($query);
        
        return view('questions.index', compact('questions', 'query'));
    }

    /**
     * Show the Form for creating a new Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('questions.create');
    }

    /**
     * Store a new Question.
     *
	 * @param QuestionRequest $request
     * @return RedirectResponse
     */
    public function store(QuestionRequest $request)
    {
    	$this->repository->create($request);
        
        return redirect()->route('questions')->with('success', 'Question succesfully created');
    }

    /**
     * Show the Form for editing an existing Question.
     *
	 * @param Request $request
	 * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
    	$question = $this->repository->find($id);

    	return view('questions.edit', compact('question'));
    }

    /**
     * Update an existing Question.
     *
	 * @param QuestionRequest $request
     * @return RedirectResponse
     */
    public function update(QuestionRequest $request, $id)
    {
    	$this->repository->update($request, $id);
        
        return redirect()->route('questions')->with('success', 'Question succesfully updated');
    }

    /**
     * Delete an existing Question.
     *
	 * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request)
    {
    	$id = $request->input('id');

    	$question = $this->repository->find($id);

    	$question->delete();
        
        return redirect()->route('questions')->with('success', 'Question succesfully deleted');
    }

}
