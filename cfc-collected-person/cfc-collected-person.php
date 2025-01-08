<?php
include '../config.php';
$requestNo = $_REQUEST['number'];
$sql = "call select_CFC_collected_person(?)";
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
    <th>CFC Recived</th>
    <th>Request collected By</th>
    <th>Date Of Collection</th> 
    <th></th>   
  </thead>';
    while ($row2 = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {    
      if($row2[9]=="") {
        
        if($row2[7]!=""){
          $buttons='<input class="form-check-input chk" name="signcheck" type="checkbox" value="'.$row2[6].'" id="flexCheckIndeterminate">';
        }
        else{
          $buttons='check previous';
        }
      }
      else {
          $buttons='UPDATED';
      }
        $html.='<tr>   
        <td>'.$row2[6].'</td>
        <td>'.$row2[1].'</td> 
        <td>'.$row2[2].'</td>
        <td>'.$row2[0].'</td>
        <td>'.$row2[3].'</td>
        <td>'.$row2[4].'</td>
        <td>'.$row2[5].'</td>
        <td>'.$row2[7].'</td> 
        <td>'.$row2[8].'</td>
        <td>'.$row2[9].'</td>   
        <td>'.$buttons.'</td>    
        </tr>';
}
$html.='</table>';
echo $html;
} catch (PDOException $e) {
    echo "Error:abcd " . $e->getMessage();
}
