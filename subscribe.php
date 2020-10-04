<?php
    require_once 'bootstrap.php';

    if (isset($_POST['subscribe'])) {

        $email = trim($_POST['sub_email']);
        $db = new Database;
        $db->query("INSERT INTO newsletter (email) VALUES (:email)");
        $db->bind(':email', $email);

        $db->execute();
    }
?>

<p class="greet" style="font-family: 'Montserrat', sans-serif;">Thanks for subscribing to our news letter!</p>
<a href="index" class="goback" style="font-family: 'Montserrat', sans-serif;">Go back</a>