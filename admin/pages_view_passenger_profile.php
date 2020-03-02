<?php
  session_start();
  include('_partials/config.php');//load config 
  include('_partials/checklogin.php'); //load checklogin 
  check_login();//invoke check login method
  $ja_id = $_SESSION['ja_id'];
  //load page using ja_id as session holder
?>
<!DOCTYPE html>
<html lang="en">
<!--Head-->
    <?php include("_partials/head.php");?>
<!-- ./Head-->
<body>
    <!--== MAIN CONTRAINER ==-->
        <?php include("_partials/nav.php");?><!--Inject Navigation Bar-->

    <!--== BODY CONTNAINER HOLDING CERTAIN PASSENGER INFORMATION ==-->
    
        <div class="container-fluid sb2">
            <div class="row">
                <?php include("_partials/sidebar.php");?><!--Inject Side Navigation Bar-->
                <?php
                    //Get details of certain passenger using passenger number
                    $jp_number = $_GET['jp_number'];
                    $ret="SELECT * FROM  jordan_passengers WHERE jp_number = ? "; 
                    $stmt= $mysqli->prepare($ret) ;
                    $stmt->bind_param('s', $jp_number);
                    $stmt->execute() ;//ok
                    $res=$stmt->get_result();
                    while($row=$res->fetch_object())
                    {
                    /* Trim date passenger joined from default timestamp to
                    *  User Uderstandable Formart  DD-MM-YYYY : 
                    */
                    $datePassengerJoined = $row->jp_date_joined;
                ?>
                <div class="sb2-2">
                    <div class="sb2-2-2">
                        <ul><!--Breadcrumps-->
                            <li><a href="pages_dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                            </li>
                            <li><a href="">/ <i class="fa fa-users" aria-hidden="true"></i> Passengers</a>
                            </li>
                            <li>/ <a href="#">Manage</a>
                            </li>
                            <li>/ <a href="#"><?php echo $row->jp_name;?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="sb2-2-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-inn-sp">
                                    <div class="inn-title">
                                        <h4><?php echo $row->jp_name;?>'s  Profile</h4>
                                        <p><?php echo $row->jp_number;?></p>
                                    </div>
                                    <div class="tab-inn ">
                                        <ul class="collapsible popout"  data-collapsible="accordion">
                                            <li>
                                                <div class="collapsible-header coll-head"><i class="material-icons">perm_identity</i>Passenger Name</div>
                                                <div class="collapsible-body coll-body"><span><?php echo $row->jp_name;?></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header  coll-head"><i class="material-icons">assignment_ind</i>Passenger National ID Number</div>
                                                <div class="collapsible-body coll-body"><span><?php echo $row->jp_national_id;?></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header coll-head"><i class="material-icons">contact_phone</i>Passenger Mobile Phone Number</div>
                                                <div class="collapsible-body coll-body"><span><?php echo $row->jp_phone;?></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header coll-head"><i class="material-icons">message</i>Passenger Email Address</div>
                                                <div class="collapsible-body coll-body"><span><?php echo $row->jp_email;?></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header coll-head"><i class="material-icons">contacts</i>Passenger Gender</div>
                                                <div class="collapsible-body coll-body"><span><?php echo $row->jp_gender;?></span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--Passenger Flights Reservation Records-->
                            <?php
                                //Get details of certain passenger reservations using passenger number
                                $jp_number = $_GET['jp_number'];
                                $ret="SELECT * FROM  jordan_flights_reservation WHERE jp_number = ? "; 
                                $stmt= $mysqli->prepare($ret) ;
                                $stmt->bind_param('s', $jp_number);
                                $stmt->execute() ;//ok
                                $res=$stmt->get_result();
                                while($row=$res->fetch_object())
                                {
                                /* Trim date passenger reserved from default timestamp to
                                *  User Uderstandable Formart  DD-MM-YYYY : 
                                */
                                $datePassengerBookedReservation = $row->jfs_date;
                            ?>
                            <div class="col-md-6">
                                <div class="box-inn-sp">
                                    <div class="inn-title">
                                        <h4><?php echo $row->jp_name;?>'s Flight Reservations</h4>
                                        <p><?php echo $row->jp_number;?></p>
                                    </div>
                                    <div class="tab-inn ">
                                        <ul class="collapsible popout"  data-collapsible="accordion">
                                            <li>
                                                <div class="collapsible-header coll-head"><i class="fa fa-plane"></i>Flight Name</div>
                                                <div class="collapsible-body coll-body"><span><?php echo $row->jf_name;?></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header  coll-head"><i class="fa fa-plane"></i>Flight Number</div>
                                                <div class="collapsible-body  coll-body"><span><?php echo $row->jf_number;?></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header coll-head"><i class="material-icons">today</i>Departure Time</div>
                                                <div class="collapsible-body coll-body"><span><?php echo $row->jf_deptime;?>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header coll-head"><i class="material-icons">trending_up</i>Flight Route</div>
                                                <div class="collapsible-body coll-body"><span><?php echo $row->jf_route;?>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header coll-head"><i class="material-icons">verified_user</i>Reservation Date</div>
                                                <div class="collapsible-body coll-body"><span><?php echo date("d-M-Y ", strtotime($datePassengerBookedReservation));?> 

                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }}?>    
    <!--
            Jordan Flights Agency Designed and Crafted with lots of love, passion and very many coffee cups by 
            MartDevelopers
            https://martdev.info
            If by any chance you might be an opensource developer and you would love to join our opensource projects 
            just join us here
            https://github.com/MartMbithi

     -->

    <!--======== SCRIPT FILES =========-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/custom.js"></script>
</body>


</html>