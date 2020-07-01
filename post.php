<?php require("includes/header.php"); ?>
    <!--navigation starts-->
<?php require("includes/nav.php"); ?>
    <!--navigation ends-->
    <div class="all-container">
        <div class="wrapper">
            <div class="left-div">
                <div class="blog-listing">
                   <?php
                     if(isset($_GET['post_slug']))
                    {
                        $post_slug=$_GET['post_slug'];
                    }
                    $query1=getQuery('',$post_slug);
                    $res =getPosts($query1,0,1);
                    if($res['status'] == 202){
                        foreach ($res['result'] as $row) {
                            // convert date and time to seconds 
                            $sec = strtotime($row['date']); 
  
                            // convert seconds into a specific format 
                            $date = date("d-M-Y", $sec); 
                    ?>
                    <div class="blog-listing-item">
                        <h2><a href="/web-trends/post/<?php echo $row['slug']; ?>"><?php echo $row['title']; ?></a></h2>
                        <div class="blog-listing-item-img">
                            <a href="/web-trends/post/<?php echo $row['slug']; ?>"><img src="/web-trends/admin/assets/img/uploads/<?php echo $row['image']; ?>" alt="blog post image"> alt=""></a>
                        </div>
                        <div class="blog-listing-info">
                            <ul class="flex-row">
                                <li><i class="fas fa-calendar-alt"></i><span>On:</span><?php echo $date; ?></li>
                                <li><i class="fas fa-folder-open"></i><span>Category:</span><?php echo $row['category_title']; ?></li>
                            </ul>
                        </div>
                        <div class="blog-content"><?php echo $row['content']; ?>
                        </div>
                    </div>
                    <?php }
                    } ?>
                </div>
                <!--end of blog listing-->
            </div>
            <?php require("includes/sidebar.php"); ?>
            <!--end of col-md-5-->
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
<?php require("includes/footer.php"); ?>
