<?php
    require_once("includes/config.php");
    require_once("classes/crud.php"); 
    if(!$crud->is_logged_in())
    {
        header("location:login.php");
    }
    require_once("includes/functions.php");

    if(isset($_POST['addUserBtn']))
    {
        $valid=1;
        $errorMessages=array();

        $username=$crud->escapeString($_POST['username']);
        $email=$crud->escapeString($_POST['email']);
        $password=$crud->escapeString($_POST['password']);
        $confirmpassword=$crud->escapeString($_POST['confirmpassword']);

        $valid=validateFormData($valid);
        //all validation
        if($valid == 0)
        {
            $output='danger';
            $errorMessages[]="All the fields are required";
        } 
        if(!empty($password) && !empty($confirmpassword))
        {
            if($password != $confirmpassword)
            {
                $output='danger';
                $errorMessages[]="Password and confirm password not same";
                $valid=0;
            }
        }      
        if(!empty($email))
        {
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) 
            {
                $output='danger';
                $errorMessages[]="Invalid Email";
                $valid=0;   
            }
        }       
        if($valid == 1)
        {
            $hash=password_hash($password,PASSWORD_BCRYPT);

            $sql="insert into `user`(`username`,`email`,`password`)values('$username','$email','$hash')";

            $result=$crud->execute($sql);

            if($result == false)
            {
                $output="danger";
                $errorMessages[]='Some problems occured,try again!';
                $valid=0;
            }
            else
            {
                $output='success';
                $errorMessages[]="User has been added successfully..!!!";
            }
        }
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
                    <h1 class="mt-4">Users</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">
                            <a href="index.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Add user</li>
                    </ol>
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <div class="card rounded-lg mt-4">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <?php
                                             if(!empty($errorMessages) && is_array($errorMessages))
                                            {
                                        ?>
                                            <div class="alert alert-<?php echo $output;?>" role="alert">
                                                <?php 
                                                    foreach($errorMessages as $errorMessage)
                                                    {
                                                        echo $errorMessage . "<br/>";
                                                    }                                                   
                                                ?>
                                            </div>
                                        <?php
                                             }
                                        ?>
                                    </div>
                                    <form method="POST" action="">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="small mb-1" for="username">Username</label>
                                                <input class="form-control py-4" id="username" type="text"
                                                    placeholder="Enter Username" name="username"  value="<?php echo !empty($username)?$username:''; ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="small mb-1" for="email">Email</label>
                                                <input class="form-control py-4" id="email" type="text"
                                                    placeholder="Enter Email" name="email"  value="<?php echo !empty($email)?$email:''; ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="small mb-1" for="Password">Password</label>
                                                <input class="form-control py-4" id="password" type="password"
                                                    placeholder="Enter Password" name="password"  value="<?php echo !empty($password)?$password:''; ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="small mb-1" for="confirmpassword">Confirm Password</label>
                                                <input class="form-control py-4" id="confirmpassword" type="password"
                                                    placeholder="Enter Confirm Password" name="confirmpassword"  value="<?php echo !empty($confirmpassword)?$confirmpassword:''; ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mt-4 mb-0">
                                                <input type="submit" class="btn btn-primary" name="addUserBtn" value="Add new user">
                                            </div>
                                        </div>

                                    </form>
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