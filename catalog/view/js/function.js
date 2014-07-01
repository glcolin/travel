/*
 * @Description: Main Function file
 */
$(document).ready(function() {

	//////Tab选项卡切换			   
	var tabContainers = $('div.tabs > div');
	tabContainers.hide().filter(':first').show();
	$('div.tabs ul.tabNavigation a').click(function () {
		tabContainers.hide();
		tabContainers.filter($(this).attr("href")).show();
		$('div.tabs ul.tabNavigation a').removeClass('selected'); 
		$('div.tabs ul.tabNavigation li').removeClass('selectedli'); 
		$(this).addClass('selected').parent().addClass('selectedli'); 
		return false;                  
	}).filter(':first').click();
	
	//////其他设置	
	$("#sidebar dt").click(function(){
		$(this).toggleClass("bottomIco")
			   .next().slideToggle(300)
			   .siblings("dd").slideUp("slow");
		$(this).siblings("dt").removeClass("bottomIco");
	});
	
	$("#newlist li:even").addClass("even");   

	//////各栏目图片设置置
    var url = document.URL;//取得当前页的URL
    
    if(/aboutus/.test(url.toLowerCase()))  //正则查找在url地址中是否有当前页
    {
        $("#subfocus").addClass("img_about");
    }else if(/news/.test(url.toLowerCase()))
    {
        $("#subfocus").addClass("img_news");
    }else if(/product/.test(url.toLowerCase()))
    {
        $("#subfocus").addClass("img_product");
    }else if(/video/.test(url.toLowerCase()))
    {
        $("#subfocus").addClass("img_video");
    }else if(/xgzl/.test(url.toLowerCase()))
    {
        $("#subfocus").addClass("img_xgzl");
    }else if(/hzpp/.test(url.toLowerCase()))
    {
        $("#subfocus").addClass("img_hzpp");
    }
	else if(/contact/.test(url.toLowerCase()))
    {
        $("#subfocus").addClass("img_contact");
    }
	
});
