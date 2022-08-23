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
      include("includes/navbar.php");
      include("includes/sidebar.php");
      require_once "classes/user.php";
      $_SESSION['redirect']=$_SERVER['PHP_SELF'];
      if(!empty($_SESSION['new_record'])){
        echo'<script> swal("SUCCESS", "'.$_SESSION['new_record'].'", "success"); </script>';   
        unset($_SESSION['new_record']);
      }
      if(!empty($_SESSION['deleted'])){
        echo'<script> swal("SUCCESS", "'.$_SESSION['deleted'].'", "success"); </script>';   
        unset($_SESSION['deleted']);
      }if(!empty($_SESSION['add_crop'])){
        echo'<script> swal("INFO", "'.$_SESSION['add_crop'].'", "info"); </script>';   
        unset($_SESSION['add_crop']);
      }
   ?>
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Expenses</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span></span>
                <button type="button" class="btn btn-sm btn btn-outline-success"
                 style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .5rem;"
                 data-bs-toggle="modal" 
                 data-bs-target="#expense">
                  Add Record
                </button>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="example"
                    class="table table-striped data-table"
                    style="width: 100%"
                  >
                    <thead>
                      <tr>
                        <th>NAME</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th></th>
                      </tr>
                    </thead>
                    <?php 
                       $user = new User();
                       $user_id = $_SESSION['user_id'];
                       $stmt = $user->runQuery("SELECT expenses_record.expense_id, expenses_record.expense_name, 
                       expenses_record.expense_date, expenses_record.amount, crop_table.crop_id, crop_table.crop_name 
                       FROM expenses_record 
                       LEFT JOIN crop_table 
                       ON expenses_record.crop_id = crop_table.crop_id 
                       WHERE crop_table.user_id = :user_id 
                       AND crop_table.status ='open'");
                       $stmt->execute(array(":user_id"=>$user_id));
                       $count = $stmt->rowCount(); 
                        $total = 0;
                    ?>
                    <tbody>
                      <?php 
                        if($count > 0){
                          while($rowExpense = $stmt->fetch(PDO::FETCH_ASSOC)){     
                          $date = new DateTime($rowExpense['expense_date']);
                          $date = $date->format('F d Y');
                          $total = $total + $rowExpense['amount'];
                      ?>
                      <tr>
                        <td><?php echo $rowExpense['expense_name']; ?></td>
                        <td><?php echo number_format($rowExpense['amount'],2); ?></td>
                        <td><?php echo $date; ?></td>
                        <td><a class="text-danger confirmation" href="code.php?delete_expense=<?php echo $rowExpense['expense_id'];?>">Delete</a></td>
                      </tr>
                      <?php  }} ?>
                    </tbody>
                    <tfoot>
                      <tr>
                          <th colspan="3" style="text-align:right">Total Expenses:</th>
                          <th><?php echo number_format($total,2); ?></th>
                      </tr>
                  </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </main>
    <?php include("modal/expense_modal.php");?>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>

    <script>
      // JQuery confirmation
      $('.confirmation').on('click', function () {
          return confirm('Are you sure you want do delete this Record');
      });


      $(document).ready(function () {
      $(".data-table").each(function (_, table) {
        $(table).DataTable();
      });
    });

  </script>
 </body>
</html>