<?php
require_once 'bootstrap.php';

$cat = $_GET['cat'];
$db = new Database;

if ($cat == 'news') {
    $db->query("SELECT * FROM posts WHERE category='news'");
    $news = $db->resultSet();

    $data = [
        'posts' => $news
    ];
} else if ($cat == 'gaming') {
    $db->query("SELECT * FROM posts WHERE category='gaming'");
    $gaming = $db->resultSet();

    $data = [
        'posts' => $gaming
    ];
} else if ($cat == 'hardware') {
    $db->query("SELECT * FROM posts WHERE category='hardware'");
    $hardware = $db->resultSet();

    $data = [
        'posts' => $hardware
    ];
} else if ($cat == 'allposts') {
    $db->query("SELECT * FROM posts");
    $all = $db->resultSet();

    $data = [
        'posts' => $all
    ];
}

?>

<?php require_once 'inc/header.php'; ?>
<div class="ft-pt ft-pt-cat">
    <p class="cat-head">Posts by <strong>categories</strong></p>
    <?php foreach ($data['posts'] as $post) : ?>
        <div class="ft-pt-cat-in">
            <div class="ft-pt-img ft-pt-cat-img">
                <img src="assets/images/cod.jpg" alt="">
            </div>
            <div class="ft-pt-text ft-pt-cat-text">
                <p class="post-heading"><strong><?php echo $post->title; ?></strong></p>
                <p><?php echo $post->body; ?></p>
                <a href="showPost?id=<?php echo $post->post_id; ?>" class="readmore">Read more...</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once 'inc/footer.php'; ?>