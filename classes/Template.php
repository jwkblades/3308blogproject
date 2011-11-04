<?php

class Template{
	private static $cache = array();
  private function loaded($name){
    return array_key_exists($name, self::$cache);
  }
	private function loadFile($name){
		$filename = "template/" . $name . ".php";
    if(file_exists($filename)){
      $content = file_get_contents($filename);
      self::$cache[$name] = $content;
			return true;
    }
    return false;
  }
  public function Template(){
		
	}
	public function load($name){
		if($this->loaded($name) || $this->loadFile($name)){
			return self::$cache[$name];
		}
    return "";
  }
  public function get($name){
    return $this->load($name);
  }
}

?>
