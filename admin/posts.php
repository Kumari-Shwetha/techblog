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
        
        $sql="delete from `posts` where id='$id'";
        $result=$crud->execute($sql);

        if($result == false)
        {
            $output='danger';
            $errorMessages[]="Something went wrong, try again..!!!";
        }
        else
        {
            $output='success';
            $errorMessages[]="Post has been deleted successfully..!!!";
        }

    }
    $sql="select * from posts order by id desc";
    $rows=$crud->read($sql);

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
        function delpost(id,title)
        {
            if(confirm("Are you sure want to delete '"+title+"' ?"))
            {
                window.location.href="posts.php?id="+id;
            }
        }

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
                    <h1 class="mt-4">Posts</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">
                            <a href="index.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Posts</li>
                    </ol>
                         <?php
                            if(!empty($errorMessages) && is_array($errorMessages))
                            {
                        ?>
                                <div class="alert alert-<?php echo $output; ?>">
                                    <?php 
                                        foreach($errorMessages as $errorMessage)
                                        {
                                            echo $errorMessage."<br/>";
                                        }
                                    ?>
                                </div>
                        <?php
                            }
                        ?>
                   
                    <div class="card mb-4">
                        <div class="card-header">
                            <a href="add-post.php"><button type="button"
                                    class="btn btn-primary btn-xs btn-addon s-b-10 s-l-5"><i
                                        class="fas fa-plus mr-1"></i> Add new post</button></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Tags</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                        foreach($rows as $key=>$row)
                                        {
                                            $sql="select * from `category` where id='".$row['category']."'";
                                            $cat_row=$crud->read($sql,$row['category']);
                                    ?>                                  
                                        <tr>
                                            <td><?php echo $key+1; ?></td>
                                            <td><?php echo $cat_row['title']; ?></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo  $row['author']; ?></td>
                                            <td><?php echo  $row['tags']; ?></td>
                                            <td><img src="assets/img/uploads/<?php echo  $row['image']; ?>" class="postimg img-fluid" /></td>
                                            <td><a href="edit-post.php?id=<?php echo $row['id']; ?>"><button type="button"
                                                        class="btn btn-primary btn-xs btn-addon s-b-10 s-l-5"><i
                                                            class="fa fa-edit"></i> Edit</button></a> | <a
                                                    href="javascript:delpost('<?php echo $row['id']; ?>','<?php echo $row['title']; ?>')"><button
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