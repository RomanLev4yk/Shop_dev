<?php

namespace App\Http\Views;

use App\Model\Page;

class DefaultView
{
	public $model;

	public function __construct(Page $model)
	{
		$this->model = $model;
	}
}
