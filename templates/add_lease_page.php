<!DOCTYPE html>
<html lang="en">

<head>

    <title>CIU | LLRC | Add Lease</title>
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
        <form id="addLeaseForm" class="welcome-text-container account-form" action="add_lease.php" method="post">
            <div class="form-group">
                <label for="student_id">Student ID<span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Student ID" required>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN<span style="color: red;">*</span></label>
                <input type="number" class="form-control" id="isbn" name="isbn" placeholder="ISBN" required>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date<span style="color: red;">*</span></label>
                <input type="date" class="form-control" id="due_date" name="due_date" placeholder="Due Date" required>
            </div>
            <div class="text-center">
                <input type="submit" value="Add" name="submit" class="mb-2 btn btn-primary">
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