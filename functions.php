<?php

function nequal($a, $b){
	return !equal($a, $b);
}

function equal($a, $b){
	return $a == $b;
}

function _if($bool, $ifout, $elseout){
//var_dump(func_get_args());
//echo "<br/>";
	if($bool || defined("TESTING")){
		return $ifout;
	}
	return $elseout;
}

function slug($str){
	$str = strtolower($str);
	$str = preg_replace(array("/[\s]/", "/[\-]+/"), array("-", "-"), $str);
	return $str;
}


?>
