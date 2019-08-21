<!DOCTYPE html>
<html lang="en">

<head>

    <title>CIU | LLRC | Books</title>
    <?php require_once "include/header_include.php"; ?>

</head>

<body>
    <!--Message-->
    <?php echo displayMessage(); ?>
    <!--Message-->

    <!--Navbar-->
    <?php require_once "include/navbar.php"; ?>
    <!--Navbar-->

    <div class="nav-window">
        <div class="container">
            <!--Menu Navigation-->
            <nav class="row">
                <!--Menu Cards-->
                <?php require_once "include/nav_menu_cards.php"; ?>
                <!--Menu Cards-->

                <?php
                $loopStart = $page * 10;
                $resultsSize = count($results);
                if ($resultsSize < (10 + $page * 10)) {
                    $loopEnd = $resultsSize;
                } else {
                    $loopEnd = $loopStart + 10;
                }

                for ($i = $loopStart; $i < $loopEnd; $i++) : ?>
                <!--Student Accounts Nav-->
                <div class="col-12 menuCardContainer">
                    <div class="menu-card bg-light p-4">
                        <div class="row">
                            <div class="col-lg-6 text-left">
                                <p class="lead">ID: <?php echo $results[$i]->id; ?></p>
                                <p class="lead">Student ID: <?php echo $results[$i]->student_id; ?></p>
                                <p class="lead">
                                    ISBN:
                                    <a href="view_single_book.php?isbn=<?php echo $results[$i]->isbn; ?>">
                                        <?php echo $results[$i]->isbn; ?>
                                    </a>
                                </p>
                            </div>
                            <div class="col-lg-6 text-left">
                                <p class="lead">Create Date: <?php echo $results[$i]->create_date; ?></p>
                                <p class="lead">Status: <?php echo $results[$i]->status; ?></p>
                                <p class="text-left">
                                    <?php if (isset($_SESSION['admin_id'])) : ?>
                                    <a href="<?php echo 'view_requests.php?id=' . $results[$i]->id; ?>" class="btn btn-info">
                                        Ready
                                    </a>
                                    <a href="<?php echo 'view_requests.php?id=' . $results[$i]->id . '&leased=true'; ?>" class="btn btn-primary">
                                        Leased
                                    </a>
                                    <?php endif; ?>
                                    <a href="<?php echo 'view_requests.php?id=' . $results[$i]->id . '&delete=true'; ?>" class="btn btn-danger">
                                        Delete
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Student Accounts Nav-->

                <?php endfor; ?>
            </nav>
            <!--Menu Navigation-->

            <!--Pagination-->
            <nav aria-label="Page navigation example" class="mt-5">
                <ul class="pagination justify-content-center">
                    <!--First Page-->
                    <li class="page-item <?php echo ($page > 0) ? '' : 'disabled'; ?>">
                        <a class="page-link" href="view_books.php?&page=<?php echo 0; ?>">
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                    </li>
                    <!--First Page-->

                    <!--Previous Page-->
                    <li class="page-item <?php echo ($page > 0) ? '' : 'disabled'; ?>">
                        <a class="page-link" href="view_books.php?&page=<?php echo $page - 1; ?>">
                            <i class="fas fa-caret-left"></i>
                        </a>
                    </li>
                    <!--Previous Page-->


                    <?php if ($page >= 5) : ?>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <?php echo $page - 5; ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="page-item active">
                        <a class="page-link" href="#">
                            <?php echo $page + 1; ?>
                        </a>
                    </li>
                    <?php if ((($page + 4) * 10 + 1)  <= count($results)) : ?>
                    <li class="page-item">
                        <a class="page-link" href="#">15</a>
                    </li>
                    <?php endif; ?>

                    <!--Next Page-->
                    <li class="page-item <?php echo (count($results) > ($page * 10) + 10) ? '' : 'disabled'; ?>">
                        <a class="page-link" href="view_books.php?&page=<?php echo $page + 1; ?>">
                            <i class="fas fa-caret-right"></i>
                        </a>
                    </li>
                    <!--Next Page-->

                    <!--Last Page-->
                    <li class="page-item  <?php echo (count($results) > ($page * 10) + 10) ? '' : 'disabled'; ?>">
                        <a class="page-link" href="view_books.php?&page=<?php echo $lastPage; ?>">
                            <i class="fas fa-angle-double-right"></i>
                        </a>
                    </li>
                    <!--Last Page-->
                </ul>
            </nav>
            <!--Pagination-->
        </div>


        <!--Footer-->
        <?php require_once "include/footer_include.php"; ?>
        <!--Footer-->


    </div>

    <!--Popup Menu-->
    <?php require_once "include/popup_menu.php"; ?>
    <!--Popup Menu-->

</body>