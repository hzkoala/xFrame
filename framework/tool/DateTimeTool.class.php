<?php
final class DateTimeTool {


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
	 * 获取标准格式的日期
	 *
	 * @param int|string $time
	 * @return string
	 */
	public static function getDate ($time = '') {
		# param
		if (! $time) {
			$time = time();
		} elseif (is_string($time)) {
			$time = strtotime($time);
		}
		
		# action
		$date = date('Y-m-d', $time);
		
		# return
		return $date;
	}
}