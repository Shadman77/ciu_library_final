<?php

include_once 'config/init.php'; //Session is started in this code

if (isset($_GET['delete']) && isset($_GET['id'])) {
    $record = new Record;
    $lease = $record->getSingleLease($_GET['id']);
    $book = $record->getSingleBook($lease->isbn);

    if ($record->changeBookLease($lease->isbn, $book->leased, "sub")) {

        if ($record->deleteLease($_GET['id'])) {
            //Delete previously deleted results
            if (isset($_SESSION['leaseResults'])) {
                unset($_SESSION['leaseResults']);
            }
            /**Add Logs */
            try {
                $log = new Log;
                $log->addLog('Lease Deleted ' . $lease->isbn, $lease->student_id, $_SESSION['admin_id']);
            } catch (Exception $e) { }

            redirect('admin_home.php', 'Deleted Successfully.', 'success');
        } else {
            redirect('index.php', 'Something went wrong.', 'error');
        }
    } else {
        redirect('index.php', 'Something went wrong.', 'error');
    }
}

if (isset($_GET['id'])) {
    $template = new Template('templates/view_leases_page.php');

    $record = new Record;
    $searchResult = array();
    array_push($searchResult, $record->getSingleLease($_GET['id']));

    $template->page = 0;
    $template->results = $searchResult;
    $template->lastPage = ceil(count($searchResult) / 10) - 1;

    echo $template; //shows the student accounts page
}

if (isset($_GET['page'])) {
    $template = new Template('templates/view_leases_page.php');


    if (!isset($_SESSION['leaseResults'])) {
        $record = new Record;
        $_SESSION['leaseResults'] = $record->getLeases();
    }


    $template->page = $_GET['page'];
    $template->results = $_SESSION['leaseResults'];
    $template->lastPage = ceil(count($_SESSION['leaseResults']) / 10) - 1;

    //have a template util class just to load the contents
    echo $template; //shows the student accounts page
} else {
    redirect('index.php', 'Opps something went wrong.', 'error');
}
