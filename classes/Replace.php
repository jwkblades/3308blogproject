<?php

require_once "Template.php";

class Replace{
	private static function _swap($matches){
		// split every time there is a ':' that isn't inside an HTML tag
    $parts = preg_split("/(?(?!=(\<.*?)):(?!(.*\>)))/", $matches[1]);
//var_dump($matches);
//echo "<br/>";
    if(count($parts) == 1){ // global variable
			global $config;
			return $config[$parts[0]];
    }
    else if(count($parts) == 2 && $parts[0] != ""){ // a bit more tricky
			if($parts[0] == "user"){
				global $user;
				return $user[$parts[1]];
      }
			else if($parts[0] == "template"){
				$tmp = new Template();
				return $tmp->get($parts[1]);
			}
			else if($parts[0] == "page"){
				global $page;
				return $page[$parts[1]];
			}
			else if($parts[0] == "function" && function_exists($parts[1])){
				return call_user_func($parts[1]);
			}
		}
		else{
			if($parts[0] == "function" && function_exists($parts[1])){
				$funcname = $parts[1];
				$parts = array_splice($parts, 1);
				$parts = array_splice($parts, 1);
				return call_user_func_array($funcname, $parts);
			}
			else{
				global $rmut;
			  if(array_key_exists($parts[1], $rmut) && array_key_exists($parts[2], $rmut[$parts[1]])){
					return $rmut[$parts[1]][$parts[2]];
				}
				else if(array_key_exists($parts[1], $rmut)){
					return $rmut[$parts[1]];
				}
			}
		}
		return "";
	}
	public function Replace(){
	}
	public static function on($in){
		//while(preg_match("/\[\[(.*?)\]\]/", $in)){
			//$in = preg_replace_callback("/\[\[(.*?)\]\]/", "self::_swap", $in);
		while(preg_match("/\[\[([^\[]*?)\]\]/", $in)){
			$in = preg_replace_callback("/\[\[([^\[]*?)\]\]/", "self::_swap", $in);
		}
		return $in;
	}
}

?>
