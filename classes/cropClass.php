<?php 
    require_once "database.php";
    class Crop{
        private $conn;
        //Constructor
        public function __construct(){
            $database = new Database();
            $db = $database->dbConnection();
            $this->conn = $db;
        }

        //INSERT NEW CROP 
        public function insert_new_crop($user_id,$crop){
            try {
                $stmt = $this->conn->prepare("INSERT INTO crop_table(user_id, crop_name, crop_date, status) VALUES(:user_id, :crop_name, NOW(),'close')");
                $stmt->bindparam(":user_id", $user_id);
                $stmt->bindparam(":crop_name", $crop);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //INSERT NEW CROP

        //UPDATE CROP STATUS 
        public function update_crop_status($crop_id,$user_id){
                $stmt = $this->conn->prepare("UPDATE crop_table SET status = 'close' WHERE user_id = :user_id");
                $stmt->execute(array(':user_id'=>$user_id));
            try {
                $stmt = $this->conn->prepare("UPDATE crop_table SET status = 'open' WHERE crop_id = :crop_id AND user_id = :user_id");
                $stmt->bindParam(":crop_id", $crop_id);
                $stmt->bindParam(":user_id", $user_id);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //UPADTE CROP STATUS

        //DELETE CROP RECORD
        public function delete_crop_record($crop_id){
            try{
                $stmt = $this->conn->prepare("DELETE FROM crop_table WHERE crop_id=:crop_id");
                $stmt->bindParam(":crop_id", $crop_id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        //DELETE CROP RECORD
    }
?>