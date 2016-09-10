<?php 

namespace App\Services;

trait CheckStatus {

	/*
	|--------------------------------------------------------------------------
	|  CheckStatus Trait
	|--------------------------------------------------------------------------
	|
	| This trait is reponsable for verifying the model status (approved, rejected or pending).
	|
	*/

	/**
	 * Check if model is approved.
	 *
	 * @return bool
	 */
    public function isApproved()
    {
    	return $this->status === 'approved';
    }

	/**
	 * Check if model is rejected.
	 *
	 * @return bool
	 */
    public function isRejected()
    {
    	return $this->status === 'rejected';
    }

	/**
	 * Check if model is pending.
	 *
	 * @return bool
	 */
    public function isPending()
    {
    	return $this->status === 'pending';
    }

}