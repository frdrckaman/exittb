<?php
require_once 'php/core/init.php';
$user = new User();
$email = new Email();
$override = new OverideData();
$all = '';
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

//$qrys = $override->getData('data_qry');
//print_r(date('dmY',strtotime('')))

//print_r($body);
//if($email->emailSend('frdrckaman@gmail.com','Re-upload of CRF after Queries have been Resolve',$body)){echo 'Good';}
//
//foreach ($override->getData('crf01_pg03') as $data){
//    try {
//        $user->createRecord('qry', array(
//            'study_id' => $data['study_id'],
//            'fid' => $data['fid'],
//            'staff_id' => 0,
//            'rec_date' => ' ',
//            'pg' => 3,
//            'status' => 0));
//        echo 'Good';
//    } catch (Exception $e) {
//        die($e->getMessage());
//    }
//}

/*$results = $override->get('processforms','status',2);
$x=0;
foreach ($results as $result){
    $data = explode('_',$result['filepath']);
    $fileP= $result['filepath'];$pfid=$result['pfid'];
    $fileP1 = explode('/',$fileP);//print_r($fileP1[7]);
    $getData = $override->getNews('crf_record','crf_id',7,'c_id',3);
    foreach ($getData as $data){
        $c_data = explode('/',$data['attachment']);
        print_r($fileP1[7]);echo ' | ';$c_data[1];echo ' , ';
        if($c_data[1] == $fileP1[7] ){
            $c_data[1];echo ' , ';
            $x++;
        }
    }
}
$getData = $override->get('crf_record','crf_id',7);



$crf_r = $override->getData('crf_record');
print_r($x);*/

//print_r($override->countNoRepeat('crf_record','tb_crf_id','c_id',1));

//$rowData = $override->getSelectNoRepeat('crf_record','tb_crf_id','c_id',1,'crf_id',7);
////print_r($rowData);
//$x=0;$y=0;
//foreach ($rowData as $rdata){
//    $dt = $override->getCount('crf_record','tb_crf_id',$rdata['tb_crf_id']);
//    if($dt == 3){
//        $x++;
//    }else{
//        $y++;
//        print_r($rdata['tb_crf_id']);echo ':'.$dt;echo ' , ';
//    }
//
//}
////print_r($x);
//echo'X : ';print_r($x);echo ' Y : ';print_r($y);
//$x=0;
//foreach ($override->getData('del_eth') as $dt){
//    $study_id = str_replace('-','',$dt['study_id']);
//    //$getD=$override->get('crf01_pg01','study_id',$study_id);
//    $getD=$override->get('crf_record','tb_crf_id',$dt['study_id']);
//    if($getD){$x++;
//        try {
//            $user->updateRecord('crf_record', array('status' => 0), $getD[0]['id']);
//            echo'Ok ';
//        } catch (Exception $e) {
//        }
//    }
//}
//
//print_r($x);
//  ****************************** updating query from table_name **********************************
//$x=1;
//$table='crf01_ug_pg01';
//foreach ($override->getData('table_name') as $data){
//    //print_r($override->getColumn('crf01_pg01')[1]);
//    foreach ($override->getColumn($table) as $column){
//        // print_r($column['Field']);echo ' , ';
//        if($data['col'] == $column['Field']){
//            $dt = $override->get($table,'study_id',$data['study_id']);
//            if($dt){print_r($data['study_id'].' | ');
//                print_r($data['col']);echo ' '.$data['value'].' , ';
//                if($data['value']){$d_value = $data['value'];}else{$d_value='';}
//                try {
//                    $user->updateRecord($table, array($data['col'] => $d_value), $dt[0]['id']);
//                    echo 'ok ,';
//                    $x++;
//                } catch (Exception $e) {
//                    die($e->getMessage());
//                }
//            }
//        }
//    }
//}
//print_r($x);
//********************** fix date format **********************************
//$dVar = array('vdate','tbsx01days','tbsx02days','tbsx03days','tbsx04days','tbsx05days','tbsx06days','formdate');
//$c_date = 'vdate';
//foreach ($override->getData('crf01_ug_pg01') as $data){
//    $dd = preg_replace('/[^A-Za-z0-9\-]/', '', $data[$c_date]);
//    $d=str_split($dd);
//    if(count($d) == 8){//print_r($d);echo ' , ';
//        $date = $d[0].$d[1].'/'.$d[2].$d[3].'/'.$d[4].$d[5].$d[6].$d[7];
//        try {
//            $user->updateRecord('crf01_ug_pg01', array($c_date=>$date), $data['id']);
//            print_r($date);echo ' | ';print_r($data['study_id']);echo ' , ';
//        } catch (Exception $e) {
//            die($e->getMessage());
//        }
//        //print_r($date);echo ' , ';
//    }
//}

//$table='old_crf_ug';
//foreach ($override->getData('old_ug_qry') as $data){
//    //print_r($override->getColumn('crf01_pg01')[1]);
//    foreach ($override->getColumn($table) as $column){
//        //print_r($column['Field']);echo ' , ';
//        if($data['col'] == $column['Field']){
//            $dt = $override->get($table,'study_id',$data['study_id']);
//            if($dt){//print_r($data['study_id'].' | ');
//                //print_r($data['col']);echo ' '.$data['value'].' , ';
//                try {
//                    $user->updateRecord($table, array($data['col'] => $data['value']), $dt[0]['id']);
//                    echo 'ok ,';
//                    $x++;
//                } catch (Exception $e) {
//                    die($e->getMessage());
//                }
//            }
//        }
//    }
//}

