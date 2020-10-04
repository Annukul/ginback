<?php
require_once './bootstrap.php';

if ($_SESSION['email']) {
    $email = $_SESSION['email'];
    if (isset($_POST['updateUser'])) {
        $name = $_POST['user_name'];
        $username = $_POST['user_username'];
        $password = $_POST['user_password'];
        $about = $_POST['user_about'];

       $updateUser = new User;
       $updateUser->updateUser($name, $username, $password, $about, $email);

       $updateUser->uploadProfilePic();
    }
} else {
    redirect('index.php');
    exit;
}
?>
<?php
require_once 'inc/header.php';
?>
<div class="update-user">
    <p class="update-user-head">Edit/Update your details</p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="userform" method="POST">
        <div class="user-from-controls">
            <label for="name">Name:*</label>
            <input type="text" name="user_name" class="user-form-input" value="<?php if (!empty($_SESSION['name'])) {echo $_SESSION['name'];} else {echo '';} ?>">
            <span class="form_errors"><?php if (!empty($data['name_err'])) {echo $data['name_err'];} else {echo '';} ?></span>
        </div>
        <div class="user-from-controls">
            <label for="username">Username:*</label>
            <input type="text" name="user_username" class="user-form-input" value="<?php if (!empty($_SESSION['username'])) {echo $_SESSION['username'];} else {echo '';} ?>">
            <span class="form_errors"><?php if (!empty($data['username_err'])) {echo $data['username_err'];} else {echo '';} ?></span>
        </div>
        <div class="form-control">
            <label for="upload">Upload Profile pic</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
            <input type="file" name="file">
        </div>
        <br>
        <div class="user-from-controls">
            <label for="email">Email:</label>
            <input type="email" name="user_email" class="user-form-input" value="<?php if (!empty($_SESSION['email'])) {echo $_SESSION['email'];} else {echo '';} ?>" disabled>
            <span class="form_errors"><?php echo "You cannot change your email"; ?></span>
        </div>
        <div class="user-from-controls">
            <label for="password">Password</label>
            <input type="password" name="user_password" class="user-form-input">
            <span class="form_errors"><?php if (!empty($data['password_err'])) {echo $data['password_err'];} else {echo '';} ?></span>
        </div>
        <div class="user-from-controls">
            <label for="about">About</label>
            <textarea name="user_about" id="" cols="30" rows="10" class="user-form-input"><?php if (!empty($_SESSION['about_user'])) {echo $_SESSION['about_user'];} else {echo '';} ?></textarea>
        </div>
        <input type="submit" name="updateUser" class="updateUser" value="Update">
        <span class="form_errors"><?php if (!empty($data['com_err'])) {echo $data['com_err'];} else {echo '';} ?></span>
    </form>
</div>
<?php require_once 'inc/footer.php'; ?>