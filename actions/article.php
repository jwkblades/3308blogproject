<?php

class Page{
	public $title;
	public $content;
	public function Page(){
	}
	private function loadPosts($aid){
		global $sql, $rmut;
		$query = "SELECT poster_id, approved, post, posted_on FROM posts WHERE article_id = " . $aid . " ORDER BY posted_on ASC";
		$results = $sql->query($query);
		$content = "";
		$tmp = new Template();
		while($row = $sql->fetchAssoc($results)){
			$rmut = $row;
			$content .= Replace::on($tmp->get("singlePost"));
		}
		return $content;
	}
	public function main(){
		global $sql, $config, $rmut;
		if(!isset($_GET['aid']) || !is_numeric($_GET['aid'])){
			header("Location: " + $config['url']);
			return;
		}
		$aid = $sql->san($_GET['aid']);
		$query = "SELECT article_title from articles WHERE public = 1 AND article_id = " . $aid . " LIMIT 1";
		$titleRes = $sql->query($query);
		if($sql->numRows($titleRes) != 1){
			// no title -- meaning it is either a private article, or non-existant
			header("Location: " + $config['url']);
			return;
		}
		$rObj = $sql->fetchObj($titleRes);
		$this->title = $rObj->article_title;
		$tmp = new Template();
		$rmut = array("title" => $this->title, "content" => $this->loadPosts($aid));
		$this->content = Replace::on($tmp->get("basePage"));
	}
}

?>
