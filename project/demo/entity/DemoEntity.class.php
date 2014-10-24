<?php
class DemoEntity extends DemoBasicEntity {


	public function __construct ($id) {
		$this->_tbname = 'table_demo';
		
		parent::__construct($id);
	}
}