<?php require_once '../inc/connection.php' ?>
<?php require_once '../inc/function.php' ?>
<?php

    //check if the previous page is editPost.php
    if(isset($_POST['submit'])&&isset($_GET['id'])){
        $errors=[];
        $id=$_GET['id'];
        $oldPost=checkID('posts',$id);
        $oldImageName=$oldPost['image'];
        /////////////////////////////////
        $title=htmlspecialchars(trim($_POST['title']));
        $body=htmlspecialchars(trim($_POST['body']));
        $image=$_FILES['image'];
        $imageName=$image['name'];
        $imageSize=$image['size']/(1024*1024);
        $imageError=$image['error'];
        $tmp_name=$image['tmp_name'];
        $imageExt=pathinfo($imageName,PATHINFO_EXTENSION);
        $allPathImage=['jpeg','jpg','png','gif'];
        echo "<pre>";
        print_r($image);
        echo "</pre>";
        $Errors=[];
        $titleError=0;
        $bodyError=0;
        if(empty($title)){
            $errors[]="Title must be not empty.";
            $titleError=1;
        }
        if(is_numeric($title)){
            $errors[]="Title must be string.";
            $titleError=1;
        }
        if(empty($body)){
            $bodyError=1;
            $errors[]="Body must be not empty.";
        }
        if(is_numeric($body)){
            $bodyError=1;
            $errors[]="Body must be string.";
        }
        //check if image is upload ...image not required
        $foundImage=0;
        if($imageError==0){
            $foundImage=1;
        }
        //size must not be greater than 2 mega byte
        if($foundImage==1&&$imageSize>2){
            $errors[]="Image size must not be greater than 2 mega byte";
        }
        if($foundImage==1&&!in_array($imageExt,$allPathImage)){
            $errors[]="Extension is fault . ";
        }
       
        //delete an old picture from upload file if it found
        echo "$oldImageName";
        if(!empty($oldImageName)){
            unlink("../upload/".$oldImageName);
        }
        
        //make edit
        $newName='';
        if($foundImage==1){
        $newName=uniqid().".$imageExt";
        //upload this picture in upload file
        move_uploaded_file($tmp_name,"../upload/$newName");
        echo "$newName";
        }
        //insert in database
       
        if(empty($newName))
        $query="update posts set `title`='$title' ,`body`='$body',`image`=null,`user_id`=1 where id =$id";
        else
        $query="update posts set `title`='$title' ,`body`='$body',`image`='$newName',`user_id`=1 where id =$id";
        $runQuery=mysqli_query($conn,$query);
        if($runQuery){
            $_SESSION['success']="updated Successfully.";
        }
        else{
            $errors[]="There is an error.";
        }
            ////////////////////////////////
             if(!empty($errors)){
                $_SESSION['errors']=$errors;
               header("location:../editPost.php?id=$id");
            }
            else{
               
                header("location:../viewPost.php?id=$id");
            }
           
    }
    else{
        header("location:index.php");
    }
?>