<?php
require_once "../simpletest/autorun.php";
require_once "../config.php";
require_once "../classes/Template.php";

class TestofTemplate extends UnitTestCase{
	function testLoad(){
		$tmp = new Template();
		$templ =  $tmp -> get("noTemp");
		$this -> assertNull($templ);
		$time = strtotime("now");
		$templ = $tmp -> get("noArticlesExist");
		$time2 = strtotime("now");
		$this -> assertTrue(isset($templ));
		$timeDiff1 = $time2 - $time;
		$time3 = strtotime("now");
		$templ2 = $tmp -> get("noArticlesExist");
		$time4 = strtotime("now");
		$timeDiff2 = $time4 - $time3;
		$this -> assertTrue($timeDiff2 < $timeDiff1);
	}
	function testGet(){
		$tmp = new Template();
		$templ =  $tmp -> get("noTemp");
		$this -> assertNull($templ);
		$time = strtotime("now");
		$templ = $tmp -> get("noArticlesExist");
		$time2 = strtotime("now");
		$this -> assertTrue(isset($templ));
		$timeDiff1 = $time2 - $time;
		$time3 = strtotime("now");
		$templ2 = $tmp -> get("noArticlesExist");
		$time4 = strtotime("now");
		$timeDiff2 = $time4 - $time3;
		$this -> assertTrue($timeDiff2 < $timeDiff1);
	}
}
?>
