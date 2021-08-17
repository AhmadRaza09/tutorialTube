<?php $this->extend('layouts/static') ?>

<?php $this->section('content') ?>

      <!-- content -->
      <br><br>
      <div class="container-fluid mt-xl-0 mt-5">
        <div class="row size justify-content-center">
          <div class="col-sm-9 align-self-xl-center">

          <div id="passwordMismatch"></div>
            <?php 
     
            if(isset($validation))
            {
              // echo "Ahmad"
             
              echo  "<div class='mt-xl-5 mt-sm-2 mt-0 mb-sm-2 mb-3 alert alert-danger alert-dismissible fade show text-muted' role='alert'>";
              echo $validation->listErrors();
              echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
              echo "</div>";
                
            }
            ?>
      
              <form id="signUp" action="/tutorialTube/public/User/signUp" method="post" >
                <fieldset class="row gx-3">
                  <legend class="mb-md-3 mb-1 mS">Create Your Account on Tutorial Tube
                    <div class="col-12">
                      <hr class="w-100">
                    </div>
                  </legend>
              <div class="col-md-6">
                
                <div class="form-floating mb-3">
                  <input type="text" name="firstName" value="<?php if(isset($_POST['firstName'])){echo set_value('firstName');}?>" class="form-control" id="FirstName" placeholder="First Name here" required pattern=[A-Za-z]{4,32} title="First name only contains alphabets with minlength 4 or maxlength 32 characters">
                  <label for="FirstName">First Name</label>
                  
                </div>

              </div>

              <div class="col-md-6 mb-md-0 mb-3">
                <div class="form-floating">
                  <input type="text" name="lastName" value="<?php if(isset($_POST['lastName'])){echo set_value('lastName');}?>" class="form-control" id="LastName" placeholder="Last Name here" required pattern=[A-Za-z]{4,32} title="Last name only contains alphabets with minlength 4 or maxlength 32 characters">
                  <label for="LastName">Last Name</label>
                </div>

              </div>

              <div class="col-md-6">
                
                <div class="form-floating mb-3">
                  <input type="email" name="email" value="<?php if(isset($_POST['email'])){echo set_value('email');}?>" class="form-control" id="Email" placeholder="Email here" required>
                  <label for="Email">Email Address</label>
                </div>

              </div>

              <div class="col-md-6">
                <div class="form-floating mb-md-0 mb-3">
                  <select name="role" class="form-select" id="Role" aria-label="Role here" required>
                    <option value="" selected>Open this to select role</option>
                    <option value="1" <?php if(isset($_POST['role'])){echo set_select('role', '1');} ?>>Student</option>
                    <option value="2" <?php if(isset($_POST['role'])){echo set_select('role', '2');} ?>>Trainer</option>
                  </select>
                  <label for="Role">Role</label>
                </div>

              </div>

              <div class="col-md-6">
                
                <div class="form-floating  mb-3">
                  <input type="password" name="password" class="form-control" id="Password" placeholder="Password here" required minlength="8" maxlength="32">
                  <label for="Password">Password</label>
                </div>

              </div>

              <div class="col-md-6">
                <div class="form-floating mb-md-0 mb-3">
                  <input type="password" name="confirmPassword" class="form-control" id="ConfirmPassword" placeholder="Confirm Password here" required minlength="8" maxlength="32">
                  <label for="ConfirmPassword">Confirm Password</label>
                </div>

              </div>

              
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-primary p-2 mb-3 col-6">Sign Up</button>
                </div>
              </fieldset>
            </form>
              
            <div class="col-12 text-center">
              Already have an account? <a href="/tutorialTube/public/User/login" role="button" class="text-decoration-none text-primary fw-bold">Log In</a>
            </div>
            
          </div>

            
<?php $this->endSection() ?>