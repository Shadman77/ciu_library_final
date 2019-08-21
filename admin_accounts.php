<?php

include_once 'config/init.php'; //Session is started in this code

/**Preventing Caching*/
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

if (isset($_GET['status']) && isset($_GET['page'])) {
    $template = new Template('templates/admin_accounts_page.php');

    if (!isset($_SESSION['adminAccountsResults'])) {
        $account = new Account;
        $_SESSION['adminAccountsResults'] = $account->getAdminAccounts($_GET['status']);
        $_SESSION['adminAccountsStatus'] = $_GET['status'];
    } elseif ($_SESSION['adminAccountsStatus'] != $_GET['status']) {
        $account = new Account;
        $_SESSION['adminAccountsResults'] = $account->getAdminAccounts($_GET['status']);
        $_SESSION['adminAccountsStatus'] = $_GET['status'];
    }


    $template->page = $_GET['page'];
    $template->status = $_SESSION['adminAccountsStatus'];
    $template->results = $_SESSION['adminAccountsResults'];
    $template->lastPage = ceil(count($_SESSION['adminAccountsResults']) / 10) - 1;

    //have a template util class just to load the contents
    echo $template; //shows the student accounts page
} else {
    redirect('index.php', 'Opps something went wrong.', 'error');
}
