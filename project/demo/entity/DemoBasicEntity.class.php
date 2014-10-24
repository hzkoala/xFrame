<?php
abstract class DemoBasicEntity extends BasicEntity {


	public function __construct ($id) {
		$this->_master = $GLOBALS['config']['db']['main']['master'];
		$this->_slave = $GLOBALS['config']['db']['main']['slave'];
		
		parent::__construct($id);
	}
}