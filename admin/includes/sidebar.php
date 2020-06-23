<nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link" href="index.php">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
               <!------------category-->
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts2"
                aria-expanded="false" aria-controls="collapseLayouts2">
                <div class="sb-nav-link-icon"><i class="fas fa-list-ul"></i></div>
                Category
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
                data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="categories.php">All categories</a>
                    <a class="nav-link" href="add-category.php">Add Category</a>
                </nav>
            </div>
            <!--------posts-------->
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts1"
                aria-expanded="false" aria-controls="collapseLayouts1">
                <div class="sb-nav-link-icon"><i class="fas fa-sticky-note"></i></div>
                Posts
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne"
                data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="posts.php">All Posts</a>
                    <a class="nav-link" href="add-post.php">Add Post</a>
                </nav>
            </div>
         
            <!--user-->
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts3"
                aria-expanded="false" aria-controls="collapseLayouts3">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                User
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne"
                data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="users.php">All Users</a>
                    <a class="nav-link" href="add-user.php">New User</a>
                </nav>
            </div>
            <!--view website-->
            <a class="nav-link" href="/techblog/" target="_blank">
                <div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
                View Website
            </a>
        </div>
    </div>
</nav>
