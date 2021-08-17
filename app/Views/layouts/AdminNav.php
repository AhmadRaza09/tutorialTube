<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/tutorialTube/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/tutorialTube/public/css/style.css">
    <link rel="stylesheet" href="/tutorialTube/public/css/jquery.fancybox.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src=<?php echo "/tutorialTube/public/js/jquery.js?" . Rand();?>></script>
    <script src="/tutorialTube/public/js/jquery.fancybox.min.js"></script>

    <title><?php echo $title?></title>
    <?php
      $uri = service('uri');
      $currentUrl = current_url(true);
      if(strpos($currentUrl, 'Admin'))
      {
        $segment = $uri->getSegment(3);
        $segment1 = 'random';
      }
      else
      {
        $segment = 'random';
        $segment1 = $uri->getSegment(2);
      }
      // echo $segment1; echo $segment;die;
      
    ?>
</head>
<body>
  <!-- navbar start -->
  
    <nav class="navbar navbar-expand-lg navbar-light fixed-top mb-5  bg-light">
        <div class="container-fluid">
          <a class="navbar-brand col-md-1 col-sm-2 col-3 " href="/tutorialTube/public/Admin/AdminClass"><img src="/tutorialTube/public/img/cover.png" alt="logo" class="img-fluid img-thumbnail"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- <form class="d-sm-flex me-lg-5 col-xl-6 col-lg-4 w">
              
              <select class="form-select form-select-sm me-2 mt-sm-0 mt-2 wF  " aria-label=".form-select-sm example">
              <option selected>Filter</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
              </select>
              <div class="input-group me-2 mt-lg-0 mt-sm-0 mt-2 wS">
                <input type="text" class="form-control form-control-sm" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </div>
            
            
          </form> -->
            <ul class="navbar-nav  me-auto mb-2 mb-lg-0 text-center ">
              <li class="nav-item">
                <a class="nav-link <?php echo $active = $segment == '' ? 'active' : ''?>"  aria-current="page" href="/tutorialTube/public/Admin/AdminClass">Dashboard</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php if($segment == "acceptedSeries" || $segment == "pendingSeriesRequest" || $segment == "rejectedSeriesRequest"){echo 'active';}?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Series Request
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item <?php echo $active = $segment == 'acceptedSeries' ? 'active' : ''?>" href="/tutorialTube/public/Admin/AdminClass/acceptedSeries">Accepted Series</a></li>
                  <li><a class="dropdown-item <?php echo $active = $segment == 'pendingSeriesRequest' ? 'active' : ''?>" href="/tutorialTube/public/Admin/AdminClass/pendingSeriesRequest">Pending Series Request</a></li>
                  <li><a class="dropdown-item <?php echo $active = $segment == 'rejectedSeriesRequest' ? 'active' : ''?>" href="/tutorialTube/public/Admin/AdminClass/rejectedSeriesRequest">Rejected Series Request</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php if($segment == "generatedVoucherRequest" || $segment == "submitedVoucherRequest"){echo 'active';}?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Vouchers Request
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item <?php echo $active = $segment == 'generatedVoucherRequest' ? 'active' : ''?>" href="/tutorialTube/public/Admin/AdminClass/generatedVoucherRequest">Generated Voucher Request</a></li>
                  <li><a class="dropdown-item <?php echo $active = $segment == 'submitedVoucherRequest' ? 'active' : ''?>" href="/tutorialTube/public/Admin/AdminClass/submitedVoucherRequest">Submited Voucher Request</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php if($segment == "acceptedUser" || $segment == "pendingUserRequest" || $segment == "rejectedUserRequest
                "){echo 'active';}?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Users Request
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item <?php echo $active = $segment == 'acceptedUser' ? 'active' : ''?>" href="/tutorialTube/public/Admin/AdminClass/acceptedUser">Accepted User</a></li>
                  <li><a class="dropdown-item <?php echo $active = $segment == 'pendingUserRequest' ? 'active' : ''?>" href="/tutorialTube/public/Admin/AdminClass/pendingUserRequest">Pending User Request</a></li>
                  <li><a class="dropdown-item <?php echo $active = $segment == 'rejectedUserRequest' ? 'active' : ''?>" href="/tutorialTube/public/Admin/AdminClass/rejectedUserRequest">Rejected User Request</a></li>
                </ul>

              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo $active = $segment1 == '' ? 'active' : ''?>" aria-current="page" href="/tutorialTube/public/series">Create Series</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo $active = $segment1 == 'uploadByMe' ? 'active' : ''?>" aria-current="page" href="/tutorialTube/public/series/uploadByMe">Uploaded By ME</a>
              </li>
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
            
            <ul class="navbar-nav me-lg-5 mb-2 mb-lg-0 text-center float-lg-end float-none">
              <li class="nav-item w-75 m-auto d-lg-none d-block"><hr></li>
              <li class="nav-item">
                  
              <?php
              $session = \Config\Services::session();
                  if(isset($session->get('login')['name']) && ($session->get('login')['name'] != ""))
                  {
                    echo "<div class='nav-link' aria-current='page'>";
                    echo $session->get('login')['name'];
                    echo "</div>";
                  }
                 
                ?>
              </li>
              <li class="nav-item">
              <?php
                  if(isset($session->get('login')['name']) && ($session->get('login')['name'] != ""))
                  {
                    echo "<a class='nav-link' aria-current='page' href='/tutorialTube/public/User/logout'>Logout</a>";
                  }
                 
                ?>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- navbar end -->

      <!-- renderSection start here -->
      <?php $this->renderSection('content') ?>
      <!-- endSection start here -->

      
          <!-- end content -->
          </div>

</div>


<script src="https://kit.fontawesome.com/6291c4e0b1.js" crossorigin="anonymous"></script>
<script src="/tutorialTube/public/js/bootstrap.bundle.js"></script>
</body>
</html>