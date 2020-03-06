<?php
  session_start();
  include('_partials/config.php');//load config 
  include('_partials/checklogin.php'); //load checklogin 
  check_login();//invoke check login method
  $js_id = $_SESSION['js_id'];
  //load page using js_id as session holder
    if(isset($_POST['reserve_flight']))
        {
            //Register New flight
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


            //Insert Captured information to a database table

            $query="INSERT INTO jordan_flights_reservation (jf_name, jfs_number, jf_route, jf_number, jf_deptime, jf_arrtime, jp_id, jp_number, jp_name, jp_national_id, jf_flight_fare) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            //bind paramaters
            $rc=$stmt->bind_param('sssssssssss', $jf_name, $jfs_number,  $jf_route, $jf_number, $jf_deptime, $jf_arrtime, $jp_id, $jp_number, $jp_name, $jp_national_id, $jf_flight_fare);
            $stmt->execute();

            //declare a varible which will be passed to alert function
            if($stmt)
            {
                $success = "Flight Reservation Added";
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
                //Get details of a certain passenger
                $jp_number =  $_GET['jp_number'];
                $ret="SELECT * FROM  jordan_passengers WHERE jp_number = ? " ; 
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('s', $jp_number);
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
                        <li class="active-bre"><a href="#">Add</a>
                        </li>
                        <li class="active-bre"><a href="#"><?php echo $row->jp_name;?> Reservation</a>
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
                                                <input required type="text" name="jp_name" value="<?php echo $row->jp_name;?>" class="validate">
                                                <label>Passenger Name</label>
                                            </div>

                                            <div class="input-field col s6">
                                                <input readonly required name="jp_number" type="text" value="<?php echo $row->jp_number;?>" class="validate">
                                                <label>Passenger  Number</label>
                                            </div>
 
                                        </div>
                                        
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input required type="text" name="jp_national_id" value="<?php echo $row->jp_national_id;?>" class="validate">
                                                <label>Passenger National ID Number</label>
                                            </div>

                                            <div class="input-field col s6">
                                                <?php
                                                //PHP function to generate random flight number
                                                    $length = 4;    
                                                    $_number =  substr(str_shuffle('0123456789'),1,$length);
                                                ?>
                                                <input required readonly name="jfs_number" value="JFA-RESERVATION-<?php echo $_number;?>" type="text"  class="validate">
                                                <label>Reservation Number</label>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="row">
                                            
                                            <div class="input-field col s6">
                                                <select required name="jf_number" onChange="getFlightDetails(this.value);"  type="text"  class="validate">
                                                    <option>Option</option>
                                                    <?php
                                                        //Get details of all flights
                                                        $ret="SELECT * FROM  jordan_flights"; 
                                                        $stmt= $mysqli->prepare($ret) ;
                                                        $stmt->execute() ;//ok
                                                        $res=$stmt->get_result();
                                                        //$cnt=1;
                                                        while($row=$res->fetch_object())
                                                        {
                                                      
                                                    ?>
                                                    <option value="<?php echo $row->jf_number;?>"><?php echo $row->jf_number ;?></option>
                                                    <?php }?>
                                                    
                                                </select>
                                                <label>Flight Route Number</label>
                                            </div>

                                            <div class="input-field col s6">
                                                <input required name="jf_name" readonly type="text" placeholder="Flight Name"  id="FlightName"  class="validate">
                                            </div>

                                            <div class="input-field col s6">
                                                <input required name="jf_route" readonly type="text" placeholder="Flight Route" id="FlightRoute"  class="validate">
                                            </div>

                                            <div class="input-field col s6">
                                                <input required name="jf_deptime" readonly placeholder="Flight Departure Time" type="text" id="FlightDepartureTime"  class="validate">
                                            </div>
                                            
                                            <div class="input-field col s6">
                                                <input required name="jf_arrtime" readonly placeholder="Flight Arrival Time" type="text" id="FlightArrivalTime"  class="validate">
                                            </div>

                                            <div class="input-field col s6">
                                                <input required name="jf_flight_fare" readonly placeholder="Flight Fare" type="text" id="FlightFare"  class="validate">
                                            </div>
                                            
                                        </div>
                                        
                                        <hr>                                        
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input type="submit" name="reserve_flight" value="Reserve Flight" class="waves-effect waves-light btn-large">
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