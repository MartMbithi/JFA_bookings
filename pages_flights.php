<?php 
    include('_partials/config.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<?php include('_partials/head.php');?>
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
	
    <!--====== BANNER ==========-->
    <section>
        <div class="rows inner_banner inner_banner_5">
            <div class="container">
                <h2><span>Available </span>Flights</h2><ul><li><a href="index.php">Home</a></li><li><i class="fa fa-angle-right" aria-hidden="true"></i> </li><li><a href="pages_flights.php" class="bread-acti">Flights</a></li></ul>
            </div>
        </div>
    </section>
    <!--====== PLACES ==========-->
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space pad-bot-redu-5" id="inner-page-title">
             <!--===== Flights ======-->
                <?php
                    //Get details of all flights
                    $ret="SELECT * FROM  jordan_flights ORDER BY RAND() "; 
                    $stmt= $mysqli->prepare($ret) ;
                    $stmt->execute() ;//ok
                    $res=$stmt->get_result();
                    $cnt=1;
                    while($row=$res->fetch_object())
                    {
                        
                ?>
                <div class="rows p2_2">
                    <div class="col-md-6 col-sm-6 col-xs-12 p2_1">
                        <img src="images/place3.jpg" alt="" />
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 p2">
                        <h3><?php echo $row->jf_name;?><span><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></span></h3>
                        <br>
                        <div class="ticket">
                            <ul>
                                <li>Flight Number : <?php echo $row->jf_number;?></li><br><hr>
                                <li>Departure Time : <?php echo $row->jf_deptime;?></li><br><hr>
                                <li>Arrival Time : <?php echo $row->jf_arrtime;?></li><br><hr>
                                <li>Departure Airport: <?php echo $row->jf_flight_dep_airport;?></li><br><hr>
                                <li>Arrival Airport: <?php echo $row->jf_flight_des_airport;?></li><br><hr>
                                <li>Flight Fare: <?php echo $row->jf_flight_ticket_fare ;?></li><br><hr>
                                <li>Flight Route: <?php echo $row->jf_flight_route;?></li><br><hr>
                            </ul>
                        </div>
                        
                        <div class="p2_book">
                            <ul>
                                <li><a href="pages_signin.php" class="link-btn">Book Now</a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <?php }?>

            </div>
        </div>
    </section>
    
    <!--Footer-->
        <?php include("_partials/footer.php");?>
    <!--========= Scripts ===========-->
    <script src="js/jquery-latest.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/wow.min.js"></script>
	<script src="js/materialize.min.js"></script>	
    <script src="js/custom.js"></script>
</body>


</html>