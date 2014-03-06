<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);
$connect = mysqli_connect("localhost", "root", "onekanda","blog-php2014" );
if(mysqli_connect_errno())
    {
        echo "Failed to connect to Mysql:" . mysql_connect_error();
    }
else{
        echo "Hello Mario Onekanda";    
    }
?>