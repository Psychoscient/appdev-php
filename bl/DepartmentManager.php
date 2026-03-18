<?php
    require_once "../model/Database.php";
    require_once "../model/DepartmentModel.php";
    class DepartmentManager {

        private $departmentModel;
        
        public function __construct() {
            $database = new Database();
            $db = $database->connectDB();
            $this->departmentModel = new DepartmentModel($db);
        }
    
        public function getDepartments(){
            $response = $this->departmentModel->readDepartments();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>