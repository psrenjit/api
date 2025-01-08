<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit;
}
include 'myconfig.php';

$data = json_decode(file_get_contents('php://input'), true);
$sln=$data['Reqest_no'];
$mobNo=$data['mobNo'];
$fromDate=$data['fdate'];
$toDate=$data['tdate'];
$cdr=$data['cdr'];
$CAF=$data['CAF'];
$address=$data['address'];
$prov=$data['Provider'];
$id=$data['id'];


if($cdr== "0"||$cdr==null ){
  $sql='call update_numbers2(?,?,?,?,?)';
  $arraycode = array($id, $mobNo, $prov, $CAF, $address);
  
}
else
{
  $sql='call update_numbers(?,?,?,?,?,?,?,?)';
$arraycode = array($id, $mobNo, $prov, $fromDate, $toDate, $cdr, $CAF, $address);
 
}

    $stmt=$pdo->prepare($sql);
    try{
print_r($arraycode);
        $stmt->execute($arraycode);    
          
        //$_SESSION[ 'request_No' ]=$stmt->fetchColumn();
    }
    catch ( PDOException $e ) {
        echo "Error:abcd " . $e->getMessage();
      
      }