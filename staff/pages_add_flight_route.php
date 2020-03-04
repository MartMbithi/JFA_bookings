<?php
  session_start();
  include('_partials/config.php');//load config 
  include('_partials/checklogin.php'); //load checklogin 
  check_login();//invoke check login method
  $js_id = $_SESSION['js_id'];
  //load page using js_id as session holder
    if(isset($_POST['add_flight_route']))
        {
            //Register
            $jfr_number = $_POST['jfr_number'];
            $jfr_dep_airport= $_POST['jfr_dep_airport'];
            $jfr_arr_airport = $_POST['jfr_arr_airport'];
            $jfr_ticket_fare = $_POST['jfr_ticket_fare'];
            
            //Insert Captured information to a database table

            $query="INSERT INTO jordan_flight_routes (jfr_number, jfr_dep_airport, jfr_arr_airport, jfr_ticket_fare) VALUES (?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            //bind paramaters
            $rc=$stmt->bind_param('ssss', $jfr_number, $jfr_dep_airport, $jfr_arr_airport, $jfr_ticket_fare);
            $stmt->execute();

            //declare a varible which will be passed to alert function
            if($stmt)
            {
                $success = "Flight Route Added";
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
            <div class="sb2-2">
                <div class="sb2-2-2">
                    <ul>
                        <li><a href="pages_dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        </li>
                        <li><a href="">/ <i class="fa fa-plane" aria-hidden="true"></i> Flight Routes</a>
                        </li>
                        <li class="active-bre"><a href="#">Add</a>
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
                                                <?php
                                                //PHP function to generate random flight number
                                                    $length = 4;    
                                                    $_number =  substr(str_shuffle('0123456789'),1,$length);
                                                ?>
                                                <input readonly required name="jfr_number" type="text" value="JFA-FR-<?php echo $_number;?>" class="validate">
                                                <label>Flight Route Number</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input required name="jfr_ticket_fare" type="text" class="validate">
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
                                                <input type="submit" name="add_flight_route" value="Add Flight Route" class="waves-effect waves-light btn-large">
                                            </div>
                                        </div>
                                    </form>
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