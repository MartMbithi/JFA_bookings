<?php
	session_start();
	include('_partials/config.php');//load config file
	include('_partials/checklogin.php');//load checklogin 
    check_login(); //invoke checklogin
    //load the upate password 
    if(isset($_POST['update_passenger']))
        {
            $jp_id = $_SESSION['jp_id'];
            $jp_name = $_POST['jp_name'];
            $jp_national_id = $_POST['jp_national_id'];
            $jp_phone = $_POST['jp_phone'];
            $passport_pic = $_FILES["passport_pic"];
            move_uploaded_file($_FILES["passport_pic"]["tmp_name"],"images/passenger/".$_FILES["passport_pic"]["name"]);

            $jp_email = $_POST['jp_email'];
           //$jp_pwd = sha1(md5($_POST['jp_pwd']));
            $jp_gender =$_POST['jp_gender'];
            
            //Insert Captured information to a database table

            $query="UPDATE jordan_passengers  SET jp_name=?, jp_national_id=?, passport_pic=?,  jp_phone=?,  jp_email=?,  jp_gender=? WHERE  jp_id=?";
            $stmt = $mysqli->prepare($query);
            //bind paramaters
            $rc=$stmt->bind_param('ssssssi', $jp_name, $jp_national_id, $passport_pic, $jp_phone,  $jp_email, $jp_gender, $jp_id);
            $stmt->execute();

            //declare a varible which will be passed to alert function
            if($stmt)
            {
                $success = "Passenger Account Updated";
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
											<li><a  href="pages_profile.php">Hello <?php echo $row->jp_name;?></a>
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
						<!--Update Profile-->
						<div class="db-2">
                            <div class="db-2-com db-2-main">
                                <h4>Upadate My Profile </h4>
                                <div class="db-2-main-com db2-form-pay db2-form-com">
                                <!--Form-->
                                    <form method="post"  class="col s12" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input type="text" name="jp_name" value="<?php echo $row->jp_name;?>" class="validate">
                                                <label>Passenger Name</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12 m6">
                                                <input type="text" name="jp_national_id" value="<?php echo $row->jp_national_id;?>" class="validate">
                                                <label>National ID Number</label>
                                            </div>
                                            <div class="input-field col s12 m6">
                                                <input type="text" name="jp_phone" value="<?php echo $row->jp_phone;?>" class="validate">
                                                <label>Phone Number</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12 m6">
                                                <input type="email" name="jp_email" value="<?php echo $row->jp_email;?>" class="validate">
                                                <label>Email</label>
                                            </div>
                                            <div class="input-field col s12 m6">
                                                <input type="text" readonly value="<?php echo $row->jp_number;?>" name="jp_number" class="validate">
                                                <label>Passenger Number</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <select name="jp_gender">
                                                    <option value="" disabled selected>Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input id="pay-ca" type="number" class="validate">
                                                <label for="pay-ca">Card Number</label>
                                            </div>
                                        </div>
                                        -->
                                        <div class="row db-file-upload">
                                            <div class="file-field input-field">
                                                <div class="db-up-btn"> <span>Profile Picture</span>
                                                    <input name="passport_pic" type="file"> </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text"> </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input type="submit" value="Update Profile" name="update_passenger" class="waves-effect waves-light full-btn"> </div>
                                        </div>
                                    </form>
                                    <!--End Form--->
                                </div>
                            </div>
                        </div>
						<!--Notifications-->
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
