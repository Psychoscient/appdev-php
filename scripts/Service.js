function addFunc() {
    const fname = document.getElementById("fname").value;
    const lname = document.getElementById("lname").value;
    const deptSelect = document.getElementById("deptSelect").value;

    $.ajax({
        url: "../controllers/Controller.php",
        type: "POST",
        data: {
            firstName: fname,
            lastName: lname,
            deptID: deptSelect
        },
        success: function(response) {

            if (response === "exists") {
                Swal.fire({
                    icon: "warning",
                    title: "Warning!",
                    text: "User already exists!"
                });
            } else if (!deptSelect) {
                Swal.fire({
                    icon: "warning",
                    title: "Warning!",
                    text: "Please select a department."
                });
            } else {
                Swal.fire({
                    title: "Success!",
                    text: response,
                    icon: "success",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload(true);
                    }
                })
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: xhr.responseText,
            });
        },
        
    });
}

function updateFunc(uID) {
    const fname = document.getElementById("fname").value;
    const lname = document.getElementById("lname").value;
    const deptSelect = document.getElementById("deptSelect").value;

    $.ajax({
        url: "../controllers/Controller.php",
        type: "POST",
        data: {
            firstName: fname,
            lastName: lname,
            deptID: deptSelect,
            userID: uID,
        },
        success: function(response) {
            if (response === "exists") {
                Swal.fire({
                    icon: "warning",
                    title: "Warning!",
                    text: "User already exists!"
                });
            } else if (!deptSelect) {
                Swal.fire({
                    icon: "warning",
                    title: "Warning!",
                    text: "Please select a department."
                }); 
            } else {
                Swal.fire({
                    title: "Success!",
                    text: response,
                    icon: "success",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload(true);
                    }
                })
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: xhr.responseText,
            });
        }
    });
}

function deleteFunc(index) {
    $.ajax({
        url: "../controllers/Controller.php",
        type: "POST",
        data: {
            userID: index,
        },
        success: function(response) {
            Swal.fire({
                    title: "Success!",
                    text: response,
                    icon: "success",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload(true);
                    }
                })
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: xhr.responseText,
            });
        }
    });
}

function redirectFunc(redirectID) {
    if(redirectID === 1) {
        window.location.href = "LoginPage.php";
    } else if(redirectID === 2) {
        window.location.href = "DashboardPage.php";
    } else if(redirectID === 3) {
        window.location.href = "RegistrationPage.php";
    }
}

function loginFunc() {
    const loginFirstName = document.getElementById("lFname").value;
    const loginLastName = document.getElementById("lLname").value;

    $.ajax({
        url: "../controllers/Controller.php",
        type: "POST",
        data: {
            lFname: loginFirstName,
            lLname: loginLastName,
        },
        success: function(response) {
            if (response === "success") {
                Swal.fire({
                    title: "Success!",
                    text: "Login successful!",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        redirectFunc(2);
                    }
                })
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Invalid credentials!",
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: xhr.responseText,
            });
        }
    });
}

$(document).ready(function(){
    $('select').formSelect();
});