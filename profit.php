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
      include("includes/security.php");
      include("includes/navbar.php");
      include("includes/sidebar.php");
      require_once "classes/user.php";
      $_SESSION['redirect']=$_SERVER['PHP_SELF'];
   ?>
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Profit Record</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span></span>
                <a href="code.php?export" class="btn btn-sm btn btn-success"
                 style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .5rem;">
                    Export excel
                 </a>
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
                        <th>Date</th>
                        <th>Croping</th>
                        <th>Total Expense</th>
                        <th>Sales</th>
                        <th>Profit</th>
                      </tr>
                    </thead>
                    <?php 
                        $user = new User();
                        $user_id = $_SESSION['user_id'];
                        //Sales
                        $stmt = $user->runQuery("SELECT  YEAR(crop_table.crop_date) as date, crop_table.crop_name, total_expense.total_exp, total_sales.total_sls, total_sales.total_sls - total_expense.total_exp as profit 
                        FROM crop_table 
                        INNER JOIN total_expense on crop_table.crop_id = total_expense.crop_id 
                        INNER JOIN total_sales on crop_table.crop_id = total_sales.crop_id 
                        WHERE crop_table.user_id = :user_id GROUP BY crop_table.crop_id;");
                        $stmt->execute(array(":user_id"=>$user_id));
                        $count = $stmt->rowCount();
                        $profit = array();     
                        if($count > 0){
                          while($rowProfit = $stmt->fetch(PDO::FETCH_ASSOC)){     
                            $profit[] = $rowProfit;
                          }}
                    ?>
                    <tbody>
                      <?php 
                       foreach($profit as $row){
                      ?>
                      <tr>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['crop_name']; ?></td>
                        <td><?php echo number_format($row['total_exp'],2); ?></td>
                        <td><?php echo number_format($row['total_sls'],2); ?></td>
                        <td><?php echo number_format($row['profit'],2); ?></td>
                        <?php } ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
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
    <script>
      $(document).ready(function () {
      $(".data-table").each(function (_, table) {
        $(table).DataTable();
      });
    });
  </script>
 </body>
</html>