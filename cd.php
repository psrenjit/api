<?php
$sln="324234,23424";
$requestNo='';
$fruitsArray = explode(',', $sln);
foreach ($fruitsArray as $fruit) {
  $requestNo.="'".$fruit."',";
}
echo rtrim($requestNo, ",");;