<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$data = $override->varName(41);
//print_r($data);
$forms = $override->frd(41);
 foreach ($forms as $form){
     $frd=$override->aman(41,$form['vid'],$form['fid']);
     print_r($frd);echo '<br>';
 }