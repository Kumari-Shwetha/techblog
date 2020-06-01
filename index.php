<?php require("includes/header.php"); ?>
<!--navigation starts-->
<?php require("includes/nav.php"); ?>
<!--navigation ends-->
<?php
    //echo "<prev>";
    //echo print_r($_SERVER);
?>
    <div class="all-container">
        <div class="wrapper">
            <div class="left-div">
                <div class="blog-listing">
                   <?php
                    $url="/techblog/";
                    if(isset($_GET['cat_slug']))
                    {
                        $cat_slug=$_GET['cat_slug'];
                        $url=$url."category/".$cat_slug."/";
                    }
                    $query=getQuery($cat_slug,'');
                    $records_per_page=3;
                    $starting_position=0;

                    if(isset($_GET["page_no"]))
                    {
                       $page_no =$_GET["page_no"];
                       $starting_position=($_GET["page_no"]-1)*$records_per_page;
                    }
                    //echo $sql=$query." LIMIT $starting_position,$records_per_page";
    
                    $res =getPosts($query,$starting_position,$records_per_page);

                    if($res['status'] == 202){
                        foreach ($res['result'] as $row) {

                            // convert date and time to seconds 
                            $sec = strtotime($row['date']); 
  
                            // convert seconds into a specific format 
                            $date = date("d-M-Y", $sec); 
                        ?>
                        <div class="blog-listing-item">
                            <h2><a href="/techblog/post/<?php echo $row['slug']; ?>"><?php echo $row['title']; ?></a></h2>
                            <div class="blog-listing-item-img">
                                <a href="/techblog/post/<?php echo $row['slug']; ?>"><img src="/techblog/admin/assets/img/uploads/<?php echo $row['image']; ?>" alt="blog post image"></a>
                            </div>
                            <div class="blog-listing-info">
                                <ul class="flex-row">
                                    <li><i class="fas fa-calendar-alt"></i><span>On:</span><?php echo $date; ?></li>
                                    <li><i class="fas fa-folder-open"></i><span>Category:</span><?php echo $row['category_title']; ?></li>
                                </ul>
                            </div>
                            <p><?php echo $row['description']; ?>
                            </p>
                            <a href="/techblog/post/<?php echo $row['slug']; ?>" class="btn-readmore">Continue Reading <i class="fas fa-arrow-right"></i></a>
                        </div>
                        <?php }
                        }
                        else if($res['status'] == 303){
                        ?>
                            <div class="blog-listing-item">
                                <h2><?php echo $res['result']; ?></h2>
                            </div>
                       <?php } ?>

                       <?php
                        paginglink($url,$query,$records_per_page,$page_no)
                       ?>
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