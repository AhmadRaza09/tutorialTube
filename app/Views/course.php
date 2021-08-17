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
        <div class="row m-0 mb-4 mt-5 gx-sm-2">
        
        <?php 
          $session = \Config\Services::session();
          if($session->getFlashdata('message'))
          {
            
            echo  "<div class='mt-xl-3 mt-md-2 mt-sm-4 mt-3 mb-sm-2 mb-2 alert alert-success alert-dismissible fade show text-muted' role='alert'>";
           echo $session->getFlashdata('message');
            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
          }
        ?> 
          <?php if(isset($tutorials[0])): ?>
            <div class="row m-0 p-0 pe-1 ps-1">
            <div class="col-sm-4 order-1 ">
            <div class="ps-4 pb-2 pt-2 fs-5  mb-1 border rounded" style="background-color:#D4EDDA;"><?php echo $seriesName[0];?></div>
              <div class="list-group list-group-flush rounded" id="list-tab" role="tablist">
              
              <?php
              $active = true;
              $i = 1;
              foreach($tutorials as $tutorial)
              {
                if($active == true)
                {
                  echo "<a class='list-group-item list-group-item-action active' id='list-home-list' data-id='{$tutorial['tutorialId']}' data-src='{$tutorial['tutorialPath']}' data-bs-toggle='list' href='#list-home' role='tab' aria-controls='home'>{$i} {$tutorial['tutorialTitle']}</a>";
                  $active = false;
                }
                else
                {
                  echo "<a class='list-group-item list-group-item-action' id='list-home-list' data-id='{$tutorial['tutorialId']}' data-src='{$tutorial['tutorialPath']}' data-bs-toggle='list' href='#list-home' role='tab' aria-controls='home'>{$i} {$tutorial['tutorialTitle']}</a>";
                }
                $i = $i + 1;  
              }            
               ?>
              </div>
            </div>
            <?php $session = \Config\Services::session();
                    if(isset($_SESSION['login']))
                    {
                          $name =  $_SESSION['login']['name'];
                          $userId = $_SESSION['login']['id'];
                           $nameArray  = str_split($name, 1);
                           $firstLetter = $nameArray[0];
                    }
                    ?>

            <div class="col-sm-8 order-0`">
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                  <div class="row m-0 p-0 g-0" >
                    <video  id="video" data-tutorialId="" data-userId="<?php if(isset($userId)){echo $userId;}else{echo 0;}?>" src="" controls="controls" class="col-12 p-0 m-0 g-0" controlsList="nodownload" autoplay="autoplay" muted ></video>
                    <div class="row ms-2 mt-3">
                     <div class="w-100 clearfix">
                       <div class="col-2 float-start">
                      <span id="view"></span>
                       Views</div>
                       <div class="col-lg-2 col-md-3  col-4 float-end">
                         <span class="me-3"><button type="button" id="classLike" class="border-0 bg-white forFeedback"><i class="far fa-thumbs-up fs-3" ></i></button><span id="like"></span></span>
                         <span><button type="button" id="classDislike" class="border-0 bg-white forFeedback" ><i class="far fa-thumbs-down fs-3" ></i></button><span id="dislike"></span></span>
                       </div>
                     </div>
                    </div>

                    <hr class="mt-2">
                    
                     <form class="row m-0 p-0 g-0"  id="commentForm" action="" method="post">
                    <div class="col-1 circle text-end pe-md-2 pe-5 mt-2"><span class="badge rounded-circle fs-4 bg-primary"><?php if(isset($firstLetter)){echo $firstLetter;}else{echo "N";} ?></span></div>
                    <input type="hidden" id="userId" name="userId" value="<?php if(isset($userId)){echo $userId;}?>">
                    <div class="col-md-11 col-10" ><input  id="input" name="comment"  class="form-control form-control-lg rounded-0 border-top-0 border-end-0 border-start-0 border-dark" type="text" placeholder="Comment" aria-label=".form-control-lg example" ></div>
                    <div class="col-12 text-end mt-2">
                      <div class="col-auto me-sm-0 me-2 ">
                        <button type="submit" class="btn btn-primary mb-3">Comment</button>
                      </div>
                    
                    </div>
                    </form>
                    

                    <div class="col-12 ms-3 d-sm-block d-none" id="comment" style="height:400px; overflow-y:auto;">
<!-- 
                      <div class="col-11 bg-light mb-md-4 mb-sm-3 mb-2 ps-4 pt-2 pb-2" style=" border-radius: 5px 25px;">
                        <p class="mb-0 ">Name</p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum aut fugit laborum!</div>

                        <div class="col-11 bg-light mb-md-4 mb-sm-3 mb-2 ps-4 pt-2 pb-2" style=" border-radius: 5px 25px;">
                          <p class="mb-0 ">Name</p>
                          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum aut fugit laborum!</div> -->

                    </div>
                  </div>

                </div>
               
              </div>
            </div>
          </div>
          <?php else: ?>
            <div class="col-12" >
              <div class="ps-4 pb-2 pt-2 fs-5  mb-5 text-center border rounded" style="background-color:#D4EDDA;"><?php echo $seriesName[0];?></div>
            </div>
            <div class="col-12 text-center col-12 fs-2">
            <div class="alert alert-primary " role="alert">
            Lectures will be uploaded soon......
            </div>
            </div>
          <?php endif?> 
          
<!-- end content -->

        </div>

      </div>

</div>

       
<?php $this->endSection() ?>