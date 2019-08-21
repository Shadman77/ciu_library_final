<!DOCTYPE html>
<html lang="en">

<head>

    <title>CIU | LLRC | Edit Student Account</title>
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
        <form id="signUpForm" class="welcome-text-container account-form" action="admin_account_edit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="old_id" name="old_id" value="<?php echo $result->id; ?>">
            <div class="text-center">
                <figure id="preview-figure" style="display: block;">
                    <img class="form-preview-img" style="display: inline-block" id="preview_img" alt="preview image" src="<?php echo $result->picture; ?>" /><br>
                    <caption>Admin Picture</caption>
                </figure>
            </div>
            <div class="form-group">
                <label for="image">Image<span style="color: red;">*</span></label>
                <div class="custom-file">
                    <input type="file" onchange="readImageURL(this);" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>
            </div>
            <div class="form-group">
                <label for="id">Admin ID<span style="color: red;">*</span></label>
                <input type="text" class="form-control" value="<?php echo $result->id; ?>" id="id" name="id" placeholder="ID" required>
            </div>
            <div class="form-group">
                <label for="name">Name<span style="color: red;">*</span></label>
                <input type="text" class="form-control" value="<?php echo $result->name; ?>" id="name" name="name" placeholder="Name" required>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="email">Email<span style="color: red;">*</span></label>
                    <input type="email" class="form-control" value="<?php echo $result->email; ?>" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="cell_no">Cell No<span style="color: red;">*</span></label>
                    <input type="tel" pattern="[0-9]{11}" class="form-control" value="<?php echo '0' . $result->cell; ?>" id="cell_no" name="cell_no" placeholder="Cell No" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="status">Status<span style="color: red;">*</span></label>
                    <select type="text" class="form-control" id="status" name="status" placeholder="Status" required>
                        <option value="pending" <?php echo ($result->status == 'pending') ? 'selected' : ''; ?>>pending</option>
                        <option value="active" <?php echo ($result->status == 'active') ? 'selected' : ''; ?>>active</option>
                        <option value="blocked" <?php echo ($result->status == 'blocked') ? 'selected' : ''; ?>>blocked</option>
                    </select>
                </div>
            </div>
            <div class="text-center">
                <input type="submit" value="Update" name="submit" class="mb-2 btn btn-warning"><br>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#verifyDelete">
                    Delete Account
                </button>
            </div>
        </form>
        <!--Form-->

        <!-- Modal -->
        <div class="modal fade" id="verifyDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure?
                    </div>
                    <form method="post" action="admin_account_edit.php" class="modal-footer">
                        <input type="hidden" id="old_id" name="old_id" value="<?php echo $result->id; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input name="delete" value="Delete" type="submit" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>

        <!--Footer-->
        <?php require_once "include/footer_include.php"; ?>
        <!--Footer-->


    </div>

    <!--Popup Menu-->
    <?php require_once "include/popup_menu.php"; ?>
    <!--Popup Menu-->

</body>