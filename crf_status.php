<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$tables = array('crf01_pg01','crf01_pg02','crf02_pg01','crf02_pg02');
foreach ($tables as $table){
    $crf01_pg1=$override->getData($table);
        foreach ($crf01_pg1 as $scan){
        $tb_crf_id = $scan['country'].''.$scan['institution'].''.$scan['facility'].'-'.$scan['tbsnum'];
        $crf=$override->getNews('crf_record','tb_crf_id',$tb_crf_id,'processed',0);
            if($crf){
            try {
                $user->updateRecord('crf_record', array('processed' => 1), $crf[0]['id']);
                echo $table.' , ';
            } catch (Exception $e) {
                print_r($e);
                }
            }
        }
    }