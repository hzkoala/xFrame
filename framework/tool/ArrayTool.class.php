<?php
final class ArrayTool {


	/**
	 * 为数组每一项加引号
	 * 
	 * @param array $arr
	 * @return string
	 */
	public static function join4query ($arr) {
		foreach ($arr as & $v) {
			$v = "'{$v}'";
		}
		$res = join(',', $arr);
		
		return $res;
	}
}
?>