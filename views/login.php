<div class="main-content">
      <form class="form-group" method="post" action="/">
          <div class="form-row align-items-center justify-content-center">
              <div class="col-auto">
              <h2 class="text-center text-primary">Log In</h2><br>
                  <input type="text" name="email" class="form-control" placeholder="Email">
                  <span class="error"><?php echo empty($this->errors['emailError'])?"":"*".$this->errors['emailError'];?></span>
                  <br><br>
                  <input type="password" name="password" class="form-control" placeholder="Password">
                  <span class="error"><?php echo empty($this->errors['passwordError'])?"":"*".$this->errors['passwordError'];?></span>
                  <br><br>

                  <input type="submit" name="submit" value="Log In" class="btn btn-primary">
              </div>
          </div>
      </form>
</div>