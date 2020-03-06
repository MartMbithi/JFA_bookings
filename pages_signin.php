<?php
    session_start();
    include('_partials/config.php');//get configuration file
    if(isset($_POST['pass_login']))
    {
        $jp_email = $_POST['jp_email'];
        $jp_pwd = sha1(md5($_POST['jp_pwd']));//double encrypt to increase security
        $stmt=$mysqli->prepare("SELECT jp_email, jp_pwd, jp_id  FROM jordan_passengers WHERE jp_email=? AND jp_pwd=?");//sql to log in user
        $stmt->bind_param('ss',$jp_email, $jp_pwd);//bind fetched parameters
        $stmt->execute();//execute bind
        $stmt -> bind_result($jp_email, $jp_pwd, $jp_id);//bind result
        $rs=$stmt->fetch();
        $_SESSION['jp_id'] = $jp_id;//assaign session to admin id
        //$uip=$_SERVER['REMOTE_ADDR'];
        //$ldate=date('d/m/Y h:i:s', time());
        if($rs)
            {//if its sucessfull
                header("location:pages_dashboard.php");
            }

        else
            {
            #echo "<script>alert('Access Denied Please Check Your Credentials');</script>";
                $err = "Access Denied Please Check Your Credentials";
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
				<h4>Sign In</h4>
				<p></p>
				<form class="col s12" method="post">
					<div class="row">
						<div class="input-field col s12">
							<input type="text" required name="jp_email" class="validate">
							<label>Email</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<input type="password" required name="jp_pwd" class="validate">
							<label>Password</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<input type="submit" name="pass_login" value="Log In" class="waves-effect waves-light btn-large"> </div>
					</div>
				</form>
				<p><a href="pages_reset_pwd.php">Forgot Password</a> | <a href="pages_signup.php">Register Account</a>
				</p>
				<div class="soc-login">
					<h4>Sign in using</h4>
					<ul>
						<li><a href="#"><i class="fa fa-facebook fb1"></i> Facebook</a> </li>
						<li><a href="#"><i class="fa fa-twitter tw1"></i> Twitter</a> </li>
						<li><a href="#"><i class="fa fa-google-plus gp1"></i> Google</a> </li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	
	<!--========= Scripts ===========-->
	<script src="js/jquery-latest.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/materialize.min.js"></script>
	<script src="js/custom.js"></script>
</body>

</html>