<?php
// the default defines below are suitable only if no dir is changed
if (! defined('ROOT')) {
	define('ROOT', realpath('../../..'));
}

if (! defined('FRAME_ROOT')) {
	define('FRAME_ROOT', realpath('../../../framework'));
}

if (! defined('PROJECT_ROOT')) {
	define('PROJECT_ROOT', realpath('..'));
}

define('COMMON', ROOT . 'project/common');
define('CACHE', PROJECT_ROOT . '/cache');
define('SESSION', PROJECT_ROOT . '/cache/session');
define('LOG', PROJECT_ROOT . '/log');
define('TEMPLATE', PROJECT_ROOT . '/template');
define('CONFIG', PROJECT_ROOT . '/config');
