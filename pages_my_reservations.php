<?php
	session_start();
	include('_partials/config.php');//load config file
	include('_partials/checklogin.php');//load checklogin 
	check_login(); //invoke checklogin
	//Cancel Reservation

	if(isset($_GET['cancelFlightReservation']))
  {
        $id=intval($_GET['cancelFlightReservation']);
        $adn="DELETE FROM  jordan_flights_reservation  WHERE jfs_id = ?";
        $stmt= $mysqli->prepare($adn);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	 
  
          if($stmt)
          {
            $info = "Flights Reservation Cancelled";
          }
            else
            {
                $err = "Try Again Later";
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
						<!--CENTER SECTION-->
						<div class="db-2">
                            <div class="db-2-com db-2-main">
                                <h4>Dashboard / Reservations</h4>
                                <div class="db-2-main-com db-2-main-com-table">
                                    <table class="responsive-table">
                                        <thead>
											<tr>
												<th>#</th>
												<th>Res Number</th>
												<th>Flight Name</th>
												<th>Dep Time</th>
												<th>ArrTime</th>
                                                <th>Route</th>
                                                <th>Fare</th>
                                                <th>Date Booked</th>
                                                <th>Cancel</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
                                                //Get details of all reserved flights
                                                $jp_id = $_SESSION['jp_id'];
												$ret="SELECT * FROM  jordan_flights_reservation WHERE jp_id = ?"; 
                                                $stmt= $mysqli->prepare($ret) ;
                                                $stmt->bind_param('i', $jp_id);
												$stmt->execute() ;//ok
												$res=$stmt->get_result();
												$cnt=1;
												while($row=$res->fetch_object())
												{
                                                    //Trim timestamp to dd-mm-yyyy
                                                    $date_booked =  $row->jfs_date;

													
											?>

												<tr>
													<td><?php echo $cnt;?></td>
													<td><?php echo $row->jfs_number;?></td>
													<td><?php echo $row->jf_name;?></td>
													<td><?php echo $row->jf_deptime;?></td>
													<td><?php echo $row->jf_arrtime;?></td>
                                                    <td><?php echo $row->jf_route;?></td>
                                                    <td><?php echo $row->jf_flight_fare;?></td>
													<td><?php echo date("d-M-Y ", strtotime($date_booked));?></td>
                                                    <td>
                                                        <a class="badge badge-danger" href="pages_my_reservations.php?cancelFlightReservation=<?php echo $row->jfs_id;?>"><i class="fa fa-times"></i>Cancel</a>                                                    
                                                    </td>
												</tr>
											<?php //increment count by 1
												$cnt = $cnt+1;
											}
											?>    
                                                
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
						
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
