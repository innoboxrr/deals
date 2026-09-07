<?php

return [

	'user_class' => 'App\Models\User',

	'lead_class' => 'App\Models\Lead',

	'agent_class' => 'App\Models\Agent',

	'workspace_class' => 'App\Models\Workspace',

	'excel_view' => 'deals::excel.',

	'notification_via' => ['mail', 'database'],

	'export_disk' => 's3',

	/*
	| Obsoleto desde SearchSurge v3: los filtros se localizan solos a partir
	| del namespace del modelo, preguntandole al autoloader de Composer.
	| Se deja vacio y no como clave ausente para que cualquier codigo que
	| todavia lo lea siga recibiendo un array valido.
	*/
	'search-options' => [],
	
];