<?php

namespace App\Model;

class Payment extends XModel
{
    public static function getAllAvailablePaymentsIcons() : array
    {
    	try {
	    	$all = Payment::select('name', 'link')
	    		->get();
	    }
	    catch (\Exception $err) {
	    	logger($err->getMessage());
	    	return [];
	    }

	    $output = [];
	    foreach ($all as $item) {
	    	$output[$item->name] = $item->link; 
	    }
	    return $output;
    }
}
