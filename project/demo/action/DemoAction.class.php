<?php
class DemoAction extends DemoBasicAction {


	public function demoMethod () {
		# param
		$this->response->setValue('param', 'demo data...');
		$this->response->setValue('seo', array(
			'title' => 'xFrame', 
			'desc' => 'Welcome 2 xFrame'
		));
	}
}
