<?php
    require_once "../model/Database.php";
    require_once "../model/UserModel.php";
    class UserManager {

        private $userModel;
        
        public function __construct() {
            $database = new Database();
            $db = $database->connectDB();
            $this->userModel = new UserModel($db);
        }
        
        public function addFunc($firstName, $lastName, $deptID) {
            try {
                if (empty($firstName) || empty($lastName) || empty($deptID)) {
                    throw new InvalidArgumentException("Please fill out the form.");
                }
            
                if ($this -> userExists($firstName, $lastName)) {
                    echo "exists";
                    exit;
                }

                if ($this->userModel->createUser($firstName, $lastName, $deptID)) {
                    echo "User created successfully.";
                    exit;
                } else {
                    echo "Failed to create user.";
                    exit;
                }
                
            } catch(InvalidArgumentException $e) {
                http_response_code(501);
                echo $e->getMessage();
                exit;
            }
        }

        public function updateFunc($firstName, $lastName, $deptID, $userID) {
            try {
                if (empty($firstName) || empty($lastName) || empty($deptID)) {
                    throw new InvalidArgumentException("Please fill out the form.");
                }
                
                if ($this -> userExists($firstName, $lastName)) {
                    echo "exists";
                    exit;
                }

                if($this -> userModel -> updateUser($userID, $firstName, $lastName, $deptID)) {
                    echo "User updated successfully.";
                    exit;
                } else {
                    echo "Failed to update user.";
                    exit;
                }

            } catch(PDOException $e) {
                http_response_code(400);
                echo $e->getMessage();
                exit;
            } 
        }

        public function userExists($firstName, $lastName) {
            $users = $this->getUsers();
            foreach ($users as $user) {
                if ($user["first_name"] === $firstName && $user["last_name"] === $lastName)
                    return true;
            }
                
            return false;
        }

        public function deleteFunc($userID) {
            try {
                if($this->userModel->deleteUser($userID)) {
                    echo "User deleted successfully.";
                    exit;
                } else {
                    echo "Failed to delete user.";
                    exit;
                }
            } catch(PDOException $e) {
                http_response_code(400);
                echo "User not found.";
                exit;
            }  
        }

        public function loginFunc($firstName, $lastName) {
            $users = $this->getUsers();

            foreach ($users as $user) {
                if ($user["first_name"] === $firstName && $user["last_name"] === $lastName) {
                    echo "success";
                    exit;
                }
            }
            echo "Invalid credentials.";
            exit;
        }
    
        public function getUsers(){
            $response = $this->userModel->readUsers();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAdvancedUsers() {
            $response = $this->userModel->readAdvancedUsers();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>