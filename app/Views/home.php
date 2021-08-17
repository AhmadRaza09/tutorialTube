<?php $this->extend('layouts/static') ?>

<?php $this->section('content') ?>

          <!-- content -->
          <br><br>
      <div class="container-fluid mt-4 g-0">
        <div class="row m-0 mb-4">

        <!-- mail confirm wait for admin approval -->
        <?php 
          	
          if(isset($confirm))
          {
            
            echo  "<div class='mt-xl-3 mt-md-2 mt-sm-4 mt-3 mb-sm-2 mb-1 alert alert-success alert-dismissible fade show text-muted' role='alert'>";
           echo $confirm;
            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
          }
        ?> 

        <!-- signup complete wait confrim your mail -->
      <?php 
          $session = \Config\Services::session();
          if($session->getFlashdata('confirmMail'))
          {
            
            echo  "<div class='mt-xl-3 mt-md-2 mt-sm-4 mt-3 mb-sm-2 mb-1 alert alert-success alert-dismissible fade show text-muted' role='alert'>";
           echo $session->getFlashdata('confirmMail');
            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
          }
        ?> 

          <div class="col-12 mt-1">

            <div id="carouselExampleDark" class="carousel carousel-dark slide  bg-danger" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
              </div>
              <div class="carousel-inner " >
                <div class="carousel-item active carouselSize position-relative  " data-bs-interval="10000">
                  <img src="/tutorialTube/public/img/home.jpg" class="d-block w-100" alt="...">
                  <div class="carousel-caption position-absolute top-50 p-0">
                    <h5 class="text-uppercase text-center fs-sm-3"><?php echo $quotation['lable1']?></h5>
                 
                  </div>
                </div>
                <div class="carousel-item carouselSize position-relative "  >
                  <img src="/tutorialTube/public/img/home4.jpg" class="d-block w-100" alt="...">
                  <div class="carousel-caption  position-absolute top-50  p-0 " >
                      
                      <h5 class="text-uppercase text-center fs-sm-3"><?php echo $quotation['lable2']?></h5>
                      
                      
                  </div>
                </div>
                <div class="carousel-item carouselSize position-relative" >
                  <img src="/tutorialTube/public/img/home5.jpg" class="d-block w-100" alt="...">
                  <div class="carousel-caption  position-absolute top-50 p-0">
                    <h5 class="text-uppercase text-center fs-sm-3"><?php echo $quotation['lable3']?></h5>
                    
                  </div>
                </div>
              

              <div class="carousel-item carouselSize position-relative">
                <img src="/tutorialTube/public/img/home2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption  position-absolute top-50 p-0">
                  <h5 class="text-uppercase text-center fs-sm-3"><?php echo $quotation['lable4']?></h5>
                  
                </div>
              </div>
            </div>

              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"  data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"  data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>


          </div>
        </div>

        <div class="row me-xxl-5 ms-xxl-0 me-xl-5 ms-xl-0 ms-lg-5 justify-content-evenly align-items-stretch m-0 ">

        <!-- if start -->
     <?php if(isset($series[0])):
     
    //  foreach start
      $displayBlockSmall = "d-sm-block d-none mt-lg-0 mt-sm-3";
      $displayBlockLarge  = "d-lg-block d-none mt-3";
      $displayBlockXlarge = "d-xl-block d-none mt-3";
      $blockFlag = 1;
        foreach($series as $course):
          // echo "<pre>";
          // print_r($course);
          // echo "</pre>";
          // echo "<br>";
          
          switch($blockFlag)
          {
            case 1:
              echo "<div class='col-xl-2 col-lg-4 col-sm-6 me-xxl-4 me-xl-5 '>";
              break;

            case 2:
              echo "<div class='col-xl-2 col-lg-4 col-sm-6 me-xxl-4 me-xl-5 mt-sm-0 mt-3'>";
              break;

            case 3:
            case 4:
              echo "<div class='col-xl-2 col-lg-4 col-sm-6 me-xxl-4 me-xl-5  . $displayBlockSmall'>";
              break;

            case 5:
            case 6:
              echo "<div class='col-xl-2 col-lg-4 col-sm-6 me-xxl-4 me-xl-5  . $displayBlockLarge'>";
              break;

            case 7:
            case 8:
              echo "<div class='col-xl-2 col-lg-4 col-sm-6 me-xxl-4 me-xl-5  . $displayBlockXlarge'>";
              break;

              default:
                echo "";
          }
      ?>
       
      <div class="card " style="width: 18rem;">
              <img src="<?php echo '/tutorialTube/public/uploads/images/' . $course['seriesImage'];?>"  class="card-img-top cardImageHeight" alt="course-logo">
              <div class="card-body">
                <h5 class="card-title cardTitle" ><?php echo $course['seriesName']?></h5>
                <p class="card-text  cardDescription" ><?php echo $course['seriesDescription']?></p>
                <div class="text-end"><a href="<?php echo '/tutorialTube/public/Series/seriesDetail/' . $course['seriesId'];?>" class="btn btn-primary">Read more</a></div>
              </div>
            </div>
          </div>
        <!-- foreach end -->
      <?php
      $blockFlag = $blockFlag + 1;
    endforeach;?>

      <!-- else start -->
     <?php else: ?>
      <div class="col-md-10 text-center col-12 fs-2">
      <div class="alert alert-primary " role="alert">
      Series will be uploaded soon......
      </div>
      </div>

      <!-- if end -->
     <?php endif?>     

      </div>


<?php $this->endSection() ?>