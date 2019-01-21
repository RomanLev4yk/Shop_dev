<?php

namespace App\Model;

class Setting extends XModel
{
	public static function getDataByDescription(string $column = '') : array
	{
		try {
			$all = Setting::select('name', 'description', 'value')
				->where('description', $column)
				->get();
		}
		catch (\Exception $err) {
			logger($err->getMessage());
			return [];
		}

		$output = [];
		foreach ($all as $item) {
			$output[explode('_', $item->name)[2]] = $item->value;
		}

		return $output;
	}
}
