<?php
include 'config.php';
$fno='';
$requestNo='';
$sln=$_REQUEST['sno'];
$fruitsArray = explode(',', $sln);
foreach ($fruitsArray as $fruit) {
  $requestNo.="'".$fruit."',";
}
$fno= rtrim($requestNo, ",");
$mobNo=$_REQUEST['mNo'];