<?php
final class GlobalTool {


	/**
     * 生成AutoloadMap
     * 
     * @return string
     */
	public static function makeAutoloadMap () {
		# action
		$allFiles = array();
		$action2class = array();
		$class2path = array();
		
		$patternDirArr = array(
			FRAME_ROOT . '/', 
			FRAME_ROOT . '/*/', 
			FRAME_ROOT . '/*/*/', 
			FRAME_ROOT . '/*/*/*/', 
			COMMON . '/', 
			COMMON . '/*/', 
			COMMON . '/*/*/', 
			COMMON . '/*/*/*/', 
			PROJECT_ROOT . '/', 
			PROJECT_ROOT . '/*/', 
			PROJECT_ROOT . '/*/*/', 
			PROJECT_ROOT . '/*/*/*/'
		);
		
		foreach ($patternDirArr as $patternDir) {
			$pattern = $patternDir . '*.class.php'; // max recursion depth 4
			$files = glob($pattern, GLOB_BRACE);
			if ($files) {
				$allFiles = array_merge($allFiles, $files);
			}
		}
		
		foreach ($allFiles as &$v) {
			$v = str_replace('\\', '/', $v);
			$className = basename($v, '.class.php');
			$action2class[strtolower($className)] = $className;
			$class2path[$className] = $v;
		}
		
		# write file
		$filePath = CONFIG . '/class.map.inc';
		$fileContent = "<?php\n";
		$fileContent .= ' $action2class = ' . var_export($action2class, TRUE) . ";\n";
		$fileContent .= ' $class2path = ' . var_export($class2path, TRUE) . ";\n";
		
		file_put_contents($filePath, $fileContent);
		
		# return
		return $fileContent;
	}


	/**
     * autoload
     * 
     * @param string $className
     * @return NULL
     */
	public static function autoload ($className) {
		# action
		if (key_exists($className, $GLOBALS['class2path'])) {
			require ($GLOBALS['class2path'][$className]);
		}
	}


	/**
     * init session
     * 
     * @return NULL
     */
	public static function initSession () {
		session_save_path(CACHE . '/session');
		ini_set("session.save_handler", "files");
		session_start();
	}


	/**
     * save session
     * 
     * @return NULL
     */
	public static function saveSession () {}


	/**
     * 获取标准Ajax返回
     * 
     * @return array
     */
	public static function initAjaxReturn () {
		$res = array(
			'status' => FALSE, 
			'msg' => '', 
			'url' => '', 
			'error_id' => 0
		);
		
		return $res;
	}


	/**
	 * 获取标准格式的时间
	 * 
	 * @param int|string $time
	 * @return string
	 */
	public static function getDatetime ($time = '') {
		# param
		if (! $time) {
			$time = time();
		} elseif (is_string($time)) {
			$time = strtotime($time);
		}
		
		# action
		$datetime = date('Y-m-d H:i:s', $time);
		
		# return
		return $datetime;
	}


	/**
	 * 清空缓存
	 * 
	 * @return NULL
	 */
	public static function cleanCache () {
		if (! defined('CACHE') || ! is_dir(CACHE . '/template_c') || ! is_dir(CACHE . '/template_cache')) {
			exit('No Cache Dir');
		}
		
		FileTool::cleanDir(CACHE . '/template_c');
		FileTool::cleanDir(CACHE . '/template_cache');
	}
}