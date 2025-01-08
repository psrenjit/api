
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit;
}
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
	$data = json_decode(file_get_contents('php://input'), true);
	include '../myconfig.php';
	$sln = $data['sno'];
	$sql = 'call signed_update_number1(?)';
	$stmt = $pdo->prepare($sql);
	try {
		$stmt->execute(array($sln));
		$res=getdetailsafterUpdate($sln);
		$response = array('Status' => true,'user' => $res);
		http_response_code(200);
		echo json_encode($response);
	} catch (PDOException $e) {
		$response = array('Status' => true,'user' => $e->getMessage());
		http_response_code(400);
		echo json_encode($response);
	}
} else {
	$response = array('Status' => true,'user' => "invalid request type");
	http_response_code(400);
	echo json_encode($response);
}



function getdetailsafterUpdate($sln)
{
	$htmldetails='';
	$htmlEmailID='';
	$htmlcfc='';
	$htmlstation='';
	$htmlcrimeno='';
	include'../mail-to-station/mail-to-station.php';
	include '../myconfig.php';
	$sql = "call signedUpdateNumber($sln)";
	$stmt = $pdo->prepare($sql);
	try {
		$stmt->execute();
		$user = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		foreach ($user as $row) {
			$htmlcfc=$row['CFC_No'];			
			$htmlstation=$row['Station'];
			$htmldetails.=$row['mobNo'].' '.$row['Provider'].'\n';
			$htmlcrimeno=$row['Crime_No'];;
			$htmlEmailID=$row['EmailId'];			
		}
		$responce=sendEmail($htmlEmailID,'Signed Request',$htmldetails,$htmlcrimeno,$htmlstation,$htmlcfc);
		return $responce;
	} catch (PDOException $e) {
		echo "Error:abcd " . $e->getMessage();
	}
}
