<?php
    require_once './bootstrap.php';
    $post_id = $_SESSION['post_id'];

    if (isset($_POST['img-submit'])) {
        $upload = new Posts;
        $upload->imgupload($post_id);
    }
?>
<?php require_once 'inc/header.php'; ?>
<div class="upload-form">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        Select Image Files to Upload:
        <input type="file" name="files[]" multiple>
        <input type="submit" name="img-submit" value="UPLOAD">
    </form>
</div>

<?php require_once 'inc/footer.php'; ?>