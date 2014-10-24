<?php
final class Process {


	/**
     * mvc route
     * 
     * @param string $action
     * @param string $method
     * @return NULL
     */
	public static function mvcRoute ($action, $method) {
		# action
		$actionName = strtolower($action . 'Action');
		$methodName = strtolower($method . 'Method');
		
		// action route
		self::checkException(key_exists($actionName, $GLOBALS['action2class']));
		
		$className = $GLOBALS['action2class'][$actionName];
		$class = new $className();
		self::executeBefore($action, $method);
		$class->$methodName();
		self::executeAfter($action, $method);
		$class->display();
	}


	/**
     * handle error
     * 
     * @param int $errno
     * @param string $errstr
     * @param string $errfile
     * @param int $errline
     * @return NULL
     */
	public static function handleError ($errno, $errstr, $errfile, $errline) {
		# action
		if ($GLOBALS['switch']['debug']) {
			debug_print_backtrace();
		}
		exit();
	}


	/**
     * handle exception
     * 
     * @param object $exception
     * @return NULL
     */
	public static function handleException ($exception) {
		# action
		if ($GLOBALS['switch']['debug']) {
			debug_print_backtrace();
		}
		exit();
	}


	/**
     * 将待检查项作为布尔值, False则抛出异常
     * 
     * @param mixed $checkItem
     * @param int $exceptionCode
     * @throws Exception
     * @return NULL
     */
	public static function checkException ($checkItem, $exceptionCode = 0) {
		# action
		if (! $checkItem) {
			$exceptionMsg = $GLOBALS['exceptionDefine'][$exceptionCode] ?  : '未定义异常';
			throw new Exception($exceptionMsg, $exceptionCode);
		}
	}


	/**
     * interceptor before functions
     * 
     * @param string $action
     * @param string $method
     * @return NULL
     */
	public static function executeBefore ($action, $method) {
		$interceptors = self::getInterceptor($action, $method);
		
		foreach ($interceptors as $item) {
			$item::before();
		}
	}


	/**
     * interceptor after functions
     * 
     * @param string $action
     * @param string $method
     * @return NULL
     */
	public static function executeAfter ($action, $method) {
		$interceptors = self::getInterceptor($action, $method);
		$interceptors = array_reverse($interceptors);
		
		foreach ($interceptors as $item) {
			$item::after();
		}
	}


	private static function getInterceptor ($action, $method) {
		$allMap = $GLOBALS['interceptorMap']['all'];
		$actionMap = $GLOBALS['interceptorMap']['action'][$action];
		$methodMap = $GLOBALS['interceptorMap']['method'][$action][$method];
		
		$interceptors = isset($methodMap) ? $methodMap : (isset($actionMap) ? $actionMap : $allMap);
		
		return $interceptors;
	}


	/**
	 * 获取Route参数
	 * 
	 * @param string $defaultAction
	 * @param string $defaultMethod
	 * @return NULL
	 */
	public static function getRoute ($defaultAction, $defaultMethod) {
		$isMatch = preg_match('~\/([A-Za-z0-9_]+)\/([A-Za-z0-9_]+)~', $_SERVER['REQUEST_URI'], $match);
		
		if ($isMatch) {
			$ret = array(
				$match[1], 
				$match[2]
			);
		} else {
			$ret = array(
				$defaultAction, 
				$defaultMethod
			);
		}
		
		return $ret;
	}
}
