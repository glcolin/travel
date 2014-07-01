<?php echo $header; ?>
<div id="content"> 
  <?php if ($warning) { ?>
  <div class="warning"><?php echo $warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
  	<div class="heading">
      <h1><img src="view/image/product.png" alt="" /> 旅游资讯</h1>
      <div class="buttons"><a href="<?php echo $insert; ?>" class="button">增加</a><a onclick="delete_action();" class="button">删除</a></div>
    </div>
	<div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
            	<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
                <td class="center" width="10%">图片</td>
                <td class="center" >地点</td>
                <td class="center" >分类</td>
                <td class="right" width="5%">操作</td>
            </tr>
          </thead>
          <tbody>
          <?php if ($informations) { ?>
          <?php foreach ($informations as $information) { ?>
          	<tr>
            <td style="text-align: center;">
                <input type="checkbox" name="selected[]" value="<?php echo $information['info']['id']; ?>" />
                <input type="hidden" name="pid" value="<?php echo $information['info']['id']; ?>" />
            </td>
            <td class="center"><img src="<?php echo $information['image']?>" style="padding: 1px; border: 1px solid #DDDDDD;"/></td>
            <td class="center"><?php echo $information['info']['title']?></td>
            <td class="center"><?php echo isset($categories[$information['info']['category']])?$categories[$information['info']['category']]:"";?></td>
            <td class="right"><?php foreach ($information['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
            </tr>
          <?php }?>
          <?php }?>
          </tbody>
        </table>
      </form>
     </div>           
  </div>
</div>

<style>
.content .ui-state-highlight td{
	height:60px;
	background-color:#33CC33;
}
.content .ui-icon{background-image: url("view/javascript/jquery/ui/themes/ui-lightness/images/ui-icons_ef8c08_256x240.png");margin-left: 34%;}
</style>

<script src="<?php echo HTTP_SERVER?>view/javascript/json.js"></script>
<script type="text/javascript">
$("#form tbody").sortable({
	items: "tr",
	stop: function(){
		save_sort();
	},
	placeholder: "ui-state-highlight",
	helper: "clone",
	tolerance: "pointer"
});

function save_sort(){
	var sort_arr=[];
	$('#form tbody [name="pid"]').each(function(){
		sort_arr.push($(this).val());
	})
	//$("#sort_string").val(JSON.encode(sort_arr));
	
	$.ajax({
		type: 'post',
		url : 'index.php?route=informations/informations/saveSort',
		dataType : "html",
		data: {
			   sort_string : JSON.encode(sort_arr)
		},
		success: function (data) {

		}
	});
}

function delete_action(){
	if($('#form tbody input[type="checkbox"]:checked').size()>0){
		$('form').submit();
	}
	else{
		alert("Please choose an item to delete.");
	}
}
</script>
 
<?php echo $footer; ?>