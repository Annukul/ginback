<?php
    require_once './bootstrap.php';
    $id = $_GET['id'];
    $edit_title = $_SESSION['edit_title'];
    $edit_category = $_SESSION['edit_category'];
    $edit_caption = $_SESSION['edit_caption'];
    $edit_body = $_SESSION['edit_body'];

    if (isset($_POST['updatePost'])) {
        $title = $_POST['title'];
        $category = $_POST['category'];
        $body = $_POST['body'];

        $update = new Posts;
        $update->edit($title, $category, $body, $id);
    }
?>

<?php require_once 'inc/header.php'; ?>

<div class="add-form">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <p>Add new post</p>
        <div class="form-control">
            <label for="title">Title</label>
            <input type="text" name="title" class="add-form-input" value="<?php echo $edit_title; ?>">
            <span class="form_errors"><?php if (!empty($data['title_err'])) {
                                            echo $data['title_err'];
                                        } else {
                                            echo '';
                                        } ?></span>
        </div>
        <div class="form-control">
            <label for="caption">Caption</label>
            <input type="text" name="caption" class="add-form-input" value="<?php echo $edit_caption; ?>">
            <span class="form_errors"><?php if (!empty($data['caption_err'])) {
                                            echo $data['caption_err'];
                                        } else {
                                            echo '';
                                        } ?></span>
        </div>
        <div class="form-control">
            <label for="category">Category</label>
            <input type="text" name="category" class="add-form-input" value="<?php echo $edit_category; ?>">
            <span class="form_errors"><?php if (!empty($data['category_err'])) {
                                            echo $data['category_err'];
                                        } else {
                                            echo '';
                                        } ?></span>
        </div>
        <div class="form-control">
            <label for="post">Post</label>
            <textarea name="body" cols="30" rows="10" class="add-form-input"><?php echo $edit_body; ?></textarea>
            <span class="form_errors"><?php if (!empty($data['body_err'])) {
                                            echo $data['body_err'];
                                        } else {
                                            echo '';
                                        } ?></span>
        </div>
        <input type="submit" name="updatePost" value="Update Post" class="cred-btn">
        <span class="form_errors"><?php if (!empty($data['com_err'])) {
                                        echo $data['com_err'];
                                    } else {
                                        echo '';
                                    } ?></span>
    </form>
</div>

<?php require_once 'inc/footer.php'; ?>