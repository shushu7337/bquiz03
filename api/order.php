<?php
include_once "../base.php";

$movie=$_POST['movie'];
$date=$_POST['date'];
$session=$_POST['session'];
$seat=$_POST['seat']; //排序
$db_movie=new DB("movie");

sort($seat);

$data['movie']=$db_movie->find($movie)['name']; //取得電影名稱
$data['date']=$date;
$data['session']=$sess[$session];
$data['qt']=count($seat);
$data['seat']=serialize($seat);

$sno=$db_movie->q("SELECT max(`id`) FROM `ord`")[0][0]+1;
$dateNo=date("Ymd");

$data['no']=$dateNo.sprintf("%04d",$sno);

$db_ord=new DB("ord");
$db_ord->save($data);
echo $data['no'];

?>