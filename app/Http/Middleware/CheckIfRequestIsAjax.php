<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfRequestIsAjax 
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{
		if ( ! $request->ajax()) {
			throw new \Exception('Only AJAX requests are permitted');	
		}

		return $next($request);
	}

}
