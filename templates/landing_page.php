<!DOCTYPE html>
<html lang="en">

<head>

    <title>CIU Library and Learning Resources Center | CIU | LLRC</title>
    <?php require_once "include/header_include.php"; ?>

    <!--Styling for the horizontal tile slider-->
    <link rel="stylesheet" type="text/css" href="css/inertialSliderStyle.css">

</head>

<body>
    <!--Message-->
    <?php echo displayMessage(); ?>
    <!--Message-->

    <!--Navbar-->
    <?php require_once "include/navbar.php"; ?>
    <!--Navbar-->

    <!--Welcome Section | Menu | Search-->
    <nav class="nav-window">

        <div class="container">
            <div class="row">

                <!--Menu Cards-->
                <?php require_once "include/nav_menu_cards.php"; ?>
                <!--Menu Cards-->

                <!--Welcome Text-->
                <div class="col-12 welcome-container">
                    <div class="welcome-text-container">
                        <!--Welcome Text-->
                        <h3>Welcome to the CIU library</h3>
                        <p class="lead">
                            Offering all the latest books and study metarials for the CIU students and faculty
                            members.
                        </p>
                        <!--Welcome Text-->

                        <!--Form-->
                        <form name="searchform" method="get" action="http://library.ciu.edu.bd/cgi-bin/koha/opac-search.pl" id="searchform" autocomplete="off">
                            <h4 style="text-align: left">Search</h4>
                            <hr class="m-0 mb-2">
                            <div class="form-row p-1">
                                <div class="col-sm-6 p-0">
                                    <input type="text" name="q" placeholder="Book Name" class="form-control search-text-input">
                                </div>
                                <div class="col-sm-4 p-0">
                                    <select name="idx" id="masthead_search" class="form-control search-text-input">
                                        <option value="">Library catalog</option>
                                        <option value="ti">Title</option>
                                        <option value="au">Author</option>
                                        <option value="su">Subject</option>
                                        <option value="nb">ISBN</option>
                                        <option value="se">Series</option>
                                        <option value="callnum,phr">Call number</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 p-0">
                                    <button type="submit" class="btn search-button"><i class="fas fa-search"></i>
                                        <span class="search-btn-text">Search</span></button>
                                </div>
                            </div>
                        </form>
                        <!--Form-->

                    </div>
                </div>

            </div>
        </div>

    </nav>
    <!--Welcome Section | Menu | Search-->

    <!--Popup Menu-->
    <?php require_once "include/popup_menu.php"; ?>
    <!--Popup Menu-->

    <!--Video-->
    <div style="background-color: #F2B121;" class="book-section container-fluid">
        <h1>LLRC AT A Glance</h1>
        <iframe id="video" width="100%" height="315" src="https://www.youtube.com/embed/cKReB7BxNyo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <!--Video-->

    <!--New Arrival Section-->
    <div id="new-arrival" class="book-section">
        <div class="container-fluid new-arrival-container">
            <h1 style="color: white; border-bottom: 2px solid white;">New Arrivals</h1>

            <!--This order of leftArrowButton-tileSliderContainer-rightArrowButton must be ensured
            since our script uses the sibling porperty to locate the tileSliderContainer
            when the button is pressed-->
            <div class="parentSliderContainer">
                <button class="leftArrowButton" type="button">
                    <img src="img/left-arrow-white.svg" height="auto" width="100%">
                </button>


                <div class="tileSliderContainer">

                    <?php for ($i = 0; $i < count($newArrivals); $i++) : ?>
                    <div class="card bg-light team">
                        <img class="card-img img-fluid" src="<?php echo $newArrivals[$i]->picture; ?>" alt="Card image cap">
                        <div class="tiles card-img-overlay text-center d-flex flex-column justify-content-center">
                            <div class="book-caption">
                                <h5 class="card-title"><?php echo $newArrivals[$i]->title; ?></h5>
                                <a href="#" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
                                <a href="#" class="btn btn-danger"><i class="fas fa-cart-plus"> To Cart</i></a>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>


                </div>
                <!--tileSliderContainer-->

                <button class="rightArrowButton" type="button">
                    <img src="img/right-arrow-white.svg" height="auto" width="100%">
                </button>
            </div>
            <!--parentSliderContainer-->

            <p><a href="javascript:viewAll('new-arrival', '#2E3192');" class="btn btn-primary">View All</a></p>
            <hr class="bg-light">
        </div>

        <!--Section Shape-->
        <div style="position: relative; top: -1px;">
            <svg width='100%' height='150px' viewBox="0 0 100 100" preserveAspectRatio="none" style='background-color: none'>

                <polygon points="0,0 100,0 100,100 0,1 0,0" style="fill: #2E3192;" />
            </svg>
        </div>
    </div>
    <!--New Arrival Section-->

    <!--Categories-->
    <div id="categories" class="book-section">
        <div class="container-fluid">
            <h1>Categories</h1>

            <!--This order of leftArrowButton-tileSliderContainer-rightArrowButton must be ensured
            since our script uses the sibling porperty to locate the tileSliderContainer
            when the button is pressed-->
            <div class="parentSliderContainer">
                <button class="leftArrowButton" type="button">
                    <img src="img/left-arrow.svg" height="auto" width="100%">
                </button>


                <div class="tileSliderContainer">

                    <div class="card bg-light team">
                        <img class="card-img img-fluid" src="img/book2.jpg" alt="Card image cap">
                        <div class="tiles card-img-overlay text-center d-flex flex-column justify-content-center">
                            <div class="book-caption">
                                <h5 class="card-title">Michael Jacob</h5>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet
                                </p>
                                <a href="#" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
                                <a href="#" class="btn btn-danger"><i class="fas fa-cart-plus"> To Cart</i></a>
                            </div>
                        </div>
                    </div>

                    <div class="tiles card bg-light team">
                        <img class="card-img img-fluid" src="img/book3.jpg" alt="Card image cap">
                        <div class="tiles card-img-overlay text-center d-flex flex-column justify-content-center">
                            <div class="book-caption">
                                <h5 class="card-title">Michael Jacob</h5>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet
                                </p>
                                <a href="#" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
                                <a href="#" class="btn btn-danger"><i class="fas fa-cart-plus"> To Cart</i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-light team">
                        <img class="card-img img-fluid" src="img/book4.jpg" alt="Card image cap">
                        <div class="tiles card-img-overlay text-center d-flex flex-column justify-content-center">
                            <div class="book-caption">
                                <h5 class="card-title">Michael Jacob</h5>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet
                                </p>
                                <a href="#" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
                                <a href="#" class="btn btn-danger"><i class="fas fa-cart-plus"> To Cart</i></a>
                            </div>
                        </div>
                    </div>

                    <div class="tiles card bg-light team">
                        <img class="card-img img-fluid" src="img/book2.jpg" alt="Card image cap">
                        <div class="tiles card-img-overlay text-center d-flex flex-column justify-content-center">
                            <div class="book-caption">
                                <h5 class="card-title">Michael Jacob</h5>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet
                                </p>
                                <a href="#" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
                                <a href="#" class="btn btn-danger"><i class="fas fa-cart-plus"> To Cart</i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-light team">
                        <img class="card-img img-fluid" src="img/book4.jpg" alt="Card image cap">
                        <div class="tiles card-img-overlay text-center d-flex flex-column justify-content-center">
                            <div class="book-caption">
                                <h5 class="card-title">Michael Jacob</h5>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet
                                </p>
                                <a href="#" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
                                <a href="#" class="btn btn-danger"><i class="fas fa-cart-plus"> To Cart</i></a>
                            </div>
                        </div>
                    </div>

                    <div class="tiles card bg-light team">
                        <img class="card-img img-fluid" src="img/book2.jpg" alt="Card image cap">
                        <div class="tiles card-img-overlay text-center d-flex flex-column justify-content-center">
                            <div class="book-caption">
                                <h5 class="card-title">Michael Jacob</h5>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet
                                </p>
                                <a href="#" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
                                <a href="#" class="btn btn-danger"><i class="fas fa-cart-plus"> To Cart</i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-light team">
                        <img class="card-img img-fluid" src="img/book3.jpg" alt="Card image cap">
                        <div class="tiles card-img-overlay text-center d-flex flex-column justify-content-center">
                            <div class="book-caption">
                                <h5 class="card-title">Michael Jacob</h5>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet
                                </p>
                                <a href="#" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
                                <a href="#" class="btn btn-danger"><i class="fas fa-cart-plus"> To Cart</i></a>
                            </div>
                        </div>
                    </div>

                    <div class="tiles card bg-light team">
                        <img class="card-img img-fluid" src="img/book4.jpg" alt="Card image cap">
                        <div class="tiles card-img-overlay text-center d-flex flex-column justify-content-center">
                            <div class="book-caption">
                                <h5 class="card-title">Michael Jacob</h5>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet
                                </p>
                                <a href="#" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
                                <a href="#" class="btn btn-danger"><i class="fas fa-cart-plus"> To Cart</i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--tileSliderContainer-->

            </div>
            <!--parentSliderContainer-->

            <p><a href="javascript:viewAll('categories','');" class="btn btn-primary">View All</a></p>
            <hr>
        </div>
    </div>
    <!--Categories-->
    
    <!--Library Info-->
    <div class="container-fluid book-section">
        <h1>Informations</h1>
        <div class="row">
            <div class="col-lg-6 mt-5">
                <h3>Calendar</h3>
                <hr>
                <div style="max-width: 100%; overflow-x: auto;">
                    <iframe src="https://calendar.google.com/calendar/embed?height=400&amp;wkst=1&amp;bgcolor=%23b6c2f0&amp;ctz=Asia%2FDhaka&amp;src=ZW4uYmQjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;color=%230B8043&amp;showTitle=0&amp;showPrint=0&amp;showTz=1" style="border-width:0; min-width: 380px;" width="100%" height="400" frameborder="0" scrolling="no" id="calendar">
                    </iframe>
                </div>
            </div>
            <div class="col-lg-6 mt-5" id="library-timings">
                <h3>Library Timings</h3>
                <hr>
                <div class="row">
                    <div class="col-lg-12 col-md-4 col-sm-12">
                        <p class="lead" style="font-weight: 500;">During the semester</p>
                        <p>Sun to Wed : 8.30 am to 9.00 pm</p>
                        <p>Thursday : 8.30 am to 7.00 pm</p>
                        <p>Friday & Sat : 10.00 am to 6.30 pm</p>
                    </div>
                    <div class="col-lg-12 col-md-4 col-sm-12">
                        <p class="lead" style="font-weight: 500;">During Off semester</p>
                        <p>Sun to Thurs : 8:30 am to 5:00 pm</p>
                        <p>Friday & Sat : <span style="color: red;">Closed</span></p>
                    </div>
                    <p class="col-lg-12 col-md-4 col-sm-12" style="color: brown;">
                        N.B: Check-out time from the library is 15 minutes prior to the library closes
                    </p>
                </div>
            </div>
            <div class="col-12 mt-5">
                <h3>Location</h3>
                <hr>
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe width="100%" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=chittagong%20independent%20university&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Footer-->
    <?php require_once "include/footer_include.php"; ?>
    <!--Footer-->

</body>

</html>