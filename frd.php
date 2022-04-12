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
//$x=0;
//$table='CRF01_ODK';
//foreach ($override->getData('table_name') as $data){
//    //print_r($override->getColumn('crf01_pg01')[1]);
//    foreach ($override->getColumn($table) as $column){
//        // print_r($column['Field']);echo ' , ';
//        if($data['col'] == $column['Field']){
//            $dt = $override->get($table,'study_id',$data['study_id']);
//            if($dt){print_r($data['study_id'].' | ');
////                print_r($data['col']);echo ' '.$data['value'].' , ';
//                if($data['value']){$d_value = $data['value'];}else{$d_value='';}
//                try {
//                    print_r($data['study_id']);echo ", ";
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
////********************** fix date format **********************************
//$dVar = array('vdate','tbsx01days','tbsx02days','tbsx03days','tbsx04days','tbsx05days','tbsx06days','formdate');
//$c_date = 'formdate';
//foreach ($override->getData('crf01_ug_pg02') as $data){
//    $dd = preg_replace('/[^A-Za-z0-9\-]/', '', $data[$c_date]);
//    $d=str_split($dd);
//    if(count($d) == 8){//print_r($d);echo ' , ';
//        $date = $d[0].$d[1].'/'.$d[2].$d[3].'/'.$d[4].$d[5].$d[6].$d[7];
//        try {
//            $user->updateRecord('crf01_ug_pg02', array($c_date=>$date), $data['id']);
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

