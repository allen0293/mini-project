<?php   
    session_start();
    require_once "classes/user.php";
    require_once "classes/variables.php";
    require_once "classes/cropClass.php";
    require_once "classes/expenseClass.php";
    require_once "classes/salesClass.php";
    $var = new Variables();
    $user = new User();
    $crop = new Crop();
    $expense = new Expense();
    $salesObj = new Sales();
    //Function to get Open crop_ID
    function get_crop_id(){
        $Crop = new User();
        $cropStmt = $Crop->runQuery("SELECT crop_id FROM crop_table WHERE status = 'open'  AND crop_table.user_id = :user_id");
        $cropStmt->execute(array(":user_id"=>$_SESSION['user_id']));
        $rowCrop = $cropStmt->fetch(PDO::FETCH_ASSOC);
        $crop_id = $rowCrop['crop_id'];
        return $crop_id;
    }

    function subtract_expense_record($expense_id){
        $User = new User();
        $expense = new Expense();
        $stmt = $User->runQuery("SELECT crop_id, amount FROM expenses_record WHERE expense_id = :expense_id");
        $stmt->execute(array(":expense_id"=>$expense_id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $crop_id = $row['crop_id'];
        $amount = $row['amount'];
        $expense->subtract_total_expense($crop_id,$amount);
        return 0;
    }

    function subtract_sales_record($sales_id){
        $salesObj = new Sales();
        $User = new User();
        $stmt = $User->runQuery("SELECT crop_id, sales FROM sales_record WHERE sales_id = :sales_id");
        $stmt->execute(array(":sales_id"=>$sales_id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $crop_id = $row['crop_id'];
        $sales = $row['sales'];
        $salesObj->subtract_total_sales($crop_id,$sales);
        return 0; 
    }

    //THIS FUNCTION WILL INSERT A NEW ACCOUNT
    if(isset($_POST["new_user"])) {
        $var->setUsername($_POST["username"]);
        $var->setPassword($_POST["password"]);
        $var->setRecoveryKey($_POST["recovery_key"]);
        $user_type = "client";

        //USERNAME CHECKER
        $stmt = $user->runQuery("SELECT * FROM user WHERE username = :username");      
        $stmt->execute(array(":username"=>$var->getUsername()));
        $count = $stmt->rowCount();
        if($count == 0){
            $var->setPassword(password_hash($var->getPassword(), PASSWORD_BCRYPT));
            $var->setRecoveryKey(password_hash($var->getRecoveryKey(), PASSWORD_BCRYPT));
            if($user->insert_new_user($var->getUsername(),$var->getPassword(),$var->getRecoveryKey(),$user_type)){
                $_SESSION['insert_success']='insert success';
                $user->redirect("index.php");
            }else{
                $_SESSION['insert_error']='Insert error';
                $user->redirect("index.php");
            }
        }else {
            $_SESSION['username_inused']="username already existed";
            $user->redirect("index.php");
        }
    }
    //END OF INSERT NEW ACCOUNT CODE

    //LOGIN USER
    if(isset($_POST["login"])){
        $var->setUsername($_POST["username"]);
        $var->setPassword($_POST["password"]);
        $stmt = $user->runQuery("SELECT * FROM user WHERE username = :username");
        $stmt->execute(array(":username"=>$var->getUsername()));
        $count = $stmt->rowCount();
        $rowUser = $stmt->fetch(PDO::FETCH_ASSOC);
        if($count > 0){
            $_SESSION['user_id']=$rowUser['user_id'];
            $_SESSION['username']=$rowUser['username'];
            $user_type = $rowUser['user_type'];
            if(password_verify($var->getPassword(),$rowUser['password'])){
                $_SESSION['login_success']=$_SESSION['username'];            
                $user->redirect("dashboard.php");
                if($user_type == "admin"){          
                    $user->redirect("admin.php");
                }else{
                    $user->redirect("dashboard.php");
                }
            }else{
                $_SESSION['password_incorrect']="Password Incorrect";
                $user->redirect("index.php");
            }
        }else{
            $_SESSION['username_incorrect']="Username Incorrect";
            $user->redirect("index.php");
        }
    }

    //CHANGE PASSWORD 
    if(isset($_POST['change_pass'])){
        $var->setUsername($_SESSION['username']);
        $var->setPassword($_POST['oldPassword']);
        $var->setNewPassword($_POST['newPassword']);
        $var->setConfirmPassword($_POST['confirmPassword']);
        $stmt = $user->runQuery("SELECT password FROM user WHERE username = :username");
        $stmt->execute(array(':username' =>$var->getUsername()));
        $count=$stmt->rowCount();
        if($count>0){
            $rowUser =  $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($var->getPassword(),$rowUser['password'])){
                if($var->getNewPassword() == $var->getConfirmPassword()){
                    $var->setNewPassword(password_hash($var->getNewPassword(),PASSWORD_BCRYPT));
                    if($user->update_password($var->getUsername(),$var->getNewPassword())){
                        $_SESSION['change_pass_success']="Change Password Success";
                        $user->redirect("dashboard.php");
                    }
                }else{
                    $_SESSION['new_confirm']="Confim Password Did not match";
                    $user->redirect("dashboard.php");
                }
            }else{
                $_SESSION['oldpass_incorrect']="Old Password Incorrect";
                $user->redirect("dashboard.php");
            }
        }
    }   
    //CHANGE PASSWORD

     //CHANGE RECOVERY KEY
     if(isset($_POST['new_key'])){
        $var->setUsername($_SESSION['username']);
        $var->setPassword($_POST['password']);
        $old_key = $_POST['old_key'];
        $recovery_key = $_POST['recovery_key'];
        $stmt = $user->runQuery("SELECT * FROM user WHERE username = :username");
        $stmt->execute(array(':username' =>$var->getUsername()));
        $count=$stmt->rowCount();
        if($count>0){
            $rowUser =  $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($old_key,$rowUser['recovery_key'])){     
                if(password_verify($var->getPassword(),$rowUser['password'])){
                    $new_key = password_hash($recovery_key,PASSWORD_BCRYPT);  
                    if($user->update_recovery_key($var->getUsername(),$new_key)){
                        $_SESSION['change_key_success']="Change Recovery Success";
                        $user->redirect("dashboard.php");
                    }
                }else{
                   $_SESSION['wrong_pass']="Password Incorrect";
                    $user->redirect("dashboard.php");  
                }
            }else{
                $_SESSION['old_key']="Incorrect Old Recovery Key";
                $user->redirect("dashboard.php");
            }
        }
    }   
    //CHANGE RECOVERY KEY
    
    //INSERT NEW CROPING RECORD
      if (isset($_POST['crop_record'])) {
        $var->setUserId($_SESSION['user_id']);
        $var->setCrop($_POST['crop']);
        if($crop->insert_new_crop($var->getUserId(),$var->getCrop())){
            $expense->insert_total_expense($var->getUserId());
            $salesObj->insert_total_sales($var->getUserId());
            $_SESSION['new_record']="New Record Added";
            $user->redirect("crop.php");
        }else{
            return 0;
        }
    }
    //INSERT NEW CROPING RECORD

    //UPDATE CROP STATUS
    if (isset($_GET['update_crop'])) {
        $var->setCropId($_GET['update_crop']);
        $var->setUserId($_SESSION['user_id']);
        $crop->update_crop_status($var->getCropId(),$var->getUserId());
        $user->redirect("crop.php");
    }
    //UPDATE CROP STATUS

    //DELETE CROP RECORD
    if (isset($_GET['delete_crop'])){
        $var->setCropId($_GET['delete_crop']);
        $crop->delete_crop_record($var->getCropId());
        $_SESSION['deleted']="Record Deleted";
        $user->redirect("crop.php");
    }
    //DEDLETE CROP RECORD

    //INSERT NEW EXPENSE RECORD
      if (isset($_POST['expense_record'])) {
        $dsc = ucwords($_POST['dsc']);
        $amount =  $_POST['amount'];
        $date_record = $_POST['date_record'];
        if(!empty(get_crop_id())){
            $crop_id = get_crop_id();
            $_SESSION['new_record']="New Record Added";
            $expense->add_total_expense($crop_id,$amount);
            $expense->insert_expense($crop_id,$dsc,$amount,$date_record);
            $user->redirect("expenses.php");
        }else{
            $_SESSION['add_crop']="Create Your Croping First And Open It";
            $user->redirect("expenses.php");
        }
    }
    //INSERT NEW EXPENSE RECORD

    //DELETE EXPENSE RECORD
    if (isset($_GET['delete_expense'])) {
        $expense_id =  $_GET['delete_expense'];
        subtract_expense_record($expense_id);

        $expense->delete_expense($expense_id);
        $_SESSION['deleted']="Record Deleted";
        $user->redirect("expenses.php");
    }
    //DEDLETE EXPENSE RECORD

    //INSERT NEW SALES RECORD
    if(isset($_POST['sales_record'])){
        $sale_name = ucwords($_POST['crop_name']);
        $quantity = $_POST['quantity'];
        $weight = $_POST['weight'];
        $amount = $_POST['amount'];
        $sales_date = $_POST['sales_date'];
        $sales = $quantity * $weight * $amount;
        if(!empty(get_crop_id())){
         $crop_id = get_crop_id();
         $_SESSION['new_record']="New Record Added";
         $salesObj->insert_sales($crop_id,$sale_name,$quantity,$weight,$amount,$sales,$sales_date);
         $salesObj->add_total_sales($crop_id,$sales);
         $user->redirect("sales.php");
        }else{
            $_SESSION['add_crop']="Create Your Croping First And Open It";
            $user->redirect("expenses.php");
        }

    }
    //INSERT NEW SALES RECORD

    //DELETE SALES RECORD
    if(isset($_GET['delete_sales'])){
        $sales_id = $_GET['delete_sales'];
        subtract_sales_record($sales_id);
        $salesObj->delete_sales($sales_id);
        $_SESSION['deleted']="Record Deleted";
        $user->redirect("sales.php");
    }
    //DELTE SALES RECORD
    
//FORGOT PASSWORD
if(isset($_POST['pass'])){
    $var->setUsername($_POST['username']);
    $var->setRecoveryKey($_POST['recovery_key']);
    $stmt = $user->runQuery("SELECT * FROM user WHERE username = :username");
    $stmt->execute(array(":username"=>$var->getUsername()));
    $count = $stmt->rowCount();
    if($count>0){
        $output=$stmt->fetch(PDO::FETCH_ASSOC);
        if(password_verify($var->getRecoveryKey(),$output['recovery_key'])){
            $_SESSION['username']= $var->getUsername();
            $_SESSION['recovery_key']=$var->getRecoveryKey();
            $user->redirect("change_pass.php");
        }else{
            $_SESSION['wrong_recovery']="Wrong Recovery Key";
            $user->redirect("index.php");
        }
    }else{
        $_SESSION['incorrect_user']="Incorrect Username";
        $user->redirect("index.php");
    }
  }
  //FORGOT PASSWORD

  //NEW PASSWORD
  if(isset($_POST['new_pass'])){
    $var->setNewPassword($_POST['password']);
    $var->setUsername($_SESSION['username']);
    $var->setNewPassword(password_hash($var->getNewPassword(),PASSWORD_BCRYPT));
    $user->update_new_password($var->getUsername(),$var->getNewPassword());
    unset($_SESSION['username']);
    unset($_SESSION['recovery_key']);
    $_SESSION['password_reset']="Password Reset";
    $user->redirect("index.php");
  }
  //NEW PASSWORD

  //Export to excel
if(isset($_GET['export'])){
    $var->setUserId($_SESSION['user_id']);
	$stmt = $user->runQuery("SELECT YEAR(crop_table.crop_date), crop_table.crop_name, total_expense.total_exp, total_sales.total_sls, total_sales.total_sls - total_expense.total_exp as profit 
    FROM crop_table 
    INNER JOIN total_expense on crop_table.crop_id = total_expense.crop_id 
    INNER JOIN total_sales on crop_table.crop_id = total_sales.crop_id 
    WHERE crop_table.user_id = :user_id GROUP BY crop_table.crop_id;");
    $stmt->execute(array(":user_id"=>$var->getUserId()));
    $count = $stmt->rowCount();
    $profit = array();
    $output = fopen('php://output','w');
    fputcsv($output,array('Date','Croping','Total Expense','Sales','Profit'));
	if($count>0){
        while($rowProfit = $stmt->fetch(PDO::FETCH_ASSOC)){
                $profit[]= $rowProfit;
        }
    }
    if($count>0){
        foreach($profit as $row){
            fputcsv($output,$row);
        }
    }
	header('Content-Type:text/csv; charset=utf8');
	header('Content-Disposition:attachment;filename=Profit_'.date('m-d-Y').'.csv');
}
?>