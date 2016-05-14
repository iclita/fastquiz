<?php 

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

trait HasCategory {

	/*
	|--------------------------------------------------------------------------
	|  HasCategory Trait
	|--------------------------------------------------------------------------
	|
	| This trait is reponsable for interacting with the correponding Category.
	|
	*/

	/**
	 * The Article Category name.
	 *
	 * @return string
	 */
    public function getCategoryName()
    {
    	return $this->category->name;
    }

	/**
	 * The Article Category icon url path.
	 *
	 * @return string
	 */
    public function getCategoryIcon()
    {
    	return url('images/categories') . '/' . $this->category->icon;
    }

}