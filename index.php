<!DOCTYPE html>
<html lang="en">
<?php 
  include("includes/header.php");
  include("includes/script.php");
?>
<body>
  <?php 
      error_reporting(0);
      session_start();
       $redirect = $_SESSION['redirect'];
        if(!empty($_SESSION['username'])){
        header("Location:  $redirect");
       }
      //NOTIFICATION FOR NEW ACCT
      if(!empty($_SESSION['username_inused'])){
        echo'<script> swal("Username already existed", "Us other username", "info");</script>';   
        unset($_SESSION['username_inused']);
      }else if(!empty($_SESSION['email_inused'])){
        echo'<script> swal("Email already existed", "Use other email address", "info");</script>';   
        unset($_SESSION['email_inused']);
      }
      else if(!empty($_SESSION['insert_success'])){
        echo'<script> swal("New Acct Added", "You may Log in your created account now", "success"); </script>';   
        unset($_SESSION['insert_success']);
      }
  ?>
<?php 
    //LOGIN NOTIFICATION
    if(!empty($_SESSION['username_incorrect'])){
      echo'<script> swal("'.$_SESSION["username_incorrect"].'", "Wrong username", "info"); </script>';   
      unset($_SESSION['username_incorrect']);
    }else if(!empty($_SESSION['password_incorrect'])){
      echo'<script> swal("'.$_SESSION["password_incorrect"].'", "Wrong password", "info"); </script>';   
      unset($_SESSION['password_incorrect']);
    }else if(!empty($_SESSION['incorrect_user'])){
      echo'<script> swal("'.$_SESSION["incorrect_user"].'", "Wrong username", "info"); </script>';   
      unset($_SESSION['incorrect_user']);
    }else if(!empty($_SESSION['wrong_recovery'])){
      echo'<script> swal("'.$_SESSION["wrong_recovery"].'", "Incorrect Recovery Key", "info"); </script>';   
      unset($_SESSION['wrong_recovery']);
    }else if(!empty($_SESSION['password_reset'])){
      echo'<script> swal("'.$_SESSION["password_reset"].'", "Password Reset Success", "success"); </script>';   
      unset($_SESSION['password_reset']);
    }
  ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto mt-5">
        <div class="card border-0 shadow rounded-3 my-5 ">
          <div class="card-body p-4 p-sm-5">
            <h3 class="card-title text-center mb-4 fw-bold fs-10">Sign In</h3>
            <form action="code.php" method="post">
              <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Username</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="Password" placeholder="Password" required>
                <label for="Password">Password</label>
              </div>
              <div class="col d-flex justify-content-between mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck" onclick="showPass()">
                  <label class="form-check-label" for="rememberPasswordCheck">
                  Show Password
                  </label>
                </div>
                <div>
                    <a style="text-decoration:none;" 
                    class="pb-1" href="#" data-bs-toggle="modal" data-bs-target="#forgot_pass">Forgot Password?</a>
                </div>
              </div>
              
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="login">Sign
                  in</button>
              </div>
              <!-- MOdal Button -->
               <div class="d-grid mt-2">
                <button type="button" class="btn btn-danger text-uppercase fw-bold" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                  SIGN UP
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    <?php include("modal/modal.php");?>
    <?php include("modal/forgot_pass.php");?>
</body>
</html>
<script>
function showPass() { 
  var x = document.getElementById("Password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function showPass2() { 
  var x = document.getElementById("newAcctPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>