<?php
class EntityAutoSaveInterceptor implements BasicInterceptor {


	public static function before () {
		#
	}


	public static function after () {
		if (is_array($GLOBALS['entityMap'])) {
			foreach ($GLOBALS['entityMap'] as $entity) {
				if (! $entity->isSave()) {
					$entity->save();
				}
			}
		}
	}
}
