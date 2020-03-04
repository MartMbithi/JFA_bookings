
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
							<input type="text" required name="jp_email" class="validate">
							<label>Email</label>
						</div>
					</div>
					
					<div class="row">
						<div class="input-field col s12">
							<input type="submit" name="pass_reset_password" value="Log In" class="waves-effect waves-light btn-large"> </div>
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