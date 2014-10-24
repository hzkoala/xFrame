<?php
class SessionInterceptor implements BasicInterceptor {


	public static function before () {
		GlobalTool::initSession();
	}


	public static function after () {
		GlobalTool::saveSession();
	}
}
