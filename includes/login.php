<?php session_start();?>
<?php require_once("error-msg.php");

if(!isset($_SESSION['user_id'])){ 
    header("Location:../index.php");
    exit();
}
    //Include connection
    include("../connection/db.php");
    //Posts count
    $posts_count = $db->query("SELECT * FROM posts");
    //Comments count
    $comments_count = $db->query("SELECT * FROM comments");
?>


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
                <h1>Welcome <?php echo $_SESSION['user_id']; ?></h1>
                <table>
                    <tr>
                        <td>Total Blog Post</td>
                        <td> <?php echo $posts_count->num_rows;?></td>
                    </tr>
                    
                    <tr>
                        <td>Total Blog Comments</td>
                          <td> <?php echo $comments_count->num_rows; ?></td>
                    </tr>
                </table>
                <ul>
                    <li><a href="new_post.php">Create new post</a></li>
                    <li><a href="#">Delete post</a></li>
                    <li><a href="#">Update post</a></li>
                </ul>
                
                
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet felis orci. Nulla justo tortor, congue in augue vel,
                placerat pellentesque est. Quisque et consectetur nisl. Nulla facilisi. Proin id rutrum nulla
                </p>
                 <p>Aliquam pretium quam eleifend augue iaculis, id imperdiet velit venenatis. Curabitur porttitor magna vel dui vulputate, ac mattis erat vehicula.
                    Aliquam pretium quam eleifend augue iaculis, id imperdiet velit venenatis. Curabitur porttitor magna vel dui vulputate, ac mattis erat vehicula.
                 </p>
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

