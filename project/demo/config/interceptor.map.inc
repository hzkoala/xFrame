<?php
$interceptorMap = array(
	'all' => array(
		'SessionInterceptor', 
		'UserAuthInterceptor', 
		'EntityAutoSaveInterceptor'
	), 
	'action' => array(
		'index' => array(), 
		'api' => array(
			'UserAuthInterceptor'
		), 
		'tool' => array()
	), 
	'method' => array(
		'index' => array(
			'index' => array(), 
			'add' => array(), 
			'del' => array(), 
			'post' => array()
		)
	)
);