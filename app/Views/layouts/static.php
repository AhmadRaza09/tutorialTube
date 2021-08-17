<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/tutorialTube/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/tutorialTube/public/css/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src=<?php echo "/tutorialTube/public/js/jquery.js?" . Rand();?>></script>
    <title><?php echo $title; ?></title>
</head>
<body>

  <?php $session = \Config\Services::session();
      $uri = service('uri');
      $segment = $uri->getSegment(1);
      $segment1 = $uri->getSegment(2);
  ?>
  <!-- navbar start -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top mb-5  bg-light">
        <div class="container-fluid">
          <a class="navbar-brand col-md-1 col-sm-2 col-3 " href="/tutorialTube/public/User"><img src="/tutorialTube/public/img/cover.png" alt="logo" class="img-fluid img-thumbnail"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form id='filters' action="/tutorialTube/public/series/freeSeries" method='post' class="d-sm-flex me-lg-5 col-xl-6 col-lg-4 w">
              
              <select id='filterCategory' name='seriesCategory' class="form-select form-select-sm me-2 mt-sm-0 mt-2 wF  " aria-label=".form-select-sm example">
           
              <option value="1" <?php if( isset($_POST['seriesCategory'])){echo set_select('seriesCategory', '1');} ?> selected>Free</option>
              <option value="2" <?php if( isset($_POST['seriesCategory'])){echo set_select('seriesCategory', '2');} ?>>Paid</option>
              
              </select>
              <select  name='seriesType' class="form-select form-select-sm me-2 mt-sm-0 mt-2 wF  " aria-label=".form-select-sm example">
              <option value="" selected>Type</option>
              <option value="1" <?php if( isset($_POST['seriesType'])){echo set_select('seriesType', '1');} ?>>Computer Science</option>
              <option value="2" <?php if( isset($_POST['seriesType'])){echo set_select('seriesType', '2');} ?>>Information Technology</option>
              
              </select>
              <div class="input-group me-2 mt-lg-0 mt-sm-0 mt-2 wS">
                <input type="text" name="seriesName" value="<?php if( isset($_POST['seriesName'])){echo set_value('seriesName');}?>" class="form-control form-control-sm" placeholder="Series Title Here" aria-label="Series Title Here" aria-describedby="button-addon2">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </div>
              <div id="pickCategory" class='d-none'><?php if(isset($_POST['seriesCategory'])){echo $_POST['seriesCategory'];}?></div>
            <div id="pickType" class='d-none'><?php if(isset($_POST['seriesType'])){echo $_POST['seriesType'];}?></div>
            <div id="pickName" class='d-none'><?php if(isset($_POST['seriesName'])){echo $_POST['seriesName'];}?></div>
          </form>
          
            <ul class="navbar-nav  me-auto mb-2 mb-lg-0 text-center ">
              <li class="nav-item">
                <a class="nav-link <?php if(($segment == 'user'  || $segment == 'User') && ($segment1 == 'index' || $segment1 == '')){echo 'active';}?>" aria-current="page" href="/tutorialTube/public/user">Home</a>
              </li>

              <!-- 1if -->
              <?php if(isset($_SESSION['login']['role'])):?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php if($segment1 == 'paidSeries' || $segment1 == 'freeSeries' || ($segment1 == ''  && $segment == 'series')){echo 'active';} ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Series
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item <?php echo $active = $segment1 == 'freeSeries' ? 'active' : '';?>" href="/tutorialTube/public/series/freeSeries">Free Series</a></li>
                  <li><a class="dropdown-item <?php echo $active = $segment1 == 'paidSeries' ? 'active' : ''; ?>" href="/tutorialTube/public/series/paidSeries">Paid Series</a></li>
                  <!-- 2if -->
                  <?php
                if(isset($_SESSION['login']['role']) && $_SESSION['login']['role'] == 2):?>
                    <li>
                   <a class="dropdown-item <?php if($segment == 'series' && $segment1 == ''){echo 'active';}?>" aria-current="page" href="/tutorialTube/public/series">Create Series</a>
                  </li>
                <!-- 2if end -->
              <?php endif?>
              
                </ul>

              </li>

                
              <!-- 1if -->
              <?php else:?>
                <li class="nav-item">
                <a class="nav-link <?php echo $active = $segment1 == 'freeSeries' ? 'active' : '';?>" aria-current="page" href="/tutorialTube/public/series/freeSeries">Free Series</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo $active = $segment1 == 'paidSeries' ? 'active' : '';?>" aria-current="page" href="/tutorialTube/public/series/paidSeries">Paid Series</a>
              </li>
              
              <?php endif?>

                <!-- 3if -->
              <?php
                if(isset($_SESSION['login']['role']) && $_SESSION['login']['role'] == 2):?>
                
                    <li class="nav-item">
                   <a class="nav-link <?php echo $active = $segment1 == 'uploadByMe' ? 'active' : '';?>" aria-current="page" href="/tutorialTube/public/series/uploadByMe">Upload By ME</a>
                  </li>
                <!-- 3if end -->
              <?php endif?>
              
              <!-- 4if -->
              <?php if(isset($_SESSION['login']['role'])):?>
              <li class="nav-item">
                <a class="nav-link <?php echo $active = $segment1 == 'submitVoucher' ? 'active' : '';?>" aria-current="page" href="/tutorialTube/public/series/submitVoucher">Submit Voucher</a>
              </li>
              <!-- 4if end -->
              <?php endif?>

              <!-- <li class="nav-item order-lg-5 order-first">
                <form class="d-lg-flex ">
              
                  <select class="form-select form-select-sm me-2" aria-label=".form-select-sm example">
                  <option selected>Filter</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                  </select>
                  <div class="input-group me-2 mt-lg-0 mt-2">
                    <input type="text" class="form-control form-control-sm" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </div>
                
                
              </form> -->
              <!-- </li> -->
              
            </ul>
            
            <ul class="navbar-nav  mb-2 mb-lg-0 text-center float-lg-end float-none">
              <li class="nav-item w-75 m-auto d-lg-none d-block"><hr></li>
              <li class="nav-item">
                <?php
                 $active = $segment1 == 'login' ? 'active' : '';
                  if(isset($session->get('login')['name']) && ($session->get('login')['name'] != ""))
                  {
                    echo "<div class='nav-link' aria-current='page'>";
                    echo $session->get('login')['name'];
                    echo "</div>";
                  }
                  else
                  {
                    echo "<a class='nav-link $active' aria-current='page' href='/tutorialTube/public/user/login'>Login</a>";
                  }
                ?>
              </li>
              <li class="nav-item">
              <?php
              
                  if(isset($session->get('login')['name']) && ($session->get('login')['name'] != ""))
                  {
                    echo "<a class='nav-link ' aria-current='page' href='/tutorialTube/public/user/logout'>Logout</a>";
                  }
                  else
                  {
                    $active = $segment1 == 'signUp' ? 'active' : '';
                    echo "<a class='nav-link $active' aria-current='page' href='/tutorialTube/public/user/signUp'>SignUp</a>";
                  }
                ?>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- navbar end -->

      <!--renderSection start here-->
      <?php $this->renderSection('content') ?>
      <!--renderSection end here-->


      <!-- end content -->

</div>

</div>
<!-- pppp
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
<div class="carousel-inner">
<div class="carousel-item active">
<img src="img/aa.png" class="d-block w-100" alt="...">
</div>
<div class="carousel-item">
<img src="img/cover.png" class="d-block w-100" alt="...">
</div>
<div class="carousel-item">
<img src="img/WhatsApp Image 2021-03-13 at 12.17.40 PM.jpeg" class="d-block w-100" alt="...">
</div>
<div class="carousel-item">
<img src="img/cover.png" class="d-block w-100" alt="...">
</div>
</div> -->
</div>


<script src="/tutorialTube/public/js/bootstrap.bundle.js"></script>
</body>
</html>