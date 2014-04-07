<?php session_start();?>
<?php require_once("error-msg.php");

if(!isset($_SESSION['id'])){ 
    header("Location:../index.php");
    exit();
}
    //Include connection
    include("../connection/db.php");
    //Posts count
    $posts_count = $db->query("SELECT * FROM posts");
    //Comments count
    $comments_count = $db->query("SELECT * FROM comments");
    //Get blogpost
    $query1= $db->prepare("SELECT posted_id, title, LEFT(body, 200) AS body, category FROM posts INNER JOIN categories ON categories.category_id = posts.category_id order by posted_id desc")or die("error"); 
    $query1->execute();
    $query1->bind_result($posted_id, $title, $body, $category);
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
                <h1>Welcome <?php //echo $_SESSION['id']; ?></h1>
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
                <h2>My lateste blog post</h2>
                    <?php  while($query1->fetch()):
                    $lastspace = strrpos($body, ' ');
                    ?>
                    <h2><?php echo $title?></h2>
                    <p><?php echo substr($body, 0, $lastspace)."<a href='post.php?id=$posted_id'>..</a>"?></p>
                    <p>Category:<?php echo $category?></p>
                    <?php endwhile?>

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

