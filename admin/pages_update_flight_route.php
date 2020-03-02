<?php
  session_start();
  include('_partials/config.php');//load config 
  include('_partials/checklogin.php'); //load checklogin 
  check_login();//invoke check login method
  $ja_id = $_SESSION['ja_id'];
  //use admin id to hold this page's session
    if(isset($_POST['update_flight_route']))
        {
            //Register
            $jfr_number = $_GET['jfr_number'];
            $jfr_dep_airport= $_POST['jfr_dep_airport'];
            $jfr_arr_airport = $_POST['jfr_arr_airport'];
            $jfr_ticket_fare = $_POST['jfr_ticket_fare'];
            
            //Insert Captured information to a database table

            $query="UPDATE  jordan_flight_routes SET jfr_dep_airport=?, jfr_arr_airport=?,  jfr_ticket_fare=? WHERE jfr_number=?";
            $stmt = $mysqli->prepare($query);
            //bind paramaters
            $rc=$stmt->bind_param('ssss', $jfr_dep_airport, $jfr_arr_airport,  $jfr_ticket_fare, $jfr_number);
            $stmt->execute();

            //declare a varible which will be passed to alert function
            if($stmt)
            {
                $success = "Flight Route Updated";
            }

            else
            {
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
                    //Get details of certain flight route using flightroute number
                    $jfr_number = $_GET['jfr_number'];
                    $ret="SELECT * FROM  jordan_flight_routes WHERE jfr_number = ? "; 
                    $stmt= $mysqli->prepare($ret) ;
                    $stmt->bind_param('s', $jfr_number);
                    $stmt->execute() ;//ok
                    $res=$stmt->get_result();
                    while($row=$res->fetch_object())
                    {
                    
            ?>
            <div class="sb2-2">
                <div class="sb2-2-2">
                    <ul>
                        <li><a href="pages_dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        </li>
                        <li><a href="">/ <i class="fa fa-plane" aria-hidden="true"></i> Flight Routes</a>
                        </li>
                        <li class="active-bre"><a href="#">Manage</a>
                        </li>
                        <li class="active-bre"><a href="#"><?php echo $row->jfr_number;?></a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Flight Route</h4>
                                    <p>Please Fill All Required Fields</p>
                                </div>
                                <div class="tab-inn">
                                    <form method = 'POST' enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input readonly required name="" type="text" value="<?php echo $row->jfr_number;?>" class="validate">
                                                <label>Flight Route Number</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input required name="jfr_ticket_fare" value="<?php echo $row->jfr_ticket_fare;?>" type="text" class="validate">
                                                <label>Flight Route Ticket Fare (Ksh)</label>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                            
                                            <div class="input-field col s6">
                                                <select required name="jfr_dep_airport" type="text"  class="validate">
                                                    <option>Mombasa</option>
                                                    <option>Voi</option>
                                                    <option>Taveta</option>
                                                    <option>Nairobi</option>
                                                </select>
                                                <label>Flight Departure Airport</label>
                                            </div>

                                            <div class="input-field col s6">
                                                <select required name="jfr_arr_airport" type="text"  class="validate">
                                                    <option>Mombasa</option>
                                                    <option>Voi</option>
                                                    <option>Taveta</option>
                                                    <option>Nairobi</option>
                                                </select>
                                                <label>Flight Arrival Airport</label>
                                            </div>
                                            
                                        </div>
                                       
                                        <hr>                                        
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input type="submit" name="update_flight_route" value="Update Flight Route" class="waves-effect waves-light btn-large">
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