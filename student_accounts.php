<?php

include_once 'config/init.php'; //Session is started in this code

if(!isset($_SESSION['admin_id'])){
    redirect('index.php','Please log in as admin.','error');
}

if (isset($_GET['status']) && isset($_GET['page'])) {
    $template = new Template('templates/student_accounts_page.php');

    if (!isset($_SESSION['studentAccountsResults'])) {
        $account = new Account;
        $_SESSION['studentAccountsResults'] = $account->getStudentAccounts($_GET['status']);
        $_SESSION['studentAccountsStatus'] = $_GET['status'];
    } elseif ($_SESSION['studentAccountsStatus'] != $_GET['status']) {
        $account = new Account;
        $_SESSION['studentAccountsResults'] = $account->getStudentAccounts($_GET['status']);
        $_SESSION['studentAccountsStatus'] = $_GET['status'];
    }


    $template->page = $_GET['page'];
    $template->status = $_SESSION['studentAccountsStatus'];
    $template->results = $_SESSION['studentAccountsResults'];
    $template->lastPage = ceil(count($_SESSION['studentAccountsResults']) / 10) - 1;

    //have a template util class just to load the contents
    echo $template; //shows the student accounts page
} else {
    redirect('index.php', 'Opps something went wrong.', 'error');
}
