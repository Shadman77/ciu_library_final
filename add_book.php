<?php

include_once 'config/init.php';

if (isset($_POST["submit"])) {

    if (
        isset($_POST['isbn']) /*&& isset($_POST['title']) && isset($_POST['author'])
        && isset($_POST['publisher']) && isset($_POST['year_published'])
        && isset($_POST['edition']) && isset($_POST['category'])
        && isset($_POST['inventory'])*/
        && (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name']))
    ) {
        /**Uploading Image */
        $fileOperation = new FileOperation;
        $imgUpload = $fileOperation->imageUpload($_POST['isbn'], 'book_image/');
        if ($imgUpload['status'] != 'success') {
            redirect('add_book.php', $imgUpload['msg'], 'error');
        }

        /**Adding all the data in an array to pass as param*/
        $data = array();
        $data['isbn'] = $_POST['isbn'];
        $data['title'] = $_POST['title'];
        $data['author'] = $_POST['author'];
        $data['publisher'] = $_POST['publisher'];
        $data['year_published'] = $_POST['year_published'];
        $data['edition'] = $_POST['edition'];
        $data['category'] = $_POST['category'];
        $data['inventory'] = $_POST['inventory'];
        $data['image'] = $imgUpload['msg'];

        /**Adding student to database */
        $recordStatus = -1; //initially setting to -1 (something went wrong)
        try {
            $record = new Record;
            $recordStatus = $record->addBook($data);
        } catch (Exception $e) {
            //deleting the image since account creation was not successfull
            if (file_exists($data['image'])) {
                unlink($data['image']);
            }
        }

        /**Checking if student added successfully */
        switch ($recordStatus) {
            case 0:
                redirect('add_book.php', 'Book already exists.', 'error');
                //image should already exist since account exists
                break;
            case 1:
                /**Delete Previous Results */
                if (isset($_SESSION['viewBooksResult'])) {
                    unset($_SESSION['viewBooksResult']);
                }
                
                /**Add to logs */
                try {
                    $log = new Log;
                    $log->addLog('Book Added ' . $_POST['isbn'], 0, $_SESSION['admin_id']);
                } catch (Exception $e) { }

                redirect('admin_home.php', 'Book added successfully', 'status');
                break;
            case -1:
                redirect('add_book.php', 'Opps something went wrong.', 'error');

                //deleting the image since account creation was not successfull
                if (file_exists($data['image'])) {
                    unlink($data['image']);
                }
        }
    } else {
        redirect('add_book.php', 'Something went wrong, please make sure all the fields are filled.', 'error');
    }
    //don't we need to remove the temp image if we could not move it?
} else {

    $template = new Template('templates/add_book_page.php');
    //have a template util class just to load the contents
    echo $template; //shows the sign up page
}
