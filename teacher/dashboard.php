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

                <div class="table-responsive">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="mb-3 clearfix col-12" style="margin: 0 -15px;">
                                <h2 class="pull-left">Users Info</h2>
                                <div style="display: flex;justify-content: space-between;">
                                    <div>
                                        <a class="btn btn-success" href="create.php">ADD</a>
                                    </div>
                                    <div>
                                        <a class="btn btn-success" href="message.php?action=send">MESSAGE SEND</a>
                                        <a class="btn btn-success" href="message.php?action=receive">MESSAGE RECEIVE</a>
                                    </div>
                                </div>
                            </div>
                            <?php

                            // Attempt select query execution
                            $sql = "SELECT * FROM users";
                            if ($result = mysqli_query($con, $sql)) {
                                if (mysqli_num_rows($result) > 0) {
                                    echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th>Id</th>";
                                    echo "<th>Name</th>";
                                    echo "<th>Fullname</th>";
                                    echo "<th>Email</th>";
                                    echo "<th>Phone</th>";
                                    echo "<th>Role</th>";
                                    echo "<th>Action</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo "<td>" . $row['fullname'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['phonenum'] . "</td>";
                                        echo "<td>" . $row['role'] . "</td>";
                                        echo "<td style='width: 180px;'>
                                            <button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#exampleModal\" data-whatever=\"" . $row['username'] . "\" data-id=\"" . $row['id'] . "\"" . ($row['id'] === $_SESSION['ID'] ? "disabled" : "") . ">Message</button>
                                            <a href=\"edit.php?id=" . $row['id'] . "\" class='btn btn-primary'>Edit</a>
                                            <a href=\"delete.php?id=" . $row['id'] . "\" class='btn btn-danger'>Delete</a>
                                        </td>";
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
    <!-- Modal boostrap example -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Receiver:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text" name="message"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-form">Close</button>
                    <button type="button" class="btn btn-primary" id="sendmsg">Send message</button>
                </div>
            </div>
        </div>
    </div>
    ...
    </div>
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
            $("#sendmsg").attr('data-id', button.data('id'))
        })
        $("#sendmsg").on("click", function(e) {
            $.ajax({
                url: "dashboard.php?idsend=" + <?php print_r($_SESSION['ID']) ?> + "&idreceive=" + $(this).attr("data-id"),
                method: "POST",
                data: {
                    message: $("#message-text").val()
                },
                success: function(data) {
                    if (data === "success") {
                        alert("Message sent successfully")
                        $('#close-form').click()
                    }
                }
            })
        })
    </script>
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        feather.replace();
    </script>
</body>

</html>