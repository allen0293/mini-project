<?php 
    require_once "database.php";

    class Expense{
        private $conn;

        public function __construct(){
            $database = new Database();
            $db = $database->dbConnection();
            $this->conn = $db;
        }

        //INSERT NEW EXPENSE RECORD
        public function insert_expense($crop_id,$expense_name,$amount,$expense_date){
            try {
                $stmt = $this->conn->prepare("INSERT INTO expenses_record(crop_id, expense_name, amount, expense_date) VALUES(:crop_id, :expense_name, :amount, :expense_date)");
                $stmt->bindparam(":crop_id", $crop_id);
                $stmt->bindparam(":expense_name", $expense_name);
                $stmt->bindparam(":amount", $amount);
                $stmt->bindparam(":expense_date", $expense_date);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //INSERT NEW EXPENSE RECORD
        
        //DELETE EXPENSE RECORD
        public function delete_expense($expense_id){
            try{
                $stmt = $this->conn->prepare("DELETE FROM expenses_record WHERE expense_id=:expense_id");
                $stmt->bindParam(":expense_id", $expense_id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        //DELETE EXPENSE RECORD

        //INSERT FUNCTION FOR TOTAL EXPENSE
        public function insert_total_expense($user_id){
            try{
                $stmt=$this->conn->prepare("INSERT INTO total_expense(crop_id)
                SELECT crop_id from crop_table WHERE user_id=:user_id ORDER BY crop_id DESC LIMIT 1;");
                $stmt->bindParam(":user_id",$user_id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                $e->getMessage();
            }
         }
        //INSERT FUNCTION FOR TOTAL EXPENSE

        //UPDATE ADD FUNCTION  FOR TOTAL EXPENSE
        public function add_total_expense($crop_id,$expense){
            try{    
                $stmt=$this->conn->prepare("UPDATE total_expense set total_exp = total_exp+:expense 
                WHERE crop_id = :crop_id");
                $stmt->bindParam(":expense",$expense);
                $stmt->bindParam(":crop_id",$crop_id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        //UPDATE ADD FUNCTION FOR TOTAL EXPENSE

        //UPDATE SUBTRACT FUNCTION  FOR TOTAL EXPENSE
        public function subtract_total_expense($crop_id,$expense){
            try{    
                $stmt=$this->conn->prepare("UPDATE total_expense set total_exp = total_exp-:expense 
                WHERE crop_id = :crop_id");
                $stmt->bindParam(":expense",$expense);
                $stmt->bindParam(":crop_id",$crop_id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        //UPDATE SUBTRACT FUNCTION FOR TOTAL EXPENSE
    }
?>