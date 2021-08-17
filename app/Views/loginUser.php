<?php $this->extend('layouts/static') ?>

<?php $this->section('content') ?>

      <!-- content -->
      <br><br>
      <div class="container-fluid mt-xl-0 mt-5">
        <div class="row size justify-content-center">
          <div class="col-xl-4 col-md-6 col-sm-8 align-self-xl-center">
            
            <?php 
     
                if(isset($incorrect))
                {
                // echo "Ahmad"

                echo  "<div class=' alert alert-danger alert-dismissible fade show text-muted' role='alert'>";
                echo $incorrect;
                echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
                  
                }
            if(isset($validation))
            {
              // echo "Ahmad"
             
              echo  "<div class=' alert alert-danger alert-dismissible fade show text-muted' role='alert'>";
              echo $validation->listErrors();
              echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
              echo "</div>";
                
            }
            ?>
      <form action="/tutorialTube/public/User/login" method="post">
                <fieldset class="row gx-3">
                  <legend class="mb-md-3 mb-1 mS fS">Login to Your Tutorial Tube Account
                    <div class="col-12">
                      <hr class="w-100">
                    </div>
                  </legend>
              <div class="col-12">
                
                <div class="form-floating mb-3">
                  <input type="email" name="email" value="<?php if(isset($_POST['email'])){echo set_value('email');} ?>" class="form-control" id="floatingInput" placeholder="Email here" required>
                  <label for="floatingInput">Email Address</label>
                </div>

              </div>

              <div class="col-12 mb-3">
              <div class="form-floating">
                  <input type="password" name="password" class="form-control" id="Password" placeholder="Password here" required minlength="8" maxlength="32">
                  <label for="Password">Password</label>
                </div>

              </div>

            
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-primary p-2 mb-3 col-6">Login</button>
                </div>
              </fieldset>
            </form>
              
            <div class="col-12 text-center">
              Don't have an account? <a href="/tutorialTube/public/User/signUp" role="button" class="text-decoration-none text-primary fw-bold">Sign Up</a>
            </div>
            
          </div>
             
            
<?php $this->endSection() ?>