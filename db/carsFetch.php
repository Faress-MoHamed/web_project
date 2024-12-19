<?php 
require_once __DIR__ . "/connection.php";
function getAllCars (){
  $conn = dataBase_connect();

    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, "SELECT * FROM cars");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    return $result;
}

function GetCarsWithLimit ($limit){
    $conn = dataBase_connect();

    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, "SELECT * FROM cars Limit ?");
        $stmt->bind_param("i", $limit);
 $stmt->execute();
    return $stmt->get_result();
}