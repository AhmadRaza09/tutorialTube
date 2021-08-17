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
         
            <form id="seriesSearch" action="" method="post" >
            <div class="row ">
            <!-- errors -->
              <div id="errors"></div>
              <div class="col-12 mb-md-1">
                <h1>Search Series</h1>
              </div>
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="text" id="seriesName" name="seriesName" class="form-control"  placeholder="Series Name here"  pattern="[A-Za-z| ]{15,50}" title="Series name only contains alphabets with minlength 15 or maxlength 50 characters" >
                  <label for="seriesName">Series Name</label>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="email" name="email" class="form-control" id="email" placeholder="Email Address here">
                  <label for="email">Uploaded By</label>
                </div>
              </div>

              <div class="col-md-6">
              <div class="form-floating  mb-3">
                  <select class="form-select pb-2" name="seriesType" id="seriesType" aria-label="Series Type here" >
                    <option selected value="">Open this select series type</option>
                    <option value="1">Computer Science</option>
                    <option value="2">Information Technology</option>
                  </select>
                  <label for="seriesType">Series Type</label>
                </div>
              </div>

              <div class="col-md-6">
              <div class="form-floating  mb-3">
                  <select class="form-select pb-2" name="seriesCategory" id="seriesCategory" aria-label="Series Category here">
                    <option selected value="">Open this select series Category</option>
                    <option value="1">Free</option>
                    <option value="2">Paid</option>
                  </select>
                  <label for="seriesCategory">Series Category</label>
                </div>
              </div>

              

              <div class="col-12 ">
                <div class="col-md-3 me-md-3 float-md-end mt-md-1 text-center">
                  <button type="submit"  class="btn btn-primary mb-md-3 col-sm-6 col-12 col-md-12 fs-5 p-2">Search</button>
                </div>
              </div>

            </div>
            </form>
          </div>

        </div>
        <!-- end searcbar -->

        
        <div class="row m-0 bg-white rounded shadow-lg g-0">
        <div id="table"></div>
        
         
          
          <!-- end content -->
            <script>
            loadTableSeries()
            </script>
<?php $this->endSection() ?>
