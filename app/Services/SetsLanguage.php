<?php 

namespace App\Services;

trait SetsLanguage {

	/*
	|--------------------------------------------------------------------------
	|  SetsLanguage Trait
	|--------------------------------------------------------------------------
	|
	| This trait is reponsable for setting the proper language.
	|
	*/

	/**
	 * Attach an event handler on booting the model.
	 *
	 * @return void
	 */
    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
        	$lang = app()->getLocale('en');
        	$model->lang = $lang;
        });

        static::updating(function($model)
        {
        	$lang = app()->getLocale('en');
        	$model->lang = $lang;
        });
    }

}