<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();$msv='';

$arr1 = array('vdate','clinic','age','gender','marital','occupation','education','location','hivpos','hivposyr','hivres','onart','onartyr','tbcasecontact','chronicillness','chronicdx','alcohol','alcoholpres','tobacco','tobaccopres','drug','drugpres','tbtx','tbtxyr');
$getData = $override->getData('crf01_pg01');
//print_r($getData);
$id=null;$errors=null;$x=1;$y=1;foreach ($getData as $data){
        foreach ($arr1 as $arr){//print_r($arr);echo ' , ';
            if($data[$arr]==' '){//print_r($arr);echo ' , ';
                switch ($arr){
                    case 'hivpos':
                        $errors[$x] = 'Qn1 (a) {Response}';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;//print_r($errors[$x]);
                        break;
                    case 'hivposyr':
                        //print_r($data['hivpos']);
                        if($data['hivpos'] === 'Yes'){
                            $errors[$x] = 'Qn1 (a) {Year tested}';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                        }
                        break;
                    case 'hivres':
                        if($data['hivpos'] === 'Yes'){
                            $errors[$x] = 'Qn1 (b)';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                        }
                        break;
                    case 'onart':
                        if($data['hivres'] == 'Positive'){
                            $errors[$x] = 'Qn1 (c) {Response}';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                        }
                        break;
                    case 'onartyr':
                        if($data['onart'] == 'Yes'){
                            $errors[$x] = 'Qn1 (c) {year start ART}';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                        }
                        break;
                    case 'tbcasecontact':
                        $errors[$x] = 'Qn2';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                        break;
                    case 'chronicillness':
                        $errors[$x] = 'Qn3';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                        break;
                    case 'chronicdx':
                        if($data['chronicillness'] == 'Yes'){
                            $errors[$x] = 'Qn3 {Specification}';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                        }
                        break;
                    case 'alcohol':
                        $errors[$x] = 'Qn4 (i) {year tested}';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                        break;
                    case 'alcoholpres':
                        if($data['alcohol'] == 'Yes'){
                            $errors[$x] = 'Qn4 (i) {alcohol current}';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                        }
                        break;
                    case 'tobacco':
                        $errors[$x] = 'Qn4 (ii)';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                        break;
                    case 'tobaccopres':
                        if($data['tobacco'] == 'Yes'){
                            $errors[$x] = 'Qn4 (a) {tobacco current}';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                        }
                        break;
                    case 'drug':
                        $errors[$x] = 'Qn4 (ii)';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                        break;
                    case 'drugpres':
                        if($data['drug'] == 'Yes'){
                            $errors[$x] = 'Qn4 (a) {drug current}';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                        }
                        break;
                    case 'tbtx':
                        $errors[$x] = 'Qn5';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                        break;
                    case 'tbtxyr':
                        if($data['tbtx'] === 'Yes'){
                            $errors[$x] = 'Qn5 {year}';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                        }
                        break;
                    default:
                        $errors[$x] = $arr;$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                        break;
                }
            }
        }
        if($errors){
            foreach ($errors as $error){
                //print_r($error);
                $msv .= $error.' , ';
            }
            //print_r($msv);
            try{
                $checkID=$override->selectData('data_qry','study_id',preg_replace('/[^A-Za-z0-9\-]/', '', $data['study_id']),'crf_id',7,'pg',1);
                if(!$checkID){
                    if($data['country']){
                        //print_r($data['study_id']);echo ' , ';
                        $user->createRecord('data_qry',array(
                            'study_id' => preg_replace('/[^A-Za-z0-9\-]/', '', $data['study_id']),
                            'm_value' => $msv,
                            'crf_id' => 7,
                            'pg' => 1,
                            'c_id' => $data['country'],
                            'i_id' => $data['institution'],
                            'f_id' => $data['facility'],
                            'gen_date' => date('Y-m-d'),
                            'status' => 0,
                            'fid' => $data['fid'],
                            'staff_id' => 2
                        ));
                        echo 'Good';
                    }
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
            $msv=null;
        }$errors=null;$y++;
    }

