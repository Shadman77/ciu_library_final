<?php
include_once 'config/init.php';

$template = new Template('templates/view_log_page.php');

$log = new Log;
if (!isset($_SESSION['viewLogResult'])) {
    $_SESSION['viewLogResult'] = $log->getLogs();
}

/**Displaying the page */
$template->results = $_SESSION['viewLogResult'];
$template->lastPage = ceil(count($_SESSION['viewLogResult']) / 10) - 1;
if (isset($_GET['page'])) {
    $template->page = $_GET['page'];
} else {
    $template->page = 0;
}


echo $template;
