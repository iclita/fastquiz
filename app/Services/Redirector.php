<?php 

namespace App\Services;

use Auth;

trait Redirector {

	/*
	|--------------------------------------------------------------------------
	|  Redirector Trait
	|--------------------------------------------------------------------------
	|
	| This trait is reponsable for redirecting back to Admin or User depending on the case.
	|
	*/

    /**
     * This method gets the correct redirect route after updating/deleting a resource.
     *
     * @param string $resource
     * @return string
     */
    private function getProperRedirectRoute($resource)
    {
        if (Auth::user()->isAdmin()) {
            return "admin.get.{$resource}";
        } 

        return $resource;
    }

}