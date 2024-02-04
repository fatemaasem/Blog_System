<?php require_once '../inc/connection.php' ?>
<?php require_once '../inc/function.php' ?>
<?php
if(isset($_POST['add'])){
    $title=htmlspecialchars(trim($_POST['title']));
    $body=htmlspecialchars(trim($_POST['body']));
    $image=$_FILES['image'];
    $imageName=$image['name'];
    $imageSize=$image['size']/(1024*1024);
    $imageError=$image['error'];
    $tmp_name=$image['tmp_name'];
    $imageExt=pathinfo($imageName,PATHINFO_EXTENSION);
    $allPathImage=['jpeg','jpg','png','gif'];
    $insertErrors=[];
    $titleError=0;
    $bodyError=0;
    if(empty($title)){
        $insertErrors[]="Title must be not empty.";
        $titleError=1;
    }
    if(is_numeric($title)){
        $insertErrors[]="Title must be string.";
        $titleError=1;
    }
    if(empty($body)){
        $bodyError=1;
        $insertErrors[]="Body must be not empty.";
    }
    if(is_numeric($body)){
        $bodyError=1;
        $insertErrors[]="Body must be string.";
    }
    //check if image is upload ...image not required
    $foundImage=0;
    if($imageError==0){
        $foundImage=1;
    }
    //size must not be greater than 2 mega byte
    if($foundImage==1&&$imageSize>2){
        $insertErrors[]="Image size must not be greater than 2 mega byte";
    }
    if($foundImage==1&&!in_array($imageExt,$allPathImage)){
        $insertErrors[]="Extension is fault . ";
    }
    
    //make insert
    $newName='';
    if($foundImage==1){
    $newName=uniqid().".$imageExt";
    //upload this picture in upload file
    move_uploaded_file($tmp_name,"../upload/$newName");
    }
    //insert in database
    if(empty($newName))
    $query="insert into posts (`title`,`image`,`body`,`user_id`) values('$title',null,'$body',1)";
    else
    $query="insert into posts (`title`,`image`,`body`,`user_id`) values('$title','$newName','$body',1)";
    $runQuery=mysqli_query($conn,$query);
    if($runQuery){
        $_SESSION['success']="Insert Successfully.";
    }
    else{
        $insertErrors[]="there is an error.";
    }
    if(!empty($insertErrors)){
        if($titleError==0)
        //if not found error at added title
            $_SESSION['title']=$title;
        //if not found error at added body
        if($bodyError==0)
            $_SESSION['body']=$body;

        $_SESSION['errors']=$insertErrors;
      
    }
    header("location:../addPost.php");
}
else{
    header("location:../addPost.php");
}
?>
