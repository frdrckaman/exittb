<?php
require_once 'php/core/init.php';
$user = new User();
$override = new OverideData();
/*$pdo = null;
try{
    $pdo = new PDO("sqlsrv:server=localhost,1435;Database=mocca","sa","123456a*");
}catch (PDOException $e){
    $e->getMessage();
}

//$query = $pdo->query("SELECT screening_id,ID FROM [SCREENING FORM]");
$query = $pdo->query("SELECT study_id,ID FROM [FORM 01]");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
//print_r($result);
//if($pdo){echo 'frdrck';}else{echo'aman';}
foreach($result as $study_id){$scn=$study_id['ID'];
    print_r($study_id['study_id']);
   // $query = $pdo->query("UPDATE [FORM 01] SET visit_code = 0 WHERE ID ='$scn'");
   // $query->execute();
    /* if($screening['screening_id']){
         $s_id=str_split($screening['screening_id']);
         $int=$s_id[0].$s_id[1];
         if($int == 'ar' ){
             $s_id[0]='A';$s_id[1]='R';
             $screening_id=implode('',$s_id);
             //print_r($screening_id);echo ' , ';
             $query = $pdo->query("UPDATE [SCREENING FORM] SET screening_id = '$screening_id' WHERE ID ='$scn'");
             if($query->execute()){
                 echo'Good , ';
             }
         }
     }*/
    /*if(strlen($screening['screening_id']) == 7){
        $s_id=str_split($screening['screening_id']);
        $int=$s_id[0].$s_id[1];
        if($int == 'AR' || $int == 'HM' || $int == 'BD' || $int == 'TM' || $int == 'WH' || $int == 'NH' || $int == 'KH' || $int == 'KB' || $int == 'MD'){
            if($s_id[3] == 7 || $s_id[3] == 6 || $s_id[3] == 0){$s_id[3]=0;}
            unset($s_id[2]);
            $screening_id=implode('',$s_id);
            print_r($screening_id);
            echo'  ,  ';
            //$query = $pdo->query("UPDATE [SCREENING FORM] SET screening_id = '$screening_id' WHERE ID ='$scn'");
            $query = $pdo->query("UPDATE [FORM 02] SET screening_id = '$screening_id' WHERE ID ='$scn'");
            $query->execute();
        }
    }*/
/*elseif(strlen($screening['screening_id']) == 5){
    $s_id=str_split($screening['screening_id']);
    $int=$s_id[0].$s_id[1];
    if($int == 'AR' || $int == 'HM' || $int == 'BD' || $int == 'TM' || $int == 'WH' || $int == 'NH' || $int == 'KH' || $int == 'KB' || $int == 'MD'){
        $int=$s_id[0].$s_id[1].'0'.$s_id[2].$s_id[3].$s_id[4];
        $screening_id=$int;
        print_r($screening_id);
        echo'  ,  ';
        //$query = $pdo->query("UPDATE [SCREENING FORM] SET screening_id = '$screening_id' WHERE ID ='$scn'");
        $query = $pdo->query("UPDATE [FORM 02] SET screening_id = '$screening_id' WHERE ID ='$scn'");
        $query->execute();
    }
}*/


        if (!empty($_FILES['attachment']["tmp_name"])) {echo 'aman';
            $attach_file = $_FILES['attachment']['type'];
            if ($attach_file == "application/pdf") {
                $folderName = 'stylesheets/';
                $attachment_file = $folderName . basename($_FILES['attachment']['name']);
                print_r($user->countPDF('$attachment_file'));
                /*if (@move_uploaded_file($_FILES['attachment']["tmp_name"], $attachment_file)) {
                    $checkError = false;
                    echo'Good';
                    //$attachment = $attachment_file;
                } else {
                    echo'Bad';
                    $checkError = true;
                    $errorMessage = 'Not uploaded to a Server';
                }*/
            } else {
                $checkError = true;
                $errorMessage = 'Not a Supported Format';
            }

}
?>
<html>
<body>
<form enctype="multipart/form-data" method="post">
    <input type="file" name="attachment" required=""/>
    <input type="submit">
</form>
</body>
</html>
