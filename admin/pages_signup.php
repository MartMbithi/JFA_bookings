<?php
	session_start();
	include('_partials/config.php');
		if(isset($_POST['signup']))
		{
            $js_number = $_POST['js_number'];
            $js_access_role = $_POST['js_access_role'];
            $js_name = $_POST['js_name'];
            $js_dept = $_POST['js_dept'];
            $js_national_id = $_POST['js_national_id'];
            $js_phone = $_POST['js_phone'];
            $js_email = $_POST['js_email'];
            $js_pwd =sha1(md5($_POST['js_pwd']));
			$query="INSERT INTO jordan_staff (js_number, js_access_role, js_name, js_dept, js_national_id, js_phone, js_email, js_pwd) VALUES (?,?,?,?,?,?,?,?)";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('ssssssss', $js_number, $js_access_role, $js_name, $js_dept, $js_national_id, $js_phone, $js_email, $js_pwd);
			$stmt->execute();
			/*
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Account Created";
			}
			else {
				$err = "Please Try Again Or Try Later";
			}
			
			
		}
?>
<!DOCTYPE html>
<html lang="en">


<?php include('_partials/head.php');?>

<body>
    <div class="blog-login">
        <div class="blog-login-in">
            <form method ="post">
                <img src="images/logo.png" alt="logo" />
                <div class="row">
                    <div class="input-field col s12" style="display:none">
                            <?php 
                                    $length = 5;    
                                    $staff_number =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                            ?>
                        <input id="first_name1" value="JFA-<?php echo $staff_number;?>" name="js_number" type="text" class="validate">
                        <label for="first_name1">Staff Number</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12" style='display:none'>
                        <input id="first_name1" name="js_access_role" value="1" type="text" class="validate">
                        <!--If staff has an access value of 1 is a non-sudo staff else has a 0-->
                        <label for="first_name1">Access Role</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="first_name1" name="js_name" type="text" class="validate">
                        <label for="first_name1">Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="first_name1" name="js_dept" type="text" class="validate">
                        <label for="first_name1">Department</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="first_name1" name="js_national_id" type="text" class="validate">
                        <label for="first_name1">National ID Number</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="first_name1" name="js_phone" type="text" class="validate">
                        <label for="first_name1">Phone</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="first_name1" name="js_email" type="email" class="validate">
                        <label for="first_name1">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="first_name1" name="js_pwd" type="password" class="validate">
                        <label for="first_name1">Password</label>
                    </div>
                </div>
                
                <div class="row">
                    <div class="input-field col s12">
                        <input type="submit" name="signup" class="waves-effect waves-light btn-large btn-log-in" value="Sign Up">
                    </div>
                </div>
                <a href="index.php" class="for-pass">Login In</a>

            </form>
        </div>
    </div>

    <!--======== SCRIPT FILES =========-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/custom.js"></script>
</body>


</html>