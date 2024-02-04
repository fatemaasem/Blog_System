<?php require_once 'inc/connection.php' ?>
<?php require_once 'inc/function.php' ?>
<?php require_once 'inc/header.php' ?>
 <?php
    $post=[];
    if (isset($_GET['id'])&&is_numeric($_GET['id'])) {
        $id=$_GET['id'];
        //to check is found in database
        $query="select posts.*, users.name  from posts join users 
        on posts.user_id=users.id
         where posts.`id`=$id";
        $runQuery=mysqli_query($conn,$query);
        
        if(mysqli_num_rows($runQuery)==1){
          $post=  mysqli_fetch_assoc($runQuery);
          
        }
        //if not found this id in database
        else{
          echo "not found";
            header("location:index.php");
        }
    }
    else {
        header("location:index.php");
    }

 ?>
 

        Page Content
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4><?=$mes['View Post']?></h4>
              <h2><?=$mes['view personal post']?></h2>
            </div>
          </div>
        </div>
      </div>
   
      </div>
    <?php

if(isset($_SESSION['success'])){
printSuccessMessage($_SESSION['success']); 
unset($_SESSION['success']);
session_destroy();
}

?>
    <div class="best-features about-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2 class=<?php if($_SESSION['lang']=='ar') echo"text-end"?>><?=$mes['Our Post Image']?></h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="upload/<?=$post['image'];?>" alt="">
            </div>
          </div>
          <div class="col-md-6 " >
            <div class="left-content">
              <h4><?=$post['title'];?></h4>
              <p><?=$post['body'];?>.</p>
               <div class="author">
                 <p><?=$mes['Author']?> <?=$post['name'];?></p>
               </div>
               <?php if(isset($_SESSION['login'])):?>
                  
              <div class="d-flex justify-content-center">
                  <a href="editPost.php?id=<?=$post['id'];?>" class="btn btn-success mr-3 "> edit post</a>
                  <a href="handle/deletePost.php?id=<?=$id;?>" class="btn btn-danger "> delete post</a><?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

    <?php require_once 'inc/footer.php' ?>