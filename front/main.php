<style>
.btns{
  display: flex;
}
.nav{
  display:flex;
  width:320px;
  overflow:hidden;  /* 溢出的時候可以隱藏 */
 
}
.icon{
  width:80px;
  flex-shrink:0;
  text-align: center;
  position :relative;
}
.icon img{
  width: 50px;
  cursor:pointer;
}
.control{
  width:45px;
  font-size: 45px;
  text-align: center;
  cursor:pointer;
}
.poster{
  border:1px solid;
  width:200px;
  height:260px;
  margin:0 auto 20px auto;
  position:relative;
}
.po{  /*上層要有高度才有辦法設比例*/ 
  width: 100%;
  height: 100%;
  background:white;
  color:black;
  position:absolute;
  display: none;
}
.po img{
  width:100%;
}
</style>



    <!-- 預告片 -->
    <?php
      // 索取資料
      $po=new DB("poster");
      $rows=$po->all(["sh"=>1]," order by `rank`"); //取出設定為顯示並排序過的資料
    ?>
    <div class="half" style="vertical-align:top;">
      <h1>預告片介紹</h1>
      <div class="rb tab" style="width:95%;">
<!-- -------------我是海報------------- -->
        <div class="poster">
          <?php
            foreach($rows as $k => $row){
              echo "<div class='po' data-ani=".$row['ani'].">";
              echo "<img src='img/".$row['path']."'>";
              echo "<div class='ct'>".$row['name']."</div>";
              echo "</div>";

            }

          ?>
        </div>
<!-- -------------我是按鈕------------- -->
        <!-- &#9664; 左鍵實心符號  &#9654; 右鍵實心符號-->
        <div class="btns">
        <div class="control" onclick="shift('left')">&#9664;</div>
        <div class="nav">
          <?php
            foreach($rows as $k => $row){
              echo "<div class='icon' >";
              echo "<img src='img/".$row['path']."'>";
              echo "</div>";
            }
          ?>
        </div>
        <div class="control" onclick="shift('right')">&#9654;</div>
        
        
   
        </div>
      </div>
    </div>
    <script>
    // -------------照片的顯示-------------
    $(".po").eq(0).show();
    // 自動功能設定
    let auto=setInterval(() => {
      slider()
    }, 3000);

    function slider(){ //
      let dom=$(".po:visible"); //現在顯示的
      //let ani=$(dom).attr("data-ani");    ani 的性質要注意
      let ani=$(dom).data('ani');   //
      let next=$(dom).next(); //下一張
      // console.log(dom,ani,next)
      
      // 如果下一張dom的長度為0，把它設為第一張達到輪播效果
      if(next.length<=0){
        next=$(".po").eq(0);
      }

      switch(ani){
        case 1:
        // 透過回呼函式讓過場動畫更為順暢
        //淡入淡出
          $(dom).fadeOut(2000,function(){//現在的，完全執行完fadeOut後再來執行fadeIn
           $(next).fadeIn(2000);  //下一張的
          }); 
          break;
        case 2:
        //放大縮小  
          $(dom).hide(2000,function(){
            $(next).show(2000);
          });
          break;
        case 3:
        //滑入滑出
          $(dom).slideUp(2000,function(){
            $(next).slideDown(2000);
          });
          break;
        case 4:
        //縮放
          $(dom).animate({width:0,height:0,left:100,top:130},function(){
            $(next).css({width:0,height:0,left:100,top:130})
            $(next).show();
            $(next).animate({width:200,height:260,left:0,top:0})
            $(dom).hide()
            $(dom).css({width:200,height:260,left:0,top:0})

          })
      }
    }
    
     // -------------照片的點擊更換-------------
    $(".icon").on("click",function(){
      
      let index=$(".icon").index($(this))
      $(".po").hide();  //全部隱藏
      $(".po").eq(index).show();  //重新播放
    })

    $(".nav").hover(
        function(){
          clearInterval(auto)  //hover近來的時候
        },
        function(){
          auto=setInterval(() => {  //hover離開的時候
            slider()
          }, 3000);
        }
    )


    // -------------照片的水平移動-------------

    let p=0;  //計算移動幾次
    let total=$(".icon").length;  //取得照片數量
    function shift(direct){
      switch(direct){
        case 'right':
            if(p<(total-4)){  //如果移動次數小於照片總數-4的話
              p=p+1 //移動次數加一
              $(".icon").animate({right:80*p}); //讓照片移動80*次數
            }
          break;
        case 'left':
          if(p>0){
            p=p-1;
            $(".icon").animate({right:80*p});
          }
          break;
      }
    }
    </script>

    <style>
      .mb{
        width: 48%;
        height: 160px;
        display: inline-block;
      }
    </style>
    <!-- 院線片 -->
    <div class="half">
      <h1>院線片清單</h1>
      <div class="rb tab" style="width:95%;">
      <?php
        $db=new DB("movie");
        $today=date("Y-m-d"); //取得今天日期
        $ondate=date("Y-m-d",strtotime("-2 days"));  //上印日期為今天往前推兩天
        $total=$db->count(['sh'=>1]," && ondate >= '$ondate' && ondate <='$today'");
        $div=4;
        $pages=ceil($total/$div);
        $now=(!empty($_GET['p']))?$_GET['p']:1;
        $start=($now-1)*$div;
        $rows=$db->all(['sh'=>1]," && ondate >= '$ondate' && ondate <='$today' order by rank limit $start,$div");  //撈出有顯示的並做排序

        foreach($rows as $row){
      ?>
          <div class="mb">
              <table>
                <tr>
                  <td rowspan="3"><a href="?do=intro&id=<?=$row['id'];?>"><img src="img/<?=$row['poster'];?>" style="height:100px;width:80px;"></a></td>
                  <td><?=$row['name'];?></td>
                </tr>
                <tr>
                  <td><img src="icon/<?=$row['level'];?>.png" style="width:15px"><?=$level[$row['level']];?></td>
                </tr>
                <tr>
                  <td><?=$row['ondate'];?></td>
                </tr>
              </table>
              <div class="ct">
                <button onclick="location.href='?do=intro&id=<?=$row['id'];?>'">劇情簡介</button>
                <button onclick="location.href='?do=order&id=<?=$row['id'];?>'">線上訂票</button>
              </div>
          </div>
      <?php
        }
      ?>
      <!-- 換頁功能 -->
        <div class="ct">
        <?php
          for($i=1;$i<=$pages;$i++){
            $font=($i==$now)?'24px':'18px';
            echo "<a href='?p=$i' style='font-size:$font;text-decoration:none'> $i </a>";
          }


        ?>
        </div>
      </div>
    </div>