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
      <div class="container-fluid mt-xl-0 mt-5">
        <div class="row size justify-content-center">
          <div class="col-lg-5 col-md-6 col-sm-8 align-self-xl-center">
            <br><br>
            <?php 
     
            if(isset($validation))
            {
              // echo "Ahmad"
             
              echo  "<div class=' alert alert-danger alert-dismissible fade show text-muted' role='alert'>";
              echo $validation->listErrors();
              echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
              echo "</div>";
                
            }
            ?>

            <!-- variable for price set used in jquery -->
           
      <form action="/tutorialTube/public/Series/uploadTutorial/<?php echo $seriesId;?>" method="post" enctype="multipart/form-data">
                <fieldset class="row gx-3">
                  <legend class="mb-md-3 mb-1 mS">Upload Tutorial on Tutorial Tube
                    <div class="col-12">
                      <hr class="w-100">
                    </div>
                  </legend>
              <div class="col-12">
                
                <div class="form-floating mb-2">
                  <input type="text" name="tutorialTitle" value="<?php if(isset($_POST['tutorialTitle'])){echo set_value('tutorialTitle');}?>" class="form-control" id="tutorialTitle" placeholder="Tutorial Title here" required pattern="[A-Za-z| ]{15,50}" title="Tutorial Title only contains alphabets with minlength 15 or maxlength 50 characters">
                  <label for="tutorialTitle">Tutorial Title</label>
                </div>

              </div>

              
              <div class="col-12">
                <div class="mb-3">
                <label for="tutorialPath" class="form-label">Select Tutorial</label>
                <input class="form-control form-control-lg" type="file" name="tutorialPath" id="tutorialPath">
                </div>
  
              </div>

                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-primary p-2 mb-3 col-sm-9 col-11">Upload Tutorial</button>
                </div>
              </fieldset>
            </form>
              
            
          </div>
             
            
<?php $this->endSection() ?>
