<?php
class BasicDatabase extends PDO {


	public function __construct ($dbConfig) {
		# param
		Process::checkException($dbConfig);
		
		# action
		$dsn = "mysql:dbname={$dbConfig['dbname']};host={$dbConfig['host']}";
		$user = $dbConfig['user'];
		$password = $dbConfig['password'];
		
		parent::__construct($dsn, $user, $password, array(
			PDO::ATTR_PERSISTENT => true
		));
	}
}
