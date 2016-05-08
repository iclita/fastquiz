<?php 

namespace App\Presenters;

use Illuminate\Database\Eloquent\Model;

trait UserPresenter {

	/*
	|--------------------------------------------------------------------------
	|  UserPresenter Trait
	|--------------------------------------------------------------------------
	|
	| This trait gives us User attributes to be shown in the view.
	|
	*/

    /**
     * Get the Facebook User profile link.
     *
     * @return string
     */
    public function getProfile()
    {
        return 'https://www.facebook.com/' . $this->facebook_id;
    }

    /**
     * Get the Facebook User avatar link.
     *
     * @return string
     */
    public function getAvatar()
    {
        return 'https://graph.facebook.com/v2.6/' . $this->facebook_id . '/picture?type=large';
    }

}