<?php
session_start();
include '../db.php';

$uid = $_POST['uid'];
$subject = $_POST['subject'];
$comment = $_POST['comment'];
$date = $_POST['date'];


if(empty($subject)) {
    header("Location: ../contactus.php?error=empty");
    exit();
}

if(empty($comment)) {
    header("Location: ../contactus.php?error=empty");
    exit();
}

else {
    $sql = "insert into user_comments (uid, subj, comment, date)
    values ('$uid', '$subject', '$comment', '$date')";
    $result = $conn->query($sql);
    /**
    echo"
        <script>window.alert('Comment Successfully Submitted');</script>
        "; **/
    header("Location: ../contactus.php");
}