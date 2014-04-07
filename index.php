<?php session_start(); ?>


<?php include("includes/error-msg.php");?>
<?php
if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    //Include connection
    include("connection/db.php");
    if(empty($username)){
        echo "Please enter your username";
    }elseif(empty($password)){
        echo "Please enter your password";
    }
    else{   
    $username  = strip_tags($username);
    $username = $db->real_escape_string($username);
    $password  = strip_tags($password);
    $password = $db->real_escape_string($password);
    $password = md5($password);
    $query = $db->query("SELECT user_id, username FROM users WHERE username='$username' AND password='$password'")or die("error");
    if($query->num_rows ===1){
        while($row = $query->fetch_object()){
        $_SESSION['user_id'] = $row->user_id;
        header('Location: includes/login.php');
        exit();
        }
    }else{
        echo "The username doesn't exit";   
    }
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Blog in PHP 2014</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
</head>
<body>
            <!--#form-->
                <form action="index.php" method="post" id="myform">
                    <h1>Welcome to my Onekblog</h1>
                    <p>
                        <label>Username</label>
                        <input type="name" name="username" class="myinput"/>
                    </p>
                    <p>
                        <label>Password</label>
                        <input type="password" name="password" class="myinput"/>
                    </p>
                    <p>
                        <input type="submit" name="submit" value="Login" class="submitbtn"/>
                    </p>
                                 
                </form>
            <!--end #form--> 
    </div>
</body>
</html>
