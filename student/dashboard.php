<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Site</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-info sticky-top bg-warning flex-md-nowrap p-10">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="" style="color: #F0F8FF;"><b>Home</b></a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="../logout.php"> <?php echo ucwords($_SESSION['NAME']); ?> Log out</a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-warning sidebar" style="height: 100vh">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column" style="color: #F0F8FF;">
                        <li class="nav-item">
                            <a class="nav-link active" href="">
                                <span data-feather="home"></span>
                                Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <h6>Manage Info</h6>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <span data-feather="users"></span>
                                Edit
                            </a>
                        </li>
                        <h6>View</h6>
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
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
                    <h1 class="h2">Dashboard</h1>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
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