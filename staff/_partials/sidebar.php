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
        //get default image if user hasnt uploaded any picture
        if($row->js_pic == '')
        {
                $profile_picture = "<img src='images/fav.ico' alt='' />";
        }
        else
        {
                $profile_picture = "<img src='images/user/$row->js_pic' alt='' />";
        }
    ?>        
            <div class="sb2-1">
                <!--== USER INFO ==-->
                <div class="sb2-12">
                    <ul>
                        <li><?php echo $profile_picture;?>
                        </li>
                        <li>
                            <h5><?php echo $row->js_name;?>
                                <span><?php echo $row->js_number;?></span>
                            </h5>
                        </li>
                    </ul>
                </div>
                <!--== LEFT MENU ==-->
                <div class="sb2-13">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li><a href="pages_dashboard.php"><i class="fa fa-bar-chart" aria-hidden="true"></i> Dashboard</a>
                        </li>

                        <!--Passengers-->
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-users" aria-hidden="true"></i> Passengers</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="pages_add_passengers.php">Add</a>
                                    </li>
                                    <li><a href="pages_manage_passengers.php">Manage</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!--End passengers-->

                        <!--Flight Routes-->
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-plane" aria-hidden="true"></i> Flight Routes</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="pages_add_flight_route.php">Add</a>
                                    </li>
                                    <li><a href="pages_manage_flight_route.php">Manage</a>
                                    </li>  
                                </ul>
                            </div>
                        </li>
                        <!--End Flight Routes-->

                        <!--Flights-->
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-plane" aria-hidden="true"></i> Flights</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="pages_add_flights.php">Add</a>
                                    </li>
                                    <li><a href="pages_manage_flights.php">Manage</a>
                                    </li>  
                                </ul>
                            </div>
                        </li>
                        <!--End Flights-->

                        <!--Reservations-->
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Reservations</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="pages_add_reservation.php">Add</a>
                                    </li>
                                    <li><a href="pages_manage_reservations.php">Manage</a>
                                    </li>
                                                                        
                                </ul>
                            </div>
                        </li>
                        <!--End Reservations-->

                        <!--Finances-->
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-money" aria-hidden="true"></i> Finances</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="pages_ticket_payments.php">Ticket Payments</a>
                                    </li> 
                                </ul>
                            </div>
                        </li>
                        <!--End Finances-->

                        <!--Reporting-->
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-pie-chart" aria-hidden="true"></i> Advance Reporting</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    
                                    <li><a href="pages_passenger_records.php">Passenger Records</a>
                                    </li>
                                    <li><a href="pages_flight_records.php">Flight Records</a>
                                    </li>
                                    <li><a href="pages_reservation_records.php">Reservation Records</a>
                                    </li>
                                    <li><a href="pages_finance_records.php">Finance Records</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!--End Reporting-->

                        <!--Feedbacks -->
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-comments" aria-hidden="true"></i> Feedbacks</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>

                                    <li><a href="pages_manage_feedbacks.php">Manage</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </li>
                        <!-- End Feedback -->

                        <!--Password Resets-->
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-lock" aria-hidden="true"></i> Password Resets</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>

                                    <li><a href="pages_manage_password_resets.php">Password Resets</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </li>
                        <!--End Passwors resets-->

                        <!--Log out-->
                        <li><a href="pages_logout.php" ><i class="fa fa-power-off" aria-hidden="true"></i> Log Out</a>
                        </li>
                        <!--Log out-->
                    </ul>
                </div>
            </div>
<?php }?>            