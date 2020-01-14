<?php
require_once 'php/core/init.php';
$user = new User();
$override = new OverideData();

 // fix age for crf01_ug_pg01 uganda
$x=0;
foreach ($override->getData('table_name') as $age){
    if($age){
        $getData = $override->get('crf01_ug_pg01','study_id',$age['study_id']);
        if($getData){
            try {
                $user->updateRecord('crf01_ug_pg01', array('age' => $age['age']), $getData[0]['id']);
                echo 'Good';$x++;
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    }
}
print_r($x);