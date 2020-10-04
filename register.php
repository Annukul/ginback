<?php
require_once './bootstrap.php';

if (isset($_POST['signup'])) {
    $db = new Database;
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $data = [
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password']),
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => '',
        'com_err' => ''
    ];

    //Validate 
    if (empty($data['name'])) {
        $data['name_err'] = 'Please enter name';
    }

    if (empty($data['email'])) {
        $data['email_err'] = 'Please enter a valid email';
    } else {
        //Check if email already exists
        $db->query("SELECT * FROM users WHERE email = :email");
        $db->bind(':email', $data['email']);
        $row = $db->single();
        if ($db->rowCount() > 0) {
            $data['email_err'] = 'Email is already taken';
        }
    }

    if (empty($data['password'])) {
        $data['password_err'] = 'Please enter password';
    } else if (strlen($data['password']) < 6) {
        $data['password_err'] = 'Error: Password should be more thean 6 characters';
    }

    if (empty($data['confirm_password'])) {
        $data['confirm_password_err'] = 'Please confirm your password';
    } else {
        if ($data['password'] != $data['confirm_password']) {
            $data['confirm_password_err'] = 'Please make sure that your passwords match';
        }
    }

    if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $db->query("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $db->bind(':name', $data['name']);
        $db->bind(':email', $data['email']);
        $db->bind(':password', $data['password']);

        $db->execute();
        redirect('login');
    } else {
        $data['com_err'] = 'Something went wrong. Please try again';
    }
}
?>
<?php require_once 'inc/header.php'; ?>
<div class="form-main">
    <div class="form-div">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form" method="POST">
            <p>Register</p>
            <div class="form-control">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-input" value="<?php echo @$data['name']; ?>">
                <span class="form_errors"><?php if (!empty($data['name_err'])) {echo $data['name_err'];} else {echo '';} ?></span>
            </div>

            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-input" value="<?php echo @$data['email']; ?>">
                <span class="form_errors"><?php if (!empty($data['email_err'])) {echo $data['email_err'];} else {echo '';} ?></span>
            </div>

            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-input">
                <span class="form_errors"><?php if (!empty($data['password_err'])) {echo $data['password_err'];} else {echo '';} ?></span>
            </div>

            <div class="form-control">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-input">
                <span class="form_errors"><?php if (!empty($data['confirm_password_err'])) {echo $data['confirm_password_err'];} else {echo '';} ?></span>
            </div>

            <input type="submit" name="signup" value="SignUp" class="cred-btn">
            <span class="form_errors"><?php if (!empty($data['com_err'])) {echo $data['com_err'];} else {echo '';} ?></span>

            <a href="login">Already a user? Login!</a>
        </form>
    </div>
</div>
<?php require_once 'inc/footer.php'; ?>