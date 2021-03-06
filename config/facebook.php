<?php

/**
 * Facebook configuration
 */
return [
	'config' => [
		'app_id' => env('FACEBOOK_APP_ID', null),
		'app_secret' => env('FACEBOOK_APP_SECRET', null),
		'default_graph_version' => env('FACEBOOK_DEFAULT_GRAPH_VERSION', 'v2.8'),
	],
	'redirect_uri' => env('APP_HOST')
];