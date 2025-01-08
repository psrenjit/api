
<?php
include '../config.php';
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
$data = json_decode(file_get_contents('php://input'), true);
$stId=$data['sId'];
$stEmail=$data['sEmail'];
$sql='call update_station(?,?)';
$stmt=$pdo->prepare($sql);
try{
  $stmt->execute(array($stId,$stEmail));
  $response = array('Status' => true,'msg' => "updated successfull");
  http_response_code(200);
  echo json_encode($response);
}
catch ( PDOException $e ){
  $response = array('Status' => true,'msg' => $e->getMessage());
  http_response_code(200);
  echo json_encode($response);
}
}