<div style="background-color: #2E3192;">
    <p class="navbar-brand" id="mobile-header-text">
        CIU Library and Learning Resources Center
    </p>
    <nav class="navbar navbar-expand-sm navbar-dark navbar-custom justify-content-between" id="top-nav">
        <header>
            <a class="navbar-brand" href="#"><img src="img/ciu_logo.png" alt="CIU Logo" height="100px" width="auto"><span id="desktop-header-text"> CIU Library and Learning Resource Center</span></a>
        </header>

        <?php if (isset($_SESSION['admin_id'])) : ?>

        <a class="nav-link hvr-grow" href="javascript:togglePopupMenu('adminSubMenu');">
            <i class="fas fa-user nav-icon"></i><br>
            Admin
        </a>

        <?php elseif (isset($_SESSION['student_id'])) : ?>

        <a class="nav-link hvr-grow" href="javascript:togglePopupMenu('studentSubMenu');">
            <i class="fas fa-user nav-icon"></i><br>
            Student
        </a>

        <?php else : ?>
        <a class="nav-link hvr-grow" href="sign_in.php">
            <i class="fas fa-user nav-icon"></i><br>
            Sign In
        </a>
        <?php endif; ?>
    </nav>
</div>