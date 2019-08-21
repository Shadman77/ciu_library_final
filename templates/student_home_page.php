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

                <!--Student Nav-->
                <div class="col-md-6 menuCardContainer">
                    <a href="view_requests.php" class="menu-card bg-light hvr-grow">
                        <span class="panel-card-icon"><i class="fas fa-shopping-cart"></i></span>
                        <?php if ($_SESSION['ready'] && $_SESSION['notification']) : ?>
                        <i class="fas fa-bell text-danger animate-flicker"></i>
                        <?php endif; ?>
                        <br>
                        View Cart
                    </a>
                </div>
                <div class="col-md-6 menuCardContainer">
                    <a href="view_requests.php" class="menu-card bg-light hvr-grow">
                        <span class="panel-card-icon"><i class="fas fa-shopping-cart"></i></span><br>
                        View Requests
                    </a>
                </div>
                <!--Student Nav-->
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