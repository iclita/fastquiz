<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use App\Services\HasCategory;
use App\Services\CheckStatus;
use DB;

class Question extends Model
{
    use Eloquence, HasCategory, CheckStatus;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description', 'choice_a', 'choice_b', 'choice_c', 'choice_d', 'correct', 'category_id', 'status', 'score'];

    /**
     * The colums that are searchable.
     * No need for this, but you can define default searchable columns.
     *
     * @var array
     */
   protected $searchableColumns = ['description'];

	/**
     * The number of questions per page on the private area.
     *
     * @constant ITEMS_PER_PAGE int
     */
    const ITEMS_PER_PAGE = 10;

	/**
     * The number of points for a published question.
     *
     * @constant POINTS_PER_ITEM int
     */
    const POINTS_PER_ITEM = 3;

	/**
     * The number of seconds to answer a question.
     *
     * @constant TIME_LIMIT int
     */
    const TIME_LIMIT = 10;

	/**
     * The number of seconds to count for delays.
     *
     * @constant TIME_DELAY int
     */
    const TIME_DELAY = 2;

	/**
	 * Get the name of this resource.
	 *
	 * @return string
	 */
    public function getResourceName()
    {
    	return trans('home.resources.question');
    }

	/**
	 * Get all the available choices.
	 *
	 * @return array
	 */
    public function getChoices()
    {
    	$choices = ['a' => $this->choice_a, 
    				'b' => $this->choice_b, 
    				'c' => $this->choice_c, 
    				'd' => $this->choice_d];

    	shuffle_assoc($choices);

    	return $choices;
    }

	/**
	 * Get the correct answer for this Question.
	 *
	 * @return string
	 */
    public function getAnswer()
    {
    	$choice = 'choice_' . $this->correct;

    	return $this->{$choice};
    }

	/**
	 * Get a temporary alias for this Question.
	 *
	 * @return string
	 */
    public function getTemporaryAlias()
    {
    	return uniqid(true) . $this->id . str_random(10);
    }

	/**
	 * Select a random question
	 *
	 * @return App\Qustion
	 */
    public static function random()
    {
    	$table = (new static)->getTable();

    	$data = collect(
    				DB::select(
						"SELECT t1.id FROM $table AS t1 
						JOIN (SELECT (RAND() * (SELECT MAX(id) FROM $table)) AS id) AS t2
						WHERE t1.status = 'approved' AND t1.id >= t2.id
						ORDER BY t1.id ASC
						LIMIT 1"
					)
    			);

    	$id = $data->pluck('id')->first();

    	return static::findOrFail($id); 
    }

	/**
	 * The Question can belong to only one Category.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	/**
	 * The Question can belong to only one User.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
