<?php
	session_start();
	include('_partials/config.php');//load config file
	include('_partials/checklogin.php');//load checklogin 
    check_login(); //invoke checklogin
    //book a flight
    if(isset($_POST['pay_reserve_flight']))
        {
            //pay a reserved flight ticket
            $jfs_number = $_POST['jfs_number'];
            $jf_name = $_POST['jf_name'];
            $jf_route = $_POST['jf_route'];
            $jf_number = $_POST['jf_number'];
            $jf_deptime  = $_POST['jf_deptime'];
            $jf_arrtime =$_POST['jf_arrtime'];
            $jp_id = $_SESSION['jp_id'];
            $jp_number = $_POST['jp_number'];
            $jp_name = $_POST['jp_name'];
            $jp_national_id = $_POST['jp_national_id'];
            $jf_flight_fare = $_POST['jf_flight_fare'];
            //$jfs_date = $_POST['jfs_date'];<!--Posted automatically when a reservation is done
            $jf_amt_paid = $_POST['jf_amt_paid'];
            $jf_payment_method = $_POST['jf_payment_method'];
            $jf_payment_refcode = $_POST['jf_payment_refcode'];
            $jf_payment_number = $_POST['jf_payment_number'];

            //Payment Status
            $payment_stats = $_POST['payment_stats'];
            $jfs_id = $_GET['jfs_id'];
            


            //Insert Captured information to a database table

            $query="INSERT INTO jordan_flights_reservation_payments (jf_name, jfs_number, jf_route, jf_number, jf_deptime, jf_arrtime, jp_id, jp_number, jp_name, jp_national_id, jf_flight_fare, jf_amt_paid, jf_payment_method, jf_payment_refcode, jf_payment_number) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $query1="UPDATE  jordan_flights_reservation SET  payment_stats =? WHERE jfs_id =? ";

            $stmt = $mysqli->prepare($query);
            $stmt1 = $mysqli->prepare($query1);

            //bind paramaters
            $rc=$stmt->bind_param('sssssssssssssss', $jf_name, $jfs_number,  $jf_route, $jf_number, $jf_deptime, $jf_arrtime, $jp_id, $jp_number, $jp_name, $jp_national_id, $jf_flight_fare, $jf_amt_paid, $jf_payment_method, $jf_payment_refcode, $jf_payment_number);
            $rc=$stmt1->bind_param('si', $payment_stats, $jfs_id);

            $stmt->execute();
            $stmt1->execute();

            //declare a varible which will be passed to alert function
            if($stmt && $stmt1)
            {
                $success = "Flight Ticket Paid";
            }
            else {
                $err = "Please Try Again Or Try Later"; 
            }      
        }

    $jp_id = $_SESSION['jp_id'];//load the dashboard page using passenger id
    $ret="SELECT  * FROM  jordan_passengers  WHERE jp_id=?";
    $stmt= $mysqli->prepare($ret) ;
    $stmt->bind_param('i', $jp_id);
    $stmt->execute() ;//ok
    $res=$stmt->get_result();
    //$cnt=1;
    while($row=$res->fetch_object())
    {
        //TRIM TIMESTAMP TO DD-MM-YYYY FORMART
         $date_joined =  $row->jp_date_joined;

		//load a default profile picture if logged in user havent uploaded a picture
		if($row->passport_pic  == '')
			{
				$passenger_dic = 
						"
							<img src='images/place3.jpg' alt='$row->jp_number' />
						";
			}
			else
			{
				$passenger_dic =  	
						"

						<img src='images/passenger/$row->passport_pic' alt='$row->jp_number' />

						";
			}
    ?>
	<!DOCTYPE html>
		<html lang="en">
			<?php include("_partials/head.php");?>
			<body>
				<!-- Preloader -->
				<div id="preloader">
					<div id="status">&nbsp;</div>
				</div>
				<!--Load Default Mobile-superesponsive navbar-->
				<?php include("_partials/mobile_nav.php");?>
				<section>
					<!-- LOGO AND MENU SECTION -->
					<div class="top-logo" data-spy="affix" data-offset-top="250">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<div class="wed-logo">
										<a href="pages_dashboard.php"><img src="images/logo.png" alt="" />
										</a>
									</div>
									<div class="main-menu">
										<ul>											
											<li><a  href="pages_passenger_profile.php">Hello <?php echo $row->jp_name;?></a>
											</li>
											<li><a href="pages_logout.php">Log Out</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<!-- TOP SEARCH BOX -->
					<div class="search-top">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<div class="search-form">
									<form  action="pages_view_flights.php" class="tourz-search-form">
										<div class="input-field">
											
										</div>
										<div class="input-field">
											<input type="text" id="select-search" class="autocomplete">
											<label for="select-search" class="search-hotel-type">Search Flight</label>
										</div>
										<div class="input-field">
											<input type="submit" value="search" class="waves-effect waves-light tourz-sear-btn"> </div>
									</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END TOP SEARCH BOX -->
				</section>
				<!--END HEADER SECTION-->
				
				<!--DASHBOARD-->
				<section>
					<div class="db">
						<!--LEFT SECTION-->
						<div class="db-l">
							<div class="db-l-1">
								<ul>
									<li>
										<?php 
										//display passenger profile picture
										 echo $passenger_dic;
										?>
									</li>
									<li><span></span><?php echo $row->jp_name;?></li>
									<li><span></span><?php echo $row->jp_number;?></li>
								</ul>
							</div>
							<div class="db-l-2">
								<ul>
									<li>
										<a href="pages_dashboard.php"><img src="images/icon/dbl6.png" alt="" />My Dashboard</a>
									</li>
									<li>
										<a href="pages_passenger_profile.php"><img src="images/icon/dbl6.png" alt="" /> My Profile</a>
									</li>
									<li>
										<a href="pages_flight_route.php"><img src="images/icon/dbl1.png" alt="" />Flight Routes</a>
									</li>
									<li>
										<a href="pages_view_flights.php"><img src="images/icon/dbl2.png" alt="" /> Flights</a>
									</li>
									<li>
										<a href="pages_flight_reservations.php"><img src="images/icon/dbl3.png" alt="" /> Flight Reservations</a>
									</li>
									<li>
										<a href="pages_reservations_paymanets.php"><img src="images/icon/dbl9.png" alt="" /> Payments</a>
									</li>
									<li>
										<a href="pages_feedbacks.php"><img src="images/icon/dbl7.png" alt="" />Feedbacks</a>
									</li>
								</ul>
							</div>
						</div>
						<!--CENTER SECTION WITH FLIGHT DETAILS-->
                        <?php
                            //Get details of all flights
                            $jfs_id = $_GET['jfs_id'];
                            $ret="SELECT * FROM  jordan_flights_reservation  WHERE jfs_id =?"; 
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i', $jfs_id);
                            $stmt->execute() ;//ok
                            $res=$stmt->get_result();
                            while($row=$res->fetch_object())
                            {
                                
                        ?>
                            <div class="db-2">
                                <div class="db-2-com db-2-main">
                                    <h4>Dashboard / Flight Reservations /Pay  <?php echo $row->jfs_number;?></h4>
                                    <div class="db-2-main-com db2-form-pay db2-form-com">
                                        <form method="post" class="col s12">
                                        <?php
                                            $jp_id = $_SESSION['jp_id'];//load the dashboard page using passenger id
                                            $ret="SELECT  * FROM  jordan_passengers  WHERE jp_id=?";
                                            $stmt= $mysqli->prepare($ret) ;
                                            $stmt->bind_param('i', $jp_id);
                                            $stmt->execute() ;//ok
                                            $res=$stmt->get_result();
                                            //$cnt=1;
                                            while($row=$res->fetch_object())
                                            {
                                                ?>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input type="text" readonly name="jp_name" value="<?php echo $row->jp_name;?>" class="validate">
                                                    <label>Passenger Name</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12 m6">
                                                    <input type="text" readonly name="jp_number" value="<?php echo $row->jp_number;?>" class="validate">
                                                    <label>Passenger Number</label>
                                                </div>
                                                <div class="input-field col s12 m6">
                                                    <input type="text" readonly value="<?php echo $row->jp_national_id;?>"  name="jp_national_id" class="validate">
                                                    <label>Passenger National ID Number</label>
                                                </div>
                                            </div>
                                            <?php }?> 

                                            <?php
                                                //Get details of all flights reservations
                                                $jfs_id = $_GET['jfs_id'];
                                                $ret="SELECT * FROM  jordan_flights_reservation WHERE jfs_id=?"; 
                                                $stmt= $mysqli->prepare($ret) ;
                                                $stmt->bind_param('i', $jfs_id);
                                                $stmt->execute() ;//ok
                                                $res=$stmt->get_result();
                                                while($row=$res->fetch_object())
                                                {
                                                    
                                            ?>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input type="text" readonly name="jfs_number" value="<?php echo $row->jfs_number;?>" class="validate">
                                                    <label>Reservation Number</label>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input type="text" readonly name="jf_number" value="<?php echo $row->jf_number;?>" class="validate">
                                                    <label>Flight Number</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12 m6">
                                                    <input type="text" readonly name="jf_name" value="<?php echo $row->jf_name;?>" class="validate">
                                                    <label>Flight Name</label>
                                                </div>
                                                <div class="input-field col s12 m6">
                                                    <input type="text" readonly name="jf_route" value="<?php echo $row->jf_route;?>" class="validate">
                                                    <label>Flight Route</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12 m6">
                                                    <input type="text" readonly name="jf_deptime" value="<?php echo $row->jf_deptime;?>" class="validate">
                                                    <label>Flight Depature Time</label>
                                                </div>
                                                <div class="input-field col s12 m6">
                                                    <input type="text" readonly name="jf_arrtime" value="<?php echo $row->jf_arrtime;?>" class="validate">
                                                    <label>Flight Arrival Time</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input id="pay-ca" name="jf_flight_fare" readonly  value="<?php echo $row->jf_flight_fare;?>" type="text" class="validate">
                                                    <label for="pay-ca">Flight Fare</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input id="pay-ca" name="jf_amt_paid" required  type="text" class="validate">
                                                    <label for="pay-ca">Amount Paid</label>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <select  name="jf_payment_method"   type="text" class="validate">
                                                    <option>Mpesa</option>
                                                    <option>Airtel Money</option>
                                                    <option>Bank Deposit</option>
                                                    <option>Cash</option>
                                                    </select>
                                                </div>
                                            </div><div class="row">
                                                <div class="input-field col s12">
                                                    <input id="pay-ca" name="jf_payment_refcode"  type="text" class="validate">
                                                    <label>Payment Refrence Codes</label>
                                                </div>
                                            </div>
                                            <div class="input-field col s6" style="display:none">
                                                <?php
                                                    $length = 6;    
                                                    $_number =  substr(str_shuffle('0123456789QWERTYUIOPLKJHGFDSAZXCVBNM'),1,$length);
                                                ?>
                                                <input  required name="jf_payment_number" value="<?php echo $_number;?>" readonly placeholder="" type="text" class="validate">
                                                <label>Payment Number</label>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input type="submit" value="Pay Ticket" name="pay_reserve_flight" class="waves-effect waves-light btn-large btn-success"> </div>
                                            </div>
                                            <div class="input-field col s6" style="display:none">
                                                <input required type="text" readonly name="payment_stats" value="Paid" class="validate">
                                                <label></label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                        
						<!--RIGHT SECTION-->
						<?php include("_partials/notifications.php");?>
					</div>
				</section>
			<!--Footer-->
			<?php include("_partials/footer.php");?>
			<!--End Footer-->
				<section>
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
<?php }}?>
