<?php

require_once 'Database.php';

class Posts
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addpost($title, $body, $category, $caption)
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'title' => trim($title),
            'body' => trim($body),
            'category' => trim($category),
            'caption' => trim($caption),
            'user_id' => $_SESSION['user_id'],
            'title_err' => '',
            'body_err' => '',
            'category_err' => '',
            'caption_err' => '',
            'com_err' => ''
        ];

        //Validate
        if (empty($data['title'])) {
            $data['title_err'] = 'Please enter a title for your body';
        }

        if (empty($data['body'])) {
            $data['body_err'] = 'Please enter your post in the textarea';
        }

        if (empty($data['category'])) {
            $data['category_err'] = 'Please enter a category';
        }

        if (empty($data['caption'])) {
            $data['caption_err'] = 'Please enter a caption';
        }

        if (empty($data['title_err']) && empty($data['body_err']) && empty($data['category_err']) && empty($data['caption_err'])) {
            // PROCESS
            $this->db->query("INSERT INTO posts (user_id, title, body, category, caption) VALUES (:user_id, :title, :body, :category, :caption)");
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':caption', $data['caption']);

            $this->db->execute();
            redirect('index');
        } else {
            $data['com_err'] = 'Something went wrong. Please try again.';
        }
    }

    public function imgupload($post_id)
    {

        // File upload configuration 
        $targetDir = "uploads/";
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
        $fileNames = array_filter($_FILES['files']['name']);
        if (!empty($fileNames)) {
            foreach ($_FILES['files']['name'] as $key => $val) {
                // File upload path 
                $fileName = basename($_FILES['files']['name'][$key]);
                $targetFilePath = $targetDir . $fileName;

                // Check whether file type is valid 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                if (in_array($fileType, $allowTypes)) {
                    // Upload file to server 
                    if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                        // Image db insert sql 
                        $insertValuesSQL .= "('" . $fileName . "', NOW()),";
                    } else {
                        $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                    }
                } else {
                    $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
                }
            }

            if (!empty($insertValuesSQL)) {
                $insertValuesSQL = trim($insertValuesSQL, ',');
                // Insert image file name into database 
                $this->db->query("INSERT INTO images (post_id, img_name) VALUES (:post_id, :img_name");

                $this->db->bind(':post_id', $post_id);
                $this->db->bind(':img_name', $fileName);

                $this->db->execute();
                redirect('showPost.php?id=' . $_SESSION['post_id']);
                // if ($insert) {
                //     $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                //     $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                //     $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                //     $statusMsg = "Files are uploaded successfully." . $errorMsg;
                // } else {
                //     $statusMsg = "Sorry, there was an error uploading your file.";
                // }

                redirect('showPost.php?id=' . $_SESSION['post_id']);
            }
        } else {
            $statusMsg = 'Please select a file to upload.';
        }
    }

    public function edit($title, $category, $body, $id)
    {
        // Sanatize POST array
        $_POST =  filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'id' => $id,
            'title' => trim($title),
            'category' => trim($category),
            'body' => trim($body),
            'user_id' => $_SESSION['user_id'],
            'category_err' => '',
            'title_err' => '',
            'body_err' => ''
        ];

        // Validate data
        if (empty($data['title'])) {
            $data['title_err'] = 'Please enter a title';
        }

        if (empty($data['body'])) {
            $data['body_err'] = 'Please enter text in body';
        }

        if (empty($data['category'])) {
            $data['category_err'] = 'Please enter a category';
        }

        // Make sure all error variables are empty
        if (empty($data['title_err']) && empty($data['body_err']) && empty($data['category_err'])) {
            $this->db->query("UPDATE posts SET title = :title, body = :body, category = :category WHERE id = :id");

            $this->db->bind(':id', $data['id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':body', $data['body']);

            redirect('showPost.php?id=' . $_SESSION['post_id']);
        } else {
            redirect('edit');
        }
    }

    public function deletePost($id)
    {
        $this->db->query("DELETE FROM posts WHERE post_id = '$id'");

        redirect('index');
    }
}
