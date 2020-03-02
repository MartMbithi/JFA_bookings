<?php
function check_login()
{
if(strlen($_SESSION['ja_id'])==0)
	{
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="index.php";
		$_SESSION["ja_id"]="";
		header("Location: http://$host$uri/$extra");
	}
}
?>
