<h3 class="ct">訂單清單</h3>
<div>
快速刪除:
<input type="radio" name="bydate" id="bydate">
依日期<input type="text" name="date" id="date">
<input type="radio" name="bymovie" id="bymovie">
依電影
<select name="movie" id="movie">
    <?php
        $movielist=$Ord->all([], " group by `movie`");
        foreach($movielist as $m){
            echo "<option value='".$m['movie']."'>".$m['movie']."</option>";
        }
    ?>
</select>
<button>刪除</button>
</div>
<div>
<style>
ul{
    display:flex;
    list-style-type:none;
    padding:0;
}
ul li{
    width:14%;
}
</style>
<ul style="background:#ccc">
    <li>訂單編號</li>
    <li>電影名稱</li>
    <li>日期</li>
    <li>場次時間</li>
    <li>訂購數量</li>
    <li>訂購位置</li>
    <li>操作</li>
</ul>
<div style="overflow:auto;height:400px;">
<?php
$orders=$Ord->all([]," order by no desc");

foreach($orders as $ord){
?>
<ul>
    <li><?=$ord['no'];?></li>
    <li><?=$ord['movie'];?></li>
    <li><?=$ord['date'];?></li>
    <li><?=$ord['session'];?></li>
    <li><?=$ord['qt'];?></li>
    <li>
        <?php
            $seat=unserialize($ord['seat']);    //將字碼轉換回陣列顯示
            foreach($seat as $s){
                echo floor($s/5)+1;
                echo "排";
                echo $s%5+1;
                echo "號";
                echo "<br>";
            }
        ?>
    </li>
    <li><button onclick="del('ord',<?=$ord['id'];?>)">刪除</button></li>
</ul>
<hr>
<?php
}
?>
</div>
</div>

<script>
//刪除資料表資料的函式
function del(movie,id){
    if(confirm("是否確認刪除?")){
        $.post("api/del.php",{"table":movie,"id":id},function(){      //如果參數本身有帶值的話送出的key值就會相同，如果沒有的話就給予一個字串  (字串:key值)
            location.reload();  //重載頁面來確定是否有刪除
        })         
    }
}
</script>