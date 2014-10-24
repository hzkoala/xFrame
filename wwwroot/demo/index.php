<?php
# setting
// some basic settings
ini_set('memory_limit', '32M');
mb_internal_encoding('UTF-8');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// define basic path
define('ROOT', realpath('../..')); // @todo: edit this value if the www dir is changed 
define('FRAME_ROOT', ROOT . '/framework');
define('PROJECT_ROOT', ROOT . '/project/demo'); // @todo: edit this value if there is more than 1 project, and project dir name is changed 
define('WWW_ROOT', realpath('.'));

# include
// path define
require_once (PROJECT_ROOT . '/config/path.conf.inc');
// config
require_once (PROJECT_ROOT . '/config/main.conf.inc');

# main
// global function
require_once (FRAME_ROOT . '/tool/GlobalTool.class.php');
require_once (FRAME_ROOT . '/tool/Request.class.php');

// autoload
// make autoload map, @todo: add token for safety if necessary
if (Request::get('remap') == 'do') {
	GlobalTool::makeAutoloadMap();
	exit('init success');
}

// autoload function
spl_autoload_register(array(
	'GlobalTool', 
	'autoload'
));

// clean cache
if (Request::get('delcache') == 'do') {
	GlobalTool::cleanCache();
	exit('del cache success');
}

// error and exception
set_error_handler(array(
	'Process', 
	'handleError'
), E_ERROR | E_WARNING | E_PARSE);
set_exception_handler(array(
	'Process', 
	'handleException'
));

// mvc route
list ($action, $method) = Process::getRoute('demo', 'demo');
Process::mvcRoute($action, $method);

?>