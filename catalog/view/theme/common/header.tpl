<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow" />
<meta name="keywords" content="<?php echo $seokeywords;?>" />
<meta name="description" content="<?php echo $seodescription;?>" />
<title>优胜旅游</title>
<link rel="shortcut icon" href="favicon.ico" >
<link href="./catalog/view/css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="./catalog/view/js/jquery-1.8.3.min.js"></script>
<script language="javascript" src="./catalog/view/js/function.js"></script>
<!--[if IE 6]>
<script language="javascript" src="./catalog/view/js/minmax.js"></script>
<script language="javascript" src="./catalog/view/js/iepng.js"></script>
<script type="text/javascript">
   EvPNG.fix('div, ul, img, li, input, h1'); 
</script>
<![endif]-->
<script type="text/javascript" src="./catalog/view/js/jquery.litenav.js"></script>
<script type="text/javascript" src="./catalog/view/js/scroll.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#marquee').kxbdMarquee({
			direction:'left',
			scrollDelay:20,
			eventA:'mouseenter',
			eventB:'mouseleave'
	});
});
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>
<body>
<!--网页头部-->
<div id="header">
  <div id="site_nav"><span class="f_r">
  <?php if($isLogged==1){?>
  	Hi,<span style='color:#FF0000;'><?php echo $username_f;?></span> <a href="./index.php?route=common/logout">退出</a> | <a href="./index.php?route=common/personalcenter">会员中心</a>| <a href="./index.php?route=common/cart">购物车</a>
  <?php }else{?>
  	<a href="./index.php?route=common/login">登录</a> | <a href="./index.php?route=common/register">注册</a> 
  <?php }?>
   | <a href="./index.php?route=about/about">联系我们</a></span>今天是：<?php echo $today;?></div>
  <h1 class="bj"><a href="#" class="logo" title="logo"><img src="./uploads/images/top_pic2.jpg" width="1400px" height="179" /></a></h1>
  <ul class="nav clearfix">
    <li id="home"><a <?php echo $route=='common/home'?'class="current"':'';?> href="./index.php" >首页</a></li>
    <li><a <?php echo $route=='lines/lines'?'class="current"':'';?> href="./index.php?route=lines/lines">旅游线路</a></li>
    <li><a <?php echo $route=='book/flight'?'class="current"':'';?> href="./index.php?route=book/flight">机票和酒店搜索</a></li>
    <!--<li><a <?php echo $route=='#'?'class="current"':'';?> href="#">酒店</a></li>-->
    <li><a <?php echo $route=='cruises/cruises'?'class="current"':'';?> href="./index.php?route=cruises/cruises">豪华游轮</a></li>
    <li><a <?php echo $route=='certificates/certificates'?'class="current"':'';?> href="./index.php?route=certificates/certificates">签证资讯</a></li>
    <li><a <?php echo $route=='grouptour/grouptour'?'class="current"':'';?> href="./index.php?route=grouptour/grouptour">旅游包团</a></li>
    <li><a <?php echo $route=='informations/informations'?'class="current"':'';?> href="./index.php?route=informations/informations">旅游资讯</a></li>
    <li><a <?php echo $route=='about/about'?'class="current"':'';?> href="./index.php?route=about/about">联系我们</a></li>
  </ul>
</div>