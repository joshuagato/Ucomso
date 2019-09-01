<?php
session_start();
include '../db.php';

$uid = $_POST['uid'];
$pwd = $_POST['pwd'];

//
$sql = "select * from users where uid='$uid'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$hash_pwd = $row['pwd'];
$hash = password_verify($pwd, $hash_pwd);
if(empty($uid)){
    header("Location: ../index.php?error=emptyfield");
    exit();
}
if(empty($pwd)){
    header("Location: ../index.php?error=emptyfield");
    exit();
}
if($hash == 0){
    header("Location: ../index.php?error=mismatch");
    exit();
}

else{
$sql = "select * from users where uid='$uid' and pwd='$hash_pwd'";
$result = $conn->query($sql);

    if(!$row = $result->fetch_assoc()){
        header("Location: ../index.php?error=mismatch");
        exit();
    }
    else{
        $_SESSION['id'] = $row['id'];
        $_SESSION['uid'] = $row['uid'];
        $_SESSION['first'] = $row['first'];
        $_SESSION['image'] = $row['image'];
    }

header("Location: ../index.php");
}