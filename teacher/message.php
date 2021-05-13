<?php
session_start();
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
                            <a class="nav-link" href="">
                                <span data-feather="users"></span>
                                Add
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

                <div class="table-responsive">
                    <div class="container-fluid">
                        <div class="row">
                            <?php
                            // Include config file
                            require_once "../config.php";

                            // Attempt select query execution
                            $sql = "";
                            $user_msg = "";
                            $title_msg = "";
                            if (isset($_GET['action']) && $_GET['action'] === 'send') {
                                $sql = "SELECT * FROM messages WHERE user_id_send=" . $_SESSION["ID"];
                                $user_msg = 'Receive';
                                $title_msg = "sent";
                            }
                            if (isset($_GET['action']) && $_GET['action'] === 'receive') {
                                $sql = "SELECT * FROM messages WHERE user_id_receive=" . $_SESSION["ID"];
                                $user_msg = 'Send';
                                $title_msg = "received";
                            }
                            ?>
                            <div class="mb-3 clearfix col-12" style="margin: 0 -15px;">
                                <h2 class="pull-left">Message <?php echo $title_msg; ?></h2>
                                <a class="btn btn-success" href="dashboard.php">BACK</a>
                            </div>
                            <?php
                            if ($result = mysqli_query($con, $sql)) {
                                if (mysqli_num_rows($result) > 0) {
                                    echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th>Id</th>";
                                    echo "<th>" . $user_msg . "</th>";
                                    echo "<th>Messages</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        $sql2 = "SELECT fullname FROM users WHERE id=" . $row['user_id_receive'];
                                        $username2 = "";
                                        while ($row2 = mysqli_fetch_array(mysqli_query($con, $sql2))) {
                                            $username2 = $row2['fullname'];
                                            break;
                                        }
                                        echo "<td>" . $username2 . "</td>";
                                        echo "<td>" . $row['message'] . "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    // Free result set
                                    mysqli_free_result($result);
                                } else {
                                    echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                }
                            } else {
                                echo "Oops! Something went wrong. Please try again later.";
                            }

                            // Close connection
                            mysqli_close($con);
                            ?>
                        </div>
                    </div>
            </main>
        </div>
    </div>
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        feather.replace();
    </script>
</body>

</html>