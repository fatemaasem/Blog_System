<?php require_once '../inc/connection.php' ?>
<?php require_once '../inc/function.php' ?>
<?php if(!isset($_SESSION['login']))
        header("location:../index.php");
?>
<?php
//check the previous page viewPost

    if(isset($_GET['id'])){
        $errors=[];
        $id=$_GET['id'];
        //if is found in database or not using the function 
        $post=checkID('posts',$id);
        //id must be integer
        if(!is_numeric($id)){
            $errors[]="id must be number  .";
        }
        else if(!$post){
            $errors[]="This post is not found.";
        }
        //if errors not found make delete query 
        if(empty($errors)){
            //delete picture from upload file
            //first check if picture is required or not
            if(!empty($post['image']))
                unlink("../upload/".$post['image']);
            $query="delete from posts where id=$id";
            $runQuery=mysqli_query($conn,$query);
            if($runQuery){
                $_SESSION['success']="Post deleted successfully";
                header("location:../index.php");
            }
            else{
                $errors[]="there is an error.";
            }
        }
        
        if(!empty($errors)){
                $_SESSION['errors']=$errors;
                header("location:../index.php");
        }
        
    }
    else{
        header("location:../index.php");
    }
?>