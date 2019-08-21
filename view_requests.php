<?php
include_once 'config/init.php';

if (isset($_SESSION['student_id']) || isset($_SESSION['admin_id'])) {
    $template = new Template('templates/view_requests_page.php');

    /**Getting the results */
    if (!isset($_SESSION['viewRequestsResult']) || isset($_POST['reset'])) {
        $request = new Request;
        $_SESSION['viewRequestsResult'] = $request->getRequests();
    } elseif (isset($_POST['keyword']) && isset($_POST['search_by'])) {
        $request = new Request;
        $_SESSION['viewRequestsResult'] = $request->getRequestsBySearch($_POST['keyword'], $_POST['search_by']);
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
