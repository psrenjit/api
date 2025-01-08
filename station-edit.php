<?php
include "config.php";
$stations = [];
$sql = "call select_all_station()";
$stmt = $pdo->prepare($sql);
try {
    $stmt->execute();
    //-----------------------------------------------------------------------------------------------//
    $user = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    foreach ($user as $row) {
        $eachStation = [
            "stationId" => $row["Station_Id"],
            "stationName" => $row["stationName"],
            "emailId" => $row["EmailId"],
        ];
        array_push($stations, $eachStation);
    }
    $response = ["Status" => true, "user" => $stations];
    http_response_code(200);
    echo json_encode($response);
    //-----------------------------------------------------------------------------------------------//
} catch (PDOException $e) {
    $response = ["Status" => false];
    http_response_code(500);
    echo json_encode($response);
}
