<?php
final class Db {
	private static $db;
	private $key;
	private $master;
	private $slave;


	/**
	 * 单例
	 * 
	 * @param array $masterDbConfig
	 * @param array $slaveDbConfig
	 * @param string $key
	 * @return object
	 */
	public static function Singleton ($masterDbConfig, $slaveDbConfig = array(), $key = 'main') {
		# param
		Process::checkException($masterDbConfig);
		
		# action
		if (! self::$db[$key]) {
			new self($masterDbConfig, $slaveDbConfig, $key);
		}
		
		# return
		return self::$db[$key];
	}


	private function __construct ($masterDbConfig, $slaveDbConfig, $key) {
		# action
		$this->master = new BasicDatabase($masterDbConfig);
		if ($slaveDbConfig) {
			$this->slave = new BasicDatabase($slaveDbConfig);
		}
		
		self::$db[$key] = $this;
	}


	private function run ($sql, $paramArr, $accessType, $queryType) {
		# action
		// accessDb
		if ($accessType == 'slave' && $this->slave) {
			$db = $this->slave;
		} else {
			$db = $this->master;
		}
		
		// query
		$query = $db->prepare($sql);
		$paramArr = array_values($paramArr);
		if ($queryType == 'query') {
			$query->execute($paramArr);
			$data = $query->fetchAll(PDO::FETCH_ASSOC);
		} else {
			$data = $query->execute($paramArr);
		}
		
		# return
		return $data;
	}


	/**
	 * 执行SQL
	 * 
	 * @param string $sql
	 * @param array $paramArr
	 * @param string $accessType
	 * @param string $runType
	 * @return array
	 */
	public function query ($sql, $paramArr = array(), $accessType = '', $runType = '') {
		# action
		$queryType = $runType ? $runType : $this->getQueryType($sql);
		$accessType = $accessType ? $accessType : $this->getAccessType($sql);
		$res = $this->run($sql, $paramArr, $accessType, $queryType);
		
		# return
		return $res;
	}


	/**
	 * getInsertId
	 * 
	 * @return int
	 */
	public function getInsertId () {
		return $this->master->lastInsertId();
	}


	private function getAccessType ($sql) {
		$accessType = 'master';
		if ($this->slave && (substr($sql, 0, 6)) == 'select') {
			$accessType = 'slave';
		}
		
		return $accessType;
	}


	private function getQueryType ($sql) {
		$queryType = 'execute';
		if (strtolower(substr($sql, 0, 6)) == 'select') {
			$queryType = 'query';
		}
		
		return $queryType;
	}


	/**
	 * 获取SQL-Where子句
	 * 
	 * @param array $paramArr
	 * @return string
	 */
	public static function getWhereStatement ($paramArr) {
		# action
		$tempArr = array();
		foreach ($paramArr as $k => $v) {
			$tempArr[] = " `{$k}` = ? ";
		}
		$whereStr = join(' AND ', $tempArr);
		
		# return
		return $whereStr;
	}


	/**
	 * 获取SQL-Insert子句
	 * 
	 * @param array $paramArr
	 * @return string
	 */
	public static function getInsertStatement ($paramArr) {
		# action
		$tempArr = array();
		foreach ($paramArr as $k => $v) {
			$tempArr[] = " `{$k}` = ? ";
		}
		$insertStr = join(' , ', $tempArr);
		
		# return
		return $insertStr;
	}
}
