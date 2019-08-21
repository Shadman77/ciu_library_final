<?php
include_once 'config/init.php';

if (isset($_SESSION['student_id']) || isset($_SESSION['admin_id'])) {
    $template = new Template('templates/view_requests_page.php');

    /**Getting the results */
    if (!isset($_SESSION['viewRequestsResult'])) {
        $request = new Request;
        $_SESSION['viewRequestsResult'] = $request->getRequests();
    }

    /**Displaying the page */
    $template->results = $_SESSION['viewRequestsResult'];
    $template->lastPage = ceil(count($_SESSION['viewRequestsResult']) / 10) - 1;
    if (isset($_GET['page'])) {
        $template->page = $_GET['page'];
    } else {
        $template->page = 0;
    }

    echo $template;
} else {
    redirect('index.php', 'Please login to view the page.', 'error');
}
