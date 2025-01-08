<?php
include '../config.php';
$requestNo = $_REQUEST['number'];
$sql = "call select_cfc_numbers(?)";
$stmt = $pdo->prepare($sql);
try {
    $stmt->execute(array($requestNo));
    $html = '<table class="table table-striped table-hover table-bordered">
    <thead class="table-dark">
    <th>SL No</th>
    <th>Request No</th>
    <th>CFC No</th>
    <th>Reqest Station</th>
    <th>Station</th>
    <th>Crime No</th>
    <th>Mobile No</th>
    <th>Request Despatch</th>    
    <th></th>
  </thead >';
    while ($row2 = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {     
      if($row2[10]=="") {
        if($row2[9]==""){
          $buttons='not collected';
        }
        else{
          $buttons='<input class="form-check-input checkapr" name="signcheck" type="checkbox" value="'.$row2[7].'" id="flexCheckIndeterminate">';
        }
      }
      else{
          $buttons='updated';
      }
        $html.='<tbody>   
        <td>'.$row2[7].'</td>
        <td>'.$row2[1].'</td> 
        <td>'.$row2[2].'</td>
        <td>'.$row2[0].'</td>
        <td>'.$row2[3].'</td>
        <td>'.$row2[4].'</td>
        <td>'.$row2[5].'</td>
        <td>'.$row2[8].'</td>    
        <td>'.$buttons.'</td>    
        </tbody>';
}
$html.='</table>';
echo $html;
} catch (PDOException $e) {
    echo "Error:abcd " . $e->getMessage();
}
