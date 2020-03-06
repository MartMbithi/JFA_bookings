<?php
  session_start();
  include('_partials/config.php');//load config 
  
    if(isset($_POST['pass_reset_password']))
        {
            //Reset_pwd
            $jps_email = $_POST['jps_email'];
            $jps_token = $_POST['jps_token'];
            $jps_dummy_pwd = $_POST['jps_dummy_pwd'];
           
            //Insert Captured information to a database table

            $query="INSERT INTO jordan_password_resets (jps_email, jps_token, jps_dummy_pwd) VALUES (?,?,?)";
            $stmt = $mysqli->prepare($query);
            //bind paramaters
            $rc=$stmt->bind_param('sss', $jps_email, $jps_token, $jps_dummy_pwd);
            $stmt->execute();

            //declare a varible which will be passed to alert function
            if($stmt)
            {
                $success = "Check your email for password reset instructions";
            }
            else {
                $err = "Please Try Again Or Try Later";
            }      
        }
?>
<!DOCTYPE html>
<html lang="en">
<?php include("_partials/head.php");?>
<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>

	<!--DASHBOARD-->
	<section>
		<div class="tr-register">
			<div class="tr-regi-form">
				<h4>Reset Password</h4>
				<form class="col s12" method="post">

					<div class="row">
						<div class="input-field col s12">
							<input type="text" required name="jps_email" class="validate">
							<label>Email</label>
						</div>
					</div>
					<div class="row" style="display:none">
                    <div class="input-field col s12" >
                        <?php
                        //PHP function to generate token
                            $length = 20;    
                            $token =  substr(str_shuffle('0123456789QWERTYUIOPLKJHGFDSAZXCVBNMqwertyuioplkjhgfdsazxcvbnm'),1,$length);
                        ?>
                        <input id="first_name1" type="text" value="<?php echo $token;?>" name='jps_token' class="validate">
                    </div>
                </div>
                <div class="row" style="display:none">
                    <div class="input-field col s12">
                        <?php
                        //PHP function to generate random dummy passsword
                            $length = 4;    
                            $dummy_pwd =  substr(str_shuffle('0123456789QWERTYUIOPLKJHGFDSAZXCVBNMqwertyuioplkjhgfdsaxcvbnm'),1,$length);
                        ?>
                        <input id="first_name1" type="text" value="<?php echo $dummy_pwd;?>" name='jps_dummy_pwd' class="validate">
                    </div>
                </div>
					
					<div class="row">
						<div class="input-field col s12">
							<input type="submit" name="pass_reset_password" value="Reset Password" class="waves-effect waves-light btn-large"> </div>
					</div>
				</form>
				<p><a href="pages_signin.php">Remembered Password</a> | <a href="pages_signup.php">Register Account</a>
				</p>
				
			</div>
		</div>
	</section>
	
	<?php include("_partials/footer.php");?>
	<!--========= Scripts ===========-->
	<script src="js/jquery-latest.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/materialize.min.js"></script>
	<script src="js/custom.js"></script>
</body>

</html>