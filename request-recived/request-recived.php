<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
$users = array();
include '../config.php';
$requestNo = $_REQUEST['number'];
$sql = "call api_select_cfc_numbers(?)";
$stmt = $pdo->prepare($sql);
try {
    $stmt->execute(array($requestNo));
    $user = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    foreach ($user as $row) {
      $age = array(        
        'Reqest_No'=>$row['Reqest_No'],
        'id'=>$row['id'],
        'CFC_No'=>$row['CFC_No'],
        'reqstation'=>$row['reqstation'],
        'Station'=>$row['station'],
        'Crime_No'=>$row['Crime_No'],
        'Sections'=>$row['Sections'],
        'mobNo'=>$row['mobNo'],
        'Provider'=>$row['Provider'],
        'fromDate'=>$row['fromDate'],
        'toDate'=>$row['toDate'],
        'cdr'=>$row['cdr'],
        'CAF'=>$row['CAF'],
        'address'=>$row['address'],
        'signeddate'=>$row['signeddate'],
        'requestcollectedperson'=>$row['requestcollectedperson'],
        'reqcoldate'=>$row['reqcoldate'],
        'cfcreciveddate'=>$row['cfcreciveddate'],
        'cfccollectedperson'=>$row['cfccollectedperson'],
        'cfccoldate'=>$row['cfccoldate'],
        'dateentry'=>$row['dateentry']
      );
      array_push($users, $age);
    }
    $response = array(
      'Status' => true,
      'user' => $users
    );
    http_response_code(200);
    echo json_encode($response);
} catch (PDOException $e) {
    echo "Error:abcd " . $e->getMessage();
}
}
