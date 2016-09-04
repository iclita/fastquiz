<?php 

namespace App\Http\Middleware;

use Closure;
use Cookie;
use App;
use Carbon\Carbon;

class VerifyLanguagePreference {

    /**
     * The languages accepted by the application.
     *
     * @var array
     */
    private $acceptedLanguages = ['en', 'de', 'ro'];

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		// Check if the user already selected its preferred language
        if (Cookie::has('fastquiz-lang')) {
            App::setLocale(Cookie::get('fastquiz-lang', 'en'));
            Carbon::setLocale(Cookie::get('fastquiz-lang', 'en'));
        }else{
        	// Otherwise try to guess the client language preferrence
        	$language = $request->getPreferredLanguage();

        	// Extract the language identifier
    		$language = strtolower(explode('_', $language)[0]);
    		
    		// Check if the identified language is accepted by the application
    		if (in_array($language, $this->acceptedLanguages)) {
    			Cookie::queue('fastquiz-lang', $language, 2628000);
            	App::setLocale($language);
            	Carbon::setLocale($language);
    		}else{
    			// If everything fails, fallback to english
            	App::setLocale('en');
            	Carbon::setLocale('en');    			
    		}
        }
        
		return $next($request);
	}

}
