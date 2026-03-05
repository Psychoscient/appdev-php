<?php
    require_once "../model/Database.php";
    require_once "../model/UserModel.php";
    class UserManager {

        private $userModel;
        
        public function __construct() {
            if (!isset($_SESSION["userArr"])){
                $_SESSION["userArr"] = [];
            }

            $database = new Database();
            $db = $database->connectDB();
            $this->userModel = new UserModel($db);
        }
        
        public function addFunc($firstName, $lastName) {
            try {
                if (empty($firstName) || empty($lastName)) {
                    throw new InvalidArgumentException("Please fill out the form.");
                }
            
                if ($this -> userExists($firstName, $lastName)) {
                    echo "exists";
                    exit;
                }

                // $_SESSION ["userArr"][] = [
                //     "firstName" => $firstName,
                //     "lastName" => $lastName
                // ];

                // echo $firstName . " " . $lastName;
                // exit;

                if ($this->userModel->createUser($firstName, $lastName)) {
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

        public function updateFunc($firstName, $lastName, $userId) {
            try {
                // if (empty($firstName) || empty($lastName)) {
                //     throw new InvalidArgumentException("Please fill out the form.");
                // }
                
                if ($this -> userExists($firstName, $lastName)) {
                    echo "exists";
                    exit;
                }

                // if(isset($_SESSION ["userArr"][$userId])) {
                //     $_SESSION ["userArr"][$userId]["firstName"] = $firstName;
                //     $_SESSION ["userArr"][$userId]["lastName"] = $lastName;
                //     echo $firstName . " " . $lastName;
                //     exit;
                // }

                if($this->userModel->updateUser($userId, $firstName, $lastName)) {
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
            // if (isset($_SESSION["userArr"][$index])) {
            //     $firstName = $_SESSION["userArr"][$index]["firstName"];
            //     $lastName = $_SESSION["userArr"][$index]["lastName"];

            //     unset($_SESSION["userArr"][$index]);

            //     echo $firstName . " " . $lastName;
            //     exit;
            // }
            // echo "User not found.";
            // exit;

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
            $fNameColumn = array_column($_SESSION["userArr"], "firstName");
            $fNameResult = array_search($firstName, $fNameColumn);

            $lNameColumn = array_column($_SESSION["userArr"], "lastName");
            $lNameResult = array_search($lastName, $lNameColumn);

            if($fNameResult !== false && $lNameResult !== false) {
                // echo "Found at index $fNameResult and $lNameResult";
                echo "success";
                exit;
            } else {
                echo "error";
                exit;
            }
        }

    // session_destroy();
    
        public function getUsers(){
            // return $_SESSION["userArr"];

            $response = $this->userModel->readUsers();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>