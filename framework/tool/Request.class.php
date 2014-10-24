<?php
final class Request {


	/**
     * 获取请求参数
     * 
     * @param string $name
     * @return mixed
     */
	public static function get ($name) {
		# action
		return $_REQUEST[$name];
	}


	/**
	 * 设置请求参数
	 * 
	 * @param string $name
	 * @param mixed $value
	 * @param bool $isForce
	 * @return NULL
	 */
	public static function set ($name, $value = '', $isForce = TRUE) {
		# action
		if (! isset($_REQUEST[$name]) || $isForce) {
			$_REQUEST[$name] = $value;
		}
	}
}
