<?php

class Mysql{
  private $dbcon;
  public function __construct($user, $pass, $host){
    $this->dbcon = mysql_connect($host, $user, $pass) or die(mysql_error());
  }
  public function select($db){
    mysql_select_db($db, $this->dbcon);
  }
  public function query($queryString){
    $result = mysql_query($queryString, $this->dbcon) or die("Query: " . $queryString . "<br/>" . mysql_error());
    return $result;
  }
  public function fetchAssoc($results){
    return mysql_fetch_assoc($results);
  }
  public function fetchObj($results){
    return mysql_fetch_object($results);
  }
  public function numRows($results){
    return mysql_num_rows($results);
  }
  public function san($in){
    return mysql_real_escape_string($in);
  }
  public function close(){
    mysql_close($this->dbcon);
  }
}

?>
