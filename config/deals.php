<?php

return [

	'user_class' => 'App\Models\User',

	'excel_view' => 'deals::excel.',

	'notification_via' => ['mail', 'database'],

	'export_disk' => 's3',
	
];