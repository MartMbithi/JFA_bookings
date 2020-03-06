<?php
  session_start();
  include('_partials/config.php');//load config 
  include('_partials/checklogin.php'); //load checklogin 
  check_login();//invoke check login method
  $ja_id = $_SESSION['ja_id'];
  //load page using ja_id as session holder
  //cancel flight
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
?>

<!DOCTYPE html>
<html lang="en">
<!--Head-->
    <?php include("_partials/head.php");?>
<!--End Head-->
<body>
    <!--== MAIN CONTRAINER ==-->
    <?php include("_partials/nav.php");?><!--Load Top Navigation Bar-->

    <!--== BODY CONTNAINER ==-->
    <div class="container-fluid sb2">
        <div class="row">
            <?php include("_partials/sidebar.php");?><!--Load Sidebar-->
            <div class="sb2-2">
                <div class="sb2-2-2">
                    <ul><!--Breadcrumps-->
                        <li><a href="pages_dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        </li>
                        <li><a href="">/ <i class="fa fa-pie-chart" aria-hidden="true"></i> Advance Reporting</a>
                        </li>
                        <li class="active-bre"><a href="#">Reservations</a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Reservations</h4>
                                    <a class="dropdown-button drop-down-meta" href="#" data-activates="dr-users"><i class="material-icons">more_vert</i></a>
                                    <ul id="dr-users" class="dropdown-content">
                                        <li><a href="javascript:window.print()"><i class="fa fa-print"></i>Print</a>
                                        </li>
                                    </ul>

                                </div>
                                <div class="tab-inn">
                                    <div class="table-responsive table-desi">
                                        <table class="table table-hover">
                                        <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>No.</th>
                                                    <th>Plane Name</th>
                                                    <th>Flight Route</th>
                                                    <th>Flight Time</th>
                                                    <th>Pass Name</th>
                                                    <th>Flight Fare</th>
                                                    <th>Flight Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    //Get details of all flights reservations
                                                    $ret="SELECT * FROM  jordan_flights_reservation  ORDER BY RAND() "; 
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    $cnt=1;
                                                    while($row=$res->fetch_object())
                                                    {
                                                      /* Trim date from default timestamp to
                                                        *  User Uderstandable Formart  DD-MM-YYYY : 
                                                        */
                                                        $dateReservationMade = $row->jfs_date;
                                                ?>

                                                    <tr>

                                                        <td><?php echo $cnt;?></td>
                                                        <td><?php echo $row->jfs_number;?></td>
                                                        <td><?php echo $row->jf_name;?></td>
                                                        <td><?php echo $row->jf_route;?></td>
                                                        <td><?php echo $row->jf_deptime;?> - <?php echo $row->jf_arrtime;?></td>
                                                        <td><?php echo $row->jp_name;?></td>
                                                        <td><?php echo $row->jf_flight_fare;?></td>
                                                        <td><?php echo date("d-M-Y ", strtotime($dateReservationMade));?> </td>                                                      
                                                    </tr>
                                                <?php //increment count by 1
                                                    $cnt = $cnt+1;
                                                }
                                                ?>    
                                                
                                            </tbody>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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