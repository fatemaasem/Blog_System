
<?php require_once 'inc/connection.php' ?>
<?php require_once 'inc/function.php' ?>
<?php require_once 'inc/header.php' ?>
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <!-- <h4>Best Offer</h4> -->
            <!-- <h2>New Arrivals On Sale</h2> -->
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <!-- <h4>Flash Deals</h4> -->
            <!-- <h2>Get your best products</h2> -->
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <!-- <h4>Last Minute</h4> -->
            <!-- <h2>Grab last minute deals</h2> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->
    <?php 
   
    if(isset($_SESSION['success'])){
      if(isset($_SESSION['login'])){
     
      }
      printSuccessMessage($_SESSION['success']); 
      unset($_SESSION['success']);
      
      
    }
   
    else if(isset($_SESSION['errors'])){
      printErrorArray($_SESSION['errors']);
      unset($_SESSION['errors']);
      
    }
    ?>
    <?php
    
    $page=1;
    $limit=3;//define from clint
    $numberPage=1;

    if(isset($_GET['page'])){
      $page=$_GET['page'];
    }
    //to define number page
    $query="select count(`id`) as total from posts";
    $runQuery=mysqli_query($conn,$query);
    if(mysqli_num_rows($runQuery)==1){
      $numberPage=ceil(mysqli_fetch_assoc($runQuery)['total']/$limit);
    }
   // validPage($page,$numberPage);
    $offset=($page-1)*$limit;

     ?>
    <?php
    $query="select id,image, created_at,title,substring(body,1,53) as body from posts order by `id` limit $limit offset $offset ";
    $runQuery=mysqli_query($conn,$query);
    if($runQuery){
        $posts=mysqli_fetch_all($runQuery,MYSQLI_ASSOC);
    }
    ?>
    
    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading ">
              
              <h2  class=<?php if($_SESSION['lang']=='ar') echo"text-end"?>><?= $mes['Latest Posts']?></h2>
              
              <!-- <a href="products.html">view all products <i class="fa fa-angle-right"></i></a> -->
            </div>
          </div>
          <?php
                foreach($posts as $post):
                ?>
          <div class="col-md-4">
            <div class="product-item">
              <!-- check if there is an picture or not -->
              <?php if(!empty($post['image'])):?>
              <a href="#" width=><img src="upload/<?=$post['image'] ?>"height="200" width="300" alt=""></a><?php endif;?>
              <div class="down-content">
              <a href="#"><h4><?=$post['title']?></h4></a>
              <h5><?=$post['created_at']?></h5>
                <p><?=$post['body']."..."?></p>
                <!-- <ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span>Reviews (24)</span> -->
                <div class="d-flex justify-content-end">
                  <a href="viewPost.php?id=<?=$post['id'];?>" class="btn btn-info "> <?= $mes['view']?></a>
                </div>
                
              </div>
            </div>
          </div>
          <?php endforeach;?>
        </div>
      </div>
   <div class=' d-flex justify-content-center'>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item <?php if($page==1) echo "disabled";?>"><a class="page-link" href="index.php?page=<?=$page-1;?>"><?=$mes['Previous']?></a></li>
          <li class="page-item"><a class="page-link" href="index.php?page=<?=$page;?>"><?="$page"?></a></li>
          <?php if($page+1<=$numberPage):?>
          <li class="page-item"><a class="page-link" href="index.php?page=<?=$page+1;?>"><?="$page"+1?></a></li><?php endif;?>
          <?php if($page+2<=$numberPage):?>
          <li class="page-item"><a class="page-link" href="index.php?page=<?=$page+2;?>"><?="$page"+2?></a></li><?php endif;?>
          <li class="page-item  <?php if($page==$numberPage) echo "disabled";?>" ><a class="page-link" href="index.php?page=<?=$page+1?>"><?=$mes['Next']?></a></li>
        </ul>
      </nav>
   </div>
</div>

 
    
<?php require_once 'inc/footer.php' ?>