<head>
    <title>Jordan Flight Booking Agency - Web based and real time flight booking system.</title>
    <!--== META TAGS ==-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--== FAV ICON ==-->
    <link rel="shortcut icon" href="images/fav.ico">

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Quicksand:300,400,500" rel="stylesheet">

    

    <!--MY NEW FONT AWESOME ICON CSS-->
    <link rel="stylesheet" href="css/font-awesome.min.css">


    <!--== ALL CSS FILES ==-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mob.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/materialize.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->


       <!--Load Sweet Alert Javascript-->
       <script src="js/swal.js"></script>
       
        <!--Inject SWAL-->
        <?php if(isset($success)) {?>
        <!--This code for injecting success alert-->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Success","<?php echo $success;?>","success");
                            },
                                100);


                            
                </script>

        <?php } ?>

        <?php if(isset($err)) {?>
        <!--This code for injecting error alert-->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Failed","<?php echo $err;?>","error");
                            },
                                100);
                </script>

        <?php } ?>
        <?php if(isset($info)) {?>
        <!--This code for injecting info alert-->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Success","<?php echo $info;?>","warning");
                            },
                                100);
                </script>

        <?php } ?>
        <script>
            function getFlightFare(val)
            
             {
                //get flightdepartureairport
                $.ajax
                ({
                type: "POST",
                url: "pages_ajax.php",
                data:'flight_route_number='+val,
                success: function(data){
                //alert(data);
                $('#FlightDepatureAirport').val(data);
            }
        });
                $.ajax
                ({
                type: "POST",
                url: "pages_ajax.php",
                data:'flight_dep_airport='+val,
                success: function(data){
                //alert(data);
                $('#FlightDestinationAirport').val(data);
            }
        });  

                $.ajax
                ({
                type: "POST",
                url: "pages_ajax.php",
                data:'flight_route='+val,
                success: function(data){
                //alert(data);
                $('#FlightRoute').val(data);
            }
        }); 
                $.ajax
                ({
                type: "POST",
                url: "pages_ajax.php",
                data:'flight_fare='+val,
                success: function(data){
                //alert(data);
                $('#FlightFareTicket').val(data);
            }
        });                      
            
            }
            function getFlightDetails(val)
            
             {
                //get flight number
                $.ajax
                ({
                type: "POST",
                url: "pages_ajax.php",
                data:'flight_number='+val,
                success: function(data){
                //alert(data);
                $('#FlightName').val(data);
            }
        });

        
                //get flight Route
                $.ajax
                ({
                type: "POST",
                url: "pages_ajax.php",
                data:'flight_route='+val,
                success: function(data){
                //alert(data);
                $('#FlightRoute').val(data);
            }
        });

        //get flight departure time
        $.ajax
                ({
                type: "POST",
                url: "pages_ajax.php",
                data:'flight_departure_time='+val,
                success: function(data){
                //alert(data);
                $('#FlightDepartureTime').val(data);
            }
        });

        //get flight arrival time
        $.ajax
                ({
                type: "POST",
                url: "pages_ajax.php",
                data:'flight_arrival_time='+val,
                success: function(data){
                //alert(data);
                $('#FlightArrivalTime').val(data);
            }
        });

        //get flight fare
        $.ajax
                ({
                type: "POST",
                url: "pages_ajax.php",
                data:'flight_fare='+val,
                success: function(data){
                //alert(data);
                $('#FlightFare').val(data);
            }
        });
    }
    </script> 

    

</head>