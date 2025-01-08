<?php
include "config.php";
$sql = "call select_station()";
$stmt = $pdo->prepare($sql);
try {
    $stmt->execute();
    $html='<option selected>Open this select </option>';
    while ($row2 = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
        $html.='<option value="'.$row2[0].'">'.$row2[1].'</option>';
}
echo $html;
} catch (PDOException $e) {
    echo "Error:abcd " . $e->getMessage();
}
