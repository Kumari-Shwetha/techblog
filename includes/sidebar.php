<div class="right-div padding-left">
    <div id="sidebar">
        <div class="right-box sidebar">
            <div class="right-card">
                <div class="head">
                    <h4>Categories</h4>
                </div>
                <div class="sidebar-content-wrapper">
                    <ul class="category-list-group">
                    	<?php
    					$rows_cat=getCategory();
    					foreach ($rows_cat as $row_cat) {

        				?>
                        <li class="list-group-item"><a href="/web-trends/category/<?php echo $row_cat['cat_slug']; ?>"><?php echo $row_cat['title']; ?></a><span>(<?php echo $row_cat['count_cat']; ?>)</span></span></li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="right-card">
                <div class="head">
                    <h4>Recent Post</h4>
                </div>
                <div class="sidebar-content-wrapper">
                    <?php
                    $query1=getQuery('','');
                    $recent_post =getPosts($query1,0,5);
                    if($recent_post['status'] == 202){
                    foreach ($recent_post['result'] as $row) {
                        // convert date and time to seconds 
                            $sec = strtotime($row['date']); 
  
                            // convert seconds into a specific format 
                            $date = date("d-M-Y", $sec); 
                    ?>
                    <div class="recent-post">
                        <div class="media">
                            <div class="latest-post-img">
                                <a href="/web-trends/post/<?php echo $row['slug']; ?>">
                                    <img src="/web-trends/admin/assets/img/uploads/<?php echo $row['image']; ?>" alt="">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="/web-trends/post/<?php echo $row['slug']; ?>"><?php echo $row['title']; ?></a>
                                </h4>
                                <ul class="recent-post-icon">
                                    <li>
                                        <!-- 2nd Jun 2018-->
                                        <span><i class="fas fa-calendar-alt"></i> <?php echo $date; ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } 
                }?>
                <!--latest post ends-->
                </div>
            </div>
            <!--div class="right-card">
                <div class="head">
                    <h4>Tags</h4>
                </div>
                <div class="sidebar-content-wrapper">
                    <div class="flex-row tags">
                        <?php
                        $tags_res=getTags();
                        foreach ($tags_res as $tag) {
                        ?>
                             <span><?php echo $tag; ?></span>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div-->
        <!--right box ends-->
        </div>
    </div>
</div>
