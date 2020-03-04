<?php
  session_start();
  include('_partials/config.php');//load config 
  include('_partials/checklogin.php'); //load checklogin 
  check_login();//invoke check login method
  $js_id = $_SESSION['js_id'];
  //load page using js_id as session holder
    if(isset($_POST['update_flight']))
        {
            //Register New flight
            $jf_name = $_POST['jf_name'];
            $jf_number = $_GET['jf_number'];
            $jf_passengers = $_POST['jf_passengers'];
            $jf_deptime = $_POST['jf_deptime'];
            $jf_arrtime = $_POST['jf_arrtime'];
            $jf_flightroute_number = $_POST['jf_flightroute_number'];
            $jf_flight_dep_airport  = $_POST['jf_flight_dep_airport'];
            $jf_flight_des_airport =$_POST['jf_flight_des_airport'];
            $jf_flight_route = $_POST['jf_flight_route'];
            $jf_flight_ticket_fare = $_POST['jf_flight_ticket_fare'];
            //$jf = $_GET['jf_id'];


            //Insert Captured information to a database table

            $query="UPDATE  jordan_flights SET jf_name=?, jf_passengers=?, jf_deptime=?, jf_arrtime=?, jf_flightroute_number=?, jf_flight_dep_airport=?, jf_flight_des_airport=?, jf_flight_route=?, jf_flight_ticket_fare=? WHERE jf_number = ?";
            $stmt = $mysqli->prepare($query);
            //bind paramaters
            $rc=$stmt->bind_param('ssssssssss', $jf_name, $jf_passengers, $jf_deptime, $jf_arrtime, $jf_flightroute_number, $jf_flight_dep_airport, $jf_flight_des_airport, $jf_flight_route, $jf_flight_ticket_fare, $jf_number);
            $stmt->execute();

            //declare a varible which will be passed to alert function
            if($stmt)
            {
                $success = "Flight Updated";
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
                //Get details of all flights
                $jf_number = $_GET['jf_number'];
                $ret="SELECT * FROM  jordan_flights WHERE jf_number = ? "; 
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('s', $jf_number);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                $cnt=1;
                while($row=$res->fetch_object())
                {
                    
            ?>
            <div class="sb2-2">
                <div class="sb2-2-2">
                    <ul>
                        <li><a href="pages_dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        </li>
                        <li><a href="">/ <i class="fa fa-plane" aria-hidden="true"></i> Flights</a>
                        </li>
                        <li class="active-bre"><a href="#">Manage</a>
                        </li>
                        <li class="active-bre"><a href="#"><?php echo $row->jf_number;?></a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Update Flight <?php echo $row->jf_number;?></h4>
                                    <p>Please Fill All Required Fields</p>
                                </div>
                                <div class="tab-inn">
                                    <form method = 'POST' enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input required value="<?php echo $row->jf_name;?>" type="text" name="jf_name" class="validate">
                                                <label>Flight Name</label>
                                            </div>

                                            <div class="input-field col s6">
                                                
                                                <input readonly required name="" type="text" value="<?php echo $row->jf_number;?>" class="validate">
                                                <label>Flight Number</label>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s4">
                                                <input required name="jf_passengers" value="<?php echo $row->jf_passengers;?>" type="text"  class="validate">
                                                <label>Number Of Passengers</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input required name="jf_deptime" value="<?php echo $row->jf_deptime;?>" type="text" placeholder="HH:MM"  class="validate">
                                                <label>Flight Departure Time</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input required name="jf_arrtime" value="<?php echo $row->jf_arrtime;?>" type="text" placeholder="HH:MM"  class="validate">
                                                <label>Flight Arrival Time</label>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            
                                            <div class="input-field col s6">
                                                <select required name="jf_flightroute_number" onChange="getFlightFare(this.value);"  type="text"  class="validate">
                                                    <option>Option</option>
                                                    <?php
                                                        //Get details of all flights
                                                        $ret="SELECT * FROM  jordan_flight_routes"; 
                                                        $stmt= $mysqli->prepare($ret) ;
                                                        $stmt->execute() ;//ok
                                                        $res=$stmt->get_result();
                                                        //$cnt=1;
                                                        while($row=$res->fetch_object())
                                                        {
                                                      
                                                    ?>
                                                    <option value="<?php echo $row->jfr_number;?>"><?php echo $row->jfr_number ;?></option>
                                                    <?php }?>
                                                    
                                                </select>
                                                <label>Flight Route Number</label>
                                            </div>

                                            <div class="input-field col s6">
                                                <input required name="jf_flight_dep_airport" readonly type="text" placeholder="Flight Departure Airport"  id="FlightDepatureAirport"  class="validate">
                                            </div>

                                            <div class="input-field col s6">
                                                <input required name="jf_flight_des_airport" readonly placeholder="Flight Destination Airport" type="text" id="FlightDestinationAirport"  class="validate">
                                            </div>

                                            <div class="input-field col s6">
                                                <input required name="jf_flight_route" readonly type="text" placeholder="Flight Route" id="FlightRoute"  class="validate">
                                            </div>

                                            <div class="input-field col s12">
                                                <input required name="jf_flight_ticket_fare" readonly placeholder="Flight Route Ticket Fare" type="text" id="FlightFareTicket"  class="validate">
                                            </div>
                                            
                                        </div>
                                        <!--
                                        <div class="row">
                                            <div class="file-field input-field">
                                                <div class="btn">
                                                    <span>Profile Picture</span>
                                                    <input required name="passport_pic"  type="file">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input  class="file-path validate" name="passport_pic"  type="text">
                                                </div>
                                            </div>
                                        </div> -->
                                        <hr>                                        
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input type="submit" name="update_flight" value="Update Flight" class="waves-effect waves-light btn-large">
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