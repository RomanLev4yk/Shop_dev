<?php

namespace App\Model;

class Currency extends XModel
{
    public static function getAllAvailableCurrencies() : array
    {
    	try {
	    	$all = Currency::select('code')
	    		->get();
	    }
	    catch (\Exception $err) {
	    	logger($err->getMessage());
	    	return [];
	    }

	    $output = [];
	    foreach ($all as $item) {
	    	$output[] = $item->code;
	    }
	    return $output;
    }
}
