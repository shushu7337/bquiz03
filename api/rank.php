<?php
    include_once "../base.php";
    $table=$_POST['table'];
    $db=new DB($table);

    $row1=$db->find($_POST['id'][0]);
    $row2=$db->find($_POST['id'][1]);

    //資料交換
    $tmp=$row1;
    $row1['rank']=$row2['rank'];
    $row2['rank']=$tmp['rank'];

    // 資料回存
    $db->save($row1);
    $db->save($row2);


?>