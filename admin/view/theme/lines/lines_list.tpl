<?php echo $header;?>
<div id="content"> 
  <?php if ($warning) { ?>
  <div class="warning"><?php echo $warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
  	<div class="heading">
      <h1><img src="view/image/product.png" alt="" /> 旅游线路</h1>
      <div class="buttons"><a href="<?php echo $insert; ?>" class="button">增加</a><a onclick="delete_action();" class="button">删除</a></div>
    </div>
	<div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
            	<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
                <td class="center" >图片</td>
                <td class="center" >名称</td>
                <td class="center" style="width:30px;">推荐</td>
                <td class="center" >分区</td>
                <td class="center" >编号</td>
                <td class="center" >出发城市</td>
                <td class="center" >结束地点</td>
                <td class="center" >出团日期</td>
                <td class="center" >旅游天数</td>
                <td class="right">操作</td>
            </tr>
          </thead>
          <tbody>
          <tr class="filter">
              <td></td>
              <td></td>
              <td></td>
              <td></td>
			  <td class="center">
              	<select name="filter_area">
                    <option value=""></option>
                    <?php foreach($areas as $area_id=>$area){?>
                    <option <?php echo $area_id==$filter_area?'selected="selected"':''?> value="<?php echo $area_id?>"><?php echo $area?></option>
                    <?php }?>
                </select>
              </td>
			  <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td align="right"><a onclick="filter();" class="button"><?php echo "Filter"; ?></a></td>
          </tr> 
          <?php if ($lines) { ?>
          <?php foreach ($lines as $line) { ?>
          	<tr>
            <td style="text-align: center;">
                <input type="checkbox" name="selected[]" value="<?php echo $line['info']['id']; ?>" />
                <input type="hidden" name="pid" value="<?php echo $line['info']['id']; ?>" />
            </td>
            <td class="center"><img src="<?php echo $line['image']?>" style="padding: 1px; border: 1px solid #DDDDDD;"/></td>
            <td class="center"><?php echo $line['info']['title']?></td>
            <td class="center"><?php echo $line['info']['hot']=='1'?'<i class="ui-icon ui-icon-star"></i>':'';?></td>
            <td class="center"><?php echo isset($areas[$line['info']['area']])?$areas[$line['info']['area']]:''?></td>
            <td class="center"><?php echo $line['info']['serial_number']?></td>
            <td class="center"><?php echo isset($fromcitys[$line['info']['from_city']])?$fromcitys[$line['info']['from_city']]:"";?></td>
            <td class="center"><?php echo isset($endcitys[$line['info']['end_city']])?$endcitys[$line['info']['end_city']]:""?></td>
            <td class="center"><?php echo $line['info']['active_date']?></td>
            <td class="center"><?php echo $line['info']['days']?></td>
            <td class="right"><?php foreach ($line['action'] as $action) { ?>
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
.content .ui-icon{background-image: url("view/javascript/jquery/ui/themes/ui-lightness/images/ui-icons_ef8c08_256x240.png");margin-left: 21%;}
</style>

<script src="<?php echo HTTP_SERVER?>view/javascript/json.js"></script>
<script type="text/javascript">
var filter_area='<?php echo $filter_area?$filter_area:""?>';
$("#form tbody").sortable({
	items: "tr:not(.filter)",
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
		url : 'index.php?route=lines/lines/saveSort',
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

function filter() {
	url = 'index.php?route=lines/lines';
	
	var filter_area = $('select[name=\'filter_area\']').attr('value');
	
	if (filter_area) {
		url += '&filter_area=' + encodeURIComponent(filter_area);
	}
	
	location = url;
}
</script>
 
<?php echo $footer; ?>