<?php

require_once './bootstrap.php';
$id = $_GET['id'];

// $delete = new Posts;
$db = new Database;
$db->query("DELETE FROM posts WHERE post_id = '$id'");

redirect('index');
// $delete->deletePost($id);