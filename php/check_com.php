<?php
	
	// new comment
	if(isset($_POST['new_comment'])){
		$new_com_name = $_POST['username'];
		$new_com_text = $_POST['comment'];
		$new_com_date = date('Y-m-d H:i:s');
		$new_com_code = generateRandomString();


		if(isset($new_com_text)){
			mysqli_query($connect, "insert into `parents` (`username`, `text`, `commentdate`, `code`)
			values ('$new_com_name', '$new_com_text', '$new_com_date', '$new_com_code')");
		}
		//header("Location: index.php");

	}


	// new reply
	if(isset($_POST['new_reply'])){
		$new_reply_name = $_SESSION['uid'];
		$new_reply_text = $_POST['new-reply'];
		$new_reply_date = date('Y-m-d H:i:s');
		$new_reply_code = $_POST['code'];


		if(isset($new_reply_text)){
			mysqli_query($connect, "insert into `children` (`user`, `text`, `date`, `par_code`)
			values ('$new_reply_name', '$new_reply_text', '$new_reply_date', '$new_reply_code')");
		}
		//header("Location: index.php");

	}


	//Edit
	if(isset($_POST['new_edit'])){
		$new_edit_name = $_SESSION['uid'];
		$new_edit_text = $_POST['new-edit'];
		$new_edit_date = date('Y-m-d H:i:s');
		$new_edit_code = $_POST['code'];


		if(isset($new_edit_text)){
			mysqli_query($connect, "update `parents` set `text`= '$new_edit_text' where `code` = '$new_edit_code'");
		}
		//header("Location: index.php");

	}



	if (isset($_POST['del-btn'])) {
			$code = $_POST['code'];

			$result = mysqli_query($connect, "delete from parents where code='$code'");
			$result = mysqli_query($connect, "delete from children where par_code='$code'");

		//header("Location: index.php");
	}



?>