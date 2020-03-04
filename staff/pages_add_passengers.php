<?php
  session_start();
  include('_partials/config.php');//load config 
  include('_partials/checklogin.php'); //load checklogin 
  check_login();//invoke check login method
  $js_id = $_SESSION['js_id'];
  //use staff id to hold this page's session
    if(isset($_POST['register_passenger']))
        {
            //Register New Passenger
            $jp_name = $_POST['jp_name'];
            $jp_national_id = $_POST['jp_national_id'];
            $jp_phone = $_POST['jp_phone'];
            $jp_number = $_POST['jp_number'];

            /*
                Upload passenger profile picture to systems server 
                --Let passenger set themselves profile picture
            $passport_pic = $_FILES["passport_pic"];
            move_uploaded_file($_FILES["passport_pic"]["tmp_name"],"images/user/".$_FILES["passport_pic"]["name"]);
            */

            $jp_email = $_POST['jp_email'];
            $jp_pwd = sha1(md5($_POST['jp_pwd']));
            $jp_gender =$_POST['jp_gender'];
            //Insert Captured information to a database table

            $query="INSERT INTO jordan_passengers (jp_name, jp_national_id, jp_phone, jp_number, jp_email, jp_pwd, jp_gender) VALUES (?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            //bind paramaters
            $rc=$stmt->bind_param('sssssss', $jp_name, $jp_national_id, $jp_phone, $jp_number, $jp_email, $jp_pwd, $jp_gender);
            $stmt->execute();

            //declare a varible which will be passed to alert function
            if($stmt)
            {
                $success = "Passenger Account Created";
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
                        <li><a href="">/ <i class="fa fa-users" aria-hidden="true"></i> Passengers</a>
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
                                    <h4>Passenger Registration Form</h4>
                                    <p>Please Fill All Required Fields</p>
                                </div>
                                <div class="tab-inn">
                                    <form method = 'POST' enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input required type="text" name="jp_name" class="validate">
                                                <label>Passenger Name</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input required name="jp_national_id" type="text"  class="validate">
                                                <label>Passenger National ID Number</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input required name="jp_phone" type="text"  class="validate">
                                                <label>Passenger Phone Number</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <?php
                                                //PHP function to generate random passenger number
                                                    $length = 4;    
                                                    $pass_number =  substr(str_shuffle('0123456789'),1,$length);
                                                ?>
                                                <input readonly required name="jp_number" type="text" value="JFA-PASS-<?php echo $pass_number;?>" class="validate">
                                                <label>Passenger Number</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s4">
                                                <input required name="jp_email" type="email"  class="validate">
                                                <label>Passenger Email</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input required name="jp_pwd" type="password"  class="validate">
                                                <label>Passenger Password</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <select required name="jp_gender" type="text"  class="validate">
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                                <label>Passenger Gender</label>
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
                                                <input type="submit" name="register_passenger" value="Register Passenger" class="waves-effect waves-light btn-large">
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