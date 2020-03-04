<?php
    $js_id = $_SESSION['js_id'];
    $ret="SELECT  * FROM  jordan_staff  WHERE js_id=?";
    $stmt= $mysqli->prepare($ret) ;
    $stmt->bind_param('i', $js_id);
    $stmt->execute() ;//ok
    $res=$stmt->get_result();
    //$cnt=1;
    while($row=$res->fetch_object())
    {
        //get default image if admin profile picture is missing
        if($row->js_pic == '')
        {
                $profile_picture = "<img src='images/fav.ico' alt='' />";
        }
        else
        {
                $profile_picture = "<img src='images/user/$row->js_pic' alt='' />";
        }
?>
  <div class="container-fluid sb1">
        <div class="row">
            <!--== LOGO ==-->
            <div class="col-md-2 col-sm-3 col-xs-6 sb1-1">
                <a href="#" class="btn-close-menu"><i class="fa fa-times" aria-hidden="true"></i></a>
                <a href="#" class="atab-menu"><i class="fa fa-bars tab-menu" aria-hidden="true"></i></a>
                <a href="pages_dashboard.php" class="logo"><img src="images/logo1.png" alt="" />
                </a>
            </div>
            <!--== SEARCH ==-->
            <div class="col-md-6 col-sm-6 mob-hide">
               
            </div>
            <!--== NOTIFICATION ==-->
            <div class="col-md-2 tab-hide">
                <div class="top-not-cen">
                </div>
            </div>
            <!--== MY ACCCOUNT ==-->
            <div class="col-md-2 col-sm-3 col-xs-6">
                <!-- Dropdown Trigger -->
                <a class='waves-effect dropdown-button top-user-pro' href='#' data-activates='top-menu'>
                    <?php echo $profile_picture;?>
                    My Account <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>

                <!-- Dropdown Structure -->
                <ul id='top-menu' class='dropdown-content top-menu-sty'>
                    <li><a href="pages_change_pwd.php" class="waves-effect"><i class="fa fa-lock" aria-hidden="true"></i> Change Password</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="pages_logout.php" class="ho-dr-con-last waves-effect"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php }?>