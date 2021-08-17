
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
            <h1 id="price" class="d-none"><?php if(isset($_POST['seriesPrice'])){echo set_value('seriesPrice');}?></h1>
      <form action="/tutorialTube/public/Series/index" method="post" enctype="multipart/form-data">
                <fieldset class="row gx-3">
                  <legend class="mb-md-3 mb-1 mS">Create Series on Tutorial Tube
                    <div class="col-12">
                      <hr class="w-100">
                    </div>
                  </legend>
              <div class="col-12">
                
                <div class="form-floating mb-3">
                  <input type="text" name="seriesName" value="<?php if(isset($_POST['seriesName'])){echo set_value('seriesName');}?>" class="form-control" id="seriesName" placeholder="Series Name here" required pattern="[A-Za-z| ]{15,50}" title="Series name only contains alphabets with minlength 15 or maxlength 50 characters">
                  <label for="seriesName">Series Name</label>
                </div>

              </div>

              <div class="col-12">
                <div class="form-floating  mb-3">
                  <select class="form-select pb-2" name="seriesType" id="seriesType" aria-label="Series Type here" required >
                    <option selected value="">Open this select series type</option>
                    <option value="1" <?php if(isset($_POST['seriesType'])){echo set_select('seriesType', '1');} ?>>Computer Science</option>
                    <option value="2" <?php if(isset($_POST['seriesType'])){echo set_select('seriesType', '2');} ?>>Information Technology</option>
                  </select>
                  <label for="seriesType">Series Type</label>
                </div>

              </div>

              <div class="col-12">
                <div class="form-floating  mb-3">
                  <select class="form-select pb-2" name="seriesCategory" id="seriesCategory" aria-label="Series Category here" required>
                    <option selected value="">Open this select series category</option>
                    <option value="1" <?php if(isset($_POST['seriesCategory'])){echo set_select('seriesCategory', '1');} ?>>Free Category</option>
                    <option value="2" <?php if(isset($_POST['seriesCategory'])){echo set_select('seriesCategory', '2');} ?>>Paid Category</option>
                    </select>
                  <label for="seriesCategory">Series Category</label>
                </div>

              </div>

              <div id="amountField" class="mb-0 mt-0 pb-0 pt-0"></div>
              

          

              <div class="col-12">
                <div class="form-floating  mb-2">
                  <textarea class="form-control" name="seriesDescription" placeholder="Series Description here" id="floatingTextarea" style="height: 120px" minlength="250" maxlength="2000"><?php if(isset($_POST['seriesDescription'])){echo set_value('seriesDescription');}?></textarea>
                  <label for="floatingTextarea" class="">Series Description</label>
                </div>
  
              </div>

              <div class="col-12">
                <div class="mb-3">
                <label for="serieImage" class="form-label">Series Image</label>
                <input class="form-control form-control-lg" type="file" name="seriesImage" id="serieImage">
                </div>
  
              </div>

                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-primary p-2 mb-3 col-sm-9 col-11">Add Series</button>
                </div>
              </fieldset>
            </form>
              
            
          </div>
             
            
<?php $this->endSection() ?>
