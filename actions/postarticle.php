<?php 
class page{
	public $title;
	public $content;
	public function page()
	{
		$this -> title = "New Post";
	}
	public function main()
	{
		global $user;
		global $sql;
		$tmp = new Template();
		if(isLoggedIn())
		{
			if($user['can_post_article'])
			{
				$this -> content = $tmp -> get("postNewArticle");
			}
		}
		else
		{
			$this -> content = "You Are Not Logged In!";
		}
	}
}
?>
