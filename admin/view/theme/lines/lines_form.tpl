<?php echo $header; ?>
<div id="content">

  <?php if ($warning) { ?>
  <div class="warning"><?php echo $warning; ?></div>
  <?php } ?> 
   
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
  <input type="hidden" name="item_id" value="<?php echo isset($this->request->get['line_id'])?$this->request->get['line_id']:""?>" />
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" />旅游线路</h1>
	  
      <div class="buttons">
      	<a onclick="$('#form').submit();" class="button">
		<span>保存</span>
		</a>
        <a href="<?php echo  $cancel;?>" class="button">
		<span>取消</span>
		</a>
	  </div>
    </div>
    <div class="content">
        <div id="tabs" class="htabs">
        	<a href="#tab-general">主要信息</a>
            <a href="#tab-introduction">详细介绍</a>
            <a href="#tab-otherfee">其他费用</a>
            <a href="#tab-images">其他图片</a>
            <a href="#tab-accommodation_fee">住宿费用</a>
            <a href="#tab-seo">SEO</a>
        </div>

		<!-- General -->
	 	<div id="tab-general">
		<table class="form">
          <tr>
			<td> 名称:</td>
			<td><input name="item_title" id="item_title" value="<?php echo isset($line_info['title']) ? $line_info['title'] : ''; ?>"/>
			</td>
		  </tr>
          <tr>
			<td> 编号:</td>
			<td><input name="item_serial_number" id="item_serial_number" value="<?php echo isset($line_info['serial_number']) ? $line_info['serial_number'] : ''; ?>"/>
			</td>
		  </tr>
          <tr>
			<td> 推荐:</td>
			<td>
            	<select name="item_hot" id="item_hot">
                	<option value="1" <?php echo isset($line_info['hot'])?($line_info['hot']==1?'selected="selected"':''):''; ?> >是</option>
                    <option value="0" <?php echo isset($line_info['hot'])?($line_info['hot']==0?'selected="selected"':''):'selected="selected"'; ?>>否</option>
                </select>
			</td>
		  </tr>
          <tr>
			<td> 分区:</td>
			<td>
				<select name="item_area" id="item_area">
                	<?php foreach($areas as $key=>$area){?>
                    <option value="<?php echo $key;?>" <?php echo isset($line_info['area'])?($key==$line_info['area']?'selected="selected"':''):''; ?> ><?php echo $area;?></option>
                    <?php }?>
                </select>
            </td>
		  </tr>
          <tr>
			<td> 出发城市:</td>
			<td>
            	<select name="item_from_city" id="item_from_city">
                	<?php foreach($fromcitys as $key=>$fromcity){?>
                    <option value="<?php echo $key;?>" <?php echo isset($line_info['from_city'])?($key==$line_info['from_city']?'selected="selected"':''):''; ?> ><?php echo $fromcity;?></option>
                    <?php }?>
                </select>
			</td>
		  </tr>
          <tr style="display:none;">
			<td> 出发日期:</td>
			<td>
            	<input name="item_departuredates" id="item_departuredates" readonly="readonly" size="150" value="<?php echo isset($line_info['departure_dates']) ? $line_info['departure_dates'] : ''; ?>"/>
			</td>
		  </tr>
          <tr>
			<td> 上车地点（多选）:</td>
			<td>
            	<select name="item_boardinglocations[]" multiple="multiple" size="7">
                <?php foreach($boardinglocations as $boardinglocation){?>
                    <option value="<?php echo $boardinglocation['id'];?>" <?php echo in_array($boardinglocation['id'],$boardinglocations_selected)?'selected="selected"':''; ?> ><?php echo $boardinglocation['title'];?></option>
                <?php }?>
                </select>
			</td>
		  </tr>
          <tr>
			<td> 主要景点:</td>
			<td>
            	<select name="item_main_attractions[]" multiple="multiple" size="7">
                <?php foreach($attractions as $attraction){?>
                    <option value="<?php echo $attraction['id'];?>" <?php echo in_array($attraction['id'],$attractions_selected)?'selected="selected"':''; ?> ><?php echo $attraction['title'];?></option>
                <?php }?>
                </select>
			</td>
		  </tr>
          <tr>
			<td> 结束地点:</td>
			<td>
            	<select name="item_end_city" id="item_end_city">
                	<?php foreach($endcitys as $key=>$endcity){?>
                    <option value="<?php echo $key;?>" <?php echo isset($line_info['end_city'])?($key==$line_info['end_city']?'selected="selected"':''):''; ?> ><?php echo $endcity;?></option>
                    <?php }?>
                </select>
			</td>
		  </tr>
          <tr>
			<td> 出团日期:</td>
			<td><input name="item_active_date" id="item_active_date" value="<?php echo isset($line_info['active_date']) ? $line_info['active_date'] : ''; ?>"/>
			</td>
		  </tr>
          <tr>
			<td> 旅游天数:</td>
			<td><input name="item_days" id="item_days" value="<?php echo isset($line_info['days']) ? $line_info['days'] : ''; ?>"/>
			</td>
		  </tr>
          <tr>
			<td> 积分:</td>
			<td><input name="item_integral" id="item_integral" value="<?php echo isset($line_info['integral']) ? $line_info['integral'] : ''; ?>"/>
			</td>
		  </tr>
          <tr>
			<td> 原价:</td>
			<td><input name="item_original_price" id="item_original_price" value="<?php echo isset($line_info['original_price']) ? $line_info['original_price'] : ''; ?>"/>
			</td>
		  </tr>
          <tr>
			<td> 价格:</td>
			<td><input name="item_price" id="item_price" value="<?php echo isset($line_info['price']) ? $line_info['price'] : ''; ?>"/>
			</td>
		  </tr>
          <tr>
			  <td onclick="select_image('item_image');">Image(271x169)<br/><span style="color:red;">&lt; Click Here or Image to change &gt;</span></td>
			  <td valign="top"><input type="hidden" name="item_image" value="<?php echo isset($line_info['image_url']) ? $line_info['image_url'] : ''; ?>" id="item_image" />
				<img src="<?php echo isset($line_info['image_url']) ? HTTP_HOME.'uploads/images/'.$line_info['image_url'] : ''; ?>"  class="image" data-href="item_image" /></td>
			</tr>
		</table>
		</div>
        <!-- Introduction -->
	    <div id="tab-introduction">
        <table class="form">
          <tr>
			<td> 介绍:</td>
			<td><textarea name="item_content" id="item_content"><?php echo isset($line_info['content']) ? $line_info['content'] : ''; ?></textarea>
			</td>
		  </tr>
        </table>
        </div>
        <!-- Other fee -->
	    <div id="tab-otherfee">
        <table class="form">
          <tr>
			<td> 其他费用:</td>
			<td><textarea name="item_otherfee" id="item_otherfee"><?php echo isset($line_info['otherfee']) ? $line_info['otherfee'] : ''; ?></textarea>
			</td>
		  </tr>
        </table>
        </div>
        <!-- Images -->
	    <div id="tab-images">
        	<ul class="images mainimages_holder" >
				<li class="addimage add_new_mainimage" onclick="select_images('add_new_mainimage');"><i class="icon-plus"></i><br /><i style="left: 12%;">(310x200)</i></li>
			</ul>
			<textarea name="item_images" id="item_images" style="display:none"><?php echo isset($line_info['images'])?$line_info['images']:''?></textarea>
        </div>
        <!-- Accommodation fee -->
	 	<div id="tab-accommodation_fee">
		<table class="list">
        	<thead>
                <tr>
                    <td class="center" rowspan="2">第一个人</td>
                    <td class="center" colspan="2">第二个人</td>
                    <td class="center" colspan="2">第三个人</td>
                    <td class="center" colspan="2">第四个人</td>
                </tr>
                <tr>
                    <td class="center">成人</td>
                    <td class="center">小孩</td>
                    <td class="center">成人</td>
                    <td class="center">小孩</td>
                    <td class="center">成人</td>
                    <td class="center">小孩</td>
                </tr>
        	</thead>
        
          <tr>
			<td class="center"><input type="text" size="10" name="fee_1_0" value="<?php echo $accommodation_fee[1][0];?>" /></td>
            <td class="center"><input type="text" size="10" name="fee_2_0" value="<?php echo $accommodation_fee[2][0];?>" /></td>
            <td class="center"><input type="text" size="10" name="fee_2_1" value="<?php echo $accommodation_fee[2][1];?>" /></td>
            <td class="center"><input type="text" size="10" name="fee_3_0" value="<?php echo $accommodation_fee[3][0];?>" /></td>
            <td class="center"><input type="text" size="10" name="fee_3_1" value="<?php echo $accommodation_fee[3][1];?>" /></td>
            <td class="center"><input type="text" size="10" name="fee_4_0" value="<?php echo $accommodation_fee[4][0];?>" /></td>
            <td class="center"><input type="text" size="10" name="fee_4_1" value="<?php echo $accommodation_fee[4][1];?>" /></td>
		  </tr>
		</table>
		</div>
        <!-- SEO -->
	 	<div id="tab-seo">
		<table class="form">
          <tr>
			<td> SEO关键字:</td>
			<td><input name="item_seo_keywords" id="item_seo_keywords" size="100" value="<?php echo isset($line_info['seo_keywords']) ? $line_info['seo_keywords'] : ''; ?>"/>
			</td>
		  </tr>
          <tr>
			<td> SEO描述:</td>
			<td><textarea cols="100" name="item_seo_description" id="item_seo_description" ><?php echo isset($line_info['seo_description']) ? $line_info['seo_description'] : ''; ?></textarea>
			</td>
		  </tr>
		</table>
		</div>
    </div>

  </div>
  	</form>
 
