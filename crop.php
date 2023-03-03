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
      if(!empty($_SESSION['new_record'])){
        echo'<script> swal("SUCCESS", "'.$_SESSION['new_record'].'", "success"); </script>';   
        unset($_SESSION['new_record']);
      }
      if(!empty($_SESSION['deleted'])){
        echo'<script> swal("SUCCESS", "'.$_SESSION['deleted'].'", "success"); </script>';   
        unset($_SESSION['deleted']);
      }
   ?>
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Croping  Record</h4>
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
                 data-bs-target="#crop_modal">
                  Add New Croping
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
                        <th>Croping</th>
                        <th>Date Created</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <?php 
                       $user = new User();
                       $user_id = $_SESSION['user_id'];
                       $stmt = $user->runQuery("SELECT * FROM crop_table WHERE user_id = :user_id");
                       $stmt->execute(array(":user_id"=>$user_id));
                       $count = $stmt->rowCount(); 
                    ?>
                    <tbody>
                      <?php 
                        if($count > 0){
                          while($rowcrop = $stmt->fetch(PDO::FETCH_ASSOC)){     
                          $date = new DateTime($rowcrop['crop_date']);
                          $date = $date->format('F d Y');  
                          if($rowcrop['status']=="open"){
                            $color = "text-success";
                          }else{
                            $color = "text-dark";
                          }  
                      ?>
                      <tr>
                        <td><?php echo $rowcrop['crop_name']; ?></td>
                        <td><?php echo $date; ?></td>
                        <td><a class="<?php echo $color ?>" href="code.php?update_crop=<?php echo $rowcrop['crop_id'];?>"><?php echo $rowcrop['status']; ?></a></td>
                        <td><a class="text-danger confirmation" href="code.php?delete_crop=<?php echo $rowcrop['crop_id'];?>">Delete</a></td>
                      </tr>
                      <?php  }} ?>
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
    <?php
      include("modal/crop_modal.php");
    ?>
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