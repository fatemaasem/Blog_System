<?php require_once '../inc/connection.php' ?>
<?php
    if(!isset($_SESSION['login']))
        header("location:../index.php");
    unset($_SESSION['login']);
    header("location:../login.php");
?>