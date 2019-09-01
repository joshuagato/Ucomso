<?php
session_start();
include '../db.php';

$oldpwd = $_POST['oldpwd'];
$newpwd = $_POST['newpwd'];
$newpwd2 = $_POST['newpwd2'];
$sessionID = $_SESSION['id'];


if(empty($oldpwd)){
    header("Location: ../index.php?error=emptied");
    exit();
}
if(empty($newpwd)){
    header("Location: ../index.php?error=emptied");
    exit();
}
if(empty($newpwd2)){
    header("Location: ../index.php?error=emptied");
    exit();
}
if($newpwd2 !== $newpwd){
    header("Location: ../index.php?error=passwords-mismatch");
    exit();
}


else{

    $sql = "select * from users where id='$sessionID'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $hash_pwd = $row['pwd'];
    $hash = password_verify($oldpwd, $hash_pwd);

    if($hash == 0){
        header("Location: ../index.php?error=pwd-db-mismatch");
        exit();
    }

    else{
        $encrypted_password = password_hash($newpwd, PASSWORD_DEFAULT);
        $sql = "update users set pwd='$encrypted_password', cpwd ='$encrypted_password' where id='$sessionID'";
        $result=$conn->query($sql);
        header("Location: ../index.php?password-change=successful");
        exit();
    }
}
