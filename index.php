<?php
include 'header.php';
?>


<?php
echo "<div class='row'>";
echo "<div class='col-xs-0 col-md-0'></div>";
echo "<div class='col-xs-12 col-md-12'>";
?>

<!-- Codes for user login functionality -->
<?php
$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if(strpos($url, 'error=mismatch') !== false){
    echo "<script>
            $(document).ready(function(){
              alert('Your username or password is incorrect! Please check it and try again');
            });
         </script>";
}
if (strpos($url, 'error=emptyfield') !== false) {
    echo "
        <script>window.alert('Fill out all fields! None of the fields should be empty.');</script>
        ";
}
?>


<!-- Codes to display Settings button and Image upload button when the user logs in -->
<?php
if(isset($_SESSION['id'])){
    $sql = "select image from users where uid='".$_SESSION['uid']."'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {
        echo"<div id='uWelcm'><img src='images/".$row['image']."' width='80px' height='90px' class='img-rounded'><b>Welcome,  </b>" . "<b>".$_SESSION['first']."</b></div>";
    }

    echo"<div id='settingsButtons'>
            <div id='passwdButton'>
                <button id='changePassBtn' class='btn btn-primary'>Change Passwd <span class= 'glyphicon glyphicon-wrench'></span></button>
            </div>
            <div id='picButton'>
                <button id='changePicBtn' class='btn btn-primary'>Change Picture <span class= 'glyphicon glyphicon-picture'></span></button>
            </div>
         </div>";
    print("<br><br>");
}
else{
    echo "<h4 id='firstH1'>You are not logged in!<h4/>";
}
?>




<!-- The Image Upload Functionality Code-->

<?php
$msg = "";
//if upload button is pressed
if(isset($_POST['upload'])){

    //the path to store the uploaded image
    $target = "images/".basename($_FILES['image']['name']);

    //connect to the database
    //$db = mysqli_connect("localhost", "root", "", "phplessons");

    //Get all the submitted data from the form
    $image = $_FILES['image']['name'];
    //$text = $_POST['text'];

    if(empty($image)){
        echo "<script>
            window.alert('Hey there!, You did not select any image!');
        </script>";
    }else{
        $sql = "update users set image='$image' where uid='".$_SESSION['uid']."'";
        mysqli_query($conn, $sql); //stores the submitted data into the database table: images
        header("Location: index.php");
    }



    //Now let's move the uploaded image into the folder: images
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
        $msg = "Image Uploaded successfully";
        echo "<script>
            (document).ready(function(){
                window.alert('Image Uploaded successfully');
            });
        </script>
        ";
    }else{
        $msg = "There was a problem uploading image";
        echo "<script>
            $(document).ready(function(){
                window.alert('There was a problem uploading image');
            });
        </script>";
    }
}

print("<br><br>");

// Image Upload form div
echo"
    <div id='changePicDiv'>
        <h5>Please upload your picture here.</h5>
        <form id='changePicForm' class='form-group' method='post' action='index.php' enctype='multipart/form-data'>
            <input type='hidden' name='1000000'>
            <div>
                <input class='form-control' type='file' name='image'>
            </div>
            <div>
                <button class='btn btn-success' type='submit' name='upload' >Upload Image <span class='glyphicon glyphicon-picture'></span></button>
            </div>
        </form>

    </div>";
?>





<!--The Password Change Code-->
<?php

if(isset($_SESSION['id'])){

    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if (strpos($url, 'error=emptied') !== false) {
        echo "
        <script>window.alert('Fill out all fields! None of the fields should be empty.');</script>
        ";
    }

    if (strpos($url, 'error=pwd-db-mismatch') !== false) {
        echo "
        <script>window.alert('The old password you typed is incorrect! Please check it and retype.');</script>
        ";
    }

    if (strpos($url, 'error=passwords-mismatch') !== false) {
        echo "
        <script>window.alert('The two new passwords do not match! Please, check and retype them.');</script>
        ";
    }

    if (strpos($url, 'password-change=successful') !== false) {
        echo "
        <script>window.alert('Congratulations! You have successfully changed your password.');</script>
        ";
    }

// The Password Change Form Div
    echo "<div id='changePassDiv'>
          <h5>Please change your password here.</h5>
            <form id='changepassword_form' class='form-group' method='POST' action='includes/changepassword.inc.php'>
                <label><h3></h3></label>
                <input class='form-control' type='password' name='oldpwd' placeholder='Old Password'><br>
                <input class='form-control' type='password' name='newpwd' placeholder='New Password'><br>
                <input class='form-control' type='password' name='newpwd2' placeholder='Confirm New Password'><br>
                <button class='btn btn-success'>Change Password <span class= 'glyphicon glyphicon-ok-sign'></button>
            </form>
     </div>";
}
?>

<?php
echo "</div>";
echo "<div class='col-xs-0 col-md-0'></div>";
echo "</div>";
?>


<!--The User Posts Form Code-->
<?php
echo "<div class='row'>";
echo "<div class='col-xs-0 col-md-2'></div>";

echo "<div class='col-xs-12 col-md-6'>";
?>

<div class='page-container'>
    <?php
    get_total();
    require_once 'php/check_com.php';
    ?>
    <?php
    if(isset($_SESSION['id'])) {
        echo "<form action='' method='post' class='main'>
            <label class='instruction'>Enter a brief comment</label>
            <input type='hidden' name='username' value='" . $_SESSION['uid'] . "'>
            <textarea class='form-text' name='comment' id='comment'></textarea>
            <br/>
            <input type='submit' class='form-submit' name='new_comment' value='post'>
        </form><br/> ";
    }
    else{
        echo "<h4 id='instruc'>You are not logged in! You must be logged in to write a post.</h4>";
    }
    ?>
    <?php get_comments(); ?>
</div>

<?php
echo "</div>";
echo "<div class='col-xs-0 col-md-4'></div>";
echo "</div>";
?>



<script>


</script>

<?php
include 'footer.php';
?>
