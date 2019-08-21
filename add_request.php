<?php
include_once 'config/init.php';

if (isset($_GET['isbn']) && isset($_SESSION['student_id'])) {
    $record = new Record;
    $request = new Request;

    $book = $record->getSingleBook($_GET['isbn']);
    if ($book) {
        if ($book->inventory > $book->leased) {
            if ($request->addRequest($_GET['isbn'])) {
                if ($record->changeBookLease($_GET['isbn'], $book->leased, 'add')) {
                    if (isset($_SESSION['viewRequestsResult'])) {
                        unset($_SESSION['viewRequestsResult']);
                    }
                    redirect('view_books.php', 'Added to cart.', 'success');
                } else {
                    redirect('index.php', 'Something went wrong.', 'error');
                }
            } else {
                redirect('index.php', 'Something went wrong.', 'error');
            }
        } else {
            redirect('view_books.php', 'Book not available.', 'error');
        }
    }
} else {
    redirect('index.php', 'Something went wrong.', 'error');
}
