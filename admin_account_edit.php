<?php

include_once 'config/init.php'; //Session is started in this code
if (isset($_POST['submit'])) {
    //Check if logged in as an admin
    if (!isset($_SESSION['admin_id'])) {
        redirect('index.php', 'You are not authorized.', 'error');
    }

    //Check if all the variables are set
    if (
        isset($_POST['id']) && isset($_POST['old_id']) && isset($_POST['name']) && isset($_POST['status'])
        && isset($_POST['email']) && isset($_POST['cell_no'])
    ) {
        $account = new Account;

        //if we need to change the image as well, remember to delete the old image
        if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
            /**Deleting Previous Image*/
            $tmpAddress =  $account->getAdminAccount($_POST['old_id'])->picture;
            if (file_exists($tmpAddress)) {
                unlink($tmpAddress);
            }

            /**Uploading Image */
            $fileOperation = new FileOperation;
            $imgUpload = $fileOperation->imageUpload($_POST['id'], 'admin_image/');
            if ($imgUpload['status'] != 'success') {
                redirect('index.php', $imgUpload['msg'], 'error');
            }
            $imgAddress = $imgUpload['msg'];
        } elseif ($_POST['old_id'] != $_POST['id']) {
            $tmpAddress =  $account->getAdminAccount($_POST['old_id'])->picture;
            $newAddress = 'admin_image/' . $_POST['id'] . '.' . pathinfo($tmpAddress, PATHINFO_EXTENSION);
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
        $data['cell_no'] = $_POST['cell_no'];
        $data['email'] = $_POST['email'];
        $data['image'] = $imgAddress;
        $data['issuer_admin_id'] = $_SESSION['admin_id'];


        if ($account->updateAdminAccount($data)) {
            //Delete previous results
            if (isset($_SESSION['adminAccountsResults'])) {
                unset($_SESSION['adminAccountsResults']);
            }

            /**Add to logs */
            try {
                $log = new Log;
                $log->addLog('Student Account Updated', $_POST['old_id'], $_SESSION['admin_id']);
            } catch (Exception $e) { }

            redirect('admin_home.php', 'Update successful.', 'success');
        } {
            redirect('admin_home.php', 'Something went wrong.', 'error');
        }
    }
} elseif (isset($_POST['delete'])) {
    $account = new Account;
    /**Deleting Previous Image*/
    $tmpAddress =  $account->getAdminAccount($_POST['old_id'])->picture;
    if (file_exists($tmpAddress)) {
        unlink($tmpAddress);
    }
    if ($account->deleteAdminAccount($_POST['old_id'])) {
        //Delete previous results
        if (isset($_SESSION['adminAccountsResults'])) {
            unset($_SESSION['adminAccountsResults']);
        }

        /**Add to logs */
        try {
            $log = new Log;
            $log->addLog('Student Account Deleted', $_POST['old_id'], $_SESSION['admin_id']);
        } catch (Exception $e) { }

        redirect('admin_home.php', 'Delete successful.', 'success');
    } else {
        redirect('admin_home.php', 'Something went wrong.', 'error');
    }
}

if (isset($_GET['id'])) {
    $template = new Template('templates/admin_account_edit_page.php');
    $account = new Account;
    $template->result = $account->getAdminAccount($_GET['id']);

    echo $template;
} else {
    redirect('index.php', 'Opps something went wrong.', 'error');
}
