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

	/**
	 * Set the status for this resource and update the score accordingly.
	 *
	 * @param string $status
	 * @return void
	 */
    public function setStatus($status)
    {
    	switch ($status) {
    		case 'approved':
    			$score = static::POINTS_PER_ITEM;
    			break;
    		case 'rejected':
    			$score = -static::POINTS_PER_ITEM;
    			break;
    		case 'pending':
    			$score = 0;
    			break;
    		default:
    			throw new \Exception('Invalid status!');
    			break;
    	}

    	$this->update([
    			'status' => $status,
    			'score' => $score
    		]);
    }

}