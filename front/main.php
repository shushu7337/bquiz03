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
}
.control{
  width:45px;
  font-size: 45px;
  text-align: center;
}
</style>



    <!-- 預告片 -->
    <?php
      // 索取資料
      $po=new DB("poster");
      $rows=$po->all(["sh"=>1]," order by `rank`");
    ?>
<div class="half" style="vertical-align:top;">
      <h1>預告片介紹</h1>
      <div class="rb tab" style="width:95%;">
        <div class="poster">
          
        </div>
        <!-- &#9664; 左鍵實心符號  &#9654; 右鍵實心符號-->
        <div class="btns">
        <div class="control">&#9664;</div>
        <div class="nav">
          <?php
            foreach($rows as $k => $row){
              echo "<div class='icon' >";
              echo "<img src='img/".$row['path']."'>";
              echo "</div>";
            }
          ?>
        </div>
        <div class="control">&#9654;</div>
        
        
   
        </div>
      </div>
    </div>

    <!-- 院線片 -->
    <div class="half">
      <h1>院線片清單</h1>
      <div class="rb tab" style="width:95%;">
        <table>
          <tbody>
            <tr> </tr>
          </tbody>
        </table>
        <div class="ct"> </div>
      </div>
    </div>