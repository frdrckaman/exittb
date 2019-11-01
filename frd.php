<?php
require_once 'php/core/init.php';
$user = new User();
$override = new OverideData();
/*
$pdo = null;

function countPDF($file){$pageNo=null;
    exec('pdftk '.$file.' dump_data', $output, $return);
    $array = explode(' ', $output[0]);

    if($array && $array[1] == 'NumberOfPages:'){
        $pageNo = $array[1];
    }else{
        foreach($output as $out){
            $ar = explode(' ', $out);
            if($ar[0] == 'NumberOfPages:'){
                $pageNo = $ar[1];
                break;
            }
        }
    }
    print_r($pageNo);
    //return $pageNo ;
}
print_r(countPDF('sop/89.pdf'));

try{
    $pdo = new PDO("sqlsrv:server=localhost,1435;Database=mocca","sa","123456a*");
}catch (PDOException $e){
    $e->getMessage();
}




if (!empty($_FILES['attachment']["tmp_name"])) {
    $attach_file = $_FILES['attachment']['type'];
    if ($attach_file == "application/pdf") {
        $folderName = 'sop/';
        $attachment_file = $folderName . basename($_FILES['attachment']['name']);

        //print_r($attachment_file);
        if (@move_uploaded_file($_FILES['attachment']["tmp_name"], $attachment_file)) {
            $checkError = false;
            print_r($user->countPDF($attachment_file));
            echo'Good';
            //$attachment = $attachment_file;
        } else {
            echo'Bad';
            $checkError = true;
            $errorMessage = 'Not uploaded to a Server';
        }
    } else {
        $checkError = true;
        $errorMessage = 'Not a Supported Format';
    }

}*/
/*$im = new imagick('/var/www/system.exit-tb.org/public_html/scanned_crf/EXIT-TB_CRF01_PG0_1_111-00001.pdf');
$im->setImageFormat('jpg');
header('Content-Type: image/jpeg');
echo $im;*/
$qrys = $override->getData('data_qry');
print_r(date('dmY',strtotime('')))

?>

