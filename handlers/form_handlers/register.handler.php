<?php

require_once '../../bootstrap.php';

$db = new Database;

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $name = trim($name);
    $name_err = '';
    $email = trim($email);
    $email_err = '';
    $password = trim($password);
    $password_err = '';
    $confirm_password = trim($confirm_password);
    $confirm_password_err = '';
    $com_err = '';

    // Validation
    if (empty($name)) {
        $name_err = 'Please enter your name';
    }

    if (empty($email)) {
        $email_err = 'Please enter your email';
    } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = 'Invalid email!';
        } else if ($this->findUserByEmail($email)) {
            $email_err = 'This email is aerady registered with us.';
        }
    }

    if (empty($password)) {
        $password_err = 'Please enter a password';
    } else {
        if (strlen($password) < 6) {
            $password_err = 'Your password length should be more than 6 characters';
        }
    }

    if (empty($confirm_password)) {
        $confirm_password_err = 'Please confirm your password';
    } else if ($password != $confirm_password) {
        $confirm_password_err = 'Please make sure that your passwords match';
    }

    // Check whether all err variables are empty or not
    if (empty($name_err) || empty($email_err) || empty($password_err) || empty($confirm_password_err)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $this->db->query("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $this->db->bind(':name', $name);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $hashed_password);

        $this->db->execute();
        redirect('login.php');
    } else {
        $com_err = 'Something went wrong. Please try again.';
        redirect('register.php');
    }
} else {
    redirect('register.php');
}
