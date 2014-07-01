<div class="f_l zuob">
<?php if($show==1){?>
<div class="box f_l mods_01 mar_b_02 mar_r_01">
<h2 class="tilv">分区</h2>
<ul class="clearfix">
		<li><a <?php echo $area==""?'class="vvn"':'';?> href="./index.php?route=lines/lines">所有</a></li>
        <?php foreach($areas as $key=>$value){?>
        <?php if($key!=$specialareas){?>
        <li><a <?php echo $area==$key?'class="vvn"':'';?> href="./index.php?route=<?php echo $key==$specialareas?"cruises/cruises":"lines/lines";?>&area=<?php echo $key;?>"><?php echo $value;?></a></li>
        <?php }?>
        <?php }?>
      </ul>
</div>

<div class="box f_l mods_01 mar_b_02 mar_r_01">
<h2 class="tilv">搜索路线</h2>
<form id="lines_search" action="./index.php?route=lines/lines" method="post" enctype="multipart/form-data">
<table width="234" height="117" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="70" align="right">天数：</td>
    <td width="164" align="left"><label for="textfield"></label>
      <input type="text" name="search_days" id="search_days" value="<?php echo $search_days;?>"/></td>
    </tr>
  <tr>
    <td align="right">出发地：</td>
    <td align="left">
    	<select name="search_fromcity" id="search_fromcity">
        	<option value=""> </option>
        	<?php foreach($fromcitys as $value){?>
        	<option value="<?php echo $value['id'];?>" <?php echo $value['id']==$search_fromcity?'selected="selected"':'';?>><?php echo $value['title'];?></option>
        	<?php }?>
        </select>
    </td>
  </tr>
  <tr>
    <td align="right">目的地：</td>
    <td align="left">
    	<select name="search_endcity" id="search_endcity">
        	<option value=""> </option>
        	<?php foreach($endcitys as $value){?>
        	<option value="<?php echo $value['id'];?>" <?php echo $value['id']==$search_endcity?'selected="selected"':'';?>><?php echo $value['title'];?></option>
       		<?php }?>
        </select>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" id="search_lines" value="" class="sousuo" /></td>
  </tr>
</table>
</form>
<!--<script type="text/javascript">
$(function(){
	$("#search_lines").click(function(){
		var search_days = htmlspecialchars($("#search_days").val());
		var search_fromcity = htmlspecialchars($("#search_fromcity").val());
		var search_endcity = htmlspecialchars($("#search_endcity").val());
		window.location.href = "./index.php?route=lines/lines&days="+search_days+"&fromcity="+search_fromcity+"&endcity="+search_endcity;
	});
	
	function htmlspecialchars(str)  
	{  
		str = str.replace(/&/g, '&amp;');
		str = str.replace(/</g, '&lt;');
		str = str.replace(/>/g, '&gt;');
		str = str.replace(/"/g, '&quot;');
		str = str.replace(/'/g, '&#039;');
		return str;
	}
});
</script>-->
</div>
<?php }?>

<div class="box f_l mods_02 mar_b_02 mar_r_01">
<h2 class="tilv">热门路线</h2>
	<ul>
		<?php foreach($hotlines as $key=>$value){?>
        <li><a href="./index.php?route=lines/line&line_id=<?php echo $value['id'];?>"><?php echo $value['title'];?></a></li>
        <?php }?>
    </ul>
</div>

<div class="box f_l mods_01 mar_b_02 mar_r_01">
<h2 class="tilv">联系我们</h2>
<div class="pandings">
 <?php echo htmlspecialchars_decode($contactus);?> 
</div>
  <img src="./uploads/images/mg2.jpg" width="248" height="171" /> </div>


</div>