<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\HasCategory;

class Article extends Model
{

	use HasCategory;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'category_id'
    ];

	/**
     * The number of articles per page on the private area.
     *
     * @constant ITEMS_PER_PAGE int
     */
    const ITEMS_PER_PAGE = 5;

	/**
	 * The Article can belong to only one Category.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	/**
	 * The Article can belong to only one User.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
