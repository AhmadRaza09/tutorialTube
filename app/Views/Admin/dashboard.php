<?php $this->extend('/layouts/AdminNav') ?>
<?php $this->section('content') ?>


      <!-- content -->
      
      <br><br>
      <div class="container-fluid mt-md-5 mt-4  g-0">
        <div class="row m-0 bg-white rounded shadow-lg g-0">
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
          <div class="bg-light p-2 mb-3  mt-lg-2 mt-md-3 mt-4">
            <div class="col-md-4   display-5  " > <span><img src="/tutorialTube/public/img/business-report__1_-removebg-preview.png" alt="" class="mb-1 col-md-1 img-fluid"></span>
              Dashboard
            </div>
          </div>

          <div class="row justify-content-evenly mb-lg-5 mb-2  m-auto">

            <div class="col-xl-3 col-sm-6">
              <table class="table table-borderless bg-light rounded">
                <thead>
                  <tr class="align-middle">
                    <th scope="col"  class="m-0 p-0 pt-3 pb-3 text-end  g-0"> <a href="/tutorialTube/public/Admin/AdminClass/pendingUserRequest"><img src="/tutorialTube/public/img/4230e8ee-f4bf-4ff0-8494-db938f91554d.png"  alt="" class="" style="width:150px"></a></th>
                    <th scope="col" class="text-start "><div><?php echo $users; ?></div>
                    <div>User Request</div>
                    </th>
                    
                  </tr>
                </thead>
                
              </table>
            </div>
            <div class="col-xl-3 col-sm-6">
              <table class="table table-borderless bg-light rounded">
                <thead>
                  <tr class="align-middle">
                    <th scope="col"  class="m-0 p-0 pt-3 pb-3 text-end  g-0"><a href="/tutorialTube/public/Admin/AdminClass/pendingSeriesRequest"><img src="/tutorialTube/public/img/series.png"  alt="" class="" style="width:150px"></a></th>
                    <th scope="col" class="text-start "><div><?php echo $series; ?></div>
                    <div>Series Request</div>
                    </th>
                    
                  </tr>
                </thead>
                
              </table>
            </div>
            <div class="col-xl-3 col-sm-6 mb-lg-5">
              <table class="table table-borderless bg-light rounded" >
                <thead>
                  <tr class="align-middle">
                    <th scope="col"  class="m-0 p-0 pt-3 pb-3 text-end  g-0"><a href="/tutorialTube/public/Admin/AdminClass/generatedVoucherRequest"><img src="/tutorialTube/public/img/bill.png"  alt="" class="" style="width:150px"></a></th>
                    <th scope="col" class="text-start "><div><?php echo $vouchers?></div>
                    <div>Voucher Request</div>
                    </th>
                    
                  </tr>
                </thead>
                
              </table>
            </div>

          </div>

          
          </div>

<?php $this->endSection() ?>