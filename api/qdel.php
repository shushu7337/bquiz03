<?php
include_once "../base.php";

// type 1
// if(!empty($_POST['date'])){
//     $Ord->del([['date']=>$_POST['date']]);
// }

// if(!empty($_POST['movie'])){
//     $Ord->del([['movie']=>$_POST['movie']]);
// }


// type 2
$type=$_POST['type'];
$option=$_POST['option'];
$Ord->del([$type=>$option]);

// type 3
// $Ord->del([$_POST['type']=>$_POST['option']]);

?>