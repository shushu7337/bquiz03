<form>
    <h3 class="ct">線上訂票</h3>
    <table style="width:70%;margin:auto">
        <tr>
            <td width="10%">電影:</td>
            <td>
                <select name="movie" id="movie">
                <!-- 撈出上映中電影的資料 -->
                <?php                
                    $db=new DB("movie");
                    $today=date("Y-m-d"); //取得今天日期
                    $ondate=date("Y-m-d",strtotime("-2 days"));  //上印日期為今天往前推兩天
                    $rows=$db->all(['sh'=>1]," && ondate >= '$ondate' && ondate <='$today' ");  //撈出有顯示的並做排序+
                    foreach($rows as $row){
                        // 做進入訂票系統的判斷，如果是從清單點入的話會直接顯示該電影的id內容，如果是從線上訂票進入會顯示第一個
                        if(!empty($_GET['id'])){
                          $selected=($_GET['id']==$row['id'])?"selected":"";
                          echo "<option value='".$row['id']."' $selected>".$row['name']."</option>";
                        }else{
                            echo "<option value='".$row['id']."'>".$row['name']."</option>";
                        }

                       
                    }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>日期:</td>
            <td>
                <select name="date" id="date"></select>
            </td>
        </tr>
        <tr>
            <td>場次:</td>
            <td>
                <select name="session" id="session"></select>
            </td>
        </tr>
    </table>
    <div class="ct">
        <input type="button" value="確定">
        <input type="reset" value="重置">
    </div>
</form>

<script>
// 載入畫面的時候直接讀取當前的id=movie的value值
getDuration();

// 監聽事件
$("#movie").on("change",function(){
    getDuration();
})

function getDuration(){
    let id=$("#movie").val();   //讓id為id=movie選到的值

    $.get("api/get_duration.php",{id},function(duration){   //將選擇的值更改並回傳到api/get_duration.php
        $("#date").html(duration)
    })
    console.log(id);
}


</script>