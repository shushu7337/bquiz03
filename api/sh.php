<?php
include_once "../base.php";

$table=$_POST['table'];
$id=$_POST['id'];

$db=new DB($table);
$row=$db->find($id);

// 透過取餘數的功能，帶來的值%2只會得到1 || 0所以透過這兩個值來做顯示跟隱藏的切換

//利用餘數的特性來製作顯示/隱藏的切換效果
// type1 簡化版切換功能 
$row['sh']=($row['sh']+1)%2;

// type2
// if($row['sh']==1){
//     $row['sh']=0;
// }else{
//     $row['sh']=1;
// }


$db->save($row);




?>