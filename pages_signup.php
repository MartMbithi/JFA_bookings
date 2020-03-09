<?php
  session_start();
  include('_partials/config.php');//load config 
    if(isset($_POST['pass_create_acc']))
        {
            //Register New Passenger
            $jp_name = $_POST['jp_name'];
            $jp_national_id = $_POST['jp_national_id'];
            $jp_phone = $_POST['jp_phone'];
            $jp_number = $_POST['jp_number'];

            /*
                Upload passenger profile picture to systems server 
                --Let passenger set the picture after they have logged in.
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
				<h4>Sign Up</h4>
				<form class="col s12" method="post">
					<div class="row">
						<div class="input-field col s6">
							<input type="text" required name="jp_name" class="validate">
							<label>Full Name</label>
						</div>

                        <div class="input-field col s6">
							<input type="text" required name="jp_national_id" class="validate">
							<label>National ID Number</label>
						</div>
                    </div>
                    <div class="row">    
                        <div class="input-field col s6">
							<input type="text" required name="jp_phone" class="validate">
							<label>Phone Number</label>
						</div>
                        <div class="input-field col s6" style="display:none">
                            <?php
                            //PHP function to generate random passenger number
                                $length = 4;    
                                $pass_number =  substr(str_shuffle('0123456789'),1,$length);
                            ?>
							<input type="text" value="JFA-PASS-<?php echo $pass_number;?>" required name="jp_number" class="validate">
							<label>Phone Number</label>
						</div>
                        <div class="input-field col s6">
							<select type="text" required name="jp_gender" class="validate">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<input type="email" required name="jp_email" class="validate">
							<label>Email</label>
						</div>
                        <div class="input-field col s12">
							<input type="password" required name="jp_pwd" class="validate">
							<label>Password</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<input type="submit" name="pass_create_acc" value="Create Acount" class="waves-effect waves-light btn-large"> </div>
					</div>
				</form>
				<p><a href="pages_reset_pwd.php">Forgot Password</a> | <a href="pages_signin.php">Log In</a>
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