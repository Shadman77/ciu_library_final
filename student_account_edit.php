<?php

include_once 'config/init.php'; //Session is started in this code
/*
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");
*/
if (isset($_POST['submit'])) {
    //Check if logged in as an admin
    if (!isset($_SESSION['admin_id'])) {
        redirect('index.php', 'You are not authorized.', 'error');
    }


    //Check if all the variables are set
    if (
        isset($_POST['id']) && isset($_POST['old_id']) && isset($_POST['name']) && isset($_POST['status'])
        && isset($_POST['email']) && isset($_POST['cell_no'])
        && isset($_POST['department']) && isset($_POST['school'])
        && isset($_POST['credit_system']) && isset($_POST['valid_till'])
    ) {
        $account = new Account;

        //if we need to change the image as well, remember to delete the old image
        if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
            /**Deleting Previous Image*/
            $tmpAddress =  $account->getStudentAccount($_POST['old_id'])->picture;
            if (file_exists($tmpAddress)) {
                unlink($tmpAddress);
            }

            /**Uploading Image */
            $fileOperation = new FileOperation;
            $imgUpload = $fileOperation->imageUpload($_POST['id'], 'student_image/');
            if ($imgUpload['status'] != 'success') {
                redirect('sign_up.php', $imgUpload['msg'], 'error');
            }
            $imgAddress = $imgUpload['msg'];
        } elseif ($_POST['old_id'] != $_POST['id']) {
            $tmpAddress =  $account->getStudentAccount($_POST['old_id'])->picture;
            $newAddress = 'student_image/' . $_POST['id'] . '.' . pathinfo($tmpAddress, PATHINFO_EXTENSION);
            rename($tmpAddress, $newAddress);
            $imgAddress = $newAddress;
        } else { //if we do not need to change the image
            $imgAddress = 0; //different query if imgAddress is 0
        }



        /**Adding all the data in an array to pass as param*/
        $data = array();
        $data['id'] = $_POST['id'];
        $data['old_id'] = $_POST['old_id'];
        $data['name'] = $_POST['name'];
        $data['status'] = $_POST['status'];
        $data['credit_system'] = $_POST['credit_system'];
        $data['cell_no'] = $_POST['cell_no'];
        $data['email'] = $_POST['email'];
        $data['school'] = $_POST['school'];
        $data['department'] = $_POST['department'];
        $data['image'] = $imgAddress;
        $data['valid_till'] = $_POST['valid_till'];
        $data['last_issuer_id'] = $_SESSION['admin_id'];


        if ($account->updateStudentAccount($data)) {
            //Delete previously collected student results
            if (isset($_SESSION['studentAccountsResults'])) {
                unset($_SESSION['studentAccountsResults']);
            }
            redirect('admin_home.php', 'Update successful.', 'success');
        } {
            redirect('admin_home.php', 'Something went wrong.', 'error');
        }
    }
} elseif (isset($_POST['delete'])) {
    $account = new Account;
    /**Deleting Previous Image*/
    $tmpAddress =  $account->getStudentAccount($_POST['old_id'])->picture;
    if (file_exists($tmpAddress)) {
        unlink($tmpAddress);
    }
    if ($account->deleteStudentAccount($_POST['old_id'])) {
        //Delete previously collected student results
        if (isset($_SESSION['studentAccountsResults'])) {
            unset($_SESSION['studentAccountsResults']);
        }
        redirect('admin_home.php', 'Delete successful.', 'success');
    } else {
        redirect('admin_home.php', 'Something went wrong.', 'error');
    }
}

if (isset($_GET['id'])) {
    $template = new Template('templates/student_account_edit_page.php');
    $account = new Account;
    $result = $account->getStudentAccount($_GET['id']);
    if ($result) {
        $template->result = $result;

        echo $template;
    } else {
        redirect('index.php', 'Opps something went wrong.', 'error');
    }
} else {
    redirect('index.php', 'Opps something went wrong.', 'error');
}
