<?php
require_once "../simpletest/autorun.php";
require_once "../config.php";
require_once "../classes/MySQL.php";

class TestOfMySQL extends UnitTestCase{
	private $sql;
	function testMySQLConnect(){
		global $settings;
		$this->assertTrue(isset($settings));
		$this->assertTrue(isset($settings['mysqlUser']));
		$this->assertTrue(isset($settings['mysqlPass']));
		$this->assertTrue(isset($settings['mysqlHost']));
		$this->sql = new MySQL($settings['mysqlUser'], $settings['mysqlPass'], $settings['mysqlHost']);
	}
	function testMySQLSelect(){
		global $settings;
		$this->assertTrue(isset($settings['mysqlDb']));
		$this->assertTrue($this->sql);
		$this->sql->select($settings['mysqlDb']);
	}
	function testMySQLQuery(){
		$this->assertTrue($this->sql);
		$query = "SELECT DATABASE() AS db";
		$results = $this->sql->query($query);
		$this->assertTrue($results);
	}
	function testMySQLNumRows(){
		$this->assertTrue($this->sql);
		$query = "SELECT DATABASE() AS db";
		$results = $this->sql->query($query);
		$this->assertTrue($results);
		$rows = $this->sql->numRows($results);
		$this->assertTrue($rows == 1);
	}
	function testMySQLFetchAssoc(){
		$this->assertTrue($this->sql);
		$query = "SELECT DATABASE() AS db";
		$results = $this->sql->query($query);
		$this->assertTrue($results);
		$row = $this->sql->fetchAssoc($results);
		$this->assertTrue($row['db'] == "blog");
	}
	function testMySQLFetchObject(){
		$this->assertTrue($this->sql);
		$query = "SELECT DATABASE() AS db";
		$results = $this->sql->query($query);
		$this->assertTrue($results);
		$row = $this->sql->fetchObj($results);
		$this->assertTrue($row->db == "blog");
	}
	function testMySQLSan(){
		$this->assertTrue($this->sql);
		$query = "WHERE var='" . $this->sql->san("' or drop *.*");
		$this->assertTrue($query == "WHERE var='\' or drop *.*");
	}
	function testMySQLClose(){
		$this->assertTrue($this->sql);
		$this->sql->close();
	}
}

?>
