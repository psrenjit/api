<?php
include 'config.php';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
$pN=$_REQUEST['number'];
$fD=$_REQUEST['fromD'];
$tD=$_REQUEST['toD'];
$cD=$_REQUEST['cR'];
$cF=$_REQUEST['cA'];
$aD=$_REQUEST['aR'];
$sql='select new_function2(?,?,?,?,?,?)';
    $stmt=$pdo->prepare($sql);
    try{
        $stmt->execute(array($rN,$pN,$fD,$tD,$cd,$cF,$aD));
       
        $_SESSION[ 'request_No' ]=$stmt->fetchColumn();
        header("Location: a.php");
    }
    catch ( PDOException $e ) {
        echo "Error:abcd " . $e->getMessage();
      }
}
//echo "renjith";