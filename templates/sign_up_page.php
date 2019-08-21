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
        <form id="signUpForm" class="welcome-text-container account-form" action="sign_up.php" method="post" enctype="multipart/form-data">
            <div class="text-center">
                <figure id="preview-figure">
                    <img class="form-preview-img" id="preview_img" alt="preview image" /><br>
                    <caption>Preview Image</caption>
                </figure>
            </div>
            <div class="form-group">
                <label for="image">Image<span style="color: red;">*</span></label>
                <div class="custom-file">
                    <input type="file" onchange="readImageURL(this);" class="custom-file-input" id="image" name="image" required>
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>
            </div>
            <div class="form-group">
                <label for="id">Student ID<span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="id" name="id" placeholder="ID" required>
            </div>
            <div class="form-group">
                <label for="name">Name<span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="email">Email<span style="color: red;">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="cell_no">Cell No<span style="color: red;">*</span></label>
                    <input type="tel" pattern="[0-9]{11}" class="form-control" id="cell_no" name="cell_no" placeholder="Cell No" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="department">Department<span style="color: red;">*</span></label>
                    <select type="text" class="form-control" id="department" name="department" placeholder="Department" required>
                        <option value="CSE">CSE</option>
                        <option value="CS">CS</option>
                        <option value="CE">CE</option>
                        <option value="EEE">EEE</option>
                        <option value="ETE">ETE</option>
                        <option value="ICT">ICT</option>
                        <option value="Accounting">Accounting</option>
                        <option value="Finance">Finance</option>
                        <option value="HRM">HRM</option>
                        <option value="Marketing">Marketing</option>
                        <option value="LLB">LLB</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="school">School<span style="color: red;">*</span></label>
                    <select type="text" class="form-control" id="school" name="school" placeholder="School" required>
                        <option value="SSE">SSE</option>
                        <option value="CIUBS">CIUBS</option>
                        <option value="SLASS">SLASS</option>
                        <option value="SOL">SOL</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="credit_system">Credit System<span style="color: red;">*</span></label>
                <select type="text" class="form-control" id="credit_system" name="credit_system" placeholder="Credit System" required>
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Password<span style="color: red;">*</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password<span style="color: red;">*</span></label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
            </div>
            <div class="text-center">
                <input type="submit" value="Sign Up" name="submit" class="mb-2 btn btn-primary"><br>
                <a href="admin_sign_up.php">Admin Sign Up</a><br>
                Already a user? <a href="sign_in.php">Sign In</a>
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