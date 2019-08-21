<!DOCTYPE html>
<html lang="en">

<head>

    <title>CIU | LLRC | Logs</title>
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
                <!--Admin Accounts Nav-->
                <div class="col-12 menuCardContainer">
                    <div class="menu-card bg-light p-4">
                        <div class="row">
                            <div class="col-lg-6 text-left">
                                <p class="lead">ID: <?php echo $results[$i]->id; ?></p>
                                <p class="lead">Action: <?php echo $results[$i]->action; ?></p>
                            </div>
                            <div class="col-lg-6 text-left">
                                <p class="lead">Student ID: <?php echo $results[$i]->student_id; ?></p>
                                <p class="lead">Admin ID: <?php echo $results[$i]->admin_id; ?></p>
                                <p class="lead">Create Date: <?php echo $results[$i]->create_date; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Admin Accounts Nav-->

                <?php endfor; ?>
            </nav>
            <!--Menu Navigation-->

            <!--Pagination-->
            <nav aria-label="Page navigation example" class="mt-5">
                <ul class="pagination justify-content-center">
                    <!--First Page-->
                    <li class="page-item <?php echo ($page > 0) ? '' : 'disabled'; ?>">
                        <a class="page-link" href="view_log.php?&page=<?php echo 0; ?>">
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                    </li>
                    <!--First Page-->

                    <!--Previous Page-->
                    <li class="page-item <?php echo ($page > 0) ? '' : 'disabled'; ?>">
                        <a class="page-link" href="view_log.php?&page=<?php echo $page - 1; ?>">
                            <i class="fas fa-caret-left"></i>
                        </a>
                    </li>
                    <!--Previous Page-->

                    <?php if ($page >= 5) : ?>
                    <li class="page-item">
                        <a class="page-link" href="view_log.php?&page=<?php echo $page - 5; ?>">
                            <?php echo $page - 5 + 1; ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="page-item active">
                        <a class="page-link" href="#">
                            <?php echo $page + 1; ?>
                        </a>
                    </li>
                    <?php if ($lastPage >= ($page + 5)) : ?>
                    <li class="page-item">
                        <a class="page-link" href="view_log.php?&page=<?php echo $page - 5; ?>">
                            <?php echo $page + 5 + 1; ?>
                        </a>
                    </li>
                    <?php endif; ?>

                    <!--Next Page-->
                    <li class="page-item <?php echo (count($results) > ($page * 10) + 10) ? '' : 'disabled'; ?>">
                        <a class="page-link" href="view_log.php?&page=<?php echo $page + 1; ?>">
                            <i class="fas fa-caret-right"></i>
                        </a>
                    </li>
                    <!--Next Page-->

                    <!--Last Page-->
                    <li class="page-item  <?php echo (count($results) > ($page * 10) + 10) ? '' : 'disabled'; ?>">
                        <a class="page-link" href="view_log.php?&page=<?php echo $lastPage; ?>">
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