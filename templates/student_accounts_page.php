<!DOCTYPE html>
<html lang="en">

<head>

    <title>CIU | LLRC | Student Accounts</title>
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

                <!--Admin Nav-->
                <div class="col-md-12 menuCardContainer">
                    <!--Form-->
                    <form class="bg-light p-2" style="color: #2E3192" method="get" action="student_account_edit.php" autocomplete="off">
                        <h4 style="text-align: center">Search By Student ID</h4>
                        <hr class="m-0 mb-2">
                        <div class="form-row p-1">
                            <div class="col-sm-8 p-0">
                                <input type="text" name="id" placeholder="Student ID" class="form-control search-text-input">
                            </div>
                            <div class="col-sm-4 p-0">
                                <button type="submit" class="btn search-button"><i class="fas fa-search"></i>
                                    <span class="search-btn-text">Search</span></button>
                            </div>
                        </div>

                        <h4 class="mt-2" style="text-align: center">Search By Account Status</h4>
                        <hr class="m-0 mb-2">
                        <a href="student_accounts.php?status=pending&page=0" class="btn btn-warning" style="background-color: <?php echo ($status === 'pending') ? '#ffe359' : '#F2B121'; ?>">Pending</a>
                        <a href="student_accounts.php?status=active&page=0" class="btn btn-warning" style="background-color: <?php echo ($status === 'active') ? '#ffe359' : '#F2B121'; ?>">Active</a>
                        <a href="student_accounts.php?status=blocked&page=0" class="btn btn-warning" style="background-color: <?php echo ($status === 'blocked') ? '#ffe359' : '#F2B121'; ?>">Blocked</a>
                        <a href="student_accounts.php?status=all&page=0" class="btn btn-warning" style="background-color: <?php echo ($status === 'all') ? '#ffe359' : '#F2B121'; ?>">All</a>

                    </form>
                    <!--Forms-->
                </div>

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
                    <div class="menu-card bg-light hvr-grow">
                        <div class="row">
                            <div class="col-lg-6">
                                <img style="width: auto; height: 235px;" src="<?php echo $results[$i]->picture; ?>" alt="Image of student <?php echo $results[$i]->id; ?>">
                            </div>
                            <div class="col-lg-6 text-left">
                                <p class="lead">Name: <?php echo $results[$i]->name; ?></p>
                                <p class="lead">ID: <?php echo $results[$i]->id; ?></p>
                                <p class="lead">Email: <?php echo $results[$i]->email; ?></p>
                                <p class="lead">Status: <?php echo $results[$i]->status; ?></p>
                                <p class="text-left">
                                    <a href="<?php echo 'student_account_edit.php?id=' . $results[$i]->id; ?>" class="btn btn-info" style="background-color: #2E3192">
                                        View Account
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
                        <a class="page-link" href="student_accounts.php?status=<?php echo $status; ?>&page=<?php echo 0; ?>">
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                    </li>
                    <!--First Page-->

                    <!--Previous Page-->
                    <li class="page-item <?php echo ($page > 0) ? '' : 'disabled'; ?>">
                        <a class="page-link" href="student_accounts.php?status=<?php echo $status; ?>&page=<?php echo $page - 1; ?>">
                            <i class="fas fa-caret-left"></i>
                        </a>
                    </li>
                    <!--Previous Page-->


                    <?php if ($page >= 5) : ?>
                    <li class="page-item">
                        <a class="page-link" href="student_accounts.php?status=<?php echo $status; ?>&page=<?php echo $page + 5; ?>">
                            <?php echo $page - 5 + 1; ?>
                        </a>
                    </li>
                    <?php endif; ?>

                    <!--Current Page-->
                    <li class="page-item active">
                        <a class="page-link" href="#">
                            <?php echo $page + 1; ?>
                        </a>
                    </li>
                    <!--Current Page-->
                    
                    <?php if ($lastPage >= ($page + 5)) : ?>
                    <li class="page-item">
                        <a class="page-link" href="student_accounts.php?status=<?php echo $status; ?>&page=<?php echo $page + 5; ?>">
                            <?php echo $page + 5 + 1; ?>
                        </a>
                    </li>
                    <?php endif; ?>

                    <!--Next Page-->
                    <li class="page-item <?php echo (count($results) > ($page * 10) + 10) ? '' : 'disabled'; ?>">
                        <a class="page-link" href="student_accounts.php?status=<?php echo $status; ?>&page=<?php echo $page + 1; ?>">
                            <i class="fas fa-caret-right"></i>
                        </a>
                    </li>
                    <!--Next Page-->

                    <!--Last Page-->
                    <li class="page-item  <?php echo (count($results) > ($page * 10) + 10) ? '' : 'disabled'; ?>">
                        <a class="page-link" href="student_accounts.php?status=<?php echo $status; ?>&page=<?php echo $lastPage; ?>">
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