<?php require_once 'inc/connection.php' ?>
<?php require_once 'inc/function.php' ?>
<?php if(!isset($_SESSION['login']))
        header("location:../index.php");
?>
<?php require_once 'inc/header.php' ?>


    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>new Post</h4>
              <h2>add new personal post</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    if(isset($_SESSION['errors'])){
       printErrorArray($_SESSION['errors']);
        unset($_SESSION['errors']);
        session_destroy();
    }
    
     else if(isset($_SESSION['success'])){
        printSuccessMessage($_SESSION['success']); 
        unset($_SESSION['success']);
        session_destroy();
     }
     ?>
<div class="container w-50 ">
  <div class="d-flex justify-content-center">
    <h3 class="my-5">add new Post</h3>
  </div>
  <form method="POST" action="handle/store.php" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php if(isset($_SESSION['title'])) echo $_SESSION['title']; ?>">
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea class="form-control" id="body" name="body" rows="5" ><?php if(isset($_SESSION['body'])) echo $_SESSION['body']?></textarea>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">image</label>
        <input type="file" class="form-control-file" id="image" name="image" >
    </div>
    <button type="submit" class="btn btn-primary" name="add">Add post</button>
  </form>
</div>

    <?php require_once 'inc/footer.php' ?>