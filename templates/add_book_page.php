<!DOCTYPE html>
<html lang="en">

<head>

    <title>CIU | LLRC | Add Book</title>
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
        <form id="addBookForm" class="welcome-text-container account-form" action="add_book.php" method="post" enctype="multipart/form-data">
            <div class="text-center">
                <figure id="preview-figure">
                    <img class="form-preview-img" id="preview_img" alt="preview image" /><br>
                    <caption>Preview Image</caption>
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
                <label for="isbn">ISBN<span style="color: red;">*</span></label>
                <input type="number" class="form-control" id="isbn" name="isbn" placeholder="ISBN" required>
            </div>
            <div class="form-group">
                <label for="title">Title<span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="author">Author<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="Author" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="publisher">Publisher<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="publisher" name="publisher" placeholder="Publisher" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="year_published">Year Published<span style="color: red;">*</span></label>
                    <input type="number" class="form-control" id="year_published" name="year_published" placeholder="Year Published" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="edition">Edition<span style="color: red;">*</span></label>
                    <input type="number" class="form-control" id="edition" name="edition" placeholder="Edition" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="category">Category<span style="color: red;">*</span></label>
                    <select type="text" class="form-control" id="category" name="category" placeholder="Category" required>
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
                <div class="form-group col-md-6">
                    <label for="inventory">Inventory<span style="color: red;">*</span></label>
                    <input type="number" class="form-control" id="inventory" name="inventory" placeholder="Inventory" required>
                </div>
            </div>
            <div class="text-center">
                <input type="submit" value="Add Book" name="submit" class="mb-2 btn btn-primary"><br>
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