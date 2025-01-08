<?php
header('Access-Control-Allow-Origin: *');
include '../myconfig.php';
$users = array();
$sql = "call select_all_station()";
$stmt = $pdo->prepare($sql);
try {
    $stmt->execute();
    //-----------------------------------------------------------------------------------------------//
    $user = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    foreach ($user as $row) {
        $age = array(
        'stationId' => $row['Station_Id'],
        'stationName' => $row['stationName'],
        'emailId' => $row['EmailId']
        );
        array_push($users, $age);
    };
    $response = array('Status' => true,
                'station' => $users
            );
            http_response_code(200);
            echo json_encode($response);
    //-----------------------------------------------------------------------------------------------//
} catch (PDOException $e) {
    echo "Error:abcd " . $e->getMessage();
}