</div>
<style>
.content img{ max-width:300px;}

.images li.addimage {
    cursor: pointer;
}
.images li {
    border: 3px solid #DDDDDD;
    float: left;
    height: 100px;
    line-height: 20px;
    list-style: none outside none;
    margin-bottom: 20px;
    margin-right: 20px;
    padding: 0;
    position: relative;
    width: 100px;
}
.images li.addimage i {
    left: 41%;
    position: relative;
    top: 33%;
}
.images img {
    border: 0 none;
    height: auto;
    max-width: 100%;
    vertical-align: middle;
	max-height:100%;
}
.images [class^="icon-"],.images [class*=" icon-"] {
    background-image: url("./view/image/glyphicons-halflings.png");
    background-position: 14px 14px;
    background-repeat: no-repeat;
    display: inline-block;
    height: 14px;
    line-height: 14px;
    margin-top: 1px;
    vertical-align: text-top;
    width: 14px;
}
.images .icon-plus {
    background-position: -408px -96px;
}
.images li a.icon-remove {
    cursor: pointer;
    position: absolute;
    right: -8px;
    top: -8px;
}
.images .icon-remove {
    background-position: -312px 0;
}
</style>

<!--select image-->
<script type="text/javascript">
var image_category_url="<?php echo HTTP_HOME.'uploads/images/';?>";
function select_image(element){
	window.open ("./view/javascript/ckeditor/elfinder/elfinder_select_image.php?token=<?php echo $token;?>&image="+element,"newwindow","height=500,width=1100,top=" + (window.screen.availHeight-30-500)/2 +",left=" + (window.screen.availWidth-10-1100)/2 +",toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no") ;
}
function image_callback(file,name){
	file=file.replace(/.*?uploads\/images\//,'');
	$('[name="' + name+'"]').val(file);
	$('[data-href="'+name+'"]').attr('src', image_category_url+file);
}
</script>

<!--editor-->
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript">
CKEDITOR.replace('item_content', {
	filebrowserBrowseUrl : "elfinder/elfinder.html",
});
CKEDITOR.replace('item_otherfee', {
	filebrowserBrowseUrl : "elfinder/elfinder.html",
});
</script>

<!--Images-->
<script src="<?php echo HTTP_SERVER?>view/javascript/json.js"></script>
<script type="text/javascript" charset="utf-8">
var image_category_url="<?php echo HTTP_HOME.'uploads/images/';?>";
function select_images(element){
	window.open ("./view/javascript/ckeditor/elfinder/elfinder_select_image.php?token=<?php echo $token;?>&imagesarea="+element,"newwindow","height=500,width=1100,top=" + (window.screen.availHeight-30-500)/2 +",left=" + (window.screen.availWidth-10-1100)/2 +",toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no") ;
}

function trans_images_data(url,add_image){

	$("<li><img src='"+url+"'/><a class='icon-remove'></a></li>").insertBefore("."+add_image);
	
	$(".mainimages_holder").sortable({
		items: "li:not(.add_new_mainimage)",
		stop: function(){
			get_images_data('item_images','.mainimages_holder li:not(.add_new_mainimage)');
		},
		placeholder: "ui-state-highlight",
		helper: "clone",
		tolerance: "pointer"
	});
	get_images_data('item_images','.mainimages_holder li:not(.add_new_mainimage)');
	
}
function get_images_data(element,filter){
	var arr = [];
	$(filter).each(function(){
		var newObj = {};
		newObj.src = $(this).find("img").attr("src").replace(/.*?uploads\/images\//,'');
		arr.push(newObj);
	});
	
	$(document).find("textarea[name='"+element+"']").text(JSON.encode(arr));
}

function init_images_data(element,filter){

	images_area = $(document).find("textarea[name='"+element+"']");
	arr = images_area.text() ? JSON.decode(images_area.text()) : [];

	for(var i = 0; i < arr.length; i ++){
		$("<li><img src='"+ image_category_url+arr[i].src + "'/><a class='icon-remove'></a></li>").insertBefore(filter);
	}
}

//Main images

init_images_data('item_images','.add_new_mainimage');
$(".mainimages_holder").sortable({
	items: "li:not(.add_new_mainimage)",
	stop: function(){
		get_images_data('item_images','.mainimages_holder li:not(.add_new_mainimage)');
	},
	placeholder: "ui-state-highlight",
	helper: "clone",
	tolerance: "pointer"
});

$(".mainimages_holder").delegate("a.icon-remove", "click", function(e){
	$(this).parent().remove();
	get_images_data('item_images','.mainimages_holder li:not(.add_new_mainimage)');
});

</script>

<!--multi datepicker-->
<link rel="stylesheet" type="text/css" href="./view/stylesheet/mdp.css">
<script type="text/javascript" src="./view/javascript/jquery/jquery-ui.multidatespicker.js"></script>
<script>
$(function() {
	var dates_str_old = $('#item_departuredates').val();
	var datas_arr = dates_str_old.split(',');
	if(datas_arr[0]){
		$('#item_departuredates').multiDatesPicker({
			addDates: datas_arr
		});
	}
	else{
		$('#item_departuredates').multiDatesPicker({
			
		});
	}
});
</script>

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
//--></script> 
<?php echo $footer; ?>