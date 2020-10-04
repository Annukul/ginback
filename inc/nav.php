<div class="container">
    <header>
        <nav>
            <div class="col-menu">
                <div id="mySidebar" class="sidebar">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <p class="session-name">Welcome, <?php echo $_SESSION['name']; ?></p>
                        <form action="logout.php" method="POST">
                            <input type="submit" value="Logout" name="logout" class="logout">
                        </form>
                    <?php endif; ?>
                    <a href="index">Home</a>
                    <a href="#">About</a>
                    <a href="#">Videos</a>
                    <a href="#">Contact</a>
                    <a href="#">Reviews</a>
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <a href="updateUser">Profile</a>
                        <a href="add">Add post</a>
                    <?php endif; ?>
                    <form action="subscribe" method="POST">
                        <p>Subscribe to our newsletter!</p>
                        <input type="email" name="sub_email" class="sub-email">
                        <input type="submit" name="subscribe" value="Subscribe" class="sub-submit">
                    </form>
                </div>
                <div id="col-menu-btn">
                    <button class="openbtn" onclick="openNav()">☰</button>
                </div>
            </div>

            <div class="nav-content">
                <div class="nav-content-left">
                    <img src="assets/img/logo.png" alt="GIN logo" style="width:130px; height:130px">
                    <p>Gaming Industry News</p>
                </div>
                <div class="nav-content-right">
                    <form action="" class="nav-content-right-form">
                        <input type="search" name="search" class="search-input">
                        <input type="submit" value="Search" class="submit-input">
                    </form>
                    <a href="#" onclick="openNav()" class="icons"><i><img src="assets/img/email.png" style="width: 35px; height: 35px"></i></a>
                    <a href="<?php if (isset($_SESSION['name'])){ echo 'logout';} else {echo 'login';} ?>" class="icons"><i><img src="assets/img/manager.png" style="width: 35px; height: 35px"></i></a>
                </div>
            </div>
        </nav>
    </header>