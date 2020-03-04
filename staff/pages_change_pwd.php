<?php
  session_start();
  include('_partials/config.php');//load config 
  include('_partials/checklogin.php'); //load checklogin 
  check_login();//invoke check login method
  $js_id = $_SESSION['js_id'];
  //load page using js_id as session holder
    if(isset($_POST['update_staff_profile']))
        {
            //Update profile
            $js_name = $_POST['js_name'];
            $js_email = $_POST['js_email'];
            
            $js_pic  = $_FILES["js_pic"]["name"];
            move_uploaded_file($_FILES["js_pic"]["tmp_name"],"images/user/".$_FILES["js_pic"]["name"]);
            //move uploaded picture
            
            $js_id = $_SESSION['js_id'];


            //Insert Captured information to a database table

            $query="UPDATE  jordan_staff  SET  js_name=?, js_email=?, js_pic=?  WHERE js_id =?";
            $stmt = $mysqli->prepare($query);
            //bind paramaters
            $rc=$stmt->bind_param('sssi',$js_name, $js_email, $js_pic, $js_id);
            $stmt->execute();

            //declare a varible which will be passed to alert function
            if($stmt)
            {
                $success = "Account Updated";
            }
            else {
                $err = "Please Try Again Or Try Later";
            }      
        }
    //update | change  password 
    if(isset($_POST['update_password']))
    {
        $js_pwd = sha1(md5($_POST['js_pwd']));
        $js_id = $_SESSION['js_id'];
        //update password
        $query = "UPDATE jordan_staff SET js_pwd=? WHERE js_id=?";
        $stmt = $mysqli->prepare($query);
        //bind paramaters
        $rc=$stmt->bind_param('si',$js_pwd, $js_id);
        $stmt->execute();
        if($stmt)
        {
            $success = 'Password Updated';
        }
        else
        {
            $err = "Please Try Again Later";
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
                    //Get details of staff
                    $js_id = $_SESSION['js_id'];
                    $ret=" SELECT * FROM  jordan_staff WHERE js_id = ? "; 
                    $stmt= $mysqli->prepare($ret) ;
                    $stmt->bind_param('s', $js_id);
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
                        <li><a href="">/ <i class="fa fa-user-secret" aria-hidden="true"></i> Profile</a>
                        </li>
                        <li class="active-bre"><a href="#">Manage</a>
                        </li>
                        <li class="active-bre"><a href="#"><?php echo $row->js_name;?></a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-3">
                    <div class="row">
                    <!--Update Profile-->
                        <div class="col-md-6">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Update <?php echo $row->js_name;?>'s Profile</h4>
                                    <p>Please Fill All Required Fields</p>
                                </div>
                                <div class="tab-inn">
                                    <form method = 'POST' enctype="multipart/form-data">

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input required type="text" value="<?php echo $row->js_name;?>" name="js_name" class="validate">
                                                <label>Name</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input required name="js_email" value="<?php echo $row->js_email;?>"  type="text"  class="validate">
                                                <label>Email</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="file-field input-field">
                                                <div class="btn">
                                                    <span>Profile Picture</span>
                                                    <input required name="js_pic"  type="file">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input  class="file-path validate" name="passport_pic"  type="text">
                                                </div>
                                            </div>    
                                        </div>
                                                                                    
                                        <hr>                                        
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input type="submit" name="update_staff_profile" value="Update <?php echo $row->js_name;?> Profile" class="waves-effect waves-light btn-large">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- ./ Update Profile-->

                        <!--Update Password-->
                        <div class="col-md-6">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Update <?php echo $row->js_name;?>'s Password</h4>
                                    <p>Please Fill All Required Fields</p>
                                </div>
                                <div class="tab-inn">
                                    <form method = 'POST' enctype="multipart/form-data">

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input required type="password"  name="" class="validate">
                                                <label>Old Password</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input required name="js_pwd"  type="password"  class="validate">
                                                <label>New Password</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input required type="password"  class="validate">
                                                <label>Confirm New Password</label>
                                            </div>
                                        </div>

                                        <hr>                                        
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input type="submit" name="update_password" value="Change Password" class="waves-effect waves-light btn-large">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- ./ Update Password-->
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