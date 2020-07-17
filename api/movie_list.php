<?php
include_once "../base.php";

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
                <span>片長:<?=($row['length']);?></span>
                <span>上映時間:<?=$row['ondate'];?></span>
            </div>
            <div>
            <!-- 這裡一致使用onclick來做點擊後的動作(除了往上)&往下 -->
                <button onclick="sh('movie',<?=$row['id'];?>)"><?=($row['sh']==1)?"顯示":"隱藏";?></button>         <!-- 顯示'資料表名稱'的'id'欄位 -->
                <button class="shift" data-rank="<?=$row['id']."-".$prev;?>">往上</button>
                <button class="shift" data-rank="<?=$row['id']."-".$next;?>">往下</button>
                <button onclick="location.href='?do=edit_movie&id=<?=$row['id'];?>'">編輯電影</button>   <!-- 編輯'資料表名稱'的'id'欄位 -->
                <button onclick="del('movie',<?=$row['id'];?>)">刪除電影</button>   <!-- 刪除'資料表名稱'的'id'欄位 -->
            </div>
            <div>劇情簡介:<?=$row['intro'];?></div>
        </div>
    </div>
<?php
    }
?>

<script>

</script>