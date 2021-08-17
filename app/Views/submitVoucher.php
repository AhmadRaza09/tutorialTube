<?php $this->extend('layouts/static') ?>

<?php $this->section('content') ?>

      <!-- content -->
      <br><br>
      <div class="container-fluid mt-md-5 mt-4  g-0">

        <div class="row m-0 bg-white rounded shadow-lg g-0">
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
         <div class="mt-lg-3 mt-sm-2 mt-1 table-responsive d-sm-flex mb-lg-4 mb-2">
         
           <table class="table table-light  table-striped table-hover align-middle text-center ms-sm-4 me-sm-4 caption-top">
             <caption><h1 class="text-dark ms-sm-0 ms-2">Submit Voucher</h1></caption>
             <thead>
               <tr class="align-middle">
                 <th scope="col" class="pt-3 pb-3">#</th>
                 <th scope="col" class="pt-3 pb-3">Voucher Id</th>
                 <th scope="col" class="pt-3 pb-3">Email</th>
                 <th scope="col" class="pt-3 pb-3">Series Name</th>
                 <th scope="col" class="pt-3 pb-3">Series Type</th>
                 <th scope="col" class="pt-3 pb-3">Series Price</th>
                 <th scope="col" class="pt-3 pb-3">Created Date</th>
                 <th scope="col" class="pt-3 pb-3">Due Date</th>
                 <th scope="col" class="pt-3 pb-3">Submit Voucher</th>
               </tr>
             </thead>
             <tbody>
             <?php 
                if(isset($voucherDetail[0]))
                {
                  $i = 1;
                  foreach($voucherDetail as $voucher)
                  {
                    switch($voucher['status'])
                    {
                      case 0:
                        $lable = "submit";
                        break;
                      case 1:
                        $lable = "wait for approve";
                        break;
                      case 2:
                        $lable = "Paid";
                        break;
                      case 3:
                        $lable = "Re-submit";
                        break; 
                    }

                    $voucher['seriesType'] = $voucher['seriesType'] == 1 ? "Comuter Science" : "Information Technology";
                      $btn = "";
                    if($voucher['status'] == 0 || $voucher['status'] == 3)
                    {
                      $btn = "<form id='voucherUpload' action='' method='post' enctype='multipart/form-data'>
                      <label for='file$i'><i class='fas fa-file-upload fs-3 me-1 mb-md-0 mb-1 align-middle text-info'></i></label>
                      <input id='voucherUploadId$i' type='hidden' value='{$voucher['voucherId']}' name='voucherId'>
                      <input type='file' class='d-none' id='file$i' name='file' required>
                      <input id='submitVoucher$i' value='$lable' name='submit$i' type='submit' class='btn  btn-primary ps-3 pe-3 rounded-pill me-lg-2 me-md-1  mb-sm-0'>
                      </form>";
                    }
                    else
                    {
                       $btn = "<span  class='text-primary border border-primary pt-1 pb-1 ps-3 pe-3 rounded-pill me-lg-2 me-md-1  mb-sm-0'>$lable</span>"; 
                    }
                    $voucherId = substr(str_repeat(0, 8).$voucher['voucherId'], - 8);
                    echo "<tr>
                    <th scope='row'>$i</th>
                 <td>$voucherId</td>
                 <td>{$voucher['email']}</td>
                 <td>{$voucher['seriesName']}</td>
                 <td>{$voucher['seriesType']}</td>
                 <td>{$voucher['seriesPrice']}</td>
                 <td>{$voucher['createdDate']}</td>
                 <td>{$voucher['dueDate']}</td>
                 <td>$btn</td>
                  </tr>";
                  $i = $i + 1;
                  }
                  echo "</tbody>
                  </table>
        
                </div>";
                }
                else
                {
                  echo "</tbody>
                  </table>
        
                </div>";
                  echo "<div class='col-12 text-center col-12 fs-2'>
                <div class='alert ms-2 me-2 alert-primary' role='alert'>
                No Voucher is there to Sumbit
                </div>
                </div>";
                }
             
             ?>
                        
            
                   
            
<?php $this->endSection() ?>
