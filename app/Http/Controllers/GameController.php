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
    	// If the answer came to late
    	if (Carbon::now()->diffInSeconds($time) >= 13) {
    		return json_encode(['error' => 'To late, my brother!']);
    	}

    	if ($data['correct'] === $choice) {
    		Auth::user()->addPoints(1);
    		$correct = true;
    	}else{
    		Auth::user()->removePoints(1);
    		$correct = false;
    	}

    	return json_encode(['correct' => $correct]);
    }
}
