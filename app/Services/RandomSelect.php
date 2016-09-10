<?php 

namespace App\Services;

use DB;

trait RandomSelect {

	/*
	|--------------------------------------------------------------------------
	|  RandomSelect Trait
	|--------------------------------------------------------------------------
	|
	| This trait is reponsable for selecting a random number of rows performance wise.
	|
	*/

	/**
	 * Select a random number of rows
	 *
	 * @param int $limit
	 * @return Collection
	 */
    public static function random($limit = 1)
    {
    	$table = (new static)->getTable();

    	$data = DB::select(
						"SELECT t1.id FROM $table AS t1 
						JOIN (SELECT (RAND() * (SELECT MAX(id) FROM $table)) AS id) AS t2
						WHERE t1.id >= t2.id - $limit
						ORDER BY t1.id ASC
						LIMIT $limit"
					);

    	$ids = [];

    	foreach ($data as $object) {
    		$ids[] = $object->id;
    	}

    	return static::whereIn('id', $ids)->get(); 
    }

}