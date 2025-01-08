<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit;
}
include "myconfig.php";
$data = array();
$sql = "call select_request()";
$stmt = $pdo->prepare($sql);
try {
    $stmt->execute();
    $user = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  foreach ($user as $row) {
    $age = array(
      "Reqest_no" => $row['Reqest_No'],
      "reqStation" => $row['reqStation'],
      "cfcNo" => $row['CFC_No'],
      "station" => $row['station'],
      "crimeNo" => $row['Crime_No'],
      "Sections" => $row['Sections'],
      "cYear" => $row['certificate_year']
    );
    array_push($data, $age);
  }
  $response = array(
    'Status' => true,
    'numbersAvailable' => $data
  );
  http_response_code(200);
  echo json_encode($response);
} catch (PDOException $e) {
  $response = array(
    'Status' => false,
    'error' => 'there is some error in saving'
  );
  http_response_code(400);
  echo json_encode($response);
}
