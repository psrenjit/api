<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'config.php';
    $reqno = $_REQUEST['reqNo'];
    $cfcno = $_REQUEST['cfcNo'];
    $reqoffice = $_REQUEST['reqOffice'];
    $ps = $_REQUEST['pS'];
    $cno = $_REQUEST['cNo'];
    $sections = $_REQUEST['sectionS'];
    $sql = 'call update_request(?,?,?,?,?,?)';
    $stmt = $pdo->prepare($sql);
    try
    {
        $stmt->execute(array(
            $reqno,
            $cfcno,
            $reqoffice,
            $ps,
            $cno,
            $sections
        ));
    }
    catch(PDOException $e)
    {
        echo "Error:abcd " . $e->getMessage();
    }
}