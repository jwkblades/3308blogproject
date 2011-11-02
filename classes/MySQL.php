<?php

class MySQL{
	private $dbConn;
	public function MySQL($user, $password, $host){
		$this->dbConn = mysql_connext($host, $user, $password);
	}
	public function selectDatabase($db){
		mysql_select_db($db, $this->dbConn);
	}
	public function query($query){
		$results = mysql_query($query, $this->dbConn);
		return $results;
	}
	public function fetchAssoc($result){
		$row = mysql_fetch_assoc($result, $this->dbConn);
		return $row;
	}
	public function close(){
		mysql_close($this->dbConn);
		unset($this->dbConn);
	}
}

?>
