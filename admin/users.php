<?php
    require_once("includes/config.php");
    require_once("classes/crud.php");
    
    if(!$crud->is_logged_in())
    {
        header("location:login.php");
    }
    if(isset($_GET['id']))
    {
        $errorMessages=array();
        $id=$_GET['id'];

        $sql="delete from `user` where `id`='$id'";

        $result=$crud->execute($sql);
        
        if($result == false)
        {
            $output="danger";
            $errorMessages[]="Something went wrong,try again..!!";
        }
        else
        {
            $output='success';
            $errorMessages[]="User has been deleted successfully..!!!";            
        }
    }
    $sql="select * from `user` order by id desc";
    $users=$crud->read($sql);
    
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
    <script>
        function deluser(id,title)
        {
            if(confirm("Are you sure want to delete '"+title+"'?"))

            {
                window.location.href="users.php?id="+id;
            }

        }
    </script>
</head>

<body class="sb-nav-fixed">
    <?php include("includes/nav.php"); ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
        <?php include("includes/sidebar.php"); ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Users</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">
                            <a href="index.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                        <?php
                            if(!empty($errorMessages) && is_array($errorMessages))
                            {
                                foreach($errorMessages as $errorMessage)
                                {
                        ?>
                                    <div class="alert alert-<?php echo $output; ?>">
                                    <?php 
                                        echo $errorMessage . "<br/>";
                                    ?>
                                    </div>
                             <?php   
                                }
                            }
                        ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <a href="add-user.php"><button type="button"
                                    class="btn btn-primary btn-xs btn-addon s-b-10 s-l-5"><i
                                        class="fas fa-plus mr-1"></i> Add new user</button></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach($users as $key=>$user)
                                        {
                                    ?>
                                        <tr>
                                            <td><?php echo $key+1; ?></td>
                                            <td><?php echo $user['username']; ?></td>
                                            <td><?php echo $user['email']; ?></td>
                                            <td><a href="edit-user.php?id=<?php echo $user['id']; ?>"><button type="button"
                                                        class="btn btn-primary btn-xs btn-addon s-b-10 s-l-5"><i
                                                            class="fa fa-edit"></i> Edit</button></a> | <a
                                                    href="javascript:deluser('<?php echo $user['id']; ?>','<?php echo $user['username']; ?>')"><button
                                                        type="button"
                                                        class="btn btn-danger btn-xs btn-addon s-b-10 s-l-5"><i
                                                            class="fa fa-trash"></i> Delete</button></a></td>

                                        </tr>
                                    <?php
                                        }
                                    ?>  
                                    </tbody>
                                </table>
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