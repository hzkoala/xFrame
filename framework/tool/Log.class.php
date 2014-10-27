<?php
final class Log {


	/**
	 * Demo方法, 用于自动完成
	 * 
	 * @param mixed $data
	 * @param string $file
	 * @return NULL
	 */
	public static function _log ($data, $file) {
		#
	}


	public static function __callstatic ($funcName, $args) {
		# action
		$data = is_string($args[0]) ? $args[0] : json_encode($args[0]);
		$file = $args[1] . '-' . DateTimeTool::getDate() . '.log';
		
		// create dir
		$dir = LOG . '/' . $funcName;
		if (! file_exists($dir)) {
			FileTool::createDir($dir);
		}
		
		// touch file
		$file = $dir . '/' . $file;
		if (! file_exists($file)) {
			FileTool::createFile($file);
		}
		
		// log data
		$msg = array(
			'time' => DateTimeTool::getDatetime(), 
			'session_id' => session_id(), 
			'data' => $data
		);
		error_log(implode("\t", $msg) . "\n\n", 3, $file);
	}
}