<?php
  session_start();
  include('_partials/config.php');//load config 
  include('_partials/checklogin.php'); //load checklogin 
  check_login();//invoke check login method
  $js_id = $_SESSION['js_id'];
  //load page using js_id as session holder
    if(isset($_POST['update_pasword']))
        {
            $email = $_GET['email'];
            $jp_pwd = sha1(md5($_POST['jp_pwd']));
            $jps_id = $_GET['jps_id'];
            $sent_mail_status = $_POST['sent_mail_status'];

            
            $query="UPDATE jordan_passengers  SET jp_pwd=?  WHERE  jp_email=?";
            $sent_mail = "UPDATE jordan_password_resets SET sent_mail_status=?  WHERE  jps_id=?";
            $stmt = $mysqli->prepare($query);
            $sent_mail_stmt = $mysqli->prepare($sent_mail);
            //bind paramaters
            $rc=$stmt->bind_param('ss', $jp_pwd, $email);
            $rc=$sent_mail_stmt->bind_param('si', $sent_mail_status, $jps_id);

            $stmt->execute();
            $sent_mail_stmt->execute();

            //declare a varible which will be passed to alert function
            if($stmt && $sent_mail_stmt)
            {
                    $success = "Password Reset";
            }
            else
            {
                $err = 'Please Try Again Later';
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
                    //Get details of certain passenger using passenger number
                    $email = $_GET['email'];
                    $ret="SELECT * FROM  jordan_passengers WHERE jp_email = ? "; 
                    $stmt= $mysqli->prepare($ret) ;
                    $stmt->bind_param('s', $email);
                    $stmt->execute() ;//ok
                    $res=$stmt->get_result();
                    while($row=$res->fetch_object())
                    {
                    /* Trim date passenger joined from default timestamp to
                    *  User Uderstandable Formart  DD-MM-YYYY : 
                    */
                    $datePassengerJoined = $row->jp_date_joined;
                ?>
                    
                <div class="sb2-2">
                    <div class="sb2-2-2">
                        <ul><!--Breadcrumps-->
                            <li><a href="pages_dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                            </li>
                            <li><a href="">/ <i class="fa fa-users" aria-hidden="true"></i> Password Resets</a>
                            </li>
                            <li>/ <a href="#">Manage</a>
                            </li>
                            <li>/ <a href="#"><?php echo $row->jp_name;?></a>
                            </li>
                        </ul>
                    </div>
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4><?php echo $row->jp_name;?>'s Profile</h4>
                                    <p>Please Fill All Required Fields</p>
                                </div>
                                <div class="tab-inn">
                                    <?php
                                        $jps_id = $_GET['jps_id'];
                                        $ret="SELECT * FROM  jordan_password_resets WHERE jps_id=? "; 
                                        $stmt= $mysqli->prepare($ret) ;
                                        $stmt->bind_param('i', $jps_id);
                                        $stmt->execute() ;//ok
                                        $res=$stmt->get_result();
                                        while($row=$res->fetch_object())
                                        {
                                           
                                    ?>
                                    <form method = 'POST'  enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input required type="text" value="<?php echo $row->jps_email;?>" name="jp_name" class="validate">
                                                <label>Email Address</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input required name="jp_national_id" value="<?php echo $row->jps_token;?>"  type="text"  class="validate">
                                                <label>Reset Token</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input required name="jp_pwd" value="<?php echo $row->jps_dummy_pwd;?>" type="text"  class="validate">
                                                <label>New Password</label>
                                            </div>
                                            <div class="input-field col s6" style="display:none">
                                                <input required name="sent_mail_status" value="Mail Send" type="text"  class="validate">
                                            </div>
                                            
                                        </div>
                                                                    
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input type="submit" name="update_pasword"  value="Sent Mail" class="waves-effect waves-light btn-large">
                                            </div>
                                            
                                        </div>
                                    </form>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
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