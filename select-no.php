<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit;
}
$data = array();
include "myconfig.php";
$requestNo = $_REQUEST['number'];
$sql = "call selectNumbersApi(?)";
$stmt = $pdo->prepare($sql);
try {
  $stmt->execute(array($requestNo));
  $user = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  foreach ($user as $row) {
    $age = array(
      "id" => $row['id'],
      "Reqest_no" => $row['Reqest_no'],
      "mobNo" => $row['mobNo'],
      "Provider" => $row['Provider'],
      "fdate" => $row['fdate'],
      "tdate" => $row['tdate'],
      "cdr" => $row['cdr'],
      "CAF" => $row['CAF'],
      "address" => $row['address']
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
  echo "Error:abcd " . $e->getMessage();
}
