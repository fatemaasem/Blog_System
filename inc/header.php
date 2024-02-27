
<!DOCTYPE html>
<html lang="<?=$lang?>">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Blog</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--

    TemplateMo 546 Sixteen Clothing

    https://templatemo.com/tm-546-sixteen-clothing

    -->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">
  <style src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    .author {
    font-family: 'Arial', sans-serif;
    font-size: 16px;
    font-weight: bold;
    color: #333;
    /* Add any other styles you want to apply */
}
body {
            text-align: <?php echo 'rtl'; ?>;
        }
  </style>
  </head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader" >
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="padding-0">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <?php if(isset($_SESSION['login'])):?>
             <h3 class="navbar-brand" style="color: white;"> <?=$_SESSION['login']?></h3><?php endif;?>
          <a class="navbar-brand" href="index.php"><h2> <em><?=$mes['Blog']?></em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php"><?=$mes['All Posts']?>
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <?php if(isset($_SESSION['login'])): ?>
              <li class="nav-item">
                <a class="nav-link" href="addPost.php"><?=$mes['Add New Post']?></a>
              </li>
              <?php endif;?>
              <?php if(($_SESSION['lang']=='ar')):
          
                ?>
              <li class="nav-item">
                <a class="nav-link" href="inc/language.php?lang=<?='en'?>">انجليزيه</a>
              </li>
              <?php endif;?>
              <?php if(isset($_SESSION['lang'])&&($_SESSION['lang']=='en')):
          
                ?>
              <li class="nav-item">
                <a class="nav-link" href="inc/language.php?lang=<?='ar'?>">Arabic</a>
              </li>
              <?php endif;?>
              <?php if(isset($_SESSION['login'])): ?>
              <li class="nav-item">
                <a class="nav-link" href="handle/logout.php"><?=$mes['Logout']?></a>
              </li>
              <?php endif;?>
              <?php if(!isset($_SESSION['login'])): ?>
              <li class="nav-item">
                <a class="nav-link" href="register.php"><?=$mes['Register']?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php"><?=$mes['Login']?></a>
              </li>
              <?php endif;?>
            </ul>
          </div>
        </div>
      </nav>
    </header>