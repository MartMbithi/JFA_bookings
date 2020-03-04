<?php
  session_start();
  include('_partials/config.php');//load config 
  
    if(isset($_POST['reset_pwd']))
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
    <div class="blog-login">
        <div class="blog-login-in">
            <form method='POST'>
                <img src="images/logo.png" alt="logo" />
                <div class="row">
                    <div class="input-field col s12">
                        <input id="first_name1" type="email" name='jps_email' class="validate">
                        <label for="first_name1">Email</label>
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
                        <label for="first_name1">Token</label>
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
                        <label for="first_name1">Dummy Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="submit" name="reset_pwd" class="waves-effect waves-light btn-large btn-log-in" value="Reset">
                    </div>
                </div>
                <a href="index.php" class="for-pass">Login</a>
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