<?php echo $header; ?>
<div id="content">

  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
    <div class="box">
        <div class="heading">
          <h1><img src="view/image/product.png" alt="" /> 联系我们</h1>
          <div class="buttons"><a onclick="$('#form').submit();" class="button">
            <span>Save</span>
            </a></div>
        </div>
        <div class="content">
            <div id="tabs" class="htabs">
                <a href="#tab-contactus">主要信息</a>
                <a href="#tab-qq_information">QQ信息</a>
            </div>
            <!-- Contact us -->
            <div id="tab-contactus">
            <textarea name="item_content" id="item_content"><?php echo $content?></textarea>
            </div>
            <!-- QQ information -->
            <div id="tab-qq_information">
            <textarea name="item_qq_information" id="item_qq_information"><?php echo $qq_information?></textarea>
            </div>
        </div> 
    </div>    
    </form>           
</div>

<!--editor-->
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript">
CKEDITOR.replace('item_content', {
	filebrowserBrowseUrl : "elfinder/elfinder.html",
});

CKEDITOR.replace('item_qq_information', {
	filebrowserBrowseUrl : "elfinder/elfinder.html",
});
</script>
 
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
//--></script>  
 
<?php echo $footer; ?>