<?php
class page{
	public $title;
	public $content;
	public function page()
	{
		$this -> title = "Search";
	}
	public function main()
	{
		global $sql;
		global $rmut;
		$tmp = new Template();
		if(isset($_POST['Submit']))
		{
			$author = $sql -> san($_POST['query']);
			$q = "SELECT * FROM users WHERE username = ".$author;
			$tem = $sql -> query($q);
			$ret = $sql -> fetchAssoc($tem);
			$rmut = array("name" => $ret);
			Replace::on($tmp -> get("searchResults"));
			$this -> content = $tmp -> get("searchResults");
		}
	}
}
?>
