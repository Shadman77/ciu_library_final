<?php

include_once 'config/init.php';

if (isset($_POST["submit"])) {

    if (
        isset($_POST['student_id']) && isset($_POST['isbn']) && isset($_POST['due_date'])
    ) {
        $record = new Record;
        //Check if books are available
        $book = $record->getSingleBook($_POST['isbn']);
        if ($book->inventory > $book->leased) {
            if ($record->addLease($_POST['student_id'], $_POST['isbn'], $_POST['due_date'])) {
                if ($record->changeBookLease($_POST['isbn'], $book->leased, "add")) {
                    //Delete previously deleted results
                    if (isset($_SESSION['leaseResults'])) {
                        unset($_SESSION['leaseResults']);
                    }
                    redirect('admin_home.php', 'Successfully Added', 'success');
                } else {
                    redirect('admin_home.php', 'Something went wrong.', 'error');
                }
            } else {
                redirect('admin_home.php', 'Something went wrong.', 'error');
            }
        } else {
            redirect('admin_home.php', 'Book not available.', 'error');
        }
    } else {
        redirect('add_lease.php', 'Check if all fields are filled.', 'error');
    }
} else {

    $template = new Template('templates/add_lease_page.php');
    //have a template util class just to load the contents
    echo $template; //shows the sign up page
}
