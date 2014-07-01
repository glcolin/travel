$(function(){
	var order_rooms_arr = new Array();	   
		   
	$("#add_room").click(function(e){
		e.preventDefault();
		var new_room = new Array();
		new_room[0]="1";
		new_room[1]="0";
		order_rooms_arr.push(new_room);
		update_rooms();
		update_rooms_data();
	}); 
	
	$('#order_rooms_html').delegate('.remove_room','click',function(e){								 
		e.preventDefault();
		var arr_index = $(this).attr("data-index");
		order_rooms_arr.splice(arr_index,1);
		update_rooms();
		update_rooms_data();
	});
	
	$('#order_rooms_html').delegate('.room_adult','change',function(){
		var number_adult=parseInt($(this).val());
		var number_child=parseInt($(this).parent().parent().find(".room_child").val());
		if((number_adult+number_child)<=4){
			var arr_index = $(this).attr("data-index");
			order_rooms_arr[arr_index][0] = $(this).val();
			update_rooms_data();
		}
		else{
			$(this).val(4-number_child);
			var arr_index = $(this).attr("data-index");
			order_rooms_arr[arr_index][0] = $(this).val();
			update_rooms_data();
			alert("总人数不能超过4");
		}
	});
	
	$('#order_rooms_html').delegate('.room_child','change',function(){	
		var number_child=parseInt($(this).val());
		var number_adult=parseInt($(this).parent().parent().find(".room_adult").val());
		if((number_adult+number_child)<=4){
			var arr_index = $(this).attr("data-index");
			order_rooms_arr[arr_index][1] = $(this).val();	
			update_rooms_data();
		}
		else{
			$(this).val(4-number_adult);
			var arr_index = $(this).attr("data-index");
			order_rooms_arr[arr_index][1] = $(this).val();	
			update_rooms_data();
			alert("总人数不能超过4");
		}
	});
	
	$(".check_fee").click(function(){
		$.ajax({
				type: "POST",
				url: "./index.php?route=lines/line/check_fee&line_id="+line_id, 
				dataType : "text",
				data: {
					   line_id : line_id,
					   order_rooms_data : JSON.encode(order_rooms_arr)
				},
				success: function (data) {
					alert("当前总价为 $"+data);
				}
		});
	});
	
	function update_rooms(){
		$("#order_rooms_html").html('');
		$.each(order_rooms_arr, function(i,val){      						 
			  var room_html = '<tr><td align="center" width="40px">房间'+(i+1)+'</td><td align="right">成人：</td><td ><select data-index="' + i +'" name="orderRoom_'+i+'_0" class="room_adult"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td><td align="right">小孩：</td><td ><select data-index="' + i +'" name="orderRoom_'+i+'_1" class="room_child"><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td><a href="#" data-index="' + i +'" class="remove_room"><img src="./catalog/view/images/delete.png" /></a></td></tr>';
			$(room_html).appendTo("#order_rooms_html");
			$('select[name="orderRoom_'+i+'_0"]').val(val[0]);
			$('select[name="orderRoom_'+i+'_1"]').val(val[1]);
		});
	}
	
	function update_rooms_data(){  
		$("#order_rooms_data").val(JSON.encode(order_rooms_arr));	
	}

})