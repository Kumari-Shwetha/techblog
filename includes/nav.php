<div class="top-line"></div>
<div class="top-bar">
    <div class="nav-menu flex-row">
        <div class="logo">
            <a href="/techblog/">Tech<span>Blog</span></a>
        </div>
        <div class="search-bar">
            <div class="form-wrapper">
                <form method="get" action="/techblog/search" onsubmit='return prettySubmit(this, event);'>
                    <input type="text" name="q" value="<?php if (isset($_GET['q'])) echo $_GET['q']; ?>" placeholder="Search..." >
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>