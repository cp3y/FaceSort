<?php
require_once(dirname(__FILE__) . '/../conf/db_conf.php');

class DBclass
{
	public $conn;

	function __construct() {
		$this->conn = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or die(mysql_error());
		mysql_select_db(MYSQL_DATABASE) or die(mysql_error());
	}

	function selectMysql($sql) {
		// SQL�N�G�������s
		$res = mysql_query($sql) or die(mysql_error());

		// ���ʂ��o�͂��܂��B 
		$row = mysql_fetch_array($res, MYSQL_NUM);

		// ���ʃZ�b�g���J��
		mysql_free_result($res);

		return $row;
	}
	
	function selectMysqlMulti($sql) {
		// SQL�N�G�������s
		$res = mysql_query($sql) or die(mysql_error());

		$result_array = array();
		// ���ʂ��o�͂��܂��B 
		while ($row = mysql_fetch_assoc($res)) {
			$result_array[] = $row;
		}

		// ���ʃZ�b�g���J��
		mysql_free_result($res);

		return $result_array;
	}

	function insertMysql($sql){
		return mysql_query($sql);
		//or die(mysql_error());
		//return true;
	}

	function updateMysql($sql){
		return mysql_query($sql);
		// or die(mysql_error());
		//return true;
	}

	function __destruct() {
		mysql_close($this->conn);
	}
}