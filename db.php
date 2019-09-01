<?php

return $conn = mysqli_connect('localhost', 'root', '', 'phplessons');
if(!$conn){
    die("Connection failed: " . sqli_connect_error());
}

?>

