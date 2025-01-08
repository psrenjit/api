
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit;
}
	include '../myconfig.php';
	$data = json_decode(file_get_contents('php://input'), true);
	$sln = $data['sno'];
	$pNames = $data['pName'];
	$sql = 'call request_collected_person1(?,?)';
	$stmt = $pdo->prepare($sql);
	try {
		$stmt->execute(array($sln, $pNames));
		$response = array('Status' => true, 'user' => "updated successfull");
		http_response_code(200);
		echo json_encode($response);
	} catch (PDOException $e) {
		$response = array('Status' => true, 'user' => $e->getMessage());
		http_response_code(400);
		echo json_encode($response);
	}

