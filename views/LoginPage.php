<?php
    session_start();
    require_once "../bl/UserManager.php";
    
    $usermanager = new UserManager();
    $users = $usermanager -> getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>Login</title>
</head>
<body>
    <div class="row">
        <form class="col s12">
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="lFname" type="text" class="validate">
                    <label for="lFname">First Name</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">phone</i>
                    <input id="lLname" type="text" class="validate">
                    <label for="lLname">Last Name</label>
                </div>
                <button class="btn waves-effect waves-light" name="action" type="button" onclick="loginFunc()">Submit
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
    <script src="../scripts/Service.js"></script>
</body>
</html>