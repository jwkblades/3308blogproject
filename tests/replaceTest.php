<?php
require_once "../simpletest/autorun.php";
require_once "../classes/Replace.php";
require_once "../classes/Template.php";
require_once "../functions.php";

$user = array("frog" => "prince");
$config = array("url" => "http://www.example.com");
$page = array("content" => "Waffles");

class TestOfReplace extends UnitTestCase{
	public function testUserReplace(){
		global $user;
		$str = "Hello [[user:frog]]";
		$final = Replace::on($str);
		$this->assertTrue($final == ("Hello " . $user['frog']));
		$str = "Hello [[user:username]]";
		$final = Replace::on($str);
		$this->assertTrue($final == "Hello ");
	}
	public function testConfigReplace(){
		global $config;
		$str = "[[url]]";
		$final = Replace::on($str);
		$this->assertTrue($final == $config['url']);
		$str = "[[othervariable]]";
		$final = Replace::on($str);
		$this->assertTrue($final == "");
	}
	public function testPageReplace(){
		global $page;
		$str = "[[page:content]]";
		$final = Replace::on($str);
		$this->assertTrue($final == $page['content']);
		$str = "[[page:title]]";
		$final = Replace::on($str);
		$this->assertTrue($final == "");
	}
	public function testFunctionReplace(){
		$now = strtotime("today");
		$str = "[[function:strtotime:today]]";
		$final = Replace::on($str);
		$this->assertTrue($now == $final);
	}
	public function testIfReplace(){
		$str = "[[function:_if:true:True value:False value]]";
		$final = Replace::on($str);
		$this->assertTrue($final == "True value");
		$str = "[[function:_if::True value:False value]]";
		$final = Replace::on($str);
		$this->assertTrue($final == "False value");
	}
}


?>
