<?php
include_once "../base.php";

$table=$_POST['table'];
$id=$_POST['id'];

$db=new DB($table);
$db->del($id);  //如果不確定的話可以echo出來做確認


?>