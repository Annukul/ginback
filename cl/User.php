<?php

require_once 'Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function updateUser($name, $username, $password, $about, $email) {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'name' => trim($name),
            'username' => trim($username),
            'password' => trim($password),
            'about' => trim($about),
            'name_err' => '',
            'username_err' => '',
            'password_err' => '',
            'about_err' => '',
            'com_err' => ''
        ];

        //Validate
        if (empty($data['name'])) {
            $data['name_err'] = 'Please enter your name';
        }

        if (empty($data['username'])) {
            $data['username_err'] = 'Please enter your username';
        }

        if (empty($data['password'])) {
            $data['password_err'] = 'Please enter your password';
        } else {
            if (strlen($data['password']) < 6) {
                $data['password_err'] = 'Your password should be minimum 6 character long';
            }
        }

        if (empty($data['name_err']) || empty($data['username_err']) || empty($data['password_err'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            $this->db->query("UPDATE users SET name = :name, username = :username, password = :password, about_user = :about WHERE email = '$email'");
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':about', $data['about']);

            $this->db->execute();
            redirect('index');
        } else {
            $data['com_err'] = 'Something went wrong. Please try again.';
        }
    }

    public function uploadProfilePic()
    {
        if ($_FILES['file']['error']) {
            echo 'Problem: ';
            switch ($_FILES['file']['error']) {
                case 1:
                    echo 'File exceed upload_max_filesize.';
                    break;

                case 2:
                    echo 'File exceed max_file_size.';
                    break;

                case 3:
                    echo 'File only partially uploaded.';
                    break;

                case 4:
                    echo 'No file uploaded.';
                    break;

                case 5:
                    echo 'Cannot upload file: No temp directory specified.';
                    break;

                case 6:
                    echo 'Upload failed. Cannot write to disk.';
                    break;

                case 8:
                    echo 'A PHP extension blocked the file upload.';
                    break;
            }
            exit;
        }

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        echo $target_file;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Does the file has the right MIME type?
        if ($imageFileType != 'jpg') {
            echo 'Problem: File is not an image.';
            exit;
        }

        // Put the file where we'd like it
        $uploaded_file = $target_dir . $_FILES['file']['name'];

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploaded_file)) {
                echo 'Problem: Could not move file to destination directory';
                exit;
            }
        } else {
            echo 'Problem: Possible file upload attack. Filename: ';
            echo $_FILES['file']['name'];
            exit;
        }

        echo 'File upload successful.';

        // Show what was uploaded
        echo 'Your uploaded image:</br>';
        echo '<img src="' . $target_dir . '' . $_FILES['file']['name'] . '" width=500 height=300 />';
        $image = $_FILES['file']['name'];

        $this->db->query("INSERT INTO users (profile_pic) VALUES ('$image')");
        $this->db->execute();
    }

    public function showUser($id) {
        $this->db->query("SELECT * FROM users WHERE user_id='$id'");
        $user = $this->db->single();
        $userName = $user->name;
    }

    public function showUserFull($id) {
        $this->db->query("SELECT * FROM users WHERE user_id='$id'");

        $row = $this->db->single();
        $name = $row->name;
        $about_user = $row->about_user;
        $profile_pic = $row->profile_pic;
    }
}