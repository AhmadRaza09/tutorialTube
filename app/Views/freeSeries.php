<?php 
$session = \Config\Services::session();
if(isset($_SESSION['login']))
{
  $role = $_SESSION['login']['role']; 
if($role == 3)
{
  $this->extend('layouts/AdminNav');
}
else
{
  $this->extend('layouts/static');
}
}
else
{
  $this->extend('layouts/static');
}
?>

<?php $this->section('content') ?>

          <!-- content -->
          <br><br>
      <div class="container-fluid mt-4 g-0">
        <div class="row m-0 mb-4">

       <div id="errors"></div>
      
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

        <div id="series" class="row me-xxl-5 ms-xxl-0 me-xl-5 ms-xl-0 ms-lg-5 justify-content-evenly align-items-stretch m-0 ">

         

      </div>

    <script>
    loadSeries();
    </script>

<?php $this->endSection() ?>