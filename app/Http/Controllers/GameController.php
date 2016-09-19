<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Redis;
use Auth;
use Carbon\Carbon;

class GameController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('ajax', ['only' => 'answer']);
	}

	/**
     * Play the game.
     *
     * @return \Illuminate\Http\Response
     */
    public function play()
    {
    	$question = Question::random();

    	if (is_null($question)) {
    		return back()->with('error', trans('home.no_questions'));
    	}

    	$alias = $question->getTemporaryAlias();

    	$data = json_encode([
    			'time' => Carbon::now()->timestamp,
    			'correct' => $question->correct,
    		]);

    	Redis::set($alias, $data);
        
        return view('game', compact('question', 'alias'));
    }

	/**
     * Answer the question.
     *
     * @param Request $request
     * @return json
     */
    public function answer(Request $request)
    {
    	$choice = $request->input('choice');
    	$alias = $request->input('alias');

    	$data = Redis::get($alias);
    	Redis::del($alias);

    	$data = json_decode($data, true);

    	$time = Carbon::createFromTimestamp($data['time']);

    	$answerTime = Carbon::now()->diffInSeconds($time);
    	// If the answer came to late
    	if ($answerTime >= Question::TIME_LIMIT + Question::TIME_DELAY) {
    		return json_encode(['error' => 'To late, my brother!']);
    	}
    	// If the answer came very quickly than convert the gained seconds into additional points
    	$additionalPoints = ($answerTime < Question::TIME_LIMIT) ? abs(ceil(Question::TIME_LIMIT - $answerTime)) : 0;

    	if ($data['correct'] === $choice) {
    		$points = 1 + $additionalPoints;
    		Auth::user()->addPoints($points);
    		$correct = true;
    	}else{
    		Auth::user()->removePoints(1);
    		$correct = false;
    	}

    	return json_encode(['correct' => $correct]);
    }
}
