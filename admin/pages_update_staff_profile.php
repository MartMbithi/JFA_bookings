<?php
  session_start();
  include('_partials/config.php');//load config 
  include('_partials/checklogin.php'); //load checklogin 
  check_login();//invoke check login method
  $ja_id = $_SESSION['ja_id'];
  //use admin id to hold this page's session
    if(isset($_POST['update_staff']))
        {
            //Update Registered Staff
            $js_number = $_GET['js_number'];
            $js_name = $_POST['js_name'];
            $js_dept = $_POST['js_dept'];
            $js_national_id = $_POST['js_national_id'];
            $js_phone = $_POST['js_phone'];
            $js_email = $_POST['js_email'];
            $js_pwd  = sha1(md5($_POST['js_pwd']));

            //Insert Captured information to a database table

            $query="UPDATE  jordan_staff  SET  js_name=?, js_dept=?, js_national_id=?, js_phone=?, js_email=?, js_pwd=? WHERE js_number =?";
            $stmt = $mysqli->prepare($query);
            //bind paramaters
            $rc=$stmt->bind_param('sssssss',  $js_name, $js_dept, $js_national_id, $js_phone, $js_email, $js_pwd, $js_number);
            $stmt->execute();

            //declare a varible which will be passed to alert function
            if($stmt)
            {
                $success = "Staff Account Updated";
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
                    //Get details of certain staff using staff number
                    $js_number = $_GET['js_number'];
                    $ret=" SELECT * FROM  jordan_staff WHERE js_number = ? "; 
                    $stmt= $mysqli->prepare($ret) ;
                    $stmt->bind_param('s', $js_number);
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
                        <li><a href="">/ <i class="fa fa-user-secret" aria-hidden="true"></i> Staff</a>
                        </li>
                        <li class="active-bre"><a href="#">Manage</a>
                        </li>
                        <li class="active-bre"><a href="#"><?php echo $row->js_name;?></a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Update <?php echo $row->js_name;?>'s Profile</h4>
                                    <p>Please Fill All Required Fields</p>
                                </div>
                                <div class="tab-inn">
                                    <form method = 'POST' enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input required type="text" value="<?php echo $row->js_name;?>" name="js_name" class="validate">
                                                <label>Staff Name</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input required name="js_national_id" value="<?php echo $row->js_national_id;?>"  type="text"  class="validate">
                                                <label>Staff National ID Number</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input required name="js_phone" value="<?php echo $row->js_phone;?>" type="text"  class="validate">
                                                <label>Staff Phone Number</label>
                                            </div>
                                            <div class="input-field col s6">
                                                
                                                <input readonly required name="js_number" type="text" value="<?php echo $row->js_number;?>" class="validate">
                                                <label>Staff Number</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s4">
                                                <input required name="js_email" value="<?php echo $row->js_email;?>" type="email"  class="validate">
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
                                                <input type="submit" name="update_staff" value="Update <?php echo $row->js_name;?>" class="waves-effect waves-light btn-large">
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