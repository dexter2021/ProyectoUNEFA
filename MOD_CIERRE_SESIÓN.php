<?php 
session_start();
if($_SESSION['login']){    
    session_destroy();
    header("location:index.php");
}
else{
    header("location:index.php");
}
?>


