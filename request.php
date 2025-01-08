<?php
session_start();
if (isset($_SESSION['request_No']))
{
    include 'config.php';
    $reqNo=$_SESSION['request_No'];
    $sql='call mycertificate.select_certificate(?)';
    $stmt=$pdo->prepare($sql);
    try{
        $stmt->execute(array($reqNo));
    }
    catch ( PDOException $e ) {
        echo "Error:abcd " . $e->getMessage();
      }
}