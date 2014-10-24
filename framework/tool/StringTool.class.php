<?php
final class StringTool {


	/**
	 * Unicode16编码
	 * 
	 * @param string $inStr
	 * @return string
	 */
	public static function unicode16_encode ($inStr) {
		$inStr = iconv('UTF-8', 'UCS-2', $inStr);
		$len = strlen($inStr);
		$outStr = '';
		
		for ($i = 0; $i < $len - 1; $i = $i + 2) {
			$c = $inStr[$i];
			$c2 = $inStr[$i + 1];
			if (ord($c) > 0) { // 两个字节的文字
				$outStr .= '\u' . base_convert(ord($c), 10, 16) . base_convert(ord($c2), 10, 16);
			} else {
				$outStr .= $c2;
			}
		}
		return $outStr;
	}
}
