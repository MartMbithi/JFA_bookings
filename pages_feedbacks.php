<?php
	session_start();
	include('_partials/config.php');//load config file
	include('_partials/checklogin.php');//load checklogin 
    check_login(); //invoke checklogin
    //book a flight
    if(isset($_POST['feedback']))
        {
            //give feedback
            $jp_id = $_SESSION['jp_id'];
            $jp_name = $_POST['jp_name'];
            $jpf_feedback  = $_POST['jpf_feedback '];
            
            //$jfs_date = $_POST['jfs_date'];<!--Posted automatically when a reservation is done


            //Insert Captured information to a database table

            $query="INSERT INTO jordan_passenger_feedbacks (jp_id, jp_name, jpf_feedback) VALUES (?,?,?)";
            $stmt = $mysqli->prepare($query);
            //bind paramaters
            $rc=$stmt->bind_param('sss', $jp_id, $jp_name,  $jpf_feedback);
            $stmt->execute();

            //declare a varible which will be passed to alert function
            if($stmt)
            {
                $success = "Feedback Submitted";
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
									<form class="tourz-search-form">
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
                        
                            <div class="db-2">
                                <div class="db-2-com db-2-main">
                                    <h4>Dashboard / Feedbacks</h4>
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
                                                    <textarea type="text" name="jpf_feedback" class="validate"></textarea>
                                                    <label>Feed Back</label>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input type="submit" value="Give Feedback" name="feedback" class="waves-effect waves-light btn-large btn-success"> </div>
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
<?php }?>
