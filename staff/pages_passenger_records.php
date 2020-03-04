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
                        <li class="active-bre"><a href="#">Passenger Records</a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Passenger Records</h4>
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
                                                    <th>Name</th>
                                                    <th>ID No.</th>
                                                    <th>Phone</th>
                                                    <th>Pass No</th>
                                                    <th>Email</th>
                                                    <th>Gender</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    //Get details of all registered passengers
                                                    $ret="SELECT * FROM  jordan_passengers ORDER BY RAND() "; 
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    $cnt=1;
                                                    while($row=$res->fetch_object())
                                                    {
                                                        /* Trim date passenger joined from default timestamp to
                                                        *  User Uderstandable Formart  DD-MM-YYYY : 
                                                        */
                                                        $datePassengerJoined = $row->jp_date_joined;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $cnt;?></td>
                                                        <td><?php echo $row->jp_name;?></td>
                                                        <td><?php echo $row->jp_national_id;?></td>
                                                        <td><?php echo $row->jp_phone;?></td>
                                                        <td>
                                                            <span class="label label-primary">
                                                                <?php echo $row->jp_number;?>
                                                            </span>    
                                                        </td>
                                                        <td><?php echo $row->jp_email;?></td>
                                                        <td><?php echo $row->jp_gender;?></td>
                                                        
                                                        <td>
                                                            <a  href="pages_view_passenger_profile.php?jp_number=<?php echo $row->jp_number;?>">
                                                                <span class="label label-success">
                                                                     View   
                                                                </span>                                                                  
                                                            </a>
                                                        </td>
                                                        
                                                    </tr> 
                                                <?php //increment count by 1
                                                    $cnt = $cnt+1;
                                                 }?>
                                            </tbody>
                                        </table>
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