<?php
session_start();
include '../db.php';

$first = $_POST['first'];
$last = $_POST['last'];
$eml = $_POST['eml'];
$uid = $_POST['uid'];
$pwd = $_POST['pwd'];
$cpwd= $_POST['cpwd'];

if(empty($first)){
    header("Location: ../signup.php?error=empty");
    exit();
}
if(empty($last)){
    header("Location: ../signup.php?error=empty");
    exit();
}
if(empty($eml)){
    header("Location: ../signup.php?error=empty");
    exit();
}
if(empty($uid)){
    header("Location: ../signup.php?error=empty");
    exit();
}
if(empty($pwd)){
    header("Location: ../signup.php?error=empty");
    exit();
}
if(empty($cpwd)){
    header("Location: ../signup.php?error=empty");
    exit();
}
if(strlen($uid) <  5){
    header("Location: ../signup.php?error=uidlength");
    exit();
}
if(strlen($pwd) <  8){
    header("Location: ../signup.php?error=passwdlength");
    exit();
}
else{
    $sql = "select uid from users where uid='$uid'";
    $result=$conn->query($sql);
    $uidcheck = mysqli_num_rows($result);
    if($uidcheck > 0){
        header("Location: ../signup.php?error=username");
        exit();
    }
    elseif($cpwd !== $pwd){
        header("Location: ../signup.php?error=password-mismatch");
        exit();
    }

    else{
        $encrypted_password = password_hash($pwd, PASSWORD_DEFAULT);
        $sql = "insert into users (first, last, eml, uid, pwd, cpwd)
        values ('$first', '$last', '$eml', '$uid', '$encrypted_password', '$encrypted_password')";
        $result=$conn->query($sql);
        echo"
        <script>window.alert('You have successfully signed up <br> You can now log in with your username and password');</script>
        ";
        header("Location: ../signup.php?signup=successful");
        exit();
    }
}
