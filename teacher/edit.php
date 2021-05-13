<?php
    require_once "../config.php";
    if (isset($_GET['id'])) {
        $sql = "SELECT * FROM users WHERE id = " .$_GET['id'];
        $result = mysqli_query($con, $sql);
        if (($row = mysqli_fetch_assoc($result)) > 0) {
            $user = $row;
        }
        $username = $row['username'];
        $password = $row['password'];
        $fullname = $row['fullname'];
        $email = $row['email'];
        $phonenum = $row['phonenum'];
        $role = $row['role'];
    }
    if (isset($_POST['update'])) {
        $sql = "UPDATE users SET username = '".$_POST['username']."',
                password = '".$_POST['password']."',
                fullname = '".$_POST['fullname']."',
                email = '".$_POST['email']."',
                phonenum = '".$_POST['phonenum']."',
                role = '".$_POST['role']."'
                 WHERE id = " .$_POST['id'];
        $result = mysqli_query($con, $sql);
        if ($result) {
            $sql = "SELECT * FROM users WHERE id = " .$_POST['id'];
            $result = mysqli_query($con, $sql);
            if (($row = mysqli_fetch_assoc($result)) > 0) {
                $user = $row;
            }
            $username = $row['username'];
            $password = $row['password'];
            $fullname = $row['fullname'];
            $email = $row['email'];
            $phonenum = $row['phonenum'];
            $role = $row['role'];
            echo "Update successfully";
        }
    }
    if (count($_GET) === 0 && count($_POST) === 0) {
        header('location: dashboard.php');
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
                        <input type="hidden" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>" name="id">
                        <input type="submit" class="btn btn-primary" value="Submit" name="update">
                        <a href="dashboard.php" class="btn btn-secondary ml-2">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>