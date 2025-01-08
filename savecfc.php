<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
include 'myconfig.php';
 if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = json_decode(file_get_contents('php://input'), true);

    $Cfc_no=$data[ "cC" ];
    $req_office=$data[ "rO" ];
    $ps=$data[ "policeS" ];
    $cno = $data['cN'];
    $section = $data['sec'];

    if (!is_numeric($Cfc_no)) {
        $errors[] = "CFC Number must be a valid number.";
    }

    // Validate Request Office (should be an integer)
    if (!is_numeric($req_office)) {
        $errors[] = "Request Office must be a valid number.";
    }

    // Validate Police Station (should be an integer)
    if (!is_numeric($ps)) {
        $errors[] = "Police Station must be a valid number.";
    }

    // Validate Crime Number (optional validation, can be alphanumeric, or only digits based on your requirement)
    if (!preg_match("/^[A-Za-z0-9]+$/", $cno)) {
        $errors[] = "Crime Number must be alphanumeric.";
    }

    // Validate Section (optional validation, alphanumeric allowed)
    if (!preg_match("/^[A-Za-z0-9 ]+$/", $section)) {
        $errors[] = "Section must be alphanumeric.";
    }

    // If there are validation errors, return them to the client
    if (!empty($errors)) {
        $response = array('Status' => false, 'errors' => $errors);
        http_response_code(400); // Bad Request
        echo json_encode($response);
        exit;
    }
    
    $sql='select insert_request(?,?,?,?,?)';
    $stmt=$pdo->prepare($sql);
    try{
        $stmt->execute(array(intval($Cfc_no),intval($req_office),intval($ps),$cno,$section));       
        $age= $stmt->fetchColumn();      
        $response = array('Status' => true,
                'reqestno' => $age
            );
            http_response_code(200);
            echo json_encode($response);  
    }
    catch ( PDOException $e ) {
        $response = array('Status' => false,
                'eroor' => $e
            );
            http_response_code(400);
            echo json_encode($response); 
    }
} else {
    $response = array('Status' => false,
                'error' => "unknown error"
            );
            http_response_code(400);
            echo json_encode($response); 
}
