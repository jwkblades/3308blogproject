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
			$q = "SELECT * FROM users WHERE username LIKE '".$author."'";
			$tem = $sql -> query($q);
			$ret = $sql -> fetchAssoc($tem);
			$userid = $ret['user_id'];
			$articles = "SELECT * FROM articles WHERE poster_id = " .$userid;
			$ret = $sql -> query($articles);
			while($row = $sql->fetchAssoc($ret))
			{
				$rmut = $row;
				$this -> content .= Replace::on($tmp -> get("searchResults"));
			}
		}
	}
}
?>
