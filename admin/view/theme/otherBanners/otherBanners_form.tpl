<?php echo $header; ?>
<div id="content">

  <?php if ($warning) { ?>
  <div class="warning"><?php echo $warning; ?></div>
  <?php } ?> 
   
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
  <input type="hidden" name="item_id" value="<?php echo isset($this->request->get['otherBanner_id'])?$this->request->get['otherBanner_id']:""?>" />
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" />其他广告图片 </h1>
	  
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
      <div id="tabs" class="htabs"><a href="#tab-general">主要信息</a></div>
		
		<table class="form">
          <tr>
			<td> 标题:</td>
			<td><input name="item_title" id="item_title" size="60" value="<?php echo isset($otherBanner_info['title']) ? $otherBanner_info['title'] : ''; ?>"/>
			</td>
		  </tr>
          <tr>
			<td> 类型:</td>
			<td>
            	<select name="item_type" id="item_type">
                	<option value="hotline" <?php echo isset($otherBanner_info['type'])?($otherBanner_info['type']=="hotline"?'selected="selected"':''):'';?> >热门路线广告</option>
                    <option value="recommendline" <?php echo isset($otherBanner_info['type'])?($otherBanner_info['type']=="recommendline"?'selected="selected"':''):'';?> >推荐路线广告</option>
                    <option value="other" <?php echo isset($otherBanner_info['type'])?($otherBanner_info['type']=="other"?'selected="selected"':''):'';?> >其他</option>
                </select>
			</td>
		  </tr>
          <tr>
			<td> 链接:</td>
			<td><input name="item_link" id="item_link" size="60" value="<?php echo isset($otherBanner_info['link']) ? $otherBanner_info['link'] : ''; ?>"/>
			</td>
		  </tr>
          <tr>
			  <td onclick="select_image('item_image');">Image(360x105)<br/><span style="color:red;">&lt; Click Here or Image to change &gt;</span></td>
			  <td valign="top"><input type="hidden" name="item_image" value="<?php echo isset($otherBanner_info['image_url']) ? $otherBanner_info['image_url'] : ''; ?>" id="item_image" />
				<img src="<?php echo isset($otherBanner_info['image_url']) ? HTTP_HOME.'uploads/images/'.$otherBanner_info['image_url'] : ''; ?>"  class="image" data-href="item_image" /></td>
		  </tr>
		</table>
	
    </div>

  </div>
  	</form>
 
</div>

<style>
.content img{ max-width:398px;}
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

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
//--></script> 
<?php echo $footer; ?>