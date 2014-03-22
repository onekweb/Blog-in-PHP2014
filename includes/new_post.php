<?php
session_start();
    include("../connection/db.php");
    if(!isset($_SESSION['user_id'])){
        header("Location: ../index.php");
        exit();
    }

    if(isset($_POST['submit'])){
        //Get data
        $title = $_POST['title'];
        $body = $_POST['body'];
        $category = $_POST['category'];
        $body = $db->real_escape_string($body);       
        $title = $db->real_escape_string($title);
        $user_id = $_SESSION['user_id'];
        $date = date('Y-m-d G:i:s');
        $body = htmlentities($body);
        if($title && $body && $category){
            $query1 = $db->query("INSERT INTO posts('user_id', 'title', 'body', 'category_id', 'posted') VALUES('$user_id', '$title', '$body', '$category', '$date')")or die(mysql_error());                	
            if($query1){
            echo "Add post";
            }else{
                echo "Error";
        }        
    }else{
            echo "Missing information";
    }
    }
    

?>


<?php require_once("error-msg.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Blog in PHP 2014</title>
    <?php include("stylesheet.php");?>
</head>
<body>
    <!--#container-->
    <div id="container">
        
        <!--#head-->
        <?php include("head.php");?>
        <!--end head-->
        
        <!--#content-->
        <div id="content">
            <!--#content-top-->
            <div id="content-top">
                <h1>About us</h1>
                <form action="<?php echo($_SERVER['PHP_SELF']);?>" method="post">
                    <label>Title</label></br><input type="name" name="title"></br>
                    <label for="body">Body:</label></br>
                    <textarea name="body" cols="50" rows="10"></textarea></br>
                    <label>Category:</label></br>
                    <select name="category">
                        <?php
                        //Include the database
                        include("../connection/db.php");
                        $query = $db->query("SELECT * FROM categories");
                        while($row = $query->fetch_object()){
                            echo "<option value='".$row->category_id ."'>".$row->category."</option>";
                        }
                        
                        ?>
                    </select>
                    </br>
                        
                    <input type="submit" name="submit"value="Submit">
                </form>
            </div>
        <!--end #content-top-->
     
        
        <!--#footer-->
                <?php include("footer.php");?>
        <!--end #footer -->
        
        <!--end #content-->    
        </div>
    </div>
</body>
</html>
