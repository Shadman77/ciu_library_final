<?php
include_once 'config/init.php';

if (isset($_SESSION['student_id']) || isset($_SESSION['admin_id'])) {
    $template = new Template('templates/view_requests_page.php');

    /**Delete */
    if (isset($_GET['delete']) && isset($_GET['id'])) {
        //Get the request in question first
        $request = new Request;
        $singleRequest = $request->getSingleRequest($_GET['id']);

        if ($singleRequest) {
            //Get in the book in question
            $record = new Record;
            $book = $record->getSingleBook($singleRequest->isbn);

            //If we managed to change the book leasing information
            if ($record->changeBookLease($singleRequest->isbn, $book->leased, 'sub')) {
                if ($request->deleteRequest($_GET['id'])) {
                    if (isset($_SESSION['viewRequestsResult'])) {
                        unset($_SESSION['viewRequestsResult']);
                    }
                    redirect('view_requests.php', 'Successfully Deleted', 'success');
                } else {
                    redirect('index.php', 'Something went wrong.' . 'error');
                }
            } else {
                redirect('index.php', 'Something went wrong.' . 'error');
            }
        } else {
            redirect('index.php', 'Something went wrong.' . 'error');
        }
    }

    /**Ready */
    if (isset($_GET['ready']) && isset($_GET['id'])) {
        $request = new Request;
        if ($request->updateRequest($_GET['id'])) {
            if (isset($_SESSION['viewRequestsResult'])) {
                unset($_SESSION['viewRequestsResult']);
            }
            redirect('view_requests.php', 'Successfully Updated.', 'success');
        } else {
            redirect('index.php', 'Something went wrong.' . 'error');
        }
    }

    /**Leased *///WE NEED TO USED POST METHOD FOR THIS AND ALSO DUE DATE
    if (isset($_GET['leased']) && isset($_GET['id'])) {
        //Get the request in question first
        $request = new Request;
        $singleRequest = $request->getSingleRequest($_GET['id']);

        if (!$singleRequest) {
            redirect('index.php', 'Something went wrong.' . 'error');
        }

        //First we delete the request
        if ($request->deleteRequest($_GET['id'])) {
            //Get in the book in question
            $record = new Record;
            $book = $record->getSingleBook($singleRequest->isbn);

            if ($book->inventory > $book->leased) {
                if ($record->addLease($singleRequest->student_id, $singleRequest->isbn, $_POST['due_date'])) {
                    if (isset($_SESSION['leaseResults'])) {
                        unset($_SESSION['leaseResults']);
                    }
                }
            }
        } else {
            redirect('index.php', 'Something went wrong.' . 'error');
        }
    }

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
