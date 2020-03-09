<?php
  session_start();
  include('_partials/config.php');//load config 
  include('_partials/checklogin.php'); //load checklogin 
  check_login();//invoke check login method
  $js_id = $_SESSION['js_id'];
  //load page using js_id as session holder
  
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
                        <li><a href="">/ <i class="fa fa-money" aria-hidden="true"></i> Finances</a>
                        </li>
                        <li class="active-bre"><a href="#">Manage / Generate Ticket</a>
                        </li>
                        <li class="active-bre"><a href="#"><?php echo $row->jfs_number;?></a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-3">
                    <button id="print"  class="waves-effect waves-light btn-large btn-success" onclick="printContent('Print_Ticket');" ><i class="fa fa-print"></i>
                         Print
                    </button>
                    <hr>              
                    <div class="row">
                        <div id="Print_Ticket" class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <img  src="images/logo1.png">
                                </div>
                                <div class="tab-inn">
                                    <form method = 'POST' enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="input-field col s6" style="display:none">
                                                <input required type="text" readonly name="payment_stats" value="Paid" class="validate">
                                                <label></label>
                                            </div>
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
                                        <?php
                                            $jfsp_id = $_GET['jfsp_id'];
                                            $ret="SELECT * FROM jordan_flights_reservation_payments WHERE jfsp_id  = ?" ;
                                            $stmt= $mysqli->prepare($ret) ;
                                            $stmt->bind_param('i', $jfsp_id);
                                            $stmt->execute() ;//ok
                                            $res=$stmt->get_result();
                                            //$cnt=1;
                                            while($row=$res->fetch_object())
                                            {
                                                
                                            
                                        ?>
                                        <div>
                                            <div class="input-field col s6">
                                                <input required name="jf_amt_paid" readonly value="<?php echo $row->jf_amt_paid;?>"type="text" id="FlightFare"  class="validate">
                                                <label>Amount Paid</label>
                                            </div>

                                            <div class="input-field col s6">
                                                <input required name="jf_payment_method " readonly value="<?php echo $row->jf_payment_method ;?>"type="text" id="FlightFare"  class="validate">
                                                <label>Payment Method</label>
                                            </div>


                                        </div>
                                        <div>
                                            <div class="input-field col s12">
                                                <input required name="jf_payment_refcode" readonly  value="<?php echo $row->jf_payment_refcode;?>" type="text" id="FlightFare"  class="validate">
                                                <label>Payment Refrence Codes<small>10 Digit code if you have paid using either Mpesa or Airtel Money and Slip number if you have used bank deposit</small></label>
                                            </div>

                                            <div class="input-field col s6" style="display:none">
                                                <input  required name="jf_payment_number" value="<?php echo $row->jf_payment_number;?>" readonly placeholder="" type="text" class="validate">
                                                <label>Payment Number</label>
                                            </div>

                                        </div>                                       
                                        <div class="row">
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php } }?>
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
    <script>
        function printContent(el){
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
        }
    </script>
</body>


</html>