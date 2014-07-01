<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="UTF-8" />
<title><?php echo isset($title)?$title:'Title'; ?></title>
<?php if (isset($description)) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if (isset($keywords)) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if (isset($styles)) { ?>
	<?php foreach ($styles as $style) { ?>
	<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
	<?php } ?>
<?php } ?>
<link rel="stylesheet" type="text/css" href="view/stylesheet/stylesheet.css" />
<script type="text/javascript" src="view/javascript/jquery/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-1.10.3.custom.min.js"></script>
<link type="text/css" href="view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="view/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="view/javascript/common.js"></script>
<?php if (isset($scripts)) { ?>
	<?php foreach ($scripts as $script) { ?>
	<script type="text/javascript" src="<?php echo $script; ?>"></script>
	<?php } ?>
<?php } ?>
<link type="text/css" href="view/stylesheet/login.css" rel="stylesheet" />
</head>
<body>

<div id="container">
	<div id="header">
		<div class="div1">
			<div class="div2">
				<!--<img src="view/image/logo.png" onClick="location = index.php" />-->
			</div>
			<div class="div3">
				<?php if(isset($login)){ ?>
					<img src="view/image/lock.png" alt="" style="position: relative; top: 3px;" />
					<?php if($login == 0){ ?>
						You are not yet logged in.
					<?php } ?>
					
					<?php if($login == 1){ ?>
						You are logged in as <?php echo $login_username;?>.
					<?php } ?>
					
				<?php } ?>
			</div>
		</div>
	</div><!-- end header -->
	<?php if ($login == 1) { ?>
	<div id="menu" >
		<ul class="left" style="display: none;">
			<li id="home">
                <a class="top" href="index.php?route=common/home">主页</a>
				<ul>
					<li><a href="index.php?route=homeBanners/homeBanners">主页旗帜广告</a></li>
                    <li><a href="index.php?route=contactus/contactus">联系我们</a></li>
                    <li><a href="index.php?route=friendlinks/friendlinks">友情链接</a></li>
                    <li><a href="index.php?route=otherBanners/otherBanners">其他图片</a></li>
                    <li><a href="index.php?route=mainseo/mainseo">主页SEO</a></li>
				</ul>
			</li>
			<li id="lines">
            	<a class="top">线路管理</a>
				<ul>
					<li><a href="index.php?route=lines/lines">线路</a></li>
					<li><a href="index.php?route=areas/areas">分区</a></li>
                    <li><a href="index.php?route=attractions/attractions">旅游景点</a></li>
                    <li><a href="index.php?route=fromcitys/fromcitys">出发城市</a></li>
                    <li><a href="index.php?route=endcitys/endcitys">结束地点</a></li>
                    <li><a href="index.php?route=boardinglocations/boardinglocations">上车地点</a></li>
				</ul>
			</li>
            <li id="certificates">
            	<a class="top">签证</a>
				<ul>
					<li><a href="index.php?route=certificates/certificates">签证</a></li>
                    <li><a href="index.php?route=certificates/categories">分类管理</a></li>
				</ul>
			</li>
            <li id="informations">
            	<a class="top">旅游资讯</a>
				<ul>
					<li><a href="index.php?route=informations/informations">旅游资讯</a></li>
                    <li><a href="index.php?route=informations/categories">分类管理</a></li>
				</ul>
			</li>
			<li id="contacts">
            	<a class="top" href="index.php?route=contactus/contactus2">联系我们页面</a>
			</li>
            <li id="users">
            	<a class="top">用户管理</a>
				<ul>
					<li><a href="index.php?route=users/users">用户管理</a></li>
                    <li><a href="index.php?route=orders/orders">订单管理</a></li>
                    <li><a href="index.php?route=tickets/tickets">机票管理</a></li>
                    <li><a href="index.php?route=grouptours/grouptours">包团管理</a></li>
				</ul>
			</li>
            <li id="system">
            	<a class="top">System</a>
				<ul>
					<li><a href="index.php?route=tool/backup">Database Backup</a></li>
					<li><a href="index.php?route=tool/reset">Reset Password</a></li>
				</ul>
			</li>
		</ul>
		
		<ul class="right" style="display: none;">
			<li id="store"><a href="../index.php" target="_blank" class="top">View Front</a></li>
			<li><a class="top" href="index.php?route=common/logout">Logout</a></li>
		</ul>
	</div><!-- end menu -->
    <?php }?>