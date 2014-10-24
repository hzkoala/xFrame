<?php
class BasicEntity {
	protected $_id;
	protected $_db;
	// to set in childClass
	protected $_master;
	protected $_slave;
	protected $_dbkey = 'main';
	protected $_tbname;
	// fields
	protected $_dataFields = array();
	protected $_changedFields = array();
	// flag
	protected $_saveFlag = FALSE;
	protected $_newFlag = FALSE;
	protected $_delFlag = FALSE;


	public function __construct ($id) {
		// get database connection
		$this->_db = Db::Singleton($this->_master, $this->_slave, $this->_dbkey);
		if ($id) {
			$this->_id = $id;
			$this->load($id);
		} else {
			$this->_newFlag = TRUE;
		}
		
		// add into global entity map
		$GLOBALS['entityMap'][] = $this;
	}


	protected function load ($id) {
		# action
		$sql = "SELECT * FROM `{$this->_tbname}` WHERE `id`='{$id}' ";
		$data = $this->_db->query($sql);
		$data = $data[0];
		
		// set value
		foreach ($data as $k => $v) {
			$this->_dataFields[$k] = $v;
		}
	}


	public function save () {
		# action
		if ($this->isNew()) {
			$this->add();
		} elseif ($this->isDel()) {
			$this->del();
		} else {
			$this->update();
		}
		
		$this->_saveFlag = TRUE;
		
		# return
		return $this->_id;
	}


	protected function add () {
		# action
		$sql = "INSERT INTO `{$this->_tbname}` SET ";
		$sql .= Db::getInsertStatement($this->_dataFields);
		$this->_db->query($sql, $this->_dataFields);
		
		// get id & del newflag
		$this->_id = $this->_db->getInsertId();
		$this->_dataFields['id'] = $this->_id;
		$this->_newFlag = FALSE;
	}


	protected function del () {
		# action
		$sql = "DELETE FROM `{$this->_tbname}` WHERE `id` = '{$this->_id}' ";
		$this->_db->query($sql);
	}


	protected function update () {
		# action
		$sql = "UPDATE `{$this->_tbname}` SET ";
		$sql .= Db::getInsertStatement($this->_changedFields);
		$sql .= " WHERE `id` = '{$this->_id}' ";
		$this->_db->query($sql, $this->_changedFields);
	}


	public function setValue ($arr) {
		foreach ($arr as $k => $v) {
			$this->$k = $v;
		}
	}


	public function isNew () {
		return $this->_newFlag;
	}


	public function isDel () {
		return $this->_delFlag;
	}


	public function isSave () {
		return $this->_saveFlag;
	}


	public function __get ($field) {
		return $this->_dataFields[$field];
	}


	public function __set ($field, $value) {
		// set value
		$this->_dataFields[$field] = (string) $value;
		
		// add into changed list
		if (! in_array($field, $this->_changedFields)) {
			$this->_changedFields[] = $field;
		}
	}
}
