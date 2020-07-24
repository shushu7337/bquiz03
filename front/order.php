<div class="order-form">
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
                    $rows=$db->all(['sh'=>1]," && ondate >= '$ondate' && ondate <='$today' ");  //撈出有顯示的
                    foreach($rows as $row){
                        // 做進入訂票系統的判斷，如果是從清單點入的話會直接顯示該電影的id內容，如果是從線上訂票進入會顯示第一個
                        if(!empty($_GET['id'])){
                          $selected=($_GET['id']==$row['id'])?"selected":"";
                          echo "<option value='".$row['id']."' data-name='".$row['name']."' $selected>".$row['name']."</option>";
                        }else{
                            echo "<option value='".$row['id']."' data-name='".$row['name']."'>".$row['name']."</option>";
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
        <input type="button" value="確定" onclick='booking()'>
        <input type="reset" value="重置">
    </div>
</form>
</div>

<style>
.room{
    width:320px;
    height:320px;
    display:flex;
    flex-wrap:wrap;
    margin:auto;
    padding-top:19px;
}
.room>div{
    width:64px;
    height:85px;
    position:relative;
    text-align:center;
    /* background:lightgray; */
}
.chkbox{
    position:absolute;
    bottom:5px;
    right:5px;
    cursor:pointer;
}
/* .room >div:nth-child(odd){   //檢查用
    background:lightblue;
} */
.info{
    margin:auto;
    width:33%;
}
.null{
    background:url("icon/03D02.png") no-repeat center;
}
.booked{
    background:url("icon/03D03.png")  no-repeat center;
}
.board{
    width:540px;
    height:370px;
    margin:auto;
    background:url("icon/03D04.png") no-repeat center 
}
.info-block{
    background:#eee;
    padding:10px 0px 10px 300px;
}
.info p{
    margin:5px;
}
</style>
<div class="booking-form" style="display:none">
    <div class="board">
        <div class="room">
        </div>
    </div>
    <div class="info-block">
        <div class="info">
            <p id="infoMoive">您選擇的電影是:<span id="movie-name"></span></p>
            <p id="infoDate">您選擇的時刻是:<span id="movie-date"></span> <span id="movie-session"></span></p>
            <p>您已經勾選 <span id="ticket"></span>張票，最多可以購買四張票</p>
        </div>
    <button onclick="prev()">上一步</button>
    <button id="send">訂購</button>
    </div>
</div>
<script>
// 載入畫面的時候直接讀取當前的id=movie的value值
getDuration();


// ------監聽事件------
// 改變觸發後得到date的值,註冊電影列表的選取事件
$("#movie").on("change",function(){
    getDuration();
})
// 改變觸發後得到session的值，註冊上映日期列表的選取事件
$("#date").on("change",function(){
    getSession();
})




function getDuration(){
    let id=$("#movie").val();   //讓id為id=movie選到的值

    $.get("api/get_duration.php",{id},function(duration){   //將選擇的值更改並回傳到api/get_duration.php
        $("#date").html(duration)
        getSession();
    })
    // console.log(id,"d");
}

function getSession(){
    let date=$("#date").val();  //取得日期
    let id=$("#movie").val();   //取得電影

    $.get("api/get_session.php",{date,id},function(session){
        $("#session").html(session);
    })
    // console.log(id);
}

//挑選座位
function booking(){
    let movie=$("#movie").val();
    let movieName=$("#movie option:selected").data("name");
    let date=$("#date").val();
    let session=$("#session").val();
    let sessionName=$("#session option:selected").data("session");
    let ticket=0;
    let seat=new Array();

    //將取得的data項目寫回該位置
    $("#movie-name").html(movieName);
    $("#movie-date").html(date);
    $("#movie-session").html(sessionName);

    $.get("api/get_seat.php",{movieName,date,sessionName},function(seats){
        $(".room").html(seats);
        
        // 如果被勾選後讓ticket增加，再將值傳入
        $(".chkbox").on("change",function(){
            let chk=$(this).prop('checked')
            switch(chk){
                case true:
                    ticket++;
                    // 判斷是否點選超過四張
                    if(ticket>4){
                        // alert("最多只能選四張票");
                        ticket--;
                        $(this).prop("checked",false);  //讓原本超過四張點選的checkbox取消被點選的狀態
                    }else{
                        seat.push($(this).val());
                        // 增加點擊時直接讓圖片顯現(原本沒有的變成有)
                        $(this).parent().removeClass("null");
                        $(this).parent().addClass("booked");

                    }
                break;
                case false:
                    ticket--;
                    seat.splice(seat.indexOf($(this).val()),1);    //indexOf 尋找是否有符合的元素
                    // 增加點擊時直接讓圖片顯現(原本有的變成沒有)
                        $(this).parent().removeClass("booked");
                        $(this).parent().addClass("null");
                break;
            }
            console.log(seat);
            $("#ticket").html(ticket);
            })
            $("#send").on("click",function(){
                $.post("api/order.php",{movie,date,session,seat},function(ordno){   //傳送四個資料到後台
                    // console.log(ordno);
                    location.href="?do=result&ord="+ordno;
                })
        })
    })

    $(".order-form").hide();
    $(".booking-form").show();

    
}
//上一步
function prev(){
    $(".order-form").show();
    $(".booking-form").hide();
    $(".room").html("");    //點選上一步後，清空room值
}
</script>