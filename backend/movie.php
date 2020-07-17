<style>
.list{
    overflow:auto;
    width:100%;
    height:420px;
    background:#eee;
}
.movie-item{
    width:100%;
    background: white;
    margin:2px 0;
}
.movie-item > div{
    display:inline-block;
}

.movie-item > div:nth-child(1),
.movie-item > div:nth-child(2){
    width:10%;
}
.movie-item > div:nth-child(3){
    width:79%;
}
.movie-item > div:nth-child(3) span{
    display:inline-block;
    width:30%;
}
</style>



<button onclick="location.href='?do=add_movie'">新增電影</button>
<hr>
<div class="list">
<?php
$db=new DB('movie');
$rows=$db->all([]," order by rank");
foreach($rows as $k => $row){
    $prev=($k!=0)?$rows[$k-1]['id']:$row['id']; //如果索引值$k不為0的話，就為$rows的[$k-1]的id值(上一筆的id)，否則為$row['id'](自己的id)
    $next=($k!=(count($rows)-1))?$rows[$k+1]['id']:$row['id']; //如果索引值$K不為總數-1的話，就為$rows的[$k+1]的id值(下一筆的id)，否則為$row['id'](自己的id)
?>
    <div class="movie-item">
        <div>
            <img src="img/<?=$row['poster'];?>" style="width:80px;height:100px"></div>
            <div>分級:<img src="icon/<?=$row['level'];?>.png"></div>
            <div>
            <div>
                <span>片名:<?=$row['name'];?></span>
                <span>片長:<?=$row['length'];?></span>
                <span>上映時間:<?=$row['ondate'];?></span>
            </div>
            <div>
            <!-- 這裡一致使用onclick來做點擊後的動作(除了往上)&往下 -->
                <button onclick="sh('movie',<?=$row['id'];?>)"><?=($row['sh']==1)?"顯示":"隱藏";?></button>         <!-- 顯示'資料表名稱'的'id'欄位 -->
                <button class="shift" data-rank="<?=$row['id']."-".$prev;?>">往上</button>
                <button class="shift" data-rank="<?=$row['id']."-".$next;?>">往下</button>
                <button onclick="edit('movie',<?=$row['id'];?>">編輯電影</button>   <!-- 編輯'資料表名稱'的'id'欄位 -->
                <button onclick="del('movie',<?=$row['id'];?>)">刪除電影</button>   <!-- 刪除'資料表名稱'的'id'欄位 -->
            </div>
            <div>劇情簡介:<?=$row['intro'];?></div>
        </div>
    </div>
<?php
}
?>
</div>
<script>
function sh(table,id){
    $.post("api/sh.php",{table,id},function(){
        location.reload();
    })
}
function del(movie,id){
    $.post("api/del.php",{"table":movie,"id":id},function(){      //如果參數本身有帶值的話送出的key值就會相同，如果沒有的話就給予一個字串  (字串:key值)
        location.reload();  //重載頁面來確定是否有刪除
    })  
}

// 使用jquery來對button的點擊做處理
    $(".shift").on("click",function(){  
        // 取得data屬性的值，並拆成一個id陣列
        let id=$(this).data("rank").split("-"); //所點下的標籤的rank值以"-"來切開,會得到兩個型態為"字串的" id值
         // id陣列連同要修改的資料表名稱一起用ajax的方式一直傳到後台 
        $.post("api/rank.php",{id,"table":"movie"},function(){ //function 為 callback function 前面的事情做完才來做function
            // 後台api處理完畢後重新載入一次頁面
            location.reload();  //重整頁面
        })
    })
</script>