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

    <!--== BODY CONTNAINER HOLDING CERTAIN STAFF INFORMATION ==-->
    
        <div class="container-fluid sb2">
            <div class="row">
                <?php include("_partials/sidebar.php");?><!--Inject Side Navigation Bar-->
                <?php
                    //Get details of certain pstaff using staff number
                    $js_number = $_GET['js_number'];
                    $ret="SELECT * FROM  jordan_staff WHERE js_number = ? "; 
                    $stmt= $mysqli->prepare($ret) ;
                    $stmt->bind_param('s', $js_number);
                    $stmt->execute() ;//ok
                    $res=$stmt->get_result();
                    while($row=$res->fetch_object())
                    {
                    
                ?>
                <div class="sb2-2">
                    <div class="sb2-2-2">
                        <ul><!--Breadcrumps-->
                            <li><a href="pages_dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                            </li>
                            <li><a href="">/ <i class="fa fa-user-secret" aria-hidden="true"></i> Staff</a>
                            </li>
                            <li>/ <a href="#">Manage</a>
                            </li>
                            <li>/ <a href="#"><?php echo $row->js_name;?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="sb2-2-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-inn-sp">
                                    <div class="inn-title">
                                        <h4><?php echo $row->js_name;?>'s  Profile</h4>
                                        <p><?php echo $row->js_number;?></p>
                                    </div>
                                    <div class="tab-inn ">
                                        <ul class="collapsible popout"  data-collapsible="accordion">
                                            <li>
                                                <div class="collapsible-header coll-head"><i class="material-icons">perm_identity</i>Staff Name</div>
                                                <div class="collapsible-body coll-body"><span><?php echo $row->js_name;?></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header  coll-head"><i class="material-icons">assignment_ind</i>Staff National ID Number</div>
                                                <div class="collapsible-body coll-body"><span><?php echo $row->js_national_id;?></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header coll-head"><i class="material-icons">contact_phone</i>Staff Mobile Phone Number</div>
                                                <div class="collapsible-body coll-body"><span><?php echo $row->js_phone;?></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header coll-head"><i class="material-icons">message</i>Staff Email Address</div>
                                                <div class="collapsible-body coll-body"><span><?php echo $row->js_email;?></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header coll-head"><i class="material-icons">contacts</i>Staff Department</div>
                                                <div class="collapsible-body coll-body"><span><?php echo $row->js_dept;?></span>
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
    <?php }?>    
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