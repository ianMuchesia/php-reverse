<?php
include_once('connect.php');
$dbs = new database();
$db=$dbs->connection();
session_start();
if(isset($_GET['countryid'])){


    $countryId = $_GET['countryid'];
    print_r([$countryId]);
    $query = "SELECT * FROM counties WHERE CountryId = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $countryId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    echo json_encode($row);
}



?>