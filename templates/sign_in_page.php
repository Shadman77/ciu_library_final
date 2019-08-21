<!DOCTYPE html>
<html lang="en">

<head>

    <title>CIU | LLRC | Sign Up</title>
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
            </nav>
            <!--Menu Navigation-->
        </div>


        <!--Form-->
        <form id="signInForm" class="welcome-text-container account-form" action="sign_in.php" method="post">
            <div class="form-group">
                <label for="id">ID<span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="id" name="id" placeholder="ID" required>
            </div>
            <div class="form-group">
                <label for="password">Password<span style="color: red;">*</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="text-center">
                <button type="submit" class="mb-2 btn btn-primary">Sign In</button><br>
                Not a user? <a href="sign_up.php">Sign Up</a>
            </div>
        </form>
        <!--Form-->

        <!--Footer-->
        <?php require_once "include/footer_include.php"; ?>
        <!--Footer-->


    </div>

    <!--Popup Menu-->
    <?php require_once "include/popup_menu.php"; ?>
    <!--Popup Menu-->

</body>