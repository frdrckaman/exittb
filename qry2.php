<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();$msv='';

$arr1 = array('country','institution','facility','tbenum','tbsx01','tbsx01days','tbsx02','tbsx02days','tbsx03','tbsx03days','tbsx04','tbsx04days','tbsx05','tbsx05days','tbsx06','tbsx_other','tbsx06days','cough_care','carefac','othercarefac');
$getData = $override->getData('crf01_pg02');
//print_r($getData);
$id=null;$errors=null;$x=1;$y=1;foreach ($getData as $data){
    foreach ($arr1 as $arr){//print_r($arr);echo ' , ';
        if($data[$arr]==' '){//print_r($arr);echo ' , ';
            switch ($arr){
                case 'tbsx01':
                    $errors[$x] = 'Qn5 (i) { Response }';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                    break;
                case 'tbsx01days':
                    if($data['tbsx01'] == 'Yes'){
                        $errors[$x] = 'Qn5 (i) { Date Tested }';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                    }
                    break;
                case 'tbsx02':
                    $errors[$x] = 'Qn5 (ii) { Response }';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                    break;
                case 'tbsx02days':
                    if($data['tbsx02'] == 'Yes'){
                        $errors[$x] = 'Qn5 (ii) { Date Tested }';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                    }
                    break;
                case 'tbsx03':
                    $errors[$x] = 'Qn5 (iii) { Response }';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                    break;
                case 'tbsx03days':
                    if($data['tbsx03'] == 'Yes'){
                        $errors[$x] = 'Qn5 (iii) { Date Tested }';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                    }
                    break;
                case 'tbsx04':
                    $errors[$x] = 'Qn5 (iv) { Response }';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                    break;
                case 'tbsx04days':
                    if($data['tbsx04'] == 'Yes'){
                        $errors[$x] = 'Qn5 (iv) { Date Tested }';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                    }
                    break;
                case 'tbsx05':
                    $errors[$x] = 'Qn5 (v) { Response }';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                    break;
                case 'tbsx05days':
                    if($data['tbsx05'] == 'Yes'){
                        $errors[$x] = 'Qn5 (v) { Date Tested }';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                    }
                    break;
                case 'tbsx06':
                    $errors[$x] = 'Qn5 (vi) { Response }';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                    break;
                case 'tbsx06days':
                    if($data['tbsx06'] == 'Yes'){
                        $errors[$x] = 'Qn5 (vi) { Date Tested }';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                    }
                    break;
                case 'cough_care':
                    $errors[$x] = 'Qn6 { Response }';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                    break;
                case 'carefac':
                    $errors[$x] = 'Qn7 { Response }';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
                    break;
                case 'othercarefac':
                    if($data['carefac'] == 'Other'){
                        $errors[$x] = 'Qn7 { Specify }';$id=$data['country'].$data['institution'].$data['facility'].$data['tbenum'];$x++;
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
            if(!str_replace(' ', '', $data['study_id']) == ''){
                $checkID=$override->selectData('data_qry','study_id',preg_replace('/[^A-Za-z0-9\-]/', '', $data['study_id']),'crf_id',7,'pg',2);
                if(!$checkID){
                    if($data['study_id']){
                        print_r($data['study_id']);echo ' , ';
                        $user->createRecord('data_qry',array(
                            'study_id' => preg_replace('/[^A-Za-z0-9\-]/', '', $data['study_id']),
                            'm_value' => $msv,
                            'crf_id' => 7,
                            'pg' => 2,
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
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
        $msv=null;
    }$errors=null;$y++;
}

