<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/swal.js"></script>
    <title>Financial Record</title>
  </head>
  <body>
    <?php
      error_reporting(0);
     include("includes/security.php");
     require_once "classes/user.php";
     $_SESSION['redirect']=$_SERVER['PHP_SELF'];
      $crop_name = '';
      $expense = 0; $sales = 0; $profit = 0;
      $user = new User();
      $user_id = $_SESSION['user_id'];
      
      $stmt = $user->runQuery("SELECT crop_table.crop_name, total_expense.total_exp, total_sales.total_sls, crop_table.crop_date, total_sales.total_sls - total_expense.total_exp as profit 
      FROM crop_table 
      INNER JOIN total_expense on crop_table.crop_id = total_expense.crop_id 
      INNER JOIN total_sales on crop_table.crop_id = total_sales.crop_id 
      WHERE crop_table.user_id = :user_id 
      AND crop_table.status='open';");
      $stmt->execute(array(":user_id"=>$user_id));
      $rowDasboard = $stmt->fetch(PDO::FETCH_ASSOC);
      $expense = $rowDasboard['total_exp'];
      $sales = $rowDasboard['total_sls'];
      $profit = $rowDasboard['profit'];
      $crop_name = $rowDasboard['crop_name'];
      if($profit >= 0){
        $color='bg-success';
      }else{
        $color='bg-danger';
      }
   
      //NOTIFICATION
      if(!empty($_SESSION['login_success'])){
        echo'<script> swal("Login Success", "Welcome '.$_SESSION["login_success"].'", "success"); </script>';   
        unset($_SESSION['login_success']);
      }if(!empty($_SESSION['oldpass_incorrect'])){
          echo'<script> swal("Incorrect Password", "'.$_SESSION["oldpass_incorrect"].'", "warning"); </script>';   
          unset($_SESSION['oldpass_incorrect']);
      }if(!empty($_SESSION['new_confirm'])){
        echo'<script> swal("Incorrect Password", "'.$_SESSION["new_confirm"].'", "warning"); </script>';   
        unset($_SESSION['new_confirm']);
      }if(!empty($_SESSION['change_pass_success'])){
        echo'<script> swal("Success!", "'.$_SESSION["change_pass_success"].'", "success"); </script>';   
        unset($_SESSION['change_pass_success']);
      }if(!empty($_SESSION['change_key_success'])){
        echo'<script> swal("Success!", "'.$_SESSION["change_key_success"].'", "success"); </script>';   
        unset($_SESSION['change_key_success']);
      }if(!empty($_SESSION['old_key'])){
        echo'<script> swal("Wrong Input", "'.$_SESSION["old_key"].'", "warning"); </script>';   
        unset($_SESSION['old_key']);
      }if(!empty($_SESSION['wrong_pass'])){
        echo'<script> swal("Wrong Input", "'.$_SESSION["wrong_pass"].'", "warning"); </script>';   
        unset($_SESSION['wrong_pass']);
      }
      //NOTIFICATION
    ?>
   <?php 
      include("includes/navbar.php");
      include("includes/sidebar.php");
   ?>
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Dashboard</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white h-100">
              <div class="col d-flex justify-content-center">
                  <div class="card-body py-5 fs-3"><?php echo $crop_name;?> Expense</div>
                  <div class="text-md py-5 font-weight-bold text-white fs-3 px-2"><?php echo number_format($expense,2); ?></div>
              </div>
              <a href="expenses.php" class=" text-decoration-none text-white">
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
              </a>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="card bg-warning text-dark h-100">
               <div class="col d-flex justify-content-center">
                  <div class="card-body py-5 fs-3"><?php echo $crop_name; ?> Sales</div>
                  <div class="text-md py-5 font-weight-bold fs-3 px-2"><?php echo number_format($sales,2); ?></div>
              </div>
              <a href="sales.php" class=" text-decoration-none text-white">
                <div class="card-footer d-flex">
                  View Details
                  <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                  </span>
                </div>
              </a>
            </div>
        </div>
          <div class="col-md-4 mb-3">
            <div class="card <?php echo $color ?> text-dark h-100">
               <div class="col d-flex justify-content-center">
                  <div class="card-body py-5 fs-3"><?php echo $crop_name; ?> Profit</div>
                  <div class="text-md py-5 font-weight-bold fs-3 px-2"><?php echo number_format($profit,2); ?></div>
              </div>
              <a href="profit.php" class=" text-decoration-none text-white">
                <div class="card-footer d-flex">
                  View Details
                  <span class="ms-auto">  
                    <i class="bi bi-chevron-right"></i>
                  </span>
                </div>
              </a>
            </div>
          </div>
        </div>

          </div>
        </div>
      </div>
    </main>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
  </body>
</html>
<script src="./js/script.js"></script>
