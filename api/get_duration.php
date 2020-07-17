<?php
include_once "../base.php";

$movie_id=$_GET['id'];
$db=new DB("movie");
$movie=$db->find($movie_id);

// 拿到今天日期
$today=strtotime(date("Y-m-d"));    //這裡不用strtotime("now")是因為用strtotime("now")取得當下時間無法等於當天，因為判別是會認定是大於今天
// 拿到上映日期
$ondate=strtotime($movie['ondate']);
// 檢查上映日還有?天
for($i=0;$i<3;$i++){
    $chk=strtotime("+$i days",$ondate);  //取得檢查用的日期
    if($chk>=$today){
        echo "<option value='".date("Y-m-d",$chk)."'>".date("m月d日 l",$chk)."</option>";
    }
}


?>