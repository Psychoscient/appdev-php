<?php
    class DepartmentModel {

        private $conn;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function readDepartments() {
            $selectQuery = "SELECT * FROM tbl_departments";
            $response = $this->conn->prepare($selectQuery);
            $response->execute();

            return $response;
        }
    }
?>