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

<br><br>
      <div class="container-fluid g-0">
        <div class="row m-0 mb-4 mt-5 gx-sm-2">
        
        <div class="col-12 text-end mb-2">
        <?php
         $session = \Config\Services::session();
        //  echo $series['seriesId'];die;
          if(isset($_SESSION['login']) && ($series['seriesUploadedBy'] == $_SESSION['login']['id']))
          {
            echo "<div class='me-3'>"; 
            echo "<a href ='/tutorialTube/public/series/uploadTutorial/{$series['seriesId']}' type='button' class='btn btn-danger   fs-md-5'>Upload Tutorial</a>";
            echo "</div>";
          }
        ?>
        </div>
          <div class="col-12">
            <div class="bg-light pt-2 border rounded ms-md-2 me-md-2 shadow-sm">
              <p class="mb-0 ps-4 mt-4 fs-4">Series Name:</p>
            <p class="ps-5 ms-5 me-4 mb-2"><?php echo $series['seriesName']?></p>
            <p class="mb-0 ps-4 fs-4">Series Type:</p>
            <p class="ps-5 ms-5 mb-2 me-4"><?php 
              if($series['seriesType'] == 1)
              {
                echo "Computer Science";
              }
              else
              {
                echo "Information Technology";
              }
            ?></p>
            <p class="mb-0 ps-4 fs-4">Series Description:</p>
            <p class="ps-5 ms-5 mb-2 me-4"><?php echo $series['seriesDescription']?></p>
            <?php if(isset($series['seriesPrice']))
            {
              echo "<p class='mb-0 ps-4 ms-2 fs-4'>Price:</p>
              <p class='ps-5 ms-5 me-4'>{$series['seriesPrice']}</p>";
            }
            ?>
            <div class="text-end mt-2 mb-3 me-4">
              
              <?php 
                  if(isset($_SESSION['login']))
                  {
                    if((isset($series['seriesPrice']) && ($series['seriesUploadedBy'] != $_SESSION['login']['id'])) && $voucherApproved != true )
                    {
                      echo "<button type='button' id='voucher' data-seriesId='{$series['seriesId']}' class='btn btn-danger col-lg-3  col-sm-4 col-8 fs-md-5'>";
                      echo "Generate Voucher";
                    }
                    else
                    {
                      echo "<a href ='/tutorialTube/public/series/course/{$series['seriesId']}' type='button' class='btn btn-primary col-lg-3  col-sm-4 col-8 fs-md-5'>";
                      echo "Start Learning!";
                    } 
                  }
                  else
                  {
                    if(!isset($series['seriesPrice']))
                    {
                      echo "<a href ='/tutorialTube/public/series/course/{$series['seriesId']}' type='button' class='btn btn-primary col-lg-3  col-sm-4 col-8 fs-md-5'>";
                      echo "Start Learning!";
                    }
                    else
                    { 
                      echo "<a href ='/tutorialTube/public/user/signUp' type='button' class='btn btn-primary col-lg-4  col-sm-5 col-9 fs-md-5'>";
                      echo "To start learning paid series first you need to signUp!";
                    }
                  }
              ?>
              </a>
            </div>
            </div>
            
          </div>

        
       
<?php $this->endSection() ?>