<?php
include "config.php";
$requestNo = $_REQUEST['slno'];
$users = array();
$sql = "call for_mail_to_station(?)";
$stmt = $pdo->prepare($sql);
try {
    $stmt->execute(array($requestNo));
    while ($row2 = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
        $data = array(
                "crimeNo" => $row2[0],
                "mobNo" => $row2[1],
                "station" => $row2[2],
                "email"=>$row2[3]
        );       
        array_push($users, $data);        
}
header('Content-Type: application/json');
echo json_encode($users);

} catch (PDOException $e) {
    echo "Error:abcd " . $e->getMessage();
}
