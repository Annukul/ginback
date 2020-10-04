<style>
    .right {
        font-family: 'Montserrat', sans-serif;
        display: flex;
        flex-direction: column;
        width: auto;
        height: auto;
        position: relative;
    }

    .author {
        padding: 10px 5px 10px 5px;
        width: 400px;
        height: auto;
        margin-bottom: 20px;
        cursor: pointer;
        background-color: white;
        border: 1px solid gainsboro;
        border-radius: 3px;
        cursor: pointer;
        transition: all 0.6s ease;
    }
    .author-img {
        align-self: center;
        border-radius: 40%;
    }

    .author:hover > .inside {
        margin-left: 10px;
    }

    .author:hover {
        box-shadow: 10px 10px 5px 5px #EAF0F1;
        border-left: 5px solid purple;
    }

    .author a:hover {
        color: purple;
    }
    .ul .li {
        display: block;
    }
    .social-media a {
      font-size: 30px;
      margin-left: 20px;
    }
    .social-media {
      display: flex;
      flex-direction: row;
    }
</style>
<div class="right">
    <div class="author">
        <div class="inside">
            <img src="assets/img/odeya.jpg" alt="Author" class="author-img" width="150px" height="120px">
            <h3 class="author-name"><?php echo $name; ?></h3>
            <p class="author-p"><?php echo $about_user; ?></p>
            <a href="<?php echo ROOT_URL; ?>about.php" class="author-more">Know more..</a>
        </div>
    </div>

    <div class="author recent-posts">
        <h3 class="recent">Recent Posts</h3>
        <div class="inside">
            <ul class="ul">
                <li class="li">+ <a href="#">First</a></li>
                <li class="li">+ <a href="#">Second</a></li>
                <li class="li">+ <a href="#">Third</a></li>
                <li class="li">+ <a href="#">Fourth</a></li>
            </ul>
        </div>
    </div>

    <div class="author categories">
        <div class="inside">
            <h3 class="recent">Categories</h3>
            <ul class="ul">
                <li class="li">~ <a href="#">Travel</a></li>
                <li class="li">~ <a href="#">Environment</a></li>
                <li class="li">~ <a href="#">Local Connection</a></li>
                <li class="li">~ <a href="#">Stories</a></li>
            </ul>
        </div>
    </div>

    <div class="author social-media">
        <div class="inside">
            <h3 class="recent">Follow me</h3>
            <ul class="ul">
                <li class="lii"><a href="https://instagram.com/the_magicpineapple.com/" target="_blank"><i class="fab fa-instagram-square"></i></a></li>
                <li class="lii"><a href="https://facebook.com/annukul003/" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                <li class="lii"><a href="https://twitter.com/Annukul003/" target="_blank"><i class="fab fa-twitter-square"></i></a></li>
                <li class="lii"><a href="https://www.reddit.com/user/Annukul" target="_blank"><i class="fab fa-reddit-square"></i></a></li>
                <li class="lii"><a href="https://www.medium.com/@thakrananukul" target="_blank"><i class="fab fa-medium"></i></a></li>
            </ul>
        </div>
    </div>
</div>
