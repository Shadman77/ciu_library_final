<?php
include_once 'config/init.php';

$template = new Template('templates/view_books_page.php');

/**Reset */
if (isset($_POST['reset'])) {
    $record = new Record;
    $_SESSION['viewBooksResult'] = $record->getAllBooks(0, 'all', 'all');
}

/**Search */
if (isset($_POST['keyword']) && isset($_POST['search_by'])) {
    $record = new Record;
    $_SESSION['viewBooksResult'] = $record->getAllBooks(0, $_POST['keyword'], $_POST['search_by']);
}

/**If still no result set */
if (!isset($_SESSION['viewBooksResult'])) {
    $record = new Record;
    $_SESSION['viewBooksResult'] = $record->getAllBooks(0, 'all', 'all');
}

/**Filter */
if (isset($_POST['filter'])) {
    $temp = array();
    for ($i = 0; $i < count($_SESSION['viewBooksResult']); $i++) {
        if (isset($_POST['filter_category'])) {
            if ($_SESSION['viewBooksResult'][$i]->category == $_POST['filter_category']) {
                array_push($temp, $_SESSION['viewBooksResult'][$i]);
                continue;
            }
        }
        if (isset($_POST['filter_edition'])) {
            if ($_SESSION['viewBooksResult'][$i]->edition == $_POST['filter_edition']) {
                array_push($temp, $_SESSION['viewBooksResult'][$i]);
                continue;
            }
        }
        if (isset($_POST['filter_year_published'])) {
            if ($_SESSION['viewBooksResult'][$i]->year_published == $_POST['filter_year_published']) {
                array_push($temp, $_SESSION['viewBooksResult'][$i]);
                continue;
            }
        }
    }
    $_SESSION['viewBooksResult'] = $temp;
}

/**Displaying the results */
if (isset($_SESSION['viewBooksResult'])) {
    $template->results = $_SESSION['viewBooksResult'];
    $template->lastPage = ceil(count($_SESSION['viewBooksResult']) / 10) - 1;
    if (isset($_GET['page'])) {
        $template->page = $_GET['page'];
    } else {
        $template->page = 0;
    }
    ////////////////////////////////////
    echo $template;
} else {
    redirect('index.php', 'Something went wrong.', 'error');
}
