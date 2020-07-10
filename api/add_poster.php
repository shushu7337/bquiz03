<?php
    include "../base.php";
    
    $db=new DB("poster");
    
    $data=[];
    if(!empty($_FILES['poster']['tmp_name'])){
        //取得檔名
        $data['path']=$_FILES['poster']['name'];
        //搬移到指定目錄(img),這裡要注意路徑(因程式會在api內執行所以存到img是要回上層)
        move_uploaded_file($_FILES['poster']['tmp_name'],"../img/".$data['path']);
    }

    $data['name']=$_POST['name'];
    $data['sh']=1;
    $data['ani']=1;
    // 讓後面新增的資料rank值直接以目前最大的id值+1
    $data['rank']=$db->q("select max(`id`) from `poster`")[0][0]+1;     //q語法函式所蒐回來的資料為二維陣列
    $db->save($data);

    to("../admin.php?do=post")

?>