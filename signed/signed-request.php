<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit;
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $users = array();
  include '../myconfig.php';
  $requestNo = $_GET['number'];
  $sql = "call select_cfc_numbers1(?)";
  $stmt = $pdo->prepare($sql);
  try {
    $stmt->execute(array($requestNo));
    $user = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    foreach ($user as $row) {
      $age = array(
        "stationName" => $row['stationName'],
        "Reqest_No" => $row['Reqest_No'],
        "CFC_No" => $row['CFC_No'],
        "Station" => $row['station'],
        "Crime_No" => $row['Crime_No'],
        "requestnosmobNo" => $row['mobNo'],
        "requestnossigneddate" => $row['myDate'],
        "requestnosid" => $row['id'],
        "requestnosrequestcollectedperson" => $row['requestcollectedperson'],
        "requestnosreqcoldate" => $row['myDate1'],
        "requestnoscfcreciveddate" => $row['myDate2'],
        "requestnoscfccollectedperson" => $row['cfccollectedperson'],
        "requestnoscfccoldate" => $row['myDate3'],
        "EmailID" => $row['EmailID']
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
    $response = array(
      'Status' => true,
      'user' => $e->getMessage()
    );
    http_response_code(400);
    echo json_encode($response);
  }
} else {
  $response = array(
    'Status' => true,
    'user' => "invalid request type"
  );
  http_response_code(400);
  echo json_encode($response);
}
