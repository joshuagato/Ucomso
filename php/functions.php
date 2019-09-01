<?php
	//session_start();
	//$_SESSION['user'] = 'Admin';

	function get_total(){
		require 'connect.php';
		$result = mysqli_query($connect, "select * from `parents` order by `commentdate` desc");
		$row_cnt = mysqli_num_rows($result);
		echo '<h1 class="tot-comm">All User Posts ('.$row_cnt.')</h1>';
	}


	function get_comments(){
		require 'connect.php';
		// Retrieving all Parent user Posts from the database
		$result = mysqli_query($connect, "select * from `parents` order by `commentdate` desc");
		$row_cnt = mysqli_num_rows($result);

		echo "<div class='row'>";
		foreach ($result as $item) {
			$date = new datetime($item['commentdate']);
			$date = date_format($date, 'M j, Y | H:i:s');
			$user = $item['username'];
			$comment = nl2br($item['text']);
			$par_code = $item['code'];


			// Code to display the Username time & date and the Post a user submits plus the Delete and Reply toggle link
			echo '<div class="comment" id="'.$par_code.'" >' . '<p class="user">' . $user . '</p>&nbsp;' .
				'<p class="time">' . $date . '</p>' . '<p class="comment-text">'. $comment . '';

				if(isset($_SESSION['id'])) {
					echo '</p>' . '<a class="link-reply" id="reply" name="' . $par_code . '">Reply</a>&nbsp' . ' ' . '';

						if(($_SESSION['uid'] === $user) || ($_SESSION['uid'] === 'admin')){
							echo '<a class="link-edit" id="edit" name="' . $par_code . '">Edit</a>' . ' ' .
							'<form method="post" class="del-btn"><input type="hidden" name="code" value="' . $par_code . '">
							<button id="delete" class="link-delete btn btn-link" name="del-btn">Delete</button></form>';
						}else{

						}
				}
			// Retrieving all Children user comments from the database
			$chi_result = mysqli_query($connect, "select * from `children` where `par_code` = '$par_code' order by `date` desc");
			$chi_cnt = mysqli_num_rows($chi_result); //The number of rows

			if ($chi_cnt == 0) {
				# code...
			}

			else{
				// Code to display the replies toggle link
				echo '<a class="link-reply" id="children" name="'.$par_code.'"><span id="tog_text">Replies</span> ('.$chi_cnt.')</a>' .
					'<div class="child-comments" id="C-'.$par_code.'">';

				foreach ($chi_result as $com) {
					$chi_date = new dateTime($com['date']);
					$chi_date = date_format($chi_date, 'M j, Y | H:i:s');
					$chi_user = $com['user'];
					$chi_com = $com['text'];
					$chi_par = $com['par_code'];

					// Code to display the Replies
					echo '<div class="child" id="'.$par_code.'-C">' . '<p class="user">' .$chi_user. '</p>&nbsp;' .
						'<p class="time">' . $chi_date.'</p>' . '<p class"comment-text">' .$chi_com. '</p>' . '</div>';
				}
				echo '</div>';
			}
			echo '</div>';
		} echo "</div>";
		
	}
	function generateRandomString($length = 6){
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$characterLength = strlen($characters);
			$randomString = '';

			for($i=0; $i < $length; $i++){
				$randomString .= $characters[rand(0, $characterLength - 1)];
			}
			return $randomString;
	}


?>