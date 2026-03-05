<?php
    class UserModel {

        private $conn;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function createUser($fName, $lName) {

            try {
                $dateNow = date('Y-m-d H:i:s');

                $insertQuery = "INSERT INTO tbl_users (first_name, last_name, created_at, updated_at) VALUES (:fName, :lName, :created_at, :updated_at)";                      
                
                $response = $this->conn->prepare($insertQuery);
                $response->bindParam(":fName", $fName);
                $response->bindParam(":lName", $lName);
                $response->bindParam(":created_at", $dateNow);
                $response->bindParam(":updated_at", $dateNow);
                
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                exit;
            }

            return $response->execute();
        }

        public function readUsers() {
            $selectQuery = "SELECT * FROM tbl_users";
            $response = $this->conn->prepare($selectQuery);
            $response->execute();

            return $response;
        }

        public function updateUser($userID, $firstName, $lastName) {
            $updateQuery = "UPDATE tbl_users SET first_name = :firstName, last_name = :lastName, updated_at = :updated_at WHERE user_id = :userID";
            $response = $this->conn->prepare($updateQuery);

            $dateNow = date('Y-m-d H:i:s');

            $response->bindParam(":firstName", $firstName);
            $response->bindParam(":lastName", $lastName);
            $response->bindParam(":updated_at", $dateNow);
            $response->bindParam(":userID", $userID);

            return $response->execute();
        }

        public function deleteUser($userID) {
            $deleteQuery = "DELETE FROM tbl_users WHERE user_id = :userID";
            $response = $this->conn->prepare($deleteQuery);
            $response->bindParam(":userID", $userID);

            return $response->execute();
        }
    }
?>