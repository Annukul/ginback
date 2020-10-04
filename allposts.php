<?php

require_once './bootstrap.php';
$db = new Database;

$db->query("SELECT * FROM posts");
$posts = $db->single();

$data = [
    'posts' => $posts
];

?>

<?php require_once 'inc/header.php'; ?>

    <div class="allposts">
        
    </div>

<?php require_once 'inc/footer.php'; ?>