<!DOCTYPE html>
<html lang="en">

<head>

    <title>CIU | LLRC | Admin Home</title>
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
                <div class="col-md-6 menuCardContainer">
                    <a href="add_book.php" class="menu-card bg-light hvr-grow">
                        <span class="panel-card-icon"><i class="fas fa-book-medical"></i></span><br>
                        Add Book
                    </a>
                </div>
                <div class="col-md-6 menuCardContainer">
                    <a href="student_accounts.php?status=pending&page=0" class="menu-card bg-light hvr-grow">
                        <span class="panel-card-icon"><i class="fas fa-users"></i></span><br>
                        Student Accounts
                    </a>
                </div>
                <div class="col-md-6 menuCardContainer">
                    <a href="admin_accounts.php?status=pending&page=0" class="menu-card bg-light hvr-grow">
                        <span class="panel-card-icon"><i class="fas fa-users-cog"></i></span><br>
                        Admin Accounts
                    </a>
                </div>
                <div class="col-md-6 menuCardContainer">
                    <a href="add_lease.php" class="menu-card bg-light hvr-grow">
                        <span class="panel-card-icon"><i class="fas fa-folder-plus"></i></span><br>
                        Add New Lease
                    </a>
                </div>
                <div class="col-md-6 menuCardContainer">
                    <a href="view_leases.php?page=0" class="menu-card bg-light hvr-grow">
                        <span class="panel-card-icon"><i class="fas fa-copy"></i></span><br>
                        View Leases
                    </a>
                </div>
                <div class="col-md-6 menuCardContainer">
                    <a href="view_requests.php" class="menu-card bg-light hvr-grow">
                        <span class="panel-card-icon"><i class="fas fa-shopping-cart"></i></span><br>
                        View Requests
                    </a>
                </div>
                <!--Admin Nav-->
            </nav>
            <!--Menu Navigation-->
        </div>


        <!--Footer-->
        <?php require_once "include/footer_include.php"; ?>
        <!--Footer-->


    </div>

    <!--Popup Menu-->
    <?php require_once "include/popup_menu.php"; ?>
    <!--Popup Menu-->

</body>