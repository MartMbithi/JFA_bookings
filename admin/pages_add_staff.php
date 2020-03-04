<?php
  session_start();
  include('_partials/config.php');//load config 
  include('_partials/checklogin.php'); //load checklogin 
  check_login();//invoke check login method
  $ja_id = $_SESSION['ja_id'];
  //use admin id to hold this page's session
    if(isset($_POST['register_staff']))
        {
            //Register New Staff
            $js_number = $_POST['js_number'];
            $js_name = $_POST['js_name'];
            $js_dept = $_POST['js_dept'];
            $js_national_id = $_POST['js_national_id'];
            $js_phone = $_POST['js_phone'];
            $js_email = $_POST['js_email'];
            $js_pwd  = sha1(md5($_POST['js_pwd']));

            //Insert Captured information to a database table

            $query="INSERT INTO jordan_staff (js_number, js_name, js_dept, js_national_id, js_phone, js_email, js_pwd) VALUES (?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            //bind paramaters
            $rc=$stmt->bind_param('sssssss', $js_number, $js_name, $js_dept, $js_national_id, $js_phone, $js_email, $js_pwd);
            $stmt->execute();

            //declare a varible which will be passed to alert function
            if($stmt)
            {
                $success = "Staff Account Created";
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
                        <li><a href="">/ <i class="fa fa-user-secret" aria-hidden="true"></i> Staff</a>
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
                                    <h4>Staff Registration Form</h4>
                                    <p>Please Fill All Required Fields</p>
                                </div>
                                <div class="tab-inn">
                                    <form method = 'POST' enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input required type="text" name="js_name" class="validate">
                                                <label>Staff Name</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input required name="js_national_id" type="text"  class="validate">
                                                <label>Staff National ID Number</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input required name="js_phone" type="text"  class="validate">
                                                <label>Staff Phone Number</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <?php
                                                //PHP function to generate random passenger number
                                                    $length = 4;    
                                                    $staff_number =  substr(str_shuffle('0123456789'),1,$length);
                                                ?>
                                                <input readonly required name="js_number" type="text" value="JFA-STAFF-<?php echo $staff_number;?>" class="validate">
                                                <label>Staff Number</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s4">
                                                <input required name="js_email" type="email"  class="validate">
                                                <label>Staff Email</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input required name="js_pwd" type="password"  class="validate">
                                                <label>Staff Password</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <select required name="js_dept" type="text"  class="validate">
                                                    <option>Finance</option>
                                                    <option>Manatainance</option>
                                                    <option>Pilot</option>
                                                    <option>Crew Service</option>
                                                </select>
                                                <label>Department</label>
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
                                                <input type="submit" name="register_staff" value="Register Staff" class="waves-effect waves-light btn-large">
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