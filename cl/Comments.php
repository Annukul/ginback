<?php
require_once 'Database.php';

class Comments {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function postcomment($name, $email, $message, $post_id) {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'name' => trim($name),
            'email' => trim($email),
            'message' => trim($message),
            'post_id' => trim($post_id),
            'name_err' => '',
            'email_err' => '',
            'message_err' => '',
            'com_err' => ''
        ];

        //Validate
        if (empty($data['name'])) {
            $data['name_err'] = 'Please enter your name.';
        }

        if (empty($data['email'])) {
            $data['email_err'] = 'Please enter your email.';
        }

        if (empty($data['message'])) {
            $data['message_err'] = 'Please a comment.';
        }

        if (empty($data['name_err']) && empty($data['email_err']) && empty($data['message_err'])) {

            $this->db->query("INSERT INTO comments (com_name, com_email, com_message, post_id) VALUES ( :name, :email, :message, :post_id)");
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':message', $data['message']);
            $this->db->bind(':post_id', $data['post_id']);

            $this->db->execute();
        } else {
            $data['com_err'] = 'Something went wrong. Please try again.';
        }
    }
}