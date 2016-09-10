<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use App\Services\HasCategory;
use App\Services\RandomSelect;
use App\Services\CheckStatus;

class Article extends Model
{
	use Eloquence, HasCategory, RandomSelect, CheckStatus;
	
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
    protected $fillable = ['title', 'content', 'category_id', 'status'];

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
    const ITEMS_PER_PAGE = 10;

	/**
	 * Get the name of this resource.
	 *
	 * @return string
	 */
    public function getResourceName()
    {
    	return trans('home.resources.article');
    }

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
