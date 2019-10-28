<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();

$fail_crf = $override->get('processforms','status',2);

foreach ($fail_crf as $crf){
    $arr = explode('_',$crf['filepath']);
    if(isset($arr[7])){
        print_r($arr[7]);echo '<br>';
    }
}
