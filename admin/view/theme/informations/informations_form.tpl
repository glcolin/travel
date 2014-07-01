<?php echo $header; ?>
<div id="content">

  <?php if ($warning) { ?>
  <div class="warning"><?php echo $warning; ?></div>
  <?php } ?> 
   
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
  <input type="hidden" name="item_id" value="<?php echo isset($this->request->get['information_id'])?$this->request->get['information_id']:""?>" />
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" />旅游资讯 </h1>
	  
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
      <div id="tabs" class="htabs"><a href="#tab-general">主要信息</a><a href="#tab-seo">SEO</a></div>
		<div id="tab-general">
		<table class="form">
          <tr>
			<td> 标题:</td>
			<td><input name="item_title" id="item_title" size="60" value="<?php echo isset($information_info['title']) ? $information_info['title'] : ''; ?>"/>
			</td>
		  </tr>
          <tr style="display:none;">
			<td> 精彩景点:</td>
			<td>
            	<select name="item_wonderful" id="item_wonderful">
                	<option value="1" <?php echo isset($information_info['wonderful'])?($information_info['wonderful']==1?'selected="selected"':''):''; ?>>是</option>
                    <option value="0" <?php echo isset($information_info['wonderful'])?($information_info['wonderful']==0?'selected="selected"':''):'selected="selected"'; ?>>否</option>
                </select>
			</td>
		  </tr>
          <tr>
			<td> 分类:</td>
			<td>
				<select name="item_category" id="item_category">
                	<?php foreach($categories as $key=>$category){?>
                    <option value="<?php echo $key;?>" <?php echo isset($information_info['category'])?($key==$information_info['category']?'selected="selected"':''):''; ?> ><?php echo $category;?></option>
                    <?php }?>
                </select>
            </td>
		  </tr>
          <tr>
			<td> 介绍:</td>
			<td><textarea name="item_content" id="item_content"><?php echo isset($information_info['content']) ? $information_info['content'] : ''; ?></textarea>
			</td>
		  </tr>
          <tr>
			  <td onclick="select_image('item_image');">Image(498x334)<br/><span style="color:red;">&lt; Click Here or Image to change &gt;</span></td>
			  <td valign="top"><input type="hidden" name="item_image" value="<?php echo isset($information_info['image_url']) ? $information_info['image_url'] : ''; ?>" id="item_image" />
				<img src="<?php echo isset($information_info['image_url']) ? HTTP_HOME.'uploads/images/'.$information_info['image_url'] : ''; ?>"  class="image" data-href="item_image" /></td>
		  </tr>
		</table>
		</div>
        <!-- SEO -->
	 	<div id="tab-seo">
		<table class="form">
          <tr>
			<td> SEO关键字:</td>
			<td><input name="item_seo_keywords" id="item_seo_keywords" size="100" value="<?php echo isset($information_info['seo_keywords']) ? $information_info['seo_keywords'] : ''; ?>"/>
			</td>
		  </tr>
          <tr>
			<td> SEO描述:</td>
			<td><textarea cols="100" name="item_seo_description" id="item_seo_description" ><?php echo isset($information_info['seo_description']) ? $information_info['seo_description'] : ''; ?></textarea>
			</td>
		  </tr>
		</table>
		</div>
    </div>

  </div>
  	</form>
 
</div>

<style>
.content img{ max-width:498px;}
</style>

<!--editor-->
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript">
CKEDITOR.replace('item_content', {
	filebrowserBrowseUrl : "elfinder/elfinder.html",
});
</script>

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