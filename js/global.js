
$(document).ready(function(){

	$(".child-comments").hide();

	$("a#children").click(function(){
		var section = $(this).attr("name");
		$("#C-" + section).toggle();
	});


	$(".form-submit").click(function(){
		var commentBox = $("#comment");
		var commentCheck = commentBox.val();
		if (commentCheck == '' || commentCheck == NULL) {
			commentBox.addClass("form-text-error");
			return false;
		}
	});

	$(".form-reply").click(function(){
		var replyBox = $("#new-reply");
		var replyCheck = replyBox.val();
		if (replyCheck == '' || replyCheck == NULL) {
			replyBox.addClass("form-text-error");
			return false;
		}
	});


	var act=1;
	$("a#reply").click(function(){
		var comCode = $(this).attr("name");
		var parent = $(this).parent();
		if (act==1){
			// Code to display the user Reply textarea
			parent.append("<form id='reply-form' method='post'>" +
				"<textarea class='form-text' name='new-reply' id='new-reply' required='required'></textarea>" +
				"<input type='hidden' name='code' value='"+comCode+"' />" +
				"<input type='submit' class='form-submit' id='form-reply' name='new_reply' value='Reply' />" +
				"</form>");
			act=0;
		}else{
			$("form#reply-form").hide();
			act=1;
		}
	});



	var act2=1;
	$("a#edit").click(function(){
		var comCode2 = $(this).attr("name");
		var parent = $(this).parent();
		if (act2==1){
		// Code to display the post Edit textarea
		parent.append("<form id='edit-form' method='post'>" +
			"<textarea class='form-text' name='new-edit' id='new-edit' required='required'></textarea>" +
			"<input type='hidden' name='code' value='"+comCode2+"' />" +
			"<input type='submit' class='form-submit' id='form-edit' name='new_edit' value='Edit' /></form>");
			act2=0;
		}else{
			$("form#edit-form").hide();
			act2=1;
		}
	});






	$("a#delete").click(function(){
		var id=$(this).attr('comment-id');
		$.ajax({
			type:"POST",
			url:"../php/check_com.php",
			data:{"comment_id":id},
			success: function(msg){
				if(msg==''){
					alert(id);
				}else{
					alert(id);
				}
			}
		});
		return false;
		//alert(id);
	});

});