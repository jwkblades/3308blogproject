<?php

require_once "classes/MySQL.php";

$sql = new MySQL("root", "root", "localhost");
$sql->selectDatabase("blog");

?>
