<?php
require_once './bootstrap.php';

if ($_SESSION['email']) {
    if (isset($_POST['addPost'])) {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $category = $_POST['category'];
        $caption = $_POST['caption'];

        $add = new Posts;
        $add->addpost($title, $body, $category, $caption);
    }
} else {
    redirect('index');
    exit;
}
?>

<?php require_once 'inc/header.php'; ?>
<div class="add-form">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <p>Add new post</p>
            <div class="form-control">
                <label for="title">Title</label>
                <input type="text" name="title" class="add-form-input">
                <span class="form_errors"><?php if (!empty($data['title_err'])) {echo $data['title_err'];} else {echo '';} ?></span>
            </div>
            <div class="form-control">
                <label for="category">Category</label>
                <input type="text" name="category" class="add-form-input">
                <span class="form_errors"><?php if (!empty($data['category_err'])) {echo $data['category_err'];} else {echo '';} ?></span>
            </div>
            <div class="form-control">
                <label for="caption">Caption</label>
                <input type="text" name="caption" class="add-form-input">
                <span class="form_errors"><?php if (!empty($data['caption_err'])) {echo $data['caption_err'];} else {echo '';} ?></span>
            </div>
            <div class="form-control">
                <label for="post">Post</label>
                <textarea name="body" cols="30" rows="10" class="add-form-input"></textarea>
                <span class="form_errors"><?php if (!empty($data['body_err'])) {echo $data['body_err'];} else {echo '';} ?></span>
            </div>
            <input type="submit" name="addPost" value="Add Post" class="cred-btn">
            <span class="form_errors"><?php if (!empty($data['com_err'])) {echo $data['com_err'];} else {echo '';} ?></span>
        </form>
</div>

<?php require_once 'inc/footer.php'; ?>