<!DOCTYPE html>
<html lang="en">


<?php include("_partials/head.php");?>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>

    <!-- MOBILE MENU -->
    <?php include("_partials/mobile_menu.php");?>
    <!--HEADER SECTION-->
    <?php include("_partials/nav.php");?>
    <!--END HEADER SECTION-->

    <!--HEADER SECTION-->
    <section>
        <div class="tourz-search">
            <div class="container">
                <div class="row">
                    <div class="tourz-search-1">
                        <h1>Plan Your Travel Now!</h1>
                        <p>Experience the ultimate flight reservations to your favourite destinations.</p>
                        <form action="pages_flights.php" class="tourz-search-form">
                            <div class="input-field">
                                <input type="text" id="select-city" class="autocomplete">
                                <label for="select-city">Enter City</label>
                            </div>
                            <div class="input-field">
                                <input type="text" id="select-search" class="autocomplete">
                                <label for="select-search" class="search-hotel-type">Search Flights</label>
                            </div>
                            <div class="input-field">
                                <input type="submit" value="search" class="waves-effect waves-light tourz-sear-btn"> </div>
                        </form>
                        <div class="tourz-hom-ser">
                            <ul>
                                
                                <li>
                                    <a href="#" class="waves-effect waves-light btn-large tourz-pop-ser-btn wow fadeInUp" data-wow-duration="1s"><img src="images/icon/31.png" alt="">Mombasa</a>
                                </li>
                                <li>
                                    <a href="#" class="waves-effect waves-light btn-large tourz-pop-ser-btn wow fadeInUp" data-wow-duration="2s"><img src="images/icon/31.png" alt=""> Nairobi</a>
                                </li>
                                <li>
                                    <a href="#" class="waves-effect waves-light btn-large tourz-pop-ser-btn wow fadeInUp" data-wow-duration="3s"><img src="images/icon/31.png" alt=""> Taveta</a>
                                </li>
                                <li>
                                    <a href="#" class="waves-effect waves-light btn-large tourz-pop-ser-btn wow fadeInUp" data-wow-duration="4s"><img src="images/icon/31.png" alt=""> Voi</a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END HEADER SECTION-->

    <section>
        <div class="rows pad-bot-redu tb-space">
            <div class="container">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title">
                    <h2>Our <span>Top Flight Cities</span></h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Our flights reservation agency covers flights accross the following towns</p>
                </div>
                <div>
                    <!-- TOUR PLACE 1 -->
                    <div class="col-md-6 col-sm-6 col-xs-12 b_packages wow slideInUp" data-wow-duration="0.5s">
                        <!-- IMAGE -->
                        <div class="v_place_img"> <img src="images/t5.png" alt="Tour Booking" title="Tour Booking" /> </div>
                        <!-- TOUR TITLE & ICONS -->
                        <div class="b_pack rows">
                            <!-- TOUR TITLE -->
                            <div class="col-md-8 col-sm-8">
                                <h4><a href="">Mombasa<span class="v_pl_name"><span></a></h4>
                            </div>
                            
                        </div>
                    </div>
                    <!-- TOUR PLACE 2 -->
                    <div class="col-md-6 col-sm-6 col-xs-12 b_packages wow fadeInUp" data-wow-duration="0.7s">
                        <!-- IMAGE -->
                        <div class="v_place_img"> <img src="images/t1.png" alt="Tour Booking" title="Tour Booking" /> </div>
                        <!-- TOUR TITLE & ICONS -->
                        <div class="b_pack rows">
                            <!-- TOUR TITLE -->
                            <div class="col-md-8 col-sm-8">
                                <h4><a href="">Voi<span class="v_pl_name"></span></a></h4>
                            </div>
                            
                        </div>
                    </div>
                    <!-- TOUR PLACE 3 -->
                    <div class="col-md-6 col-sm-6 col-xs-12 b_packages wow fadeInUp" data-wow-duration="0.9s">
                        <div class="v_place_img"><img src="images/t2.png" alt="Tour Booking" title="Tour Booking" /> </div>
                        <div class="b_pack rows">
                            <div class="col-md-8 col-sm-8">
                                <h4><a href="tour-details.html">Taveta<span class="v_pl_name"></span></a></h4>
                            </div>
                            
                        </div>
                    </div>
                    <!-- TOUR PLACE 4 -->
                    <div class="col-md-6 col-sm-6 col-xs-12 b_packages wow fadeInUp" data-wow-duration="1.1s">
                        <div class="v_place_img"><img src="images/t3.png" alt="Tour Booking" title="Tour Booking" /> </div>
                        <div class="b_pack rows">
                            <div class="col-md-8 col-sm-8">
                                <h4><a href="">Nairobi<span class="v_pl_name"></span></a></h4>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

   <!--Footer-->
    <?php include("_partials/footer.php");?>
    
        <div class="icon-float">
            <ul>
                <li><a href="#" class="sh">1k <br> Share</a> </li>
                <li><a href="#" class="fb1"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
                <li><a href="#" class="gp1"><i class="fa fa-google-plus" aria-hidden="true"></i></a> </li>
                <li><a href="#" class="tw1"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
                <li><a href="#" class="li1"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </li>
                <li><a href="#" class="wa1"><i class="fa fa-whatsapp" aria-hidden="true"></i></a> </li>
                <li><a href="#" class="sh1"><i class="fa fa-envelope-o" aria-hidden="true"></i></a> </li>
            </ul>
        </div>
    </section>
    <!--========= Scripts ===========-->
    <script src="js/jquery-latest.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/custom.js"></script>
</body>


</html>