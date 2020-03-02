<?php
    session_start();
    include('_partials/config.php');//get configuration file
    if(isset($_POST['login']))
    {
        $ja_email = $_POST['ja_email'];
        $ja_pwd = sha1(md5($_POST['ja_pwd']));//double encrypt to increase security
        $stmt=$mysqli->prepare("SELECT ja_email, ja_pwd, ja_id  FROM jordan_admin WHERE ja_email=? AND ja_pwd=?");//sql to log in user
        $stmt->bind_param('ss',$ja_email, $ja_pwd);//bind fetched parameters
        $stmt->execute();//execute bind
        $stmt -> bind_result($ja_email, $ja_pwd, $ja_id);//bind result
        $rs=$stmt->fetch();
        $_SESSION['ja_id'] = $ja_id;//assaign session to admin id
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


<?php include('_partials/head.php');?>

<body>
    <div class="blog-login">
        <div class="blog-login-in">
            <form method ="post">
                <img src="images/logo.png" alt="logo" />
                <div class="row">
                    <div class="input-field col s12">
                        <input id="first_name1" name="ja_email" type="email" required class="validate">
                        <label for="first_name1">Email</label>
                    </div>
                </div>
                
                <div class="row">
                    <div class="input-field col s12">
                        <input id="first_name1" name="ja_pwd" type="password" class="validate">
                        <label for="first_name1">Password</label>
                    </div>
                </div>
                
                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" name="login" class="waves-effect waves-light btn-large btn-log-in">Login</button>
                    </div>
                </div>
                <a href="forgot_pwd.php" class="for-pass">Forgot Password?</a>
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