$(function(){	
	$(".cart-delete").click(function(e){
		e.preventDefault();
		var order_id = $(this).attr("data-id");
		$.ajax({
				type: "POST",
				url: "./index.php?route=common/cart/deleteOrder", 
				dataType : "text",
				data: {
					   order_id : order_id
				},
				success: function (data) {
					location.reload();
				}
		});
	});
})