// ********************** Removing - from study_id and copy tb_crf_id to study_id *********************************************
//$arr = array('111-12233', '111-12332', ' 111-12476');
//$table='missing_crf';
//
//foreach ($override->getData($table) as $data){
////    $dt = $data['country'].$data['institution'].$data['facility'].$data['tbenum'];
//    $dt = $data['tb_crf_id'];
//    $id_v = $dt;
//    $sid=preg_replace('/[^A-Za-z0-9\-]/', '', $id_v);
//    $dt = str_split($sid);
//    if(in_array('-',$dt)){
//        $d = explode('-',$sid);
//        $id=$d[0].$d[1];
//        //$id=implode('',$dt);
//    }else{$id=$sid;}
//    try {
//        $user->updateRecord($table, array('study_id' => $id), $data['id']);
//        echo $id_v.' -> '; print_r($id);echo ' , ';
//    } catch (Exception $e) {
//        die($e->getMessage());
//    }
//
//}
/*************************** fix length of enum append zeros ********************************************************/
//$table='crf01_pg02_odk';
//foreach ($override->getData($table) as $data){
//    if($data['tbenum']){
//        //if(1==1){
//            $str = strlen($data['tbenum']);
//            if($str == 4){
//                $nw = '0'.$data['tbenum'];
//                try {
//                    $user->updateRecord($table, array('tbenum' => $nw), $data['id']);
//                    print_r($nw);echo ' , ';
//                } catch (Exception $e) {
//                    die($e->getMessage());
//                }
//            }elseif ($str == 3){
//                $nw = '00'.$data['tbenum'];
//                try {
//                    $user->updateRecord($table, array('tbenum' => $nw), $data['id']);
//                    print_r($nw);echo ' , ';
//                } catch (Exception $e) {
//                    die($e->getMessage());
//                }
//            }elseif ($str == 2){
//                $nw = '000'.$data['tbenum'];
//                try {
//                    $user->updateRecord($table, array('tbenum' => $nw), $data['id']);
//                    print_r($nw);echo ' , ';
//                } catch (Exception $e) {
//                    die($e->getMessage());
//                }
//            }elseif ($str == 1){
//                $nw = '0000'.$data['tbenum'];
//                try {
//                    $user->updateRecord($table, array('tbenum' => $nw), $data['id']);
//                    print_r($nw);echo ' , ';
//                } catch (Exception $e) {
//                    die($e->getMessage());
//                }
//            }
//       // }
//    }
//}
// **************************** UPDATE tb_crf_id on missing_crf ****************************************
//foreach ($override->getData('missing_crf') as $data){
//    $dt=str_replace('A', '', preg_replace('/[^A-Za-z0-9\-]/', '', $data['study_id']));
//    $tb = $override->getF('crf_record','study_id', $dt);
//    try {
//        $user->updateRecord('missing_crf', array('tb_crf_id' => $tb[0]['tb_crf_id']), $data['id']);
//        echo $data['tb_crf_id'].' -> '.$dt;
//    } catch (Exception $e) {
//        die($e->getMessage());
//    }
//}
//$arrys = array(50,59,61,62,63,64);$sum=0;
//$td=200* count($arrys);$y=1;$tg=200;$sum=0;
//$staff = array('Kamabanga','Baali','Casiana','Ezra','Florence','Loning`o');
//$dates = array('2020-11-17');
//$no = count($dates) - 1;
//if($dates[$no] != date('Y-m-d')){array_push($dates, date('Y-m-d'));}
//$count=$override->getNo('missing_crf');
//$tc = $count*3;
//echo '<table border="1"><tbody>';
//foreach ($dates as $date){$x=0;$dsum=0;
//    echo '<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
//    echo '<tr><th>Day '.$y.' ( '. $date.' )'.' &nbsp;</th><th> Done &nbsp;</th><th> Remained &nbsp;</th><th> Target &nbsp;</th></tr>';
//    foreach ($arrys as $arry){
//        $data = $override->countData('missing_crf','staff_id',$arry,'date_modified', $date);
//        $sum +=$data;$dsum +=$data;$rm=$tg-$data;if($rm > 0){$frm=$rm;}else{$frm=0;}
//        echo '<tr><td>'.$staff[$x].'</td><td>'.$data.'</td><td>'.$frm.'</td><td>'.$tg.'</td></tr>';
//        $x++;}
//    $dtr=$td-$dsum;
//    if($dtr > 0){$tgr = $dtr;}else{$tgr=$tg;}
//    echo '<tr><th>Total</th><th>'.number_format($dsum).' </th><th>'.number_format($tgr).'</th><th>'.number_format($td).'</th></tr>';
//$y++;}
//echo '</tbody></table>';
//echo '<br>';
//echo '<table border="1"><tbody>';
//$remain=$tc-$sum;
//echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
//echo '<tr><th>Total Entered &nbsp;</th><th>'.number_format($sum).'&nbsp;</th></tr>';
//echo '<tr><th>Total Remained &nbsp;</th><th>'.number_format($remain).'&nbsp;</th></tr>';
//echo '<tr><th>Total CRF &nbsp;</th><th>'.number_format($tc).'&nbsp;</th></tr></tbody></table>';
//$x = 0;
//foreach ($override->getData('crf_record') as $data){
//    $getId = $override->get('crf_record','tb_crf_id',$data['tb_crf_id']);
//    if (count($getId) <= 1){
//        print_r($data['study_id']);echo ' , ';
//        $x++;
//    }
//}
//******************************** removing space ********************************
//foreach ($override->getData('missing_crf') as $data){
//    $col = preg_replace('/[^A-Za-z0-9\-]/', '', $data['study_id']);
//    try {
//        $user->updateRecord('missing_crf', array('study_id' => $col), $data['id']);
//        echo 'Good, ';
//    } catch (Exception $e) {
//    }
//}
//
//$table = "frd_pg_3";
//
//foreach ($override->getData($table) as $data){
////    print_r($data['study_id']);
//    $dt=$override->get("missing_crf", 'study_id', $data['study_id'])[0];
////    print_r($dt);echo " , ";
//    try {
//        $user->updateRecord('missing_crf', array('status' => 0), $dt['id']);
//        echo 'Good, ';
//    } catch (Exception $e) {
//    }
//}

//$up=11113121;$lw=11110001;$x=0;$f=0;$n=0;
//while ($lw <= $up){
//    if($override->get('crf_record','study_id',$lw)){$f +=1;
//
////        print_r($lw);echo ' | ';
//    }else{$n+=1;
////        print_r($lw);echo ' | ';
//    }
//    $lw +=1;
//}
//
//print_r('Found: '.$f.' | '.'Not Found: '.$n);

$frd = '/var/www/system.exit-tb.org/public_html/scanned_crf/EXIT-TB_CRF01_PG0_1_111-00001.pdf';
$folderName = '/var/www/quexf.exit-tb.org/public_html/scans/';

//foreach ($override->getNews('crf_record', 'c_id', 1, 'page', 3) as $file){
//    print_r($file['attachment']);
//}

//$f = explode('/', $frd);
//$a = $folderName.$f[6];
//print_r($a);
//$output = shell_exec('cp 403.php data/');
//echo "<pre>$output</pre>";


