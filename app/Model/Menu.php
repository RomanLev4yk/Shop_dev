<?php

namespace App\Model;

class Menu extends XModel
{
    public static function getItems() : array
    {
    	try {
    		$all = Menu::select('id', 'name', 'link', 'parent_id')
    			->get()
                ->toArray();
    	}
    	catch (\Exception $err) {
    		logger($err->getMessage());
    		return [];
    	}

        $a = self::recursiveBuildMenuItem($all, 0);
        // print_r($a);
        // exit();

        return $a;
    }

    public static function recursiveBuildMenuItem(array $all, $i = 0) : array
    {
        $output = [];
        foreach ($all as $item) {
            if ($item['parent_id'] === $i) {
                $output[$item['id']] = [
                    'id' => $item['id'],
                    'title' => $item['name'],
                    'link' => $item['link'],
                    'childs' => []
                ];

                $output[$item['id']]['childs'][] = self::recursiveBuildMenuItem($all, $item['id']);
            }
        }
        return $output;
    }
}
