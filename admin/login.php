<?php
    require_once("includes/config.php");
    require_once("classes/crud.php");
    if($crud->is_logged_in())
    {
        header("location:index.php");
    }
                                       
    if(isset($_POST['loginBtn']))
    {
        $email=$crud->escapeString($_POST['email']);
        $password=$crud->escapeString($_POST['password']);

        $sql="select * from user where `email`='$email'";
        
        $result=$crud->login($sql);

       // echo password_hash('$password',PASSWORD_BCRYPT);

        if($result == false)
        {
            $_SESSION['message']="Your entered wrong email!";
        }
        else
        {
            
            if(password_verify($password,$result['password']))
            {
                $_SESSION['loggedin']=true;
                $_SESSION['user_id']=$result['id'];
                $_SESSION['username']=$result['username'];

                header("location:index.php");
            }
            else
            {
                 $_SESSION['message']="Your entered wrong password!";
                
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control py-4" id="inputEmailAddress" name="email" type="email" placeholder="Enter email address" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Enter password" required />
                                        </div>
                                         <div class="form-group">
                                           <p class="text-danger">
                                           <?php
                                                if(isset($_SESSION['message']))
                                                {
                                                     echo $_SESSION['message'];
                                                     unset($_SESSION['message']);
                                                }                                               
                                             ?>
                                            </p>
                                        </div>
                                        <div
                                            class="form-group d-flex align-items-center justify-content-end  mt-4 mb-0">
                                            <input type="submit" class="btn btn-primary" value="Login" name="loginBtn">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <?php include("includes/footer.php"); ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
</body>

</html>