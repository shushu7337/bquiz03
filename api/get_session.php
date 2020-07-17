<?php
include_once "../base.php";

$sess=[
    1=>"14:00~16:00",
    2=>"16:00~18:00",
    3=>"18:00~20:00",
    4=>"20:00~22:00",
    5=>"22:00~24:00",
];


$movie_id=$_GET['id'];  //取得該電影id
$movie_date=$_GET['date'];  //取得該電影日期

// $db=new DB("order");
// $movie=$db->find($movie_id);

// 拿到今天日期
$today=strtotime(date("Y-m-d"));    
// 拿到上映日期
$ondate=strtotime($movie['ondate']);

if(strtotime($movie_date)==$today){

    $now=floor((date("G")-12)/2);   //目前正在放映的場次時間(G為小時)//現在訂票的時間
    for($i=($now+1);$i<=5;$i++){    
        echo "<option value='$i'>".$sess[$i]."</option>";
    }
}

if(strtotime($movie_date)==$today){ //如果取得的電影日期等於今天

}else{
    for($i=1;$i<=5;$i++){
        echo "<option value='$i'>".$sess[$i]."</option>";
    }
}

?>