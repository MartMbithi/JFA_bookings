<?php
  session_start();
  include('_partials/config.php');//load config 
  include('_partials/checklogin.php'); //load checklogin 
  check_login();//invoke check login method
  $ja_id = $_SESSION['ja_id'];
  //load page using ja_id as session holder
  //delete Feedback
  if(isset($_GET['delete_password_reset']))
  {
        $id=intval($_GET['delete_password_reset']);
        $adn="DELETE FROM  jordan_password_resets  WHERE jps_id = ?";
        $stmt= $mysqli->prepare($adn);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	 
  
          if($stmt)
          {
            $info = "Password Reset Deleted";
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
                        <li><a href="">/ <i class="fa fa-lock" aria-hidden="true"></i> Passsword Reset Requests</a>
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
                                    <h4>Passenger Reset Requests</h4>
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
                                                    <th>Email</th>
                                                    <th>Token</th>
                                                    <th>Timestamp</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    //Get details of all pwd resets
                                                    $ret="SELECT * FROM  jordan_password_resets ORDER BY RAND() "; 
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    $cnt=1;
                                                    while($row=$res->fetch_object())
                                                    {
                                                        $t_stamp = $row->jps_tstamp;

                                                        
                                                ?>
                                                    <tr>
                                                        <td><?php echo $cnt;?></td>
                                                        <td><?php echo $row->jps_email;?></td>
                                                        <td>
                                                            <span class="label label-primary">
                                                                <?php echo $row->jps_token;?>   
                                                            </span>    
                                                        </td>
                                                        <td><?php echo date("d-M-Y h::m::s ", strtotime($t_stamp));?></td>

                                                        <td>
                                                        <?php 
                                                            if($row->sent_mail_status == 'Pending')
                                                            {
                                                                echo 
                                                                    "
                                                                        <a  href='pages_sent_mail.php?email=$row->jps_email&token=$row->jps_token&dummy_pwd=$row->jps_dummy_pwd&jps_id=$row->jps_id'>
                                                                            <span class='label label-success'>
                                                                                Update Password
                                                                            </span>                                                                  
                                                                        </a>
                                                                    ";
                                                            }
                                                            else
                                                            {
                                                                echo 
                                                                    "
                                                                        <a target='_blank' href='mailto:$row->jps_email&token=$row->jps_token&dummy_pwd=$row->jps_dummy_pwd&jps_id=$row->jps_id'>
                                                                            <span class='label label-success'>
                                                                                Send Email
                                                                            </span>                                                                  
                                                                        </a>
                                                                    ";
                                                            };
                                                        ?>    
                                                                                                                     
                                                            
                                                            <br>


                                                            <a  href="pages_manage_password_resets.php?delete_password_reset=<?php echo $row->jps_id;?>">
                                                                <span class="label label-danger">
                                                                     Delete  
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