<!DOCTYPE html>
<html lang="en">

<head>

    <title>CIU | LLRC | View Book</title>
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
        <form id="addBookForm" class="welcome-text-container account-form" action="view_single_book.php" method="post" enctype="multipart/form-data">
            <div class="text-center">
                <figure id="preview-figure" style="display: block;">
                    <img class="form-preview-img" style="display: inline-block" src="<?php echo $result->picture; ?>" id="preview_img" alt="preview image" /><br>
                    <caption>Preview Image</caption>
                </figure>
            </div>
            <?php if (isset($_SESSION['admin_id'])) : ?>
            <div class="form-group">
                <label for="image">Image<span style="color: red;">*</span></label>
                <div class="custom-file">
                    <input type="file" onchange="readImageURL(this);" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="isbn">ISBN<span style="color: red;">*</span></label>
                <input type="number" value="<?php echo $result->isbn; ?>" class="form-control" id="isbn" name="isbn" placeholder="ISBN" required>
            </div>
            <div class="form-group">
                <label for="title">Title<span style="color: red;">*</span></label>
                <input type="text" value="<?php echo $result->title; ?>" class="form-control" id="title" name="title" placeholder="Title" required>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="author">Author<span style="color: red;">*</span></label>
                    <input type="text" value="<?php echo $result->author; ?>" class="form-control" id="author" name="author" placeholder="Author" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="publisher">Publisher<span style="color: red;">*</span></label>
                    <input type="text" value="<?php echo $result->publisher; ?>" class="form-control" id="publisher" name="publisher" placeholder="Publisher" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="year_published">Year Published<span style="color: red;">*</span></label>
                    <input type="number" value="<?php echo $result->year_published; ?>" class="form-control" id="year_published" name="year_published" placeholder="Year Published" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="edition">Edition<span style="color: red;">*</span></label>
                    <input type="number" value="<?php echo $result->edition; ?>" class="form-control" id="edition" name="edition" placeholder="Edition" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="category">Category<span style="color: red;">*</span></label>
                    <select type="text" class="form-control" id="category" name="category" placeholder="Category" required>
                        <option value="Engineering" <?php echo ($result->category == 'Engineering') ? 'selected' : ''; ?>>Engineering</option>
                        <option value="Science" <?php echo ($result->category == 'Science') ? 'selected' : ''; ?>>Science</option>
                        <option value="IT" <?php echo ($result->category == 'IT') ? 'selected' : ''; ?>>IT</option>
                        <option value="Business" <?php echo ($result->category == 'Business') ? 'selected' : ''; ?>>Business</option>
                        <option value="Marketing" <?php echo ($result->category == 'Marketing') ? 'selected' : ''; ?>>Marketing</option>
                        <option value="Electrical" <?php echo ($result->category == 'Electrical') ? 'selected' : ''; ?>>Electrical</option>
                        <option value="Programming" <?php echo ($result->category == 'Programming') ? 'selected' : ''; ?>>Programming</option>
                        <option value="Law" <?php echo ($result->category == 'Law') ? 'selected' : ''; ?>>Law</option>
                        <option value="Accounting" <?php echo ($result->category == 'Accounting') ? 'selected' : ''; ?>>Accounting</option>
                    </select>
                </div>
                <?php if (isset($_SESSION['admin_id'])) : ?>
                <div class="form-group col-md-6">
                    <label for="inventory">Inventory<span style="color: red;">*</span></label>
                    <input type="number" value="<?php echo $result->inventory; ?>" class="form-control" id="inventory" name="inventory" placeholder="Inventory" required>
                </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['student_id'])) : ?>
                <div class="form-group col-md-6 text-center">
                    <p class="lead">Add to cart</p>
                    <a href="add_request.php?isbn=<?php echo $result->isbn; ?>" class="btn btn-danger">
                        <i style="font-size: 200%" class="fas fa-cart-plus"></i>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <?php if (isset($_SESSION['admin_id'])) : ?>
            <div class="text-center">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#verifyUpdate">
                    Update
                </button>
                <!-- Modal -->
                <div class="modal fade" id="verifyUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <div class="modal-footer">
                                <input type="hidden" id="old_isbn" name="old_isbn" value="<?php echo $result->isbn; ?>">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input name="submit" value="Update" type="submit" class="btn btn-warning">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#verifyDelete">
                    Delete
                </button>
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
                            <div class="modal-footer">
                                <input type="hidden" id="old_id" name="old_id" value="<?php echo $result->id; ?>">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input name="delete" value="Delete" type="submit" class="btn btn-danger">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
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