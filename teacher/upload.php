<?php
session_start();
require_once "../config.php";
if (isset($_POST['message'])) {
    $id_send = $_GET['idsend'];
    $id_receive = $_GET['idreceive'];
    $message = $_POST['message'];
    $sql = "INSERT INTO messages(user_id_send, user_id_receive, message) VALUES($id_send, $id_receive, '$message')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "success";
    };
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Site</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-info sticky-top bg-dark flex-md-nowrap p-10">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="" style="color: #ffffff;"><b>Home</b></a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="../logout.php"> <?php echo ucwords($_SESSION['NAME']); ?> Log out</a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-dark sidebar" style="height: 100vh">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column" style="color: #ffffff;">

                        <h6>Manage</h6>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <span data-feather="users"></span>
                                Users
                            </a>
                        </li>

                        <h6>Game</h6>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <span data-feather="users"></span>
                                Quiz
                            </a>
                        </li>

                        <h6>Assignments</h6>
                        <li class="nav-item">
                            <a class="nav-link" href="upload.php">
                                <span data-feather="users"></span>
                                Add
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="fileUpload" value="">
                    <input type="submit" name="up" value="Upload">
                </form>
                <?php
                if (isset($_POST['up']) && isset($_FILES['fileUpload'])) {
                    if ($_FILES['fileUpload']['error'] > 0)
                        echo "Upload failed!";
                    else {
                        move_uploaded_file($_FILES['fileUpload']['tmp_name'], 'upload/' . $_FILES['fileUpload']['name']);
                        echo "upload successfully <br/>";
                        echo 'Directory: upload/' . $_FILES['fileUpload']['name'] . '<br>';
                        echo 'File type: ' . $_FILES['fileUpload']['type'] . '<br>';
                        echo 'File size: ' . ((int)$_FILES['fileUpload']['size'] / 1024) . 'KB';
                    }
                }
                ?>
            </main>
        </div>
</body>

</html>