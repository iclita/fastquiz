<?php

if ( ! function_exists('short'))
{
	/**
	 * Get the short form of a string.
	 *
	 * @param  string  $string
	 * @param  int  $length
	 * @param  string  $append
	 * @return string
	 */
	function short($string, $length=40, $append='..')
	{
		if (mb_strlen($string.$append) > $length) {
			$endPosition = $length - mb_strlen($append);
			$newString = mb_substr($string, 0, $endPosition).$append;
		}else{
			$newString = $string;
		}

		return $newString;
	}
}

if ( ! function_exists('mb_ucfirst')) 
{	
	/**
	 * Get the ucfirst mb version.
	 *
	 * @param  string $string
	 * @param  string $encoding
	 * @return string
	 */
    function mb_ucfirst($string, $encoding = "UTF-8") 
    {
	    $strlen = mb_strlen($string, $encoding);
	    $firstChar = mb_substr($string, 0, 1, $encoding);
	    $then = mb_substr($string, 1, $strlen - 1, $encoding);
	    
	    return mb_strtoupper($firstChar, $encoding) . $then;
    }
}

if ( ! function_exists('mb_ucwords')) 
{	
	/**
	 * Get the ucwords mb version.
	 *
	 * @param  string $str
	 * @param  string $encoding
	 * @return string
	 */
    function mb_ucwords($str, $encoding = "UTF-8") 
    {
    	$string =  mb_convert_case($str, MB_CASE_TITLE, $encoding);
		
		return $string;
    }
}

if ( ! function_exists('cached_asset'))
{
    function cached_asset($path)
    {
        // Get the full path to the asset.
        $realPath = public_path($path);

        if ( ! file_exists($realPath)) {
            throw new \Exception("File not found at [{$realPath}]");
        }

        // Get the last updated timestamp of the file.
        $timestamp = filemtime($realPath);

        // Append the timestamp to the path as a query string.
        $path  .= '?v=' . $timestamp;

        return asset($path);
    }
}

if ( ! function_exists('categories'))
{
	/**
	 * Get all the categories in the application.
	 *
	 * @return array
	 */
    function categories()
    {
    	$categories = trans('categories');
    	asort($categories);

    	return $categories;
    }
}

if ( ! function_exists('getSearchParams'))
{
	/**
	 * Get the search query as an array of parameters to be appended to the url.
	 *
	 * @param Illuminate\Http\Request $request
	 * @return array
	 */
    function getSearchParams(\Illuminate\Http\Request $request)
    {
    	// If we don't have a search input it means we have nothing to append to the query string
        if ( ! $request->input('search')) {
        	return [];
        }

        return [
        	'search' => 'true', 
        	'keywords' => $request->input('keywords'), 
        	'category' => $request->input('category'), 
        	'status' => $request->input('status')
        ];
    }
}

if ( ! function_exists('shuffle_assoc'))
{
	/**
	 * Shuffle an array but preserve keys.
	 *
	 * @param Illuminate\Http\Request $request
	 * @return array
	 */
    function shuffle_assoc(&$array) {
        $keys = array_keys($array);

        shuffle($keys);

        foreach($keys as $key) {
            $new[$key] = $array[$key];
        }

        $array = $new;

        return true;
    }
}