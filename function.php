<?php
require_once'php/core/init.php';

function noCrf($c,$crf){
    $override = new OverideData();
    $no=$override->countNoRepeat2('crf_record','tb_crf_id','c_id',$c,'crf_id',$crf);
    if($no > 0){return $no;}else{return 0;}
}
function noCrfWk($c,$crf){
    $override = new OverideData();
    $last_row = $override->lastRow('wk_report','id');
    $no=$override->wkDataRange('crf_record','tb_crf_id','c_id',$c,'crf_id',$crf,'up_date',$last_row[0]['start_date'],date('Y-m-d'));
    if($no > 0){return $no;}else{return 0;}
}
function wkNoCrf(){
    $override = new OverideData();
    $last_row = $override->lastRow('wk_report','id');
    return $last_row[0]['end_date'];
}