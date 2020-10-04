<?php
session_start();
require_once './bootstrap.php';

if ($_POST['addcomment']) {
    $comments = new Comments;

    $name = $_POST['com_name'];
    $email = $_POST['com_email'];
    $message = $_POST['com_message'];
    $post_id = $_SESSION['post_id'];

    $comments->postcomment($name, $email, $message, $post_id);
    redirect('showPost?id='.$post_id);

} else {
    redirect('showPost');
}