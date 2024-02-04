<?php
session_start();
$conn=mysqli_connect("localhost","root","","blog_system");
if(!isset($_SESSION['lang'])){
    $_SESSION['lang']='en';
}
if($_SESSION['lang']=='en'){
    require_once 'messageEn.php' ;
}
else {
    require_once 'messageAr.php' ;
}
