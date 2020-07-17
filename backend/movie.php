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

</div>
<script>
reloadlist();

function reloadlist(){
    $.get("api/movie_list.php",function(list){
        $(".list").html(list);

        //監聽事件只會在有此物件的地方做行為
        // 使用jquery來對button的點擊做處理 
        $(".shift").on("click",function(){  
            // 取得data屬性的值，並拆成一個id陣列
            let id=$(this).data("rank").split("-"); //所點下的標籤的rank值以"-"來切開,會得到兩個型態為"字串的" id值
        
             // id陣列連同要修改的資料表名稱一起用ajax的方式一直傳到後台 
            $.post("api/rank.php",{id,"table":"movie"},function(){ //function 為 callback function 前面的事情做完才來做function

                // 後台api處理完畢後重新載入一次頁面
                reloadlist();  //重整頁面
            })
        })
    })    
}


function sh(table,id){
    $.post("api/sh.php",{table,id},function(){
        reloadlist();
    })
}
function del(movie,id){
    $.post("api/del.php",{"table":movie,"id":id},function(){      //如果參數本身有帶值的話送出的key值就會相同，如果沒有的話就給予一個字串  (字串:key值)
        reloadlist();  //重載頁面來確定是否有刪除
    })  
}


</script>