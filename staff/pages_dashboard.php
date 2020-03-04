<?php
  session_start();
  include('_partials/config.php');
  include('_partials/checklogin.php');
  check_login();
  $js_id = $_SESSION['js_id'];
  //staff id to hold session
?>

<!DOCTYPE html>
<html lang="en">
<?php include('_partials/head.php');?>
<body>
    <!--== MAIN CONTRAINER ==-->
    <?php include('_partials/nav.php');?>
    <!--== BODY CONTNAINER ==-->
    <div class="container-fluid sb2">
        <div class="row">
            <?php include("_partials/sidebar.php");?>

            <!--== BODY INNER CONTAINER ==-->
            <div class="sb2-2">
                <!--== breadcrumbs ==-->
                <div class="sb2-2-2">
                    <ul>
                        <li><a href="pages_dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        </li>
                        <li class="active-bre"><a href="#"> Dashboard</a>
                        </li>
                    </ul>
                </div>
                <!--== DASHBOARD INFO ==-->
                <div class="ad-v2-hom-info">
					<div class="ad-v2-hom-info-inn">
						<ul>

                             <!--Passengers-->
							<li>
								<div class="ad-hom-box ad-hom-box-1">
									<span class="ad-hom-col-com ad-hom-col-1"><i class="fa fa-users"></i></span>
									<div class="ad-hom-view-com">
                                    <?php
                                        //code for summing up all passengers
                                        $result ="SELECT count(*) FROM jordan_passengers";
                                        $stmt = $mysqli->prepare($result);
                                        $stmt->execute();
                                        $stmt->bind_result($passengers);
                                        $stmt->fetch();
                                        $stmt->close();
                                    ?>
									<p> Passengers</p>
									<h3><?php  echo $passengers;?></h3>
									</div>
								</div>
							</li>
                            <!--End Passengers-->

                            <!--Flights-->
							<li>
								<div class="ad-hom-box ad-hom-box-3">
									<span class="ad-hom-col-com ad-hom-col-3"><i class="fa fa-plane"></i></span>
									<div class="ad-hom-view-com">
                                    <?php
                                        //code for summing up all flights
                                        $result ="SELECT count(*) FROM jordan_flights";
                                        $stmt = $mysqli->prepare($result);
                                        $stmt->execute();
                                        $stmt->bind_result($flights);
                                        $stmt->fetch();
                                        $stmt->close();
                                    ?>
									<p>Flights</p>
									<h3><?php echo $flights;?></h3>
									</div>
								</div>
							</li>
                            <!--End Flights-->

                            <!--Reservations-->
							<li>
								<div class="ad-hom-box ad-hom-box-4">
									<span class="ad-hom-col-com ad-hom-col-4"><i class="fa fa-calendar-check-o"></i></span>
									<div class="ad-hom-view-com">
                                    <?php
                                        //code for summing up all reservations
                                        $result ="SELECT count(*) FROM jordan_flights_reservation";
                                        $stmt = $mysqli->prepare($result);
                                        $stmt->execute();
                                        $stmt->bind_result($jfs);
                                        $stmt->fetch();
                                        $stmt->close();
                                    ?>
									<p>Reservations</p>
									<h3><?php echo $jfs;?></h3>
									</div>
								</div>
							</li>
                            <!--End Reservations-->

                            <!--Paid Reservations-->
							<li>
								<div class="ad-hom-box ad-hom-box-2">
									<span class="ad-hom-col-com ad-hom-col-2"><i class="fa fa-ticket"></i></span>
									<div class="ad-hom-view-com">
                                    <?php
                                        //code for summing up all staffs
                                        $result ="SELECT COUNT(*) FROM jordan_flights_reservation_payments";
                                        $stmt = $mysqli->prepare($result);
                                        $stmt->execute();
                                        $stmt->bind_result($🤑);
                                        $stmt->fetch();
                                        $stmt->close();
                                    ?>
									<p>Tickets</p>
									<h3><?php echo $🤑;?></h3>
									</div>
								</div>
							</li>
                            <!--Paid Reservations-->

						</ul>
					</div>
                </div>
                <div class="sb2-2-3">
                    <div class="row">
                        <!--== Donought Chart To Show Percentage Number Of  Reservations Per Flight Route ==-->
    
                        <div class="col-md-6">
                            <div class="inn-title">
                                    <h4>Percentage Reservations Per Flight Route</h4>
                                    <p>Numbers Of Passengers Reservations Per Flight Route</p>
                                </div>
                            <div class="box-inn-sp">
                                <!--
                                    Canvas JS Donought Chart Please reffer to 
                                    canvasjs.com to see how this magic happens
                                -->
                            <div id="FlightsReservationsPerRoute"  style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

                            </div>
                        </div>

                        <!--== Pie Chart To Show How Many Flights Does Each Flight Route Has ==-->
                        <div class="col-md-6">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Percentage Number Of Flights Per Flight Route</h4>
                                    <p>Number Of Planes Per Flight Route</p>
                                    
                                </div>
                                        <!--
                                            Canvas JS Pie Chart Please reffer to 
                                            canvasjs.com to see how this magic happens
                                        -->
                                    <div id="NumberOfFlightsPerRoute"  style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

                            </div>
                        </div>
                    </div>
                </div>

                <!--== Glance Of Recently Joined Passengers ==-->
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Recently Joined Passengers</h4>
                                </div>
                                <div class="tab-inn">
                                    <div class="table-responsive table-desi">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>ID No.</th>
                                                    <th>Phone</th>
                                                    <th>Pass No</th>
                                                    <th>Email</th>
                                                    <th>Gender</th>
                                                    <th>Date Joined</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    //Get details of all registered passengers
                                                    $ret="SELECT * FROM  jordan_passengers ORDER BY RAND() "; 
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    $cnt=1;
                                                    while($row=$res->fetch_object())
                                                    {
                                                        /* Trim date passenger joined from default timestamp to
                                                        *  User Uderstandable Formart  DD-MM-YYYY : 
                                                        */
                                                        $datePassengerJoined = $row->jp_date_joined;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $cnt;?></td>
                                                        <td><?php echo $row->jp_name;?></td>
                                                        <td><?php echo $row->jp_national_id;?></td>
                                                        <td><?php echo $row->jp_phone;?></td>
                                                        <td>
                                                            <span class="label label-primary">
                                                                <?php echo $row->jp_number;?>
                                                            </span>    
                                                        </td>
                                                        <td><?php echo $row->jp_email;?></td>
                                                        <td><?php echo $row->jp_gender;?></td>
                                                        <td>
                                                            <span class="label label-success">
                                                                <?php echo date("d-M-Y ", strtotime($datePassengerJoined));?> 
                                                            </span>
                                                        </td>
                                                        
                                                    </tr> 
                                                <?php //increment count by 1
                                                    $cnt = $cnt+1;
                                                 }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Recently Added Flights-->
                <div class="sb2-2-3">
                    <div class="row">
                        <!--== Added Flights ==-->
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Jordan Flights Agency Flights Records</h4>
                                </div>
                                <div class="tab-inn">
                                    <div class="table-responsive table-desi">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Plane Name</th>
                                                    <th>Plane Number</th>
                                                    <th>Plane No Of Passengers</th>
                                                    <th>Flight Route</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    //Get details of all flights
                                                    $ret="SELECT * FROM  jordan_flights ORDER BY RAND() "; 
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    $cnt=1;
                                                    while($row=$res->fetch_object())
                                                    {
                                                      
                                                ?>

                                                    <tr>

                                                        <td><?php echo $cnt;?></td>
                                                        <td><?php echo $row->jf_name;?></td>
                                                        <td><?php echo $row->jf_number;?></td>
                                                        <td><?php echo $row->jf_passengers;?> Passengers</td>
                                                        <td><?php echo $row->jf_flight_route;?></td>
                                                
                                                    </tr>
                                                <?php //increment count by 1
                                                    $cnt = $cnt+1;
                                                }
                                                ?>    
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
        <!--
            Jordan Flights Agency Designed and Crafted with lots of love, passion and very many coffee cups by 
            MartDevelopers
            https://martdev.info
            If by any chance you might be an opensource developer and you would love to join our opensource projects 
            just join us here
            https://github.com/MartMbithi

        -->

    <!--======== SCRIPT FILES =========-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/custom.js"></script>
    <!--Canvas Js Scripts and hard coded javascript to lot our charts-->
    <script src="js/canvasjs.min.js"></script>
    <script>
        window.onload = function () {

        var DonoughtChart = new CanvasJS.Chart("FlightsReservationsPerRoute", {
            theme: "light",
            exportFileName: "Doughnut Chart",
            exportEnabled: false,
            animationEnabled: true,
            title:{
                text: ""
            },
            legend:{
                cursor: "pointer",
                itemclick: explodePie
            },
            data: [{
                type: "doughnut",
                innerRadius: 90,
                showInLegend: true,
                toolTipContent: "<b>{name}</b>: {y} (#percent%)",
                indexLabel: "{name} - #percent%",
                dataPoints: [
                    { y:
                        <?php
                            //code for summing up all flights  booked from Mombasa to Nairobi
                            $result ="SELECT count(*) FROM jordan_flights_reservation WHERE jf_route = 'Mombasa-Nairobi'";
                            $stmt = $mysqli->prepare($result);
                            $stmt->execute();
                            $stmt->bind_result($msa_nai);
                            $stmt->fetch();
                            $stmt->close();
                            echo $msa_nai;
                        ?>,
                        name: "Mombasa-Nairobi" },

                    { y:
                        <?php
                            //code for summing up all flights  booked from Mombasa to Voi
                            $result ="SELECT count(*) FROM jordan_flights_reservation WHERE jf_route = 'Mombasa-Voi'";
                            $stmt = $mysqli->prepare($result);
                            $stmt->execute();
                            $stmt->bind_result($msa_voi);
                            $stmt->fetch();
                            $stmt->close();
                            echo $msa_voi;
                        ?>,
                         name: "Mombasa-Voi" },
                    { y:
                        <?php
                            //code for summing up all flights  booked from Mombasa Taveta
                            $result ="SELECT count(*) FROM jordan_flights_reservation WHERE jf_route = 'Mombasa-Taveta'";
                            $stmt = $mysqli->prepare($result);
                            $stmt->execute();
                            $stmt->bind_result($msa_taveta);
                            $stmt->fetch();
                            $stmt->close();
                            echo $msa_taveta;
                        ?>, 
                        name: "Mombasa-Taveta" },

                    { y:
                        <?php
                            //code for summing up all flights  booked from Voi Taveta
                            $result ="SELECT count(*) FROM jordan_flights_reservation WHERE jf_route = 'Voi-Taveta'";
                            $stmt = $mysqli->prepare($result);
                            $stmt->execute();
                            $stmt->bind_result($voi_taveta);
                            $stmt->fetch();
                            $stmt->close();
                            echo $voi_taveta;
                        ?>, name: "Voi-Taveta" }
                    
                ]
            }]
        });

            var PieChart = new CanvasJS.Chart("NumberOfFlightsPerRoute", {
            animationEnabled: true,
            title: {
                text: ""
            },
            data: [{
                type: "pie",
                startAngle: 240,
                yValueFormatString: "##0.00'%'",
                indexLabel: "{label} {y}",
                dataPoints: [
                    {y:
                        <?php
                            //code for summing up all flights from Mombasa to Nairobi
                            $result ="SELECT count(*) FROM jordan_flights WHERE jf_flight_route = 'Mombasa-Nairobi'";
                            $stmt = $mysqli->prepare($result);
                            $stmt->execute();
                            $stmt->bind_result($msa_nai);
                            $stmt->fetch();
                            $stmt->close();
                            echo $msa_nai;
                        ?>, label: "Mombasa-Nairobi"},
                    {y:
                        <?php
                            //code for summing up all flights from Mombasa Voi
                            $result ="SELECT count(*) FROM jordan_flights WHERE jf_flight_route = 'Mombasa-Voi'";
                            $stmt = $mysqli->prepare($result);
                            $stmt->execute();
                            $stmt->bind_result($msa_voi);
                            $stmt->fetch();
                            $stmt->close();
                            echo $msa_voi;
                        ?>, label: "Mombasa-Voi"},
                    {y:
                        <?php
                            //code for summing up all flights from Mombasa Voi
                            $result ="SELECT count(*) FROM jordan_flights WHERE jf_flight_route = 'Mombasa-Taveta'";
                            $stmt = $mysqli->prepare($result);
                            $stmt->execute();
                            $stmt->bind_result($msa_taveta);
                            $stmt->fetch();
                            $stmt->close();
                            echo $msa_taveta;
                        ?>, label: "Mombasa-Taveta"},

                    {y:
                        <?php
                            //code for summing up all flights from Voi-taveta
                            $result ="SELECT count(*) FROM jordan_flights WHERE jf_flight_route = 'Voi-Taveta'";
                            $stmt = $mysqli->prepare($result);
                            $stmt->execute();
                            $stmt->bind_result($voi_taveta);
                            $stmt->fetch();
                            $stmt->close();
                            echo $voi_taveta;
                        ?>, label: "Voi-Taveta"}
                ]
            }]
        });
        DonoughtChart.render();
        PieChart.render();

        function explodePie (e) {
            if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
                e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
            } else {
                e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
            }
            e.chart.render();
        }

        }
    </script>
</body>


</html>