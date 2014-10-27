<?php
final class FileTool {


	/**
	 * 清空目录
	 * 
	 * @param string $path
	 * @return NULL
	 */
	public static function cleanDir ($path) {
		$files = glob($path . '/*');
		foreach ($files as $file) {
			unlink($file);
		}
	}


	/**
	 * 创建目录
	 * 
	 * @param string $path
	 * @return NULL
	 */
	public static function createDir ($path) {
		mkdir($path, 0777, TRUE);
		chmod($path, 0777);
	}


	/**
	 * 创建文件
	 * 
	 * @param string $path
	 * @return NULL
	 */
	public static function createFile ($path) {
		touch($path);
		chmod($path, 0777);
	}
}
?>