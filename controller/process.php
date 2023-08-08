<?php
include_once('connect.php');
$dbs = new database();
$db=$dbs->connection();
session_start();
if(isset($_GET['countryid'])){


    $countryId = $_GET['countryid'];
  
    $query = "SELECT * FROM counties WHERE CountryId = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $countryId);
    $stmt->execute();
    $result = $stmt->get_result();
    //$row = $result->fetch_assoc();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($rows);
}

if(isset($_GET['countyid'])){


    $countyId = $_GET['countyid'];
  
    $query = "SELECT * FROM areas WHERE StateId = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $countyId);
    $stmt->execute();
    $result = $stmt->get_result();
    //$row = $result->fetch_assoc();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($rows);
}




?>