<div class="main-content">
      <form class="form-group" method="post" action="register">
          <div class="form-row align-items-center justify-content-center">
              <div class="col-auto">
              <h2 class="text-center text-primary">Register</h2><br>
                  <input type="text" name="fname" class="form-control" placeholder="First name">
                  <span class="error"><?php echo empty($_SESSION['fnameErr'])?"":"*".$_SESSION['fnameErr'];?></span>
                  <br><br>
                  <input type="text" name="lname" class="form-control" placeholder="Last name">
                  <span class="error"><?php echo empty($_SESSION['lnameErr'])?"":"*".$_SESSION['lnameErr'];?></span>
                  <br><br>
                  <select class="custom-select my-1 mr-sm-2" name="gender">
                      <option value="" selected>Gender</option>
                      <option value="0">Female</option>
                      <option value="1">Male</option>
                      <option value="2">Other</option>
                  </select>
                  <span class="error"><?php echo empty($_SESSION['genderErr'])?"":"*".$_SESSION['genderErr'];?></span>
                  <br><br>
                  <input type="text" name="email" class="form-control" placeholder="Email">
                  <span class="error"><?php echo empty($_SESSION['emailErr'])?"":"*".$_SESSION['emailErr'];?></span>
                  <br><br>
                  <input type="password" name="password" class="form-control" placeholder="Password">
                  <span class="error"><?php echo empty($_SESSION['passwordErr'])?"":"*".$_SESSION['passwordErr'];?></span>
                  <br><br>
                  <input type="password" name="passwordConfirm" class="form-control" placeholder="Password Confirmation">
                  <span class="error"><?php echo empty($_SESSION['passwordConfirmErr'])?"":"*".$_SESSION['passwordConfirmErr'];?></span>
                  <br><br>

                  <button type="submit" name="submit" value="Submit" class="btn btn-primary">Register</button>
              </div>
          </div>
      </form>
  </div>