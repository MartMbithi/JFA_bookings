<?php
  session_start();
  include('_partials/config.php');//load config 
  include('_partials/checklogin.php'); //load checklogin 
  check_login();//invoke check login method
  $ja_id = $_SESSION['ja_id'];
  //use admin id to hold this page's session
    if(isset($_POST['PayflightTicket']))
        {
            //add payment
            $jfs_number = $_POST['jfs_number'];
            $jf_name = $_POST['jf_name'];
            $jf_route = $_POST['jf_route'];
            $jf_number = $_POST['jf_number'];
            $jf_deptime  = $_POST['jf_deptime'];
            $jf_arrtime =$_POST['jf_arrtime'];
            $jp_id = $_GET['jp_id'];
            $jp_number = $_GET['jp_number'];
            $jp_name = $_POST['jp_name'];
            $jp_national_id = $_POST['jp_national_id'];
            $jf_flight_fare = $_POST['jf_flight_fare'];
            //$jfs_date = $_POST['jfs_date'];<!--Posted automatically when a reservation is done
            $jf_amt_paid = $_POST['jf_amt_paid'];
            $jf_payment_method = $_POST['jf_payment_method'];
            $jf_payment_refcode = $_POST['jf_payment_refcode'];
            $jf_payment_number = $_POST['jf_payment_number'];
            


            //Insert Captured information to a database table

            $query="INSERT INTO jordan_flights_reservation_payments (jf_name, jfs_number, jf_route, jf_number, jf_deptime, jf_arrtime, jp_id, jp_number, jp_name, jp_national_id, jf_flight_fare, jf_amt_paid, jf_payment_method, jf_payment_refcode, jf_payment_number) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            //bind paramaters
            $rc=$stmt->bind_param('sssssssssssssss', $jf_name, $jfs_number,  $jf_route, $jf_number, $jf_deptime, $jf_arrtime, $jp_id, $jp_number, $jp_name, $jp_national_id, $jf_flight_fare, $jf_amt_paid, $jf_payment_method, $jf_payment_refcode, $jf_payment_number);
            $stmt->execute();

            //declare a varible which will be passed to alert function
            if($stmt)
            {
                $success = "Flight Ticket Paid";
            }
            else {
                $err = "Please Try Again Or Try Later"; 
            }      
        }
?>

<!DOCTYPE html>
<html lang="en">
    <!--Head-->
    <?php include("_partials/head.php");?>
    <!-- ./ Head-->

<body>
    <!--== MAIN CONTRAINER ==-->
    <?php include("_partials/nav.php");?><!--Load navigation bar-->
    <!--== BODY CONTNAINER ==-->
    <div class="container-fluid sb2">
        <div class="row">
            <!--Side Navigation bar-->
                <?php include("_partials/sidebar.php");?>
            <!-- ./ Side Navigation bar-->
            <?php
                $jfs_number =  $_GET['jfs_number'];
                $ret="SELECT * FROM  jordan_flights_reservation WHERE jfs_number = ? " ; 
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('s', $jfs_number);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
                {
                
            ?>

            <div class="sb2-2">
                <div class="sb2-2-2">
                    <ul>
                        <li><a href="pages_dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        </li>
                        <li><a href="">/ <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Reservations</a>
                        </li>
                        <li class="active-bre"><a href="#">Manage</a>
                        </li>
                        <li class="active-bre"><a href="#">Pay /  <?php echo $row->jfs_number;?></a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Flight Reservation Form</h4>
                                    <p>Please Fill All Required Fields</p>
                                </div>
                                <div class="tab-inn">
                                    <form method = 'POST' enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input required type="text" readonly name="jp_name" value="<?php echo $row->jp_name;?>" class="validate">
                                                <label>Passenger Name</label>
                                            </div>

                                            <div class="input-field col s6">
                                                <input readonly required readonly name="jp_number" type="text" value="<?php echo $row->jp_number;?>" class="validate">
                                                <label>Passenger  Number</label>
                                            </div>
 
                                        </div>
                                        
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input required type="text" readonly name="jp_national_id" value="<?php echo $row->jp_national_id;?>" class="validate">
                                                <label>Passenger National ID Number</label>
                                            </div>

                                            <div class="input-field col s6">
                                                <input required readonly name="jfs_number" value="<?php echo $row->jfs_number;?>" type="text"  class="validate">
                                                <label>Reservation Number</label>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="row">
                                            
                                            <div class="input-field col s6">
                                                <input value="<?php echo $row->jf_number;?>" required name="jf_number"   type="text"  class="validate">
                                                <label>Flight Route Number</label>
                                            </div>

                                            <div class="input-field col s6">
                                                <input required name="jf_name" readonly type="text" placeholder=""  value="<?php echo $row->jf_name;?>" class="validate">
                                                <label>Flight Name</label>
                                            </div>

                                            <div class="input-field col s6">
                                                <input required name="jf_route" value="<?php echo $row->jf_route;?>" readonly type="text" placeholder="" id="FlightRoute"  class="validate">
                                                <label>Flight Route</label>
                                            </div>

                                            <div class="input-field col s6">
                                                <input required name="jf_deptime" value="<?php echo $row->jf_deptime;?>" readonly  type="text" id="FlightDepartureTime"  class="validate">
                                                <label>Flight Departure Time</label>
                                            </div>
                                            
                                            <div class="input-field col s6">
                                                <input required name="jf_arrtime" value="<?php echo $row->jf_arrtime;?>" readonly placeholder="" type="text" id="FlightArrivalTime"  class="validate">
                                                <label>Flight Arrival Time</label>
                                            </div>

                                            <div class="input-field col s6">
                                                <input required name="jf_flight_fare" value="<?php echo $row->jf_flight_fare;?>"  readonly placeholder="" type="text" id="FlightFare"  class="validate">
                                                <label>Flight Fare</label>
                                            </div>
                                            
                                        </div>
                                        
                                        <hr>  
                                        <div>
                                            <div class="input-field col s6">
                                                <input required name="jf_amt_paid" type="text" id="FlightFare"  class="validate">
                                                <label>Amount Paid</label>
                                            </div>

                                            <div class="input-field col s6">
                                                <select required name="jf_payment_method"   readonly placeholder="" type="text" class="validate">
                                                    <option>Mpesa</option>
                                                    <option>Airtel Money</option>
                                                    <option>Bank Deposit</option>
                                                </select>
                                                <label>Payment Method</label>
                                            </div>

                                        </div>
                                        <div>
                                            <div class="input-field col s12">
                                                <input required name="jf_payment_refcode" type="text" id="FlightFare"  class="validate">
                                                <label>Payment Refrence Codes<small>Enter 10 Digit code if you have paid using either Mpesa or Airtel Money and Slip number if you have used bank deposit</small></label>
                                            </div>

                                            <div class="input-field col s6" style="display:none">
                                                <?php
                                                    $length = 6;    
                                                    $_number =  substr(str_shuffle('0123456789QWERTYUIOPLKJHGFDSAZXCVBNM'),1,$length);
                                                ?>
                                                <input  required name="jf_payment_number" value="<?php echo $_number;?>" readonly placeholder="" type="text" class="validate">
                                                <label>Payment Number</label>
                                            </div>

                                        </div>                                       
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input type="submit" name="PayflightTicket" value="Pay Ticket" class="waves-effect waves-light btn-large">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php }?>
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