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
}
?>