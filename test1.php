<?php
include "config.php";
$requestNo =6;//$_GET['number'];
$provider='VI';//$_GET['provider'];
$row_id = "";
$fg="1";
$sql = "call test_select_numbers(?,?)";
$stmt = $pdo->prepare($sql);
try {
    $stmt->execute(array($requestNo,$provider));
    $check = $stmt->fetchAll(PDO::FETCH_ASSOC);    
    
    $row_id = $check[0]['Provider'];
    
    $fg= airtel($check,$provider);
    echo $fg;
   
        
}
catch (PDOException $e) {
    echo "Error:abcd " . $e->getMessage();
}



function airtel($check,$provider){
    $htmbsnl="";
    $tbsnl=0;
    $tjio=0;
    $tvi=0;
    $tairtel=0;
    $htmlbsnl="";
    $htmlairtel="";
    $htmlvi="";
    $htmljio="";
   $aday=date("d.m.Y"); 
   $cfcNumber = $check[0]['CFC_No'];
   $stationNmae=$check[0]['requestStation'];
   $crimestation=$check[0]['caseStation'];
   $cromeNo=$check[0]['Crime_No'];
   $sec=$check[0]['Sections'];   
    //echo $checks['name'] . '<br>';

$cafadrcdr='airtel1';
$subcafadrcdr='airtel2';

foreach ($check as $checks) {
        $cAF=false;
        $cDR=false;
        $aDR=false;
    if($checks['Provider']=='BSNL'){
        $cAF=$checks['CAF'];
        $cDR=$checks['cdr'];
        $aDR=$checks['address'];
        if(($cDR)&&($cAF)&&($aDR)){
            $cafadrcdr='Decoded Call details, Customer Application Form & Address proof ';
            $subcafadrcdr='CAF, ADDRESS & Call details ';
        }elseif(($cDR)&&($cAF)&&(!$aDR)){
            $cafadrcdr='Decoded Call details, Customer Application Form ';
            $subcafadrcdr='CAF & Call details ';
        }elseif((!$cDR)&&($cAF)&&($aDR)){
            $cafadrcdr='Customer Application Form & Address';
            $subcafadrcdr='CAF & ADDRESS';
        }elseif(($cDR)&&(!$cAF)&&(!$aDR)){
            $cafadrcdr='Decoded Call details';
            $subcafadrcdr='Call details';
        }elseif((!$cDR)&&($cAF)&&(!$aDR)){
            $cafadrcdr='Customer Application Form';
            $subcafadrcdr='CAF';
        }
        else{
            $cafadrcdr='567';
            $subcafadrcdr='890';
        }
        $tbsnl=1;
        $htmlbsnl.='<li><strong> '.$cafadrcdr.' </strong>of <strong>BSNL</strong> Mobile Phone Number <strong>'.$checks['mobNo'].'</strong>&nbsp;from <strong>'.$checks['fdate'].'</strong> to <strong>'.$checks['tdate'].'.</strong></li>';
    }
    elseif($checks['Provider']=='Airtel'){
        $cAF=$checks['CAF'];
        $cDR=$checks['cdr'];
        $aDR=$checks['address'];
        if(($cDR)&&($cAF)&&($aDR)){
            $cafadrcdr='Decoded Call details, Customer Application Form & Address proof ';
            $subcafadrcdr='CAF, ADDRESS & Call details ';
        }elseif(($cDR)&&($cAF)&&(!$aDR)){
            $cafadrcdr='Decoded Call details, Customer Application Form ';
            $subcafadrcdr='CAF & Call details ';
        }elseif((!$cDR)&&($cAF)&&($aDR)){
            $cafadrcdr='Customer Application Form & Address';
            $subcafadrcdr='CAF & ADDRESS';
        }elseif(($cDR)&&(!$cAF)&&(!$aDR)){
            $cafadrcdr='Decoded Call details';
            $subcafadrcdr='Call details';
        }elseif((!$cDR)&&($cAF)&&(!$aDR)){
            $cafadrcdr='Customer Application Form';
            $subcafadrcdr='CAF';
        }
        else{
            $cafadrcdr='567';
            $subcafadrcdr='890';
        }
        $tairtel=1;
        $htmlairtel.='<li><strong> '.$cafadrcdr.' </strong>of <strong>Airtel</strong> Mobile Phone Number <strong>'.$checks['mobNo'].'</strong>&nbsp;from <strong>'.$checks['fdate'].'</strong> to <strong>'.$checks['tdate'].'.</strong></li>';
    }
    elseif($checks['Provider']=='VI'){
        $cAF=$checks['CAF'];
        $cDR=$checks['cdr'];
        $aDR=$checks['address'];
        if(($cDR)&&($cAF)&&($aDR)){
            $cafadrcdr='Decoded Call details, Customer Application Form & Address proof ';
            $subcafadrcdr='CAF, ADDRESS & Call details ';
        }elseif(($cDR)&&($cAF)&&(!$aDR)){
            $cafadrcdr='Decoded Call details, Customer Application Form ';
            $subcafadrcdr='CAF & Call details ';
        }elseif((!$cDR)&&($cAF)&&($aDR)){
            $cafadrcdr='Customer Application Form & Address';
            $subcafadrcdr='CAF & ADDRESS';
        }elseif(($cDR)&&(!$cAF)&&(!$aDR)){
            $cafadrcdr='Decoded Call details';
            $subcafadrcdr='Call details';
        }elseif((!$cDR)&&($cAF)&&(!$aDR)){
            $cafadrcdr='Customer Application Form';
            $subcafadrcdr='CAF';
        }
        else{
            $cafadrcdr='567';
            $subcafadrcdr='890';
        }

        echo $cafadrcdr;
        //$tvi=1;
        //$htmlvi.='<li><strong>'.$cafadrcdr.'  </strong>of <strong>VI</strong> Mobile Phone Number <strong>'.$checks['mobNo'].'</strong>&nbsp;from <strong>'.$checks['fdate'].'</strong> to <strong>'.$checks['tdate'].'.</strong></li>';
    }
    elseif($checks['Provider']=='Jio'){
        $cAF=$checks['CAF'];
        $cDR=$checks['cdr'];
        $aDR=$checks['address'];
        if(($cDR)&&($cAF)&&($aDR)){
            $cafadrcdr='Decoded Call details, Customer Application Form & Address proof ';
            $subcafadrcdr='CAF, ADDRESS & Call details ';
        }elseif(($cDR)&&($cAF)&&(!$aDR)){
            $cafadrcdr='Decoded Call details, Customer Application Form ';
            $subcafadrcdr='CAF & Call details ';
        }elseif((!$cDR)&&($cAF)&&($aDR)){
            $cafadrcdr='Customer Application Form & Address';
            $subcafadrcdr='CAF & ADDRESS';
        }elseif(($cDR)&&(!$cAF)&&(!$aDR)){
            $cafadrcdr='Decoded Call details';
            $subcafadrcdr='Call details';
        }elseif((!$cDR)&&($cAF)&&(!$aDR)){
            $cafadrcdr='Customer Application Form';
            $subcafadrcdr='CAF';
        }
        else{
            $cafadrcdr='567';
            $subcafadrcdr='890';
        }
        $tjio=1;
        $htmljio.='<li><strong> '.$cafadrcdr.'</strong>of <strong>RELIANCE JIO</strong> Mobile Phone Number <strong>'.$checks['mobNo'].'</strong>&nbsp;from <strong>'.$checks['fdate'].'</strong> to <strong>'.$checks['tdate'].'.</strong></li>';
    }
}



//echo $htmbsnl;
//echo $htmvi;
//echo $htmjio;
//echo $htm;
}



?>