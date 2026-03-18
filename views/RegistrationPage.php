<?php
    session_start();
    require_once "../bl/UserManager.php";
    require_once "../bl/DepartmentManager.php";
    
    $usermanager = new UserManager();
    $users = $usermanager -> getUsers();
    $advancedUsers = $usermanager -> getAdvancedUsers();

    $deptmanager = new DepartmentManager();
    $departments = $deptmanager -> getDepartments();
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
    <title>Registration</title>
</head>
<body>
    <div class="row">
        <?php if(!empty($advancedUsers)) : ?>
            <button class="btn waves-effect waves-light" type="submit" name="action" onclick="redirectFunc(1)">Login
                <i class="material-icons right">send</i>
            </button>
        <?php endif; ?>
        <div class="col s12 m8 offset-m2 l6 offset-l3">
            <div class="row">
                <div class="input-field col s12 m6 l6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="fname" type="text" class="validate" name="fname">
                    <label for="fname">First Name</label>
                </div>

                <div class="input-field col s12 m6 l6">
                    <input id="lname" type="text" class="validate" name="lname">
                    <label for="lname">Last Name</label>
                </div>

                <div class="input-field col s12">
                    <select id="deptSelect">
                        <option value="" disabled selected>Choose your option</option>
                        <?php foreach($departments as $index => $department) : ?>
                        <option value="<?= $department['dept_id'] ?>"><?= $department['dept_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label>Materialize Select</label>
                </div>

                <div class="col s12">
                    <button class="waves-effect waves-light btn-large blue darken-2" id="addBtn" type="button" style="width: 100%;" onclick="addFunc()">
                        <i class="material-icons left">add_circle_outline</i>
                        Add User
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m10 offset-m1 l8 offset-l2">
            <table id="myTable" class="highlight centered striped responsive-table">
                <tr>
                    <th style="text-align: center;">User ID</th>
                    <th style="text-align: center;">First Name</th>
                    <th style="text-align: center;">Last Name</th>
                    <th style="text-align: center;">Department</th>
                    <th style="text-align: center;">Action</th>
                </tr>

                <?php if (!empty($advancedUsers)) : ?>
                    <?php foreach($advancedUsers as $index => $user) : ?>
                        <tr>
                            <td><?= $user['user_id'] ?></td>
                            <td><?= $user['first_name'] ?></td>
                            <td><?= $user['last_name'] ?></td>
                            <td><?= $user['dept_name'] ?></td>
                            <td>
                                <button onclick="updateFunc(<?= $user['user_id'] ?>)"
                                        class="btn-small waves-effect waves-light green"
                                        style="width: 50%; margin:5px">
                                    <i class="material-icons right">update</i>
                                    Update
                                </button>
                                <button onclick="deleteFunc(<?= $user['user_id'] ?>)"
                                        class="btn-small waves-effect waves-light red"
                                        style="width: 50%; margin:5px">
                                    <i class="material-icons right">delete</i>
                                    Delete
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4">No data found.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <script src="../scripts/Service.js"></script>
</body>
</html>