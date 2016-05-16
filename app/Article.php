<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\HasCategory;
use Sofa\Eloquence\Eloquence;

class Article extends Model
{

	use HasCategory, Eloquence;
	
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
     * The colums that are searchable.
     * No need for this, but you can define default searchable columns.
     *
     * @var array
     */
   protected $searchableColumns = ['title', 'content'];

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
