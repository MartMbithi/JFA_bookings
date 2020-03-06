<?php
function check_login()
{
if(strlen($_SESSION['jp_id'])==0)
	{
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="index.php";
		$_SESSION["jp_id"]="";
		header("Location: http://$host$uri/$extra");
	}
}
?>
