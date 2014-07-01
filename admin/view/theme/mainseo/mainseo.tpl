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
          <h1><img src="view/image/product.png" alt="" /> 主页SEO</h1>
          <div class="buttons"><a onclick="$('#form').submit();" class="button">
            <span>Save</span>
            </a></div>
        </div>
        <div class="content">
            <div id="tabs" class="htabs">
                <a href="#tab-mainseo">主要信息</a>
            </div>
            <!-- Contact us -->
            <div id="tab-mainseo">
            <table class="form">
              <tr>
                <td> SEO 关键字:</td>
                <td><input size="100" name="item_main_seo_keywords" id="item_main_seo_keywords" value="<?php echo $main_seo_keywords?>" />
                </td>
              </tr>
              <tr>
                <td> SEO 描述:</td>
                <td><textarea cols="100" name="item_main_seo_description" id="item_main_seo_description"><?php echo $main_seo_description?></textarea>
                </td>
              </tr>
            </table>  
            
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