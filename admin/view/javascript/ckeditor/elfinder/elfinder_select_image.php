<?php
//Security Checking
session_start();
if(!isset($_SESSION['token']) || !isset($_GET['token'])){
	exit('ACCESS DENIED');
}else{
	$token1 = $_SESSION['token'];
	$token2 = $_GET['token'];
	if($token1 != $token2){
		exit('ACCESS DENIED');
	}
}
//unset($_SESSION['token']);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>elFinder 2.0</title>

		<!-- jQuery and jQuery UI (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui.css">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/theme.css">

		<!-- elFinder JS (REQUIRED) -->
		<script type="text/javascript" src="js/elfinder.min.js"></script>

		<!-- elFinder translation (OPTIONAL) -->
		<script type="text/javascript" src="js/i18n/elfinder.ru.js"></script>

		<!-- elFinder initialization (REQUIRED) -->
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				var Request = new QueryString();
					var elf = $('#elfinder').elfinder({
						url : 'php/connector.php',  // connector URL (REQUIRED)
						// lang: 'ru',             // language (OPTIONAL)
						 getFileCallback : function(file) {
							
							var name = Request["image"];
							if(name){
								window.opener.image_callback(file,name);
								window.close();
							}					 						 	
							name = Request["imagesarea"];
							if(name){
								window.opener.trans_images_data(file,name);
								window.close();
							}	
						}
					}).elfinder('instance');
				
			});
			
			function QueryString()
			{
				var name,value,i;
				var str=location.href;
				var num=str.indexOf("?")
				str=str.substr(num+1);
				var arrtmp=str.split("&");
				for(i=0;i < arrtmp.length;i++){
					num=arrtmp[i].indexOf("=");
					if(num>0){
						name=arrtmp[i].substring(0,num);
						value=arrtmp[i].substr(num+1);
						this[name]=value;
					}
				}
			}
		</script>
	</head>
	<body>

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

	</body>
</html>
