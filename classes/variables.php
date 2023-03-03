<?php 
    class Variables{
        private $user_id;
        private $username;
        private $password;
        private $confirmPass;
        private $newPassword;
        private $crop;
        private $crop_id;
        private $recovery_key;

        //User ID  Setter and Getter
        public function getUserId(){
            return $this->user_id;
        }
        public function setUserId($user_id){
            $this->user_id = $user_id;
        }
        //User ID  Setter and Getter

        //Username  Setter and Getter
        public function getUsername(){
            return $this->username;
        }
        public function setUsername($username){
                $this->username = $username;
        }
        //Username  Setter and Getter

        //Password  Setter and Getter
        public function getPassword(){
            return $this->password;
        }
        public function setPassword($passowrd){
            $this->password = $passowrd;
        }
        //Password  Setter and Getter

        //Old Password Setter and Getter
        public function getConfirmPassword(){
            return $this->confirmPass;
        }
        public function setConfirmPassword($confirmPass){
            $this->confirmPass = $confirmPass;
        }
        //Old Password Setter and  Getter

        //New Password Setter and Getter
        public function getNewPassword(){
            return $this->newPassword;
        }
        public function setNewPassword($newPassword){
            $this->newPassword = $newPassword;
        }

        //Recovery Key Setter and Getter
        public function getRecoveryKey(){
            return $this->recovery_key;
        }
        public function setRecoveryKey($recovery_key){
            $this->recovery_key = $recovery_key;
        }
        //Recovery Key Setter and Getter

        //Crop Setter and Getter
        public function getCrop(){
            return $this->crop;
        }
        public function setCrop($crop){
            $this->crop = $crop;
        }
        //Crop Setter and  Getter

        //Crop ID Setter and Getter
        public function getCropId(){
            return $this->crop_id;
        }
        public function setCropId($crop_id){
            $this->crop_id = $crop_id;
        }
        //Crop ID Setter and  Getter
    }


?>