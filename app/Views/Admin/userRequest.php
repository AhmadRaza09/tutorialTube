<?php $this->extend('/layouts/AdminNav') ?>
<?php $this->section('content') ?>

<div class='d-none' id='pageLink'><?php echo $pageLink ?></div>
   <!-- content -->
   <br><br>
      <div class="container-fluid mt-md-5 mt-4  g-0">

           <div id="message"></div>
          
          
        <!-- start searchbar -->
        <div class="row m-0 mb-3 bg-white rounded shadow-sm g-0 justify-content-evenly">

          <div class="col-sm-10 col-11 border border-dark rounded p-3 mt-3 mb-md-4 mb-3 bg-light">
         
            <form id="search" action="" method="post" >
            <div class="row ">
            <!-- errors -->
              <div id="errors"></div>
              <div class="col-12 mb-md-1">
                <h1>Search User</h1>
              </div>
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First Name here" pattern=[A-Za-z]{4,32} title="Last name only contains alphabets with minlength 4 or maxlength 32 characters" >
                  <label for="firstName">First Name</label>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name here" pattern=[A-Za-z]{4,32} title="Last name only contains alphabets with minlength 4 or maxlength 32 characters">
                  <label for="lastName">Last Name</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="email" name="email" class="form-control" id="email" placeholder="Email Address here">
                  <label for="email">Email Address</label>
                </div>
              </div>

              <div class="col-md-3 mt-md-1 text-center">
                <button type="submit"  class="btn btn-primary mb-md-3 col-sm-6 col-12 col-md-12 fs-5 p-2">Search</button>
              </div>
            </div>
            </form>
          </div>

        </div>
        <!-- end searcbar -->

        <div class="row m-0 bg-white rounded shadow-lg g-0 ">
         <div id="table"></div>
         
          
          <!-- end content -->
            <script>
            loadTable()
            </script>
<?php $this->endSection() ?>
