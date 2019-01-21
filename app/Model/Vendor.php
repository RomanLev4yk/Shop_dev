<?php

namespace App\Model;

class Vendor extends XModel
{
    protected $table = 'vendors';

    public function vendor ()
  	{
  		return $this->hasMany('App\Model\Product');
  	}
}
