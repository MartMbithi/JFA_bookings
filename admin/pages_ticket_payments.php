<?php
  session_start();
  include('_partials/config.php');//load config 
  include('_partials/checklogin.php'); //load checklogin 
  check_login();//invoke check login method
  $ja_id = $_SESSION['ja_id'];
  //load page using ja_id as session holder

  //delete payment record
  if(isset($_GET['deletePayment']))
  {
        $id=intval($_GET['deletePayment']);
        $jfs_number = $_GET['jfs_number'];
        $payment_stats= $_GET['payment_stats'];
        $adn="DELETE FROM  jordan_flights_reservation_payments  WHERE jfsp_id = ?";
        $query="UPDATE jordan_flights_reservation SET payment_stats = ? WHERE jfs_number =?";
        $stmt= $mysqli->prepare($adn);
        $stmt1 = $mysqli->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt1->bind_param('ss', $payment_stats, $jfs_number);
        $stmt->execute();
        $stmt1->execute();

        $stmt->close();	 
        $stmt1->close();
  
          if($stmt && $stmt1)
          {
            $info = "Flights Payment Records Deleted";
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
                        <li><a href="pages_dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> Finances</a>
                        </li>
                        <li><a href="">/ <i class="fa fa-money" aria-hidden="true"></i> Tickets</a>
                        </li>
                        <li class="active-bre"><a href="#">Manage</a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Manage Flights Reservations Payments</h4>
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
                                                    <th>Payment Method</th>
                                                    <th>Payment Code</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    //Get details of all flights
                                                    $ret="SELECT * FROM  jordan_flights_reservation_payments  ORDER BY RAND() "; 
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    $cnt=1;
                                                    while($row=$res->fetch_object())
                                                    {
                                                      /* Trim date from default timestamp to
                                                        *  User Uderstandable Formart  DD-MM-YYYY : 
                                                        */
                                                        //$dateReservationMade = $row->jfs_date;
                                                ?>

                                                    <tr>

                                                        <td><?php echo $cnt;?></td>
                                                        <td><?php echo $row->jfs_number;?></td>
                                                        <td><?php echo $row->jf_name;?></td>
                                                        <td><?php echo $row->jf_route?></td>
                                                        <td><?php echo $row->jf_deptime;?> - <?php echo $row->jf_arrtime;?></td>
                                                        <td><?php echo $row->jp_name;?></td>
                                                        <td><?php echo $row->jf_flight_fare;?></td>
                                                        <td><?php echo $row->jf_payment_method;?></td>
                                                        <td><?php echo $row->jf_payment_refcode;?></td>


                                                        <td>
                                                            <a  href='pages_get_flight_ticket.php?jfs_number=<?php echo $row->jfs_number;?>&jfsp_id=<?php echo $row->jfsp_id;?>&jp_number=<?php echo $row->jp_number;?>'>
                                                                <span class='label label-success'>
                                                                    Get Ticket
                                                                </span>                                                                  
                                                            </a>
                                                            <br>                                                            
                                                            <a  href="pages_ticket_payments.php?deletePayment=<?php echo $row->jfsp_id;?>&jfs_number=<?php echo $row->jfs_number;?>&payment_stats=Pending">
                                                                <span class="label label-danger">
                                                                     Delete Payment
                                                                </span>                                                                  
                                                            </a>     
                                                        </td>
                                                        
                                                
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