<?php
include_once "../base.php";

//取得前台傳來的電影id，並取得該電影資料
$movie_id=$_GET['id'];
$db=new DB("movie");
$movie=$db->find($movie_id);

//取得今天的時間數值(以當日的凌晨零時來計算)
$today=strtotime(date("Y-m-d"));    //這裡不用strtotime("now")是因為用strtotime("now")取得當下時間無法等於當天，因為判別是會認定是大於今天

//計算兩天前的上映日期時間數值
$ondate=strtotime($movie['ondate']);
// 檢查上映日還有?天(//計算該電影在今天之後的上映日期)
for($i=0;$i<3;$i++){
    $chk=strtotime("+$i days",$ondate);  //取得檢查用的日期
    if($chk>=$today){
        //產生要放在選單中的選項內容
        echo "<option value='".date("Y-m-d",$chk)."'>".date("m月d日 l",$chk)."</option>";
    }
}


?>