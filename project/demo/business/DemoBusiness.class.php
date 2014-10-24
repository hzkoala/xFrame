<?php
class DemoBusiness extends DemoBasicBusiness {


	public function addDemo ($data) {
		# action
		$test = new DemoEntity();
		$test->setValue($data);
		$id = $test->save();
		
		# return 
		return $id;
	}
}
