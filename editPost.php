<?php require_once 'inc/connection.php' ?>
<?php require_once 'inc/function.php' ?>
<?php if(!isset($_SESSION['login']))
        header("location:../index.php");
?>
<?php require_once 'inc/header.php' ?>
<?php
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $errors=[];
    $post=checkID('posts',$id);
    if(!is_numeric($id)){
        $errors[]="Id must be number.";
    }
    //check if found in database
    else if(!$post){
        $errors[]="This post is not found.";
    }
    if(!empty($errors)){
        header("location:index.php");
    }
}
else{
    header("location:index.php");
}
?>

 <!-- Page Content -->
 <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Edit Post</h4>
              <h2>edit your personal post</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
   
    <?php
    /*
if(isset($_SESSION['errors'])){
    printErrorArray($_SESSION['errors']);
     unset($_SESSION['errors']);
    
 }
 */
?>
<div class="container w-50 ">
<div class="d-flex justify-content-center">

    <h3 class="my-5">edit Post</h3>
  </div>

    <form method="POST" action="handle/update.php?id=<?=$id;?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?=$post['title']?>">
            <?php 
            if(isset($_SESSION['title_error'])):
                print_error($_SESSION['title_error']);
                unset($_SESSION['title_error']);
            endif;
                ?>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea class="form-control" id="body" name="body" rows="5"><?=$post['body']?></textarea>
            <?php 
            if(isset($_SESSION['body_error'])):
                print_error($_SESSION['body_error']);
                unset($_SESSION['body_error']);
            endif;
                ?>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">image</label>
            <input type="file" class="form-control-file" id="image" name="image" >
            <?php 
            if(isset($_SESSION['image_error'])):
                print_error($_SESSION['image_error']);
                unset($_SESSION['image_error']);
            endif;
                ?>
        </div>
        <?php if(!empty($post['image'])):?>
        <img src="upload/<?= $post['image'];?>" width="100px" >
        <?php endif;?>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>


<?php require_once 'inc/footer.php' ?>