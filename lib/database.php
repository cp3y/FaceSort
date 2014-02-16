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
		// SQLクエリを実行
		$res = mysql_query($sql) or die(mysql_error());

		// 結果を出力します。 
		$row = mysql_fetch_array($res, MYSQL_NUM);

		// 結果セットを開放
		mysql_free_result($res);

		return $row;
	}
	
	function selectMysqlMulti($sql) {
		// SQLクエリを実行
		$res = mysql_query($sql) or die(mysql_error());

		$result_array = array();
		// 結果を出力します。 
		while ($row = mysql_fetch_assoc($res)) {
			$result_array[] = $row;
		}

		// 結果セットを開放
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