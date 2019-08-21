<!--Pop Up Menu-->
<div id="resources" class="menu-pop-up d-flex align-items-center justify-content-center">
    <div class="popup-close-btn">
        <a href="javascript:togglePopupMenu('resources');" class="close-button">
            <div class="close-btn-in">
                <div class="close-button-block"></div>
                <div class="close-button-block"></div>
            </div>
            <div class="close-btn-out">
                <div class="close-button-block"></div>
                <div class="close-button-block"></div>
            </div>
        </a>
    </div>

    <!--Sub Menu-->
    <div class="row popup-submenu-container">
        <div class="col-6 menuCardContainer">
            <a href="" class="menu-card hvr-grow">
                <img src="img/campus_icon.png" alt="campus_icon"><br>
                Services
            </a>
        </div>
        <div class="col-6 menuCardContainer">
            <a href="" class="menu-card hvr-grow">
                <img src="img/books_icon.png" alt="books_icon"><br>
                Resources
            </a>
        </div>
        <div class="col-6 menuCardContainer">
            <a href="" class="menu-card hvr-grow">
                <img src="img/news_icon.png" alt="news_icon"><br>
                News
            </a>
        </div>
        <div class="col-6 menuCardContainer">
            <a href="" class="menu-card hvr-grow">
                <img src="img/contact_icon.png" alt="contact_icon"><br>
                Contact
            </a>
        </div>
    </div>
</div>
<!--Pop Up Menu-->

<!--Pop Up Admin Menu-->
<div id="adminSubMenu" class="menu-pop-up d-flex align-items-center justify-content-center">
    <div class="popup-close-btn">
        <a href="javascript:togglePopupMenu('adminSubMenu');" class="close-button">
            <div class="close-btn-in">
                <div class="close-button-block"></div>
                <div class="close-button-block"></div>
            </div>
            <div class="close-btn-out">
                <div class="close-button-block"></div>
                <div class="close-button-block"></div>
            </div>
        </a>
    </div>

    <!--Sub Menu-->
    <div class="row popup-submenu-container">
        <form action="admin_home.php" method="post" class="col-6 menuCardContainer">
            <button class="menu-card hvr-grow bg-light">
                <i style="font-size: 200%;" class="fas fa-cogs"></i><br>
                Admin Panel
            </button>
        </form>
        <form action="sign_in.php" method="post" class="col-6 menuCardContainer">
            <input type="hidden" name="logout" value="logout" id="logout">
            <button type="submit" class="menu-card hvr-grow bg-light text-danger">
                <i style="font-size: 200%;" class="fas fa-power-off"></i><br>
                Logout
            </button>
        </form>
    </div>
</div>
<!--Pop Up Admin Menu-->

<!--Pop Up Student Menu-->
<div id="studentSubMenu" class="menu-pop-up d-flex align-items-center justify-content-center">
    <div class="popup-close-btn">
        <a href="javascript:togglePopupMenu('studentSubMenu');" class="close-button">
            <div class="close-btn-in">
                <div class="close-button-block"></div>
                <div class="close-button-block"></div>
            </div>
            <div class="close-btn-out">
                <div class="close-button-block"></div>
                <div class="close-button-block"></div>
            </div>
        </a>
    </div>

    <!--Sub Menu-->
    <div class="row popup-submenu-container">
        <form action="student_home.php" method="post" class="col-6 menuCardContainer">
            <button class="menu-card hvr-grow bg-light">
                <i style="font-size: 200%;" class="fas fa-graduation-cap"></i><br>
                Student Panel
            </button>
        </form>
        <form action="sign_in.php" method="post" class="col-6 menuCardContainer">
            <input type="hidden" name="logout" value="logout" id="logout">
            <button type="submit" class="menu-card hvr-grow bg-light text-danger">
                <i style="font-size: 200%;" class="fas fa-power-off"></i><br>
                Logout
            </button>
        </form>
    </div>
</div>
<!--Pop Up Student Menu-->