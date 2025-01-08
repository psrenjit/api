<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit;
}
include './myconfig.php';

    $data = json_decode(file_get_contents('php://input'), true);
    $Reqest_no = $data['Reqest_no'];
    $mobNo = $data['mobNo'];
    $fromDate = $data['fdate'];
    $toDate = $data['tdate'];
    $cdr = $data['cdr'];
    $CAF = $data['CAF'];
    $address = $data['address'];
    $prov = $data['Provider'];
    foreach ($requiredFields as $field) {
        if (empty($data[$field])) {
            http_response_code(400);
            echo json_encode(['Status' => false, 'error' => "Field '$field' is required."]);
            exit;
        }
    }
    $sql = '';
    $sql = ($fromDate && $toDate) 
    ? 'CALL insert_numbers(?, ?, ?, ?, ?, ?, ?, ?)' 
    : 'CALL insert_number2(?, ?, ?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    try {
        if ($fromDate == '') {
            $stmt->execute(array($Reqest_no, $mobNo, $prov, $cdr, $CAF, $address));
        } else {
            $stmt->execute(array($Reqest_no, $mobNo, $prov, $fromDate, $toDate, $cdr, $CAF, $address));
        }
        $response = array('Status' => true, 'msg' => "inserted one record");
        http_response_code(200);
        echo json_encode($response);
    } catch (PDOException $e) {
        $response = array('Status' => false, 'error' => $e->getMessage());
        http_response_code(400);
        echo json_encode($response);
    }
