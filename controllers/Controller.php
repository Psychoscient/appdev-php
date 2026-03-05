<?php
    // session_start();
    require_once "../bl/UserManager.php";

    $usermanager = new UserManager();

    if(isset($_POST["firstName"], $_POST["lastName"]) && !isset($_POST["userId"])) { 
        $usermanager -> addFunc($_POST["firstName"], $_POST["lastName"]);
        exit;
        
    } else if(isset($_POST["firstName"], $_POST["lastName"], $_POST["userId"])) {
        $usermanager -> updateFunc($_POST["firstName"], $_POST["lastName"], $_POST["userId"]);
        exit;

    } else if(isset($_POST["userId"])) {
        $usermanager -> deleteFunc($_POST["userId"]);
        exit;

    } else if(isset($_POST["lFname"], $_POST["lLname"])) {
        $usermanager -> loginFunc($_POST["lFname"], $_POST["lLname"]);
        exit;
    }

    // session_destroy();
?>