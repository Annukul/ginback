<?php
require_once './bootstrap.php';

if (isset($_POST['login'])) {
    $db = new Database;
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $data = [
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'email_err' => '',
        'password_err' => '',
        'com_err' => ''
    ];

    //Validate
    if (empty($data['email'])) {
        $data['email_err'] = 'Please enter a valid email';
    }

    if (empty($data['password'])) {
        $data['password_err'] = 'Please enter password';
    }

    if (empty($data['email_err']) && empty($data['password_err'])) {

        $db->query('SELECT * FROM users WHERE email = :email');
        $db->bind(':email', $data['email']);

        $row = $db->single();

        $hashed_password = $row->password;
        if (password_verify($data['password'], $hashed_password)) {
            session_start();
            $_SESSION['name'] = $row->name;
            $_SESSION['user_id'] = $row->user_id;
            $_SESSION['username'] = $row->username;
            $_SESSION['email'] = $row->email;
            $_SESSION['about_user'] = $row->about_user;
            redirect('index');
        } else {
            $data['password_err'] = 'Incorrect password';
        }
        
    } else {
        $data['com_err'] = 'Something went wrong. Please try again';
    }
}
?>
<?php require_once 'inc/header.php'; ?>
<div class="form-main">
    <div class="form-div">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form" method="POST">
            <p>Login</p>

            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-input" value="<?php echo @$data['email']; ?>">
                <span class="form_errors"><?php echo @$data['email_err']; ?></span>
            </div>

            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-input">
                <span class="form_errors"><?php echo @$data['password_err']; ?></span>
            </div>

            <input type="submit" name="login" value="LogIn" class="cred-btn">

            <a href="register">New here? Register!</a>
        </form>
    </div>
</div>
<?php require_once 'inc/footer.php'; ?>