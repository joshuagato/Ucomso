<?php
include 'header.php';
?>

    <?php
    $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if(strpos($url, 'error=empty') !== false){
        echo"
        <script>window.alert('Please fill out all fields!');</script>
        ";
    }
    elseif(strpos($url, 'error=username') !== false){
        echo"
        <script>window.alert('Username already exists! Please type a different username.');</script>
        ";
    }
    elseif(strpos($url, 'error=password-mismatch') !== false){
        echo"
        <script>window.alert('The passwords do not match! Please check them and try again.');</script>
        ";
    }
    elseif(strpos($url, 'signup=successful') !== false){
        echo"
        <script>window.alert('Congratulations! You have successfully signed up . You can now log in with your username and password');
        </script>";
    }
    elseif(strpos($url, 'error=uidlength') !== false){
        echo"
        <script>window.alert('Your username must be at least five (5) characters long!');
        </script>";
    }
    elseif(strpos($url, 'error=passwdlength') !== false){
        echo"
        <script>window.alert('Your password must be at least eight (8) characters long!');
        </script>";
    }
?>

    <br/><br/>

<?php
    echo "<div class='row'>";
    echo "<div class='col-xs-0 col-md-3'></div>";

    echo "<div class='col-xs-12 col-md-6'>";
    if(isset($_SESSION['id'])){
        echo"
          <script>window.alert('You are already logged in');</script>
        ";
        echo "<div class='alert-info'>You are already logged in! First sign out in order to sign up.</div>";
    }

    else{
        echo "<h1 id='signupH1'><u>Sign Up Here</u></h1>";
        echo  "<br/>";
        echo "<form class='form-group' id='signup_form' action='includes/signup.inc.php' method='POST'>
        <input class='form-control' type='text' name='first' placeholder='Firstname'>
        <input class='form-control' type='text' name='last' placeholder='Lastname'>
        <input class='form-control' type='email' name='eml' placeholder='Email'>
        <input class='form-control' type='text' name='uid' placeholder='Username'>
        <input class='form-control' type='password' name='pwd' placeholder='Password'>
        <input class='form-control' type='password' name='cpwd' placeholder='Confirm Password'>
        <button class='btn btn-success btn-block'>Register <span class='glyphicon glyphicon-registration-mark'></span></button>
    </form>";
    }

echo "</div>";
echo "<div class='col-xs-0 col-md-3'></div>";
echo "</div>";
?>

<?php
include 'footer.php';
?>