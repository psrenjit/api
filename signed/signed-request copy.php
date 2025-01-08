<?php
include '../config.php';
$emailids="";
$requestNo = $_REQUEST['number'];
$sql = "call select_cfc_numbers(?)";
$stmt = $pdo->prepare($sql);
try {
    $stmt->execute(array($requestNo));
    $html = '<table class="table-bordered table-fit">
    <tr>
    <td>SL No</td>
    <td>Request No</td>
    <td>CFC No</td>
    <td>Reqest Station</td>
    <td>Station</td>
    <td>Crime No</td>
    <td>Mobile No</td>
    <td>Signed Date</td>    
  </tr>';
    while ($row2 = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
      if($row2[6]=="") {
          $buttons='<button class="btn  bttapr"><i class="fa fa-check" style="font-size:30px;color:#5092E9"></i>';
      }
      else{
          $buttons='<button class="btn"><i class="fa fa-check" style="font-size:30px;color:#E4080A"></i>';
      }
      $emailids='<input type="hidden" id="emailIds" value="'.$row2[13].'">';
        $html.='<tr>   
        <td>'.$row2[7].'</td>
        <td>'.$row2[1].'</td> 
        <td>'.$row2[2].'</td>
        <td>'.$row2[0].'</td>
        <td>'.$row2[3].'</td>
        <td>'.$row2[4].'</td>
        <td>'.$row2[5].'</td>
        <td>'.$row2[6].'</td>    
        <td>'.$buttons.'</td>    
        </tr>';
}
$html.='</table>'.$emailids;
echo $html;
} catch (PDOException $e) {
    echo "Error:abcd " . $e->getMessage();
}
