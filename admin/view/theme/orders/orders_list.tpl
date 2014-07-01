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
      <h1><img src="view/image/product.png" alt="" /> 订单管理</h1>
      <div class="buttons"><!--<a href="<?php echo $insert; ?>" class="button">Add</a><a onclick="delete_action();" class="button">Delete</a>--></div>
    </div>
	<div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
      <textorder id="sort_string" name="sort_string" style="display:none;"></textorder>
        <table class="list">
          <thead>
            <tr>
            	<!--<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>-->
                <td class="center" >订单号</td>
                <td class="center" >联系人</td>
                <td class="center" >联系电话</td>
                <td class="center" >下单时间</td>
                <td class="right"><?php echo "Action"; ?></td>
            </tr>
          </thead>
          <tbody>
          <tr class="filter">
              <td class="center"><input type="text" name="filter_number" value="<?php echo $filter_number; ?>" /></td>
              <td></td>
              <td></td>
			  <td></td>
              <td align="right"><a onclick="filter();" class="button"><?php echo "Search"; ?></a></td>
            </tr>
          <?php if ($orders) { ?>
          <?php foreach ($orders as $order) { ?>
          	<tr>
            <!--<td style="text-align: center;">
                <input type="checkbox" name="selected[]" value="<?php echo $order['info']['id']; ?>" />
                <input type="hidden" name="pid" value="<?php echo $order['info']['id']; ?>" />
            </td>-->
            <td class="center"><?php echo $order['info']['number']?></td>
            <td class="center"><?php echo $order['info']['contact']?></td>
            <td class="center"><?php echo $order['info']['phone']?></td>
            <td class="center"><?php echo $order['info']['create_date']?></td>
            <td class="right"><?php foreach ($order['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
            </tr>
          <?php }?>
          <?php }?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>   
     </div>        
  </div>
</div>

<script src="<?php echo HTTP_SERVER?>view/javascript/json.js"></script>
<script type="text/javascript">
/*$("#form tbody").sortable({
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
	$("#sort_string").val(JSON.encode(sort_arr));
	
	$.ajax({
		type: 'post',
		url : 'index.php?route=orders/orders/saveSort',
		dataType : "html",
		data: {
			   sort_string : JSON.encode(sort_arr)
		},
		success: function (data) {

		}
	});
}*/

function delete_action(){
	if($('#form tbody input[type="checkbox"]:checked').size()>0){
		$('form').submit();
	}
	else{
		alert("Please choose an item to delete.");
	}
}

function filter() {
	url = 'index.php?route=orders/orders';
	
	var filter_number = $('input[name="filter_number"]').val();
	
	if (filter_number) {
		url += '&filter_number=' + encodeURIComponent(filter_number);
	}
	
	location = url;
}
</script>
 
<?php echo $footer; ?>