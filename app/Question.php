<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\HasCategory;
use Sofa\Eloquence\Eloquence;

class Question extends Model
{
    use HasCategory, Eloquence;
	
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
    protected $fillable = ['description', 'choice_a', 'choice_b', 'choice_c', 'choice_d', 'category_id'];

    /**
     * The colums that are searchable.
     * No need for this, but you can define default searchable columns.
     *
     * @var array
     */
   protected $searchableColumns = ['description', 'choice_a', 'choice_b', 'choice_c', 'choice_d'];

	/**
     * The number of questions per page on the private area.
     *
     * @constant ITEMS_PER_PAGE int
     */
    const ITEMS_PER_PAGE = 10;

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