<?php
include 'header.php';
?>

<?php
$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if(strpos($url, 'error=empty') !==false){
    echo "<div class='alert-danger'>Fill out all fields! None of the fields should be empty.</div>";
    echo"
        <script>window.alert('Fill out all fields!');</script>
        ";
}

print("<br><br/>");

echo "<div class='row'>";
echo "<div class='col-xs-0 col-md-3'></div>";

echo "<div class='col-xs-12 col-md-6'>";

if(isset($_SESSION['id'])){
    $uid = $_SESSION['uid'];
        echo "<h1 id='contactusH1'><u>Write your comments here.</u></h1>";
        echo "<form class='form-group' id='contact_form' method='POST' action='includes/contactus.inc.php' href='mailto:ucomso@gmail.com'>
        <label><h3>Your username is: $uid</h3></label>
        <input type='hidden' name='uid' value='".$_SESSION['uid']."'>
        <input class='form-control' type='text' name='subject' placeholder='Subject'>
        <textarea class='form-control' name='comment' placeholder='Type your message here.'></textarea>
        <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
        <button class='btn btn-success btn-block'>Submit Comment <span class='glyphicon glyphicon-envelope'></span></button>
    </form>";
}
else{
    echo"
          <script>window.alert('You are not logged in!');</script>
        ";
    echo "<div class='alert-error'>You are not logged in! Log in to submit a comment</div>";

    }

echo "</div>";
echo "<div class='col-xs-0 col-md-3'></div>";
echo "</div>";
?>


<?php
include 'footer.php';
?>