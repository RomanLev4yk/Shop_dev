<?php

function recursiveBuildMenuItem($arr, $i = 0) {
	$output = [];
	foreach ($arr as $item) {
		if ($item['parent_id'] === $i) {
			$output[$item['id']] = [
				'id' => $item['id'],
				'childs' => []
			];

			$output[$item['id']]['childs'][] = recursiveBuildMenuItem($arr, $item['id']);
		}
	}
	return $output;
}

$arr = [
    [
        'id' => 1,
        'parent_id' => 0
    ],
    [
        'id' => 2,
        'parent_id' => 1
    ],
    [
        'id' => 3,
        'parent_id' => 2
    ]
];

[
    [
        'id' => 1,
        'childs' => [
            [
                'id' => 2,
                'childs' => [
                    [
                        'id' => 3,
                        'childs' => []
                    ]
                ]
            ]
        ]
    ]
];

print_r(recursiveBuildMenuItem($arr, 0));