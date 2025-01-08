
<?php
include '../config.php';
$fno='';
$requestNo='';
$sln=$_REQUEST['sno'];
$fruitsArray = explode(',', $sln);
foreach ($fruitsArray as $fruit) {
  $requestNo.="'".$fruit."',";
}
$fno= rtrim($requestNo, ",");
$mobNo=$_REQUEST['mNo'];
$sql='call signed_update_number(?,?)';
$stmt=$pdo->prepare($sql);
try{
  $stmt->execute(array($fno,$mobNo));
}
catch ( PDOException $e ){
  echo "Error:abcd " . $e->getMessage();
}
