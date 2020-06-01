<?php
    require_once("includes/config.php");
    require_once("classes/crud.php");
    if(!$crud->is_logged_in())
    {
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - techblog</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="sb-nav-fixed">
<?php include("includes/nav.php"); ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
        <?php include("includes/sidebar.php");?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4 box">
                                <div class="card-body"><i class="fas fa-sticky-note"></i></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="text-white stretched-link" href="posts.php">Total Posts</a>
                                    <div class="text-white">
                                        <?php
                                        $query_post="SELECT * FROM posts";
                                        echo $crud->numRows($query_post);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4 box">
                                <div class="card-body"><i class="fas fa-list-ul"></i></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="text-white stretched-link" href="categories.php">Total Categories</a>
                                    <div class="text-white">
                                        <?php
                                        $query_post="SELECT * FROM category";
                                        echo $crud->numRows($query_post);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4 box">
                                <div class="card-body"><i class="fas fa-users"></i></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="text-white stretched-link" href="users.php">Total Users</a>
                                    <div class="text-white">
                                    <?php
                                        $query_post="SELECT * FROM user";
                                        echo $crud->numRows($query_post);
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4 box">
                                <div class="card-body"><i class="fas fa-eye"></i></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="text-white stretched-link" target="_blank" href="/techblog/">view website</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include("includes/footer.php"); ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

</html>