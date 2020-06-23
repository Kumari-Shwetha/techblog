<?php
    require_once("includes/config.php");
    require_once("classes/crud.php");
    require_once("includes/functions.php");

    if(!$crud->is_logged_in())
    {
        header("location:login.php");
    }
    //if(isset($_POST['category']))
  
    if(isset($_POST['editPost']))
    {
        $valid=1;
        $errorMessages=array();

        $category=$crud->escapeString($_POST['category']);
        $title=$crud->escapeString($_POST['title']);
        $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($title)));
        $description=$crud->escapeString($_POST['description']);
        $content=$crud->escapeString($_POST['content']);
        $author=$crud->escapeString($_POST['author']);
        $tags=$crud->escapeString($_POST['tags']);
        $id=$crud->escapeString($_GET['id']);

        $folder="assets/img/uploads/";
        $filename=$_FILES['image']['name'];

        if(!empty($id))
        {
            $valid=validateFormData($valid);

            if($valid == 0)
            {
                $output='danger';
                $errorMessages[]="All the fields are required";
            }
            if(!empty($filename))
            {
                
                $target_file=$folder.basename($_FILES['image']['name']);
                $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
                $allowed=array('jpeg','png','jpg');

                if(!in_array($imageFileType,$allowed))
                {
                    $output='danger';
                    $errorMessages[]="Sorry, only JPG, JPEG, PNG files are allowed.";
                    $valid=0;
                }

            }

            if($valid == 1)
            {
                $date = date('Y-m-d h:i:s');

                echo $query="SELECT id,slug FROM posts WHERE slug='$slug'";
                $result=$crud->read($query);
                print_r($result);

                if($result['id'] != $id){
                    $query="SELECT id,slug FROM posts WHERE slug LIKE '$slug%'";
                    $total_row=$crud->numRows($query);

                    if($total_row > 0){

                        $result= $crud-> read($query);
                        foreach ($result as $row) {
                           $data[]=$row['slug'];
                        }
                        if(in_array($slug,$data))
                        {
                            $count = 0;
                            while(in_array(($slug . '-' . ++$count), $data));
                            $slug = $slug . '-' . $count;
                        }
                    }
                }
                
           
                if(!empty($filename))
                {
                    move_uploaded_file($_FILES['image']['tmp_name'],$target_file);
                    $sql="update `posts` set `category`='$category',`title`='$title',`slug`='$slug',`description`='$description',`content`='$content',`author`='$author',`tags`='$tags',`date`='$date',`image`='$filename' where `id`='$id'";
                }
                else
                {
                    $sql="update `posts` set `category`='$category',`title`='$title',`slug`='$slug',`description`='$description',`content`='$content',`author`='$author',`tags`='$tags',`date`='$date' where `id`='$id'";
                }
                $result=$crud->execute($sql);

                if($result == false)
                {
                    $output='danger';
                    $errorMessages[]="Some error occured,try again !";
                }
                else
                {
                    $error=false;
                    $output='success';
                    $errorMessages[]="Post has been updated successfully";
                }
            }
        }
       else
       {
            $output='danger';
            $errorMessages[]="Invalid Post ID";
       }

    }

    $sql="select * from category order by id desc";
    $rows=$crud->read($sql);

    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $sql_post="select * from posts where id='$id'";
        $post=$crud->read($sql_post,$id);
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
    <link rel="stylesheet" href="http://tinymce.cachefly.net/4.0/skins/lightgray/skin.min.css">
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
                    <h1 class="mt-4">Posts</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">
                            <a href="index.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Edit post</li>
                    </ol>
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <div class="card rounded-lg mt-4">
                                <div class="card-body">
                                    <div class="col-md-12">
                                    <?php
                                        if(!(empty($errorMessages)) && is_array($errorMessages))
                                        {
                                    ?>
                                            <div class="alert alert-<?php echo $output; ?>">
                                                <?php 
                                                    foreach($errorMessages as $errorMessage)
                                                    {
                                                        echo $errorMessage. "<br/>";
                                                    }
                                                ?>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                    </div>
                                    <form method="POST" action="" enctype="multipart/form-data">
                                         <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="small mb-1" for="category">Category</label>
                                                <select class="form-control" id="category" name="category">
                                                    <?php
                                                        foreach($rows as $key=>$row)
                                                        {
                                                            if(isset($_POST['category']))
                                                            {
                                                                $selected=($row['id'] == $_POST['category'])?'selected':''; 
                                                            }
                                                            else
                                                            {
                                                                $selected=($row['id'] == $post['category'])?'selected':''; 
                                                                    
                                                            }
                                                        ?>
                                                            <option value="<?php echo $row['id'];?>" <?php echo $selected; ?>><?php echo $row['title']; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="small mb-1" for="title">Title</label>
                                                <input class="form-control" id="title" type="text"
                                                    placeholder="Enter Post Title" name="title" value="<?php echo isset($_POST['title'])?$_POST['title']:$post['title']; ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><label class="small mb-1"
                                                    for="desc">Description</label>
                                                <textarea class="form-control" id="desc"
                                                    placeholder="Enter Description" name="description"><?php echo isset($_POST['description'])?$_POST['description']:$post['description']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group"><label class="small mb-1"
                                                    for="content">Content</label>
                                                <textarea class="form-control" id="content"
                                                    placeholder="Enter Content" name="content"><?php echo isset($_POST['content'])?$_POST['content']:$post['content']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="small mb-1" for="author">Author</label>
                                                <input class="form-control" id="author" type="text"
                                                    placeholder="Enter Post Author" name="author" value="<?php echo isset($_POST['author'])?$_POST['author']:$post['author']; ?>" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group"><label class="small mb-1"
                                                    for="tags">Tags(seperated by comma)</label>
                                                <textarea class="form-control" id="tags"
                                                    placeholder="Enter Tags" name="tags"><?php echo isset($_POST['author'])?$_POST['author']:$post['author']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group"><label class="small mb-1"
                                                    for="image">Image</label><input id="image" type="file"
                                                    placeholder="Attach file" name="image"  /></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mt-4 mb-0">
                                                <input type="submit" class="btn btn-primary" value="Update Post" name="editPost">
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
    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
    <script>
        tinymce.init({
            selector: "textarea#content",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>
</body>

</html>
