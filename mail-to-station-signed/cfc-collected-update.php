
<?php
include '../config.php';
$requestNo='';
$sln=$_REQUEST['sno'];
$sql='call cfc_collected_update(?)';
$stmt=$pdo->prepare($sql);
try{
  $stmt->execute(array($sln));
}
catch ( PDOException $e ){
  echo "Error:abcd " . $e->getMessage();

}
