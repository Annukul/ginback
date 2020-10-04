<?php
require_once './bootstrap.php';
$db = new Database;
$db->query("SELECT * FROM posts WHERE featured_post='1'");
$featured_post = $db->single();
$id = $featured_post->user_id;
// Get Author details
$db->query("SELECT * FROM users WHERE user_id='$id'");
$user = $db->single();

// NEWS CATEGORY
$db->query("SELECT * FROM posts WHERE category='news' LIMIT 3");
$news = $db->resultSet();

$dataN = [
    'posts' => $news
];

// GAMING CATEGORY
$db->query("SELECT * FROM posts WHERE category='gaming' LIMIT 3");
$gaming = $db->resultSet();

$dataG = [
    'posts' => $gaming
];

// HARDWARE CATEGORY
$db->query("SELECT * FROM posts WHERE category='hardware' LIMIT 3");
$hardware = $db->resultSet();

$dataH = [
    'posts' => $hardware
];

?>
<?php
require_once 'inc/header.php';
?>
<div class="content">
    <!-- <div class="options">
        <a href="#">
            <p>News</p>
        </a>
        <a href="#">
            <p>Gaming</p>
        </a>
        <a href="#">
            <p>Hardware</p>
        </a>
        <a href="#">
            <p>Reviews</p>
        </a>
        <a href="#">
            <p>Videos</p>
        </a>
    </div> -->
    <div class="topnav" id="myTopnav">
        <a href="categories?cat=news" class="active">News</a>
        <a href="categories?cat=gaming">Gaming</a>
        <a href="categories?cat=hardware">Hardware</a>
        <a href="categories?cat=allposts">All Posts</a>
        <!-- <div class="dropdown">
            <button class="dropbtn">Categories
            </button>
            <div class="dropdown-content">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
        </div> -->
        <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>
    <div class="ft-pt">
        <div class="ft-pt-img">
            <!-- <button id="vidbutton">Play</button>  -->
            <!-- <br><br> -->
            <video id="myvid" width="420" controls autoplay>
                <source src="../vid/video.mp4" type="video/mp4">
                <source src="../vid/video.ogg" type="video/ogg">
                Your browser does not support HTML5 video.
            </video>
        </div>
        <div class="ft-pt-text">
            <a href="#">
                <p class="post-heading"><strong><?php echo $featured_post->title; ?></strong></p>
            </a>
            <small class="post-auth">by <?php echo $user->name; ?> on <?php echo $featured_post->post_created_at; ?> in Gaming</small>
            <p><?php echo $featured_post->body; ?></p>
            <a href="showPost?id=<?php echo $featured_post->post_id; ?>" class="readmore">Read more...</a>
        </div>
    </div>


    <p class="cats">Posts</p>

    <div class="pt-cat">
        <div class="pt-cat-left">
            <a href="categories?cat=news" class="pt-cat-head">
                <p>News</p>
            </a>
            <?php foreach($dataN['posts'] as $post) : ?>
                <div class="one">
                    <img src="assets/images/cod.jpg" alt="">
                    <a href="showPost?id=<?php echo $post->post_id; ?>">
                        <p class="post-heading"><strong><?php echo $post->title; ?></strong></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>


        <div class="pt-cat-mid">
            <a href="categories?cat=gaming" class="pt-cat-head">
                <p>Gaming</p>
            </a>
            <?php foreach($dataG['posts'] as $post) : ?>
                <div class="one">
                    <img src="assets/images/cod.jpg" alt="">
                    <a href="showPost?id=<?php echo $post->post_id; ?>">
                        <p class="post-heading"><strong><?php echo $post->title; ?></strong></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>


        <div class="pt-cat-right">
            <a href="categories?cat=hardware" class="pt-cat-head">
                <p>Hardware</p>
            </a>
            <?php foreach($dataH['posts'] as $post) : ?>
                <div class="one">
                    <img src="assets/images/cod.jpg" alt="">
                    <a href="showPost?id=<?php echo $post->post_id; ?>">
                        <p class="post-heading"><strong><?php echo $post->title; ?></strong></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- <a href="allposts">More posts</a> -->
    </div>
</div>
</div>

<?php require_once 'inc/footer.php'; ?>