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

                <!--Admin Nav-->
                <div class="col-md-12 menuCardContainer">


                    <div class="bg-light p-2">
                        <!--Filter By-->
                        <h4>Filter By</h4>
                        <hr>
                        <form action="view_books.php" method="post" autocomplete="off">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="filter_category">Category</label>
                                    <select type="text" class="form-control search-text-input" id="filter_category" name="filter_category" placeholder="Category">
                                        <option value="All" selected>All</option>
                                        <option value="Engineering">Engineering</option>
                                        <option value="Science">Science</option>
                                        <option value="IT">IT</option>
                                        <option value="Business">Business</option>
                                        <option value="Marketing">Marketing</option>
                                        <option value="Electrical">Electrical</option>
                                        <option value="Programming">Programming</option>
                                        <option value="Law">Law</option>
                                        <option value="Accounting">Accounting</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="filter_year_published">Year Published</label>
                                    <input type="number" class="form-control search-text-input" id="filter_year_published" name="filter_year_published" placeholder="Year Published">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="filter_edition">Edition</label>
                                    <input type="number" class="form-control search-text-input" id="filter_edition" name="filter_edition" placeholder="Edition">
                                </div>
                                <div class="form-group col-sm-2">
                                    <label for="submit">Apply Filters</label><br>
                                    <input name="filter" value="Go" type="submit" class="btn search-button" style="max-width: 100px;">
                                </div>
                            </div>
                        </form>
                        <!--Filter By-->
                        <!--Search-->
                        <h4>Search</h4>
                        <hr class="m-0 mb-2">
                        <form action="view_books.php" method="post" autocomplete="off">
                            <div class="form-row p-1">
                                <div class="col-sm-6 p-0">
                                    <input type="text" id="keyword" name="keyword" placeholder="Keyword" class="form-control search-text-input" required>
                                </div>
                                <div class="col-sm-4 p-0">
                                    <select name="search_by" id="search_by" class="form-control search-text-input" required>
                                        <option value="title">Title</option>
                                        <option value="author">Author</option>
                                        <option value="isbn">ISBN</option>
                                        <option value="publisher">Publisher</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 p-0">
                                    <button type="submit" class="btn search-button"><i class="fas fa-search"></i>
                                        <span class="search-btn-text">Search</span></button>
                                </div>
                            </div>
                        </form>
                        <form action="view_books.php" method="post" class="form-group col-12 mt-2">
                            <label for="reset">Remove Filters</label><br>
                            <input type="submit" name="reset" value="Reset" class="btn bg-danger text-light search-button" style="max-width: 100px;">
                        </form>
                        <!--Search-->
                    </div>
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
                                <p class="lead">Title: <?php echo $results[$i]->title; ?></p>
                                <p class="lead">Author: <?php echo $results[$i]->author; ?></p>
                                <p class="lead">Year Published: <?php echo $results[$i]->year_published; ?></p>
                                <p class="lead">ISBN: <?php echo $results[$i]->isbn; ?></p>
                                <p class="text-left">
                                    <a href="<?php echo 'view_single_book.php?isbn=' . $results[$i]->isbn; ?>" class="btn btn-info" style="background-color: #2E3192">
                                        View
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