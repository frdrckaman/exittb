<?php
require_once'php/core/init.php';

function noCrf($c,$crf){
    $override = new OverideData();
    $no=$override->countNoRepeat2('crf_record','tb_crf_id','c_id',$c,'crf_id',$crf);
    if($no > 0){return $no;}else{return 0;}
}