// ********************** Removing - from study_id *********************************************
//foreach ($override->getData('crf_record') as $data){
//    $sid=preg_replace('/[^A-Za-z0-9\-]/', '', $data['study_id']);
//    $dt = str_split($sid);
//    if(in_array('-',$dt)){
//        $d = explode('-',$sid);
//        $id=$d[0].$d[1];
//        $id=implode('',$dt);
//    }else{$id=$data['tb_crf_id'];}
//        try {
//            print_r($id);echo ' , ';
//            //$user->updateRecord('crf_record', array('study_id' => $id), $data['id']);
//        } catch (Exception $e) {
//            die($e->getMessage());
//        }
//}
//$x = 0;
//foreach ($override->getData('crf_record') as $data){
//    $getId = $override->get('crf_record','tb_crf_id',$data['tb_crf_id']);
//    if (count($getId) <= 1){
//        print_r($data['study_id']);echo ' , ';
//        $x++;
//    }
//}
//******************************** removing space ********************************
//foreach ($override->getData('table_name') as $data){
//    $col = preg_replace('/[^A-Za-z0-9\-]/', '', $data['col']);
//    try {
//        $user->updateRecord('table_name', array('col' => $col), $data['id']);
//        echo 'Good';
//    } catch (Exception $e) {
//    }
//}
//$n=0;$cr1=0;$cr2=0;$cr3=0;
//foreach ($override->getNoRepeat('crf_record','study_id','crf_id', 7) as $crf1){
//    if($crf1['study_id']){
//        //print_r($crf1['study_id']);echo ' , ';$n++;
//        $crf01 = $override->getNoRepeat('crf01_pg01','study_id','study_id',$crf1['study_id']);
//        if($crf01){
//            //print_r($crf01[0]['study_id']);echo ' , ';$n++;
//            $cr1=1;
//        }
//        $crf02 = $override->getNoRepeat('crf01_pg02','study_id','study_id',$crf1['study_id']);
//        if($crf02){
//            //print_r($crf02[0]['study_id']);echo ' , ';$n++;
//            $cr2=1;
//        }
//        $crf03 = $override->getNoRepeat('crf01_pg03','study_id','study_id',$crf1['study_id']);
//        if($crf02){
//            //print_r($crf03[0]['study_id']);echo ' , ';$n++;
//            $cr3=1;
//        }
//    }
//    if($cr1 == 1 && $cr2 == 1 && $cr3 == 1){
//
//    }else{
//        print_r($crf1['study_id']);echo ' , ';$n++;
//    }
//
//}
//print_r($n);

?>
<!---->
<!--<style>-->
<!--div.b128{-->
<!-- border-left: 1px black solid;-->
<!-- height: 60px;-->
<!--}-->
<!--</style>-->
<!---->
<?php
//global $char128asc,$char128charWidth;
//$char128asc=' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
//$char128wid = array(
// '212222','222122','222221','121223','121322','131222','122213','122312','132212','221213', // 0-9
// '221312','231212','112232','122132','122231','113222','123122','123221','223211','221132', // 10-19
// '221231','213212','223112','312131','311222','321122','321221','312212','322112','322211', // 20-29
// '212123','212321','232121','111323','131123','131321','112313','132113','132311','211313', // 30-39
// '231113','231311','112133','112331','132131','113123','113321','133121','313121','211331', // 40-49
// '231131','213113','213311','213131','311123','311321','331121','312113','312311','332111', // 50-59
// '314111','221411','431111','111224','111422','121124','121421','141122','141221','112214', // 60-69
// '112412','122114','122411','142112','142211','241211','221114','413111','241112','134111', // 70-79
// '111242','121142','121241','114212','124112','124211','411212','421112','421211','212141', // 80-89
// '214121','412121','111143','111341','131141','114113','114311','411113','411311','113141', // 90-99
// '114131','311141','411131','211412','211214','211232','23311120' ); // 100-106
//
//////Define Function
//function bar128($text) { // Part 1, make list of widths
// global $char128asc,$char128wid;
// $w = $char128wid[$sum = 104]; // START symbol
// $onChar=1;
// for($x=0;$x<strlen($text);$x++) // GO THRU TEXT GET LETTERS
// if (!( ($pos = strpos($char128asc,$text[$x])) === false )){ // SKIP NOT FOUND CHARS
// $w.= $char128wid[$pos];
// $sum += $onChar++ * $pos;
// }
// $w.= $char128wid[ $sum % 103 ].$char128wid[106]; //Check Code, then END
// //Part 2, Write rows
// $html="<table cellpadding=0 cellspacing=0><tr>";
// for($x=0;$x<strlen($w);$x+=2) // code 128 widths: black border, then white space
// $html .= "<td><div class=\"b128\" style=\"border-left-width:{$w[$x]};width:{$w[$x+1]}\"></div>";
// return "$html<tr><td colspan=".strlen($w)." align=center><font family=arial size=2><b>$text</table>";
//}
//print_r(bar128(stripcslashes('frdrck aman')));

