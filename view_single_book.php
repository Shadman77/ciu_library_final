<?php
include_once 'config/init.php';


/**Preventing Caching*/
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

$template = new Template('templates/view_single_book_page.php');

if (isset($_POST['submit'])) {
    //Check if logged in as an admin
    if (!isset($_SESSION['admin_id'])) {
        redirect('index.php', 'You are not authorized.', 'error');
    }

    //Check if all the variables are set
    if (
        isset($_POST['isbn']) && isset($_POST['title']) && isset($_POST['author']) && isset($_POST['publisher'])
        && isset($_POST['year_published']) && isset($_POST['edition'])
        && isset($_POST['category']) && isset($_POST['inventory'])
        && isset($_POST['old_isbn'])
    ) {
        $record = new Record;

        //if we need to change the image as well, remember to delete the old image
        if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
            /**Deleting Previous Image*/
            $tmpAddress =  $record->getSingleBook($_POST['old_isbn'])->picture;
            if (file_exists($tmpAddress)) {
                unlink($tmpAddress);
            }

            /**Uploading Image */
            $fileOperation = new FileOperation;
            $imgUpload = $fileOperation->imageUpload($_POST['isbn'], 'book_image/');
            if ($imgUpload['status'] != 'success') {
                redirect('sign_up.php', $imgUpload['msg'], 'error');
            }
            $imgAddress = $imgUpload['msg'];
        } elseif ($_POST['old_isbn'] != $_POST['isbn']) {
            $tmpAddress =  $record->getSingleBook($_POST['old_isbn'])->picture;
            $newAddress = 'book_image/' . $_POST['isbn'] . '.' . pathinfo($tmpAddress, PATHINFO_EXTENSION);
            rename($tmpAddress, $newAddress);
            $imgAddress = $newAddress;
        } else { //if we do not need to change the image
            $imgAddress = 0; //different query if imgAddress is 0
        }

        /**Adding all the data in an array to pass as param*/
        $data = array();
        $data['isbn'] = $_POST['isbn'];
        $data['old_isbn'] = $_POST['old_isbn'];
        $data['title'] = $_POST['title'];
        $data['author'] = $_POST['author'];
        $data['publisher'] = $_POST['publisher'];
        $data['year_published'] = $_POST['year_published'];
        $data['edition'] = $_POST['edition'];
        $data['category'] = $_POST['category'];
        $data['inventory'] = $_POST['inventory'];
        $data['image'] = $imgAddress;


        if ($record->updateBook($data)) {
            /**Delete Previous Results */
            if (isset($_SESSION['viewBooksResult'])) {
                unset($_SESSION['viewBooksResult']);
            }
            redirect('admin_home.php', 'Update successful.', 'success');
        } {
            redirect('admin_home.php', 'Something went wrong.', 'error');
        }
    }
} elseif (isset($_POST['delete'])) {
    $record = new Record;
    /**Deleting Previous Image*/
    $tmpAddress =  $record->getSingleBook($_POST['old_isbn'])->picture;
    if (file_exists($tmpAddress)) {
        unlink($tmpAddress);
    }
    if ($record->deleteBook($_POST['old_isbn'])) {
        /**Delete Previous Results */
        if (isset($_SESSION['viewBooksResult'])) {
            unset($_SESSION['viewBooksResult']);
        }
        redirect('admin_home.php', 'Delete successful.', 'success');
    } else {
        redirect('admin_home.php', 'Something went wrong.', 'error');
    }
}

if (isset($_GET['isbn'])) {
    $record = new Record;
    $result = $record->getSingleBook($_GET['isbn']);
    $template->result = $result;
    echo $template;
} else {
    redirect('index.php', 'Specific book not found.', 'error');
}
