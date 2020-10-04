<?php
require_once './bootstrap.php';
@$id = $_SESSION['user_id'];
$db = new Database;

// Get post by ID
$post_id = $_GET['id'];
$_SESSION['post_id'] = $_GET['id'];
$edit_id = $_SESSION['post_id'];
$db->query("SELECT * FROM posts WHERE post_id='$post_id'");
$post = $db->single();
$post_user_id = $post->user_id;
$_SESSION['edit_title'] = $post->title;
$_SESSION['edit_category'] = $post->category;
$_SESSION['edit_caption'] = $post->caption;
$_SESSION['edit_body'] = $post->body;

$db->query("SELECT * FROM users WHERE user_id='$post_user_id'");
$user = $db->single();

// Recent posts
$db->query("SELECT title FROM posts ORDER BY post_created_at DESC");
$feature = $db->single();

// ADD COMMENT
if (@$_POST['addcomment']) {
    $comments = new Comments;

    $name = $_POST['com_name'];
    $email = $_POST['com_email'];
    $message = $_POST['com_message'];

    $comments->postcomment($name, $email, $message, $post_id);
}

// SHOW COMMENTS
$com_id = $_SESSION['post_id'];
$db->query("SELECT * FROM comments WHERE post_id='$com_id'");
$comments = $db->resultSet();

$dataCom = [
    'comments' => $comments
];

?>

<?php require_once 'inc/header.php'; ?>

<div class="full-post">
    <div class="the">
        <div class="post-up">
            <div class="slideshow-container">
                <div class="mySlides fade image-inside">
                    <div class="numbertext">1 / 6</div>
                    <img src="assets/images/one.jpg" style="width:100%" class="img">
                    <div class="text">Caption Text</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">2 / 6</div>
                    <img src="assets/images/two.jpg" style="width:100%" class="img">
                    <div class="text">Caption Two</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">3 / 6</div>
                    <img src="assets/images/three.jpg" style="width:100%" class="img">
                    <div class="text">Caption Three</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">4 / 6</div>
                    <img src="assets/images/four.jpg" style="width:100%" class="img">
                    <div class="text">Caption Three</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">5 / 6</div>
                    <img src="assets/images/five.jpg" style="width:100%" class="img">
                    <div class="text">Caption Three</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">6 / 6</div>
                    <img src="assets/images/six.jpg" style="width:100%" class="img">
                    <div class="text">Caption Three</div>
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

            </div>
            <br>

            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
                <span class="dot" onclick="currentSlide(4)"></span>
                <span class="dot" onclick="currentSlide(5)"></span>
                <span class="dot" onclick="currentSlide(6)"></span>
            </div>

            <br>
            <br>
            <div class="post-left">
                <h1><?php echo $post->title; ?></h1>
                <small class="post-auth">by <?php echo $user->name; ?> on <?php echo $post->post_created_at; ?> in <?php echo $post->category; ?></small>
                <br>
                <p><strong><?php echo $post->caption; ?></strong></p>
                <br>
                <p class="post-body"><?php echo $post->body; ?></p>
                <hr>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <?php if ($_SESSION['user_id'] == $post->user_id) : ?>
                        <div class="btns">
                            <a href="edit?id=<?php echo $edit_id; ?>" class="edit">Edit</a>
                            <a href="delete?id=<?php echo $edit_id; ?>" class="delete">Delete</a>
                            <a href="upload?id=<?php echo $edit_id; ?>" class="edit">Upload Image</a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="post-right">
            <p>About the <strong>Author</strong></p>
            <div class="author">
                <div class="author-img">
                    <img src="assets/img/odeya.jpg" alt="">
                </div>
                <div class="author-text">
                    <p class="author-head">Annukul</p>
                    <p class="author-p">
                        It was around 1 p.m when I reached the village where I
                        later told that I am, in some way, lost. There was no one
                        outside. The wind was playing with the dead and dried
                        grass, rolling it again and again until it turned into a
                        ball. This was the Thar Desert region which is located near
                        the town Jaisalmer which is also called the Golden city of
                        Rajasthan, India.
                    </p>
                </div>
            </div>
        </div>
    </div>


    <!-- COMMENT SECTION !-->

    <!-- SHOW COMMENTS !-->
    <div class="show-comments">
        <p><strong>Comments</strong></p>
        <hr>
        <?php foreach ($dataCom['comments'] as $comment) : ?>
            <div class="comments-div">
                <p class="com_name"><strong><?php echo $comment->com_name; ?></strong></p>
                <small>posted on <?php echo $comment->comment_added_at; ?></small>
                <p class="comment-content"><?php echo $comment->com_message; ?></p>
                <!-- <a href="#">Reply?</a> -->
            </div>
        <?php endforeach; ?>
    </div>
    <br>
    <hr>

    <!-- ADD COMMENT !-->
    <div class="comments">
        <form action="comments" method="POST">
            <p>Leave a reply</p>
            <small>Your email address will not be published.</small>
            <div class="form-control">
                <label for="name">Name</label>
                <input type="text" name="com_name" class="add-form-input" required>
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" name="com_email" class="add-form-input" required>
            </div>
            <div class="form-control">
                <label for="message">Message</label>
                <textarea name="com_message" cols="30" rows="10" class="add-form-input"></textarea>
            </div>
            <input type="submit" name="addcomment" value="Post" class="cred-btn">
        </form>
    </div>
</div>

<?php require_once 'inc/footer.php'; ?>