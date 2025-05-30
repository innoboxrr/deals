<?php

return [

	'user_class' => 'App\Models\User',

	'lead_class' => 'App\Models\Lead',

	'agent_class' => 'App\Models\Agent',

	'workspace_class' => 'App\Models\Workspace',

	'excel_view' => 'deals::excel.',

	'notification_via' => ['mail', 'database'],

	'export_disk' => 's3',

	'search-options' => [
		'filtersPath' => 'vendor' . DIRECTORY_SEPARATOR . 'innoboxrr' . DIRECTORY_SEPARATOR . 'deals' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'Filters',
		'filtersNamespace' => 'Innoboxrr\Deals\Models\Filters',
	],
	
];