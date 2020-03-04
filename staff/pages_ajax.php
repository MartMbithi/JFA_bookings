<?php
include('_partials/pdoconfig.php');
if(!empty($_POST["flight_route_number"])) 
{	
    //get flight departure airport
    $id=$_POST['flight_route_number'];
    $stmt = $DB_con->prepare("SELECT * FROM jordan_flight_routes WHERE  jfr_number = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
?>
<?php echo htmlentities($row['jfr_dep_airport']); ?>
<?php
}
}

if(!empty($_POST["flight_dep_airport"])) 
{	
    //get flight destination airport
    $id=$_POST['flight_dep_airport'];
    $stmt = $DB_con->prepare("SELECT * FROM jordan_flight_routes WHERE  jfr_number = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
?>
<?php echo htmlentities($row['jfr_arr_airport']); ?>
<?php
}
}

if(!empty($_POST["flight_route"])) 
{	
    //get flight route
    $id=$_POST['flight_route'];
    $stmt = $DB_con->prepare("SELECT * FROM jordan_flight_routes WHERE  jfr_number = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
?>
<?php echo htmlentities($row['jfr_dep_airport']); ?>-<?php echo htmlentities($row['jfr_arr_airport']); ?> 
<?php
}
}

if(!empty($_POST["flight_fare"])) 
{	
    //get flight route fare
    $id=$_POST['flight_fare'];
    $stmt = $DB_con->prepare("SELECT * FROM jordan_flight_routes WHERE  jfr_number = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
?>
Ksh <?php echo htmlentities($row['jfr_ticket_fare']); ?>
<?php
}
}

if(!empty($_POST["flight_number"])) 
{	
    //get flight name
    $id=$_POST['flight_number'];
    $stmt = $DB_con->prepare("SELECT * FROM jordan_flights WHERE  jf_number = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
?>
<?php echo htmlentities($row['jf_name']); ?>
<?php
}
}

if(!empty($_POST["flight_route"])) 
{	
    //get flight route
    $id=$_POST['flight_route'];
    $stmt = $DB_con->prepare("SELECT * FROM jordan_flights WHERE  jf_number = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
?>
<?php echo htmlentities($row['jf_flight_route']); ?>
<?php
}
}

if(!empty($_POST["flight_departure_time"])) 
{	
    //get flight departuretime
    $id=$_POST['flight_departure_time'];
    $stmt = $DB_con->prepare("SELECT * FROM jordan_flights WHERE  jf_number = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
?>
<?php echo htmlentities($row['jf_deptime']); ?>
<?php
}
}


if(!empty($_POST["flight_arrival_time"])) 
{	
    //flight_arrival_time
    $id=$_POST['flight_arrival_time'];
    $stmt = $DB_con->prepare("SELECT * FROM jordan_flights WHERE  jf_number = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
?>
<?php echo htmlentities($row['jf_arrtime']); ?>
<?php
}
}

if(!empty($_POST["flight_fare"])) 
{	
    //flight_arrival_time
    $id=$_POST['flight_fare'];
    $stmt = $DB_con->prepare("SELECT * FROM jordan_flights WHERE  jf_number = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
?>
<?php echo htmlentities($row['jf_flight_ticket_fare']); ?>
<?php
}
}


?>


