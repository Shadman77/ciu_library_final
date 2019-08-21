<?php

include_once 'config/init.php';

if (isset($_POST["submit"])) {

    if (
        isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email'])
        && isset($_POST['cell_no']) && isset($_POST['department'])
        && isset($_POST['school']) && isset($_POST['credit_system'])
        && isset($_POST['password']) && isset($_POST['confirm_password'])
        && (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name']))
    ) {
        /**Checking if passwords match */
        if ($_POST['password'] !== $_POST['confirm_password']) {
            redirect('sign_up.php', 'Passwords do not match.', 'error');
        }

        /**Uploading Image */
        $fileOperation = new FileOperation;
        $imgUpload = $fileOperation->imageUpload($_POST['id'], 'student_image/');
        if ($imgUpload['status'] != 'success') {
            redirect('sign_up.php', $imgUpload['msg'], 'error');
        }


        /**Adding all the data in an array to pass as param*/
        $data = array();
        $data['id'] = $_POST['id'];
        $data['name'] = $_POST['name'];
        $data['credit_system'] = $_POST['credit_system'];
        $data['cell_no'] = $_POST['cell_no'];
        $data['email'] = $_POST['email'];
        $data['password'] = $_POST['password'];
        $data['school'] = $_POST['school'];
        $data['department'] = $_POST['department'];
        $data['image'] = $imgUpload['msg'];


        /**Adding student to database */
        $accountStatus = -1;//initially setting to -1 (something went wrong)
        try {
            $account = new Account;
            $accountStatus = $account->signUp($data);
        } catch (Exception $e) {
            //deleting the image since account creation was not successfull
            if (file_exists($data['image'])) {
                unlink($data['image']);
            }
        }


        /**Checking if student added successfully */
        switch ($accountStatus) {
            case 0:
                redirect('sign_up.php', 'User already exists.', 'error');
                //image should already exist since account exists
                break;
            case 1:
                redirect('index.php', 'User added successfully', 'status');
                break;
            case -1:
                redirect('sign_up.php', 'Opps something went wrong.', 'error');

                //deleting the image since account creation was not successfull
                if (file_exists($data['image'])) {
                    unlink($data['image']);
                }
        }
    } else {
        redirect('sign_up.php', 'Something went wrong, please make sure all the fields are filled.', 'error');
    }
    //don't we need to remove the temp image if we could not move it?
} else {

    $template = new Template('templates/sign_up_page.php');
    //have a template util class just to load the contents
    echo $template; //shows the sign up page
}
