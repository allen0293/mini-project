<?php 
    require_once "database.php";
    class Sales{
        private $conn;
        public function __construct(){
            $database = new Database();
            $db = $database->dbConnection();
            $this->conn = $db;
        }

          //INSERT NEW SALES RECORD
          public function insert_sales($crop_id,$sale_name,$quantity,$weight,$amount,$sales,$sales_date){
            try{
                $stmt = $this->conn->prepare("INSERT INTO sales_record(crop_id, sale_name, quantity, weight, amount, sales, sales_date) 
                VALUES(:crop_id, :sale_name, :quantity, :weight, :amount, :sales, :sales_date)");
                $stmt->bindParam(":crop_id",$crop_id);
                $stmt->bindParam(":sale_name",$sale_name);
                $stmt->bindParam(":quantity",$quantity);
                $stmt->bindParam(":weight",$weight);
                $stmt->bindParam(":amount",$amount);
                $stmt->bindParam(":sales",$sales);
                $stmt->bindParam(":sales_date",$sales_date);
                $stmt->execute();
                return $stmt;

            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        //INSERT NEW SALES RECORD

        //DELETE SALES RECORD
        public function delete_sales($sales_id){
            try{
                $stmt = $this->conn->prepare("DELETE FROM sales_record WHERE sales_id = :sales_id");
                $stmt->bindParam(":sales_id",$sales_id);
                $stmt->execute();
                return $stmt;

            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        //DELETE SALES RECORD

        //INSERT FUNCTION FOR TOTAL SALES
        public function insert_total_sales($user_id){
            try{
                $stmt=$this->conn->prepare("INSERT INTO total_sales(crop_id)
                SELECT crop_id from crop_table WHERE user_id=:user_id ORDER BY crop_id DESC LIMIT 1;");
                $stmt->bindParam(":user_id",$user_id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                $e->getMessage();
            }
        }
        //INSERT FUNCTION FRO TOTAL SALES   
        
        //UPDATE ADD FUNCTION FOR TOTAL SALES
        public function add_total_sales($crop_id,$sales){
            try{    
                $stmt=$this->conn->prepare("UPDATE total_sales set total_sls = total_sls+:sales 
                WHERE crop_id = :crop_id");
                $stmt->bindParam(":sales",$sales);
                $stmt->bindParam(":crop_id",$crop_id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        //UPDATE FUNCTION FOR TOTAL SALES

        //UPDATE SUBTRACT FUNCTION FOR TOTAL SALES
        public function subtract_total_sales($crop_id,$sales){
            try{    
                $stmt=$this->conn->prepare("UPDATE total_sales set total_sls = total_sls-:sales 
                WHERE crop_id = :crop_id");
                $stmt->bindParam(":sales",$sales);
                $stmt->bindParam(":crop_id",$crop_id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        //UPDATE SUBTRACT FUNCTION FOR TOTAL SALES
    }

?>