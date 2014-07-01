  <!--网页底部开始-->
  <div id="foot">
    <div class="submenu">
        <a href="./index.php">首页</a> | 
        <a href="./index.php?route=lines/lines">旅游线路</a> | 
        <a href="#">机票搜索</a> | 
        <a href="#">酒店</a> | 
        <a href="#">豪华游轮</a> | 
        <a href="./index.php?route=certificates/certificates">签证</a> | 
        <a href="#">旅游包团</a> | 
        <a href="./index.php?route=informations/informations">旅游资讯</a> | 
        <a href="#">客户服务</a>
    </div>
	5901 8th Ave. #2 Brooklyn, NY 11220<br/>
    Copyright(C)2013 优胜旅行社 版权所有 www.usavetip.com 拥有最终解释权 </div>
</div>

<script type="text/javascript" src="./catalog/view/js/qq.js"></script>
<div id="KeFuDiv" class="KeFuDiv" style="1px solid #1E9296">
  <div style='background: url("./catalog/view/images/mid001.gif") repeat scroll 0 0 rgba(0, 0, 0, 0)'>
  <?php echo htmlspecialchars_decode($qq_information);?>
  </div>
</div>

<script>
//初始位置
gID("KeFuDiv").style.top = (document.documentElement.clientHeight - gID("KeFuDiv").offsetHeight)/2 +"px";
//gID("KeFuDiv").style.left = document.documentElement.clientWidth - gID("KeFuDiv").offsetWidth +"px";
gID("KeFuDiv").style.right = "0px";
//开始滚动
ScrollDiv('KeFuDiv');
</script>
<!--qq结束--> 

</body>
</html>