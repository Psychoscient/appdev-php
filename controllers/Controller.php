<?php
    // session_start();
    require_once "../bl/UserManager.php";

    $usermanager = new UserManager();

    if(isset($_POST["firstName"], $_POST["lastName"]) && $_POST["deptID"] && !isset($_POST["userID"])) { 
        $usermanager -> addFunc($_POST["firstName"], $_POST["lastName"], $_POST["deptID"]);
        exit;
        
    } else if(isset($_POST["firstName"], $_POST["lastName"], $_POST["deptID"], $_POST["userID"])) {
        $usermanager -> updateFunc($_POST["firstName"], $_POST["lastName"], $_POST["deptID"], $_POST["userID"]);
        exit;

    } else if(isset($_POST["userID"])) {
        $usermanager -> deleteFunc($_POST["userID"]);
        exit;

    } else if(isset($_POST["lFname"], $_POST["lLname"])) {
        $usermanager -> loginFunc($_POST["lFname"], $_POST["lLname"]);
        exit;
    }

    // session_destroy();
?>