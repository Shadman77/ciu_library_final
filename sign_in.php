<?php

include_once 'config/init.php';

if (isset($_POST['id']) && isset($_POST['password'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];

    $account = new Account;

    //if admin account
    if ($id[0] == 'a') {
        if ($account->adminSignIn($id, $password)) {
            $_SESSION['admin_id'] = $id;
            redirect('index.php', $id . ' logged in successfully.', 'success');
        } else {
            redirect('sign_in.php', 'Incorrect user name or password.', 'error');
        }
    } else {
        if ($account->signIn($id, $password)) {
            $_SESSION['student_id'] = $id;
            redirect('index.php', $id . ' logged in successfully.', 'success');
        } else {
            redirect('sign_in.php', 'Incorrect user name or password.', 'error');
        }
    }
} elseif (isset($_POST['logout'])) {
    session_destroy();
    session_start();
    redirect('index.php', 'User logged out successfully.', 'success');
} else {

    $template = new Template('templates/sign_in_page.php');
    //have a template util class just to load the contents


    echo $template; //shows the landing page
}
