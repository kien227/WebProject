<?php
// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
$username = $password = $fullname = $email = $phonenum = $role = "";
$username_err = $password_err = $fullname_err = $email_err = $phonenum_err = $role_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    $input_name = trim($_POST["username"]);
    if (empty($input_name)) {
        $username_err = "Please enter username.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\d\s]+$/")))) {
        $username_err = "Please enter a valid username.";
    } else {
        $username = $input_name;
    }

    // Validate password
    $input_password = trim($_POST["password"]);
    if (empty($input_password)) {
        $password_err = "Please enter valid password.";
    } else {
        $password = $input_password;
    }

    // Validate fullname
    $input_fullname = trim($_POST["fullname"]);
    if (empty($input_fullname)) {
        $fullname_err = "Please enter a valid fullname.";
    } else {
        $fullname = $input_fullname;
    }

    // Validate email
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter an email.";
    } else {
        $email = $input_email;
    }

    // Validate phonenum
    $input_phonenum = trim($_POST["phonenum"]);
    if (empty($input_phonenum)) {
        $phonenum_err = "Please enter the phone number.";
    } elseif (!ctype_digit($input_phonenum)) {
        $phonenum_err = "Please enter a valid phone number.";
    } else {
        $phonenum = $input_phonenum;
    }

    // Validate role
    $input_role = trim($_POST["role"]);
    if (empty($input_role)) {
        $role_err = "Please enter the role.";
    } else {
        $role = $input_role;
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($user_err) && empty($email_err) && empty($phonenum_err) && empty($role_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, fullname, email, phonenum, role) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($con, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_password, $param_fullname, $param_email, $param_phonenum, $param_role);

            // Set parameters
            $param_username = $username;
            $param_password = $password;
            $param_fullname = $fullname;
            $param_email = $email;
            $param_phonenum = $phonenum;
            $param_role = $role;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: dashboard.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo ("go go brbr");
    }

    // Close connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Add user</h2>
                    <p>Please fill this form and submit to add user to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Fullname</label>
                            <input type="text" name="fullname" class="form-control <?php echo (!empty($user_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fullname; ?>">
                            <span class="invalid-feedback"><?php echo $user_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Phonenum</label>
                            <input type="text" name="phonenum" class="form-control <?php echo (!empty($phonenum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phonenum; ?>">
                            <span class="invalid-feedback"><?php echo $phonenum_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" name="role" class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $role; ?>">
                            <span class="invalid-feedback"><?php echo $role_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="dashboard.php" class="btn btn-success">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>