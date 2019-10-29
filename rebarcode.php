<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();

$fail_crf = $override->get('processforms','status',2);
//$c = '/var/www/quexf.exit-tb.org/public_html/scans//EXIT-TB_CRF01_PG0_1_12110032_CRFID_4_CID_1.pdf';
//$c = '/var/www/quexf.exit-tb.org/public_html/scans//EXIT-TB_TRMNT_PG0_1_12110068.pdf';
//$a_c = explode('_',$c);
//$sid = str_split($a_c[5]);
//print_r($a_c);
//if($a_c[2] == 'CRF01' && $sid[0] == 2){
//    //print_r($a_c[5]);
//}

foreach ($fail_crf as $crf){
    $arr = explode('_',$crf['filepath']);
    //print_r($arr);echo '<br>';
    if($arr[2] == 'CRF01' ){
        $sid = str_split($arr[5]);
        if( $sid[0] == 3){
            print_r($arr[5]);echo '<br>';
            print_r($arr);echo '<br>';
        }
    }
}


