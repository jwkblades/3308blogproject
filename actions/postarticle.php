<?php 
class page{
	public $title;
	public $content;
	public function page()
	{
		$this -> title = "New Post";
	}
	private function post($p, $t)
	{
		global $sql;
		global $user;
		$post = $sql -> san($p);
		$title = $sql -> san($t);
		$q = "INSERT INTO articles (article_title, poster_id, public) VALUES ('".$title . "', ".$user['user_id'].", 1)";
		$sql -> query($q);
		$aid = $sql -> query("SELECT article_id FROM articles WHERE poster_id = ".$user['user_id']." and article_title = '".$title."'");
		$raid = $sql -> fetchAssoc($aid);
		$qu= "INSERT INTO posts (poster_id, article_id, approved, post, posted_on) VALUES (".$user['user_id'].", ".$raid['article_id'].", 1, '".$post."', NOW())";
		$sql -> query($qu);
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
			else
			{
				$this -> content = "You do not have permission to post!";
			}
		}
		else
		{
			$this -> content = "You Are Not Logged In!";
		}
	}
}
?>
