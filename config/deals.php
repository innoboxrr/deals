<?php

return [

	'user_class' => 'App\Models\User',

	'agent_class' => 'App\Models\Agent',

	'excel_view' => 'deals::excel.',

	'notification_via' => ['mail', 'database'],

	'export_disk' => 's3',

	'search-options' => [
		'filtersPath' => 'vendor' . DIRECTORY_SEPARATOR . 'innoboxrr' . DIRECTORY_SEPARATOR . 'deals' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'Filters',
		'filtersNamespace' => 'Innoboxrr\Deals\Models\Filters',
	],
	
];