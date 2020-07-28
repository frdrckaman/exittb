<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$var=null;$x=0;$y=0;$var1=null;
$cnt=null;$frd=null;$dup=false;

function check($arr,$val){
    if(in_array($val,$arr)){
        return true;
    }else{
        return false;
    }
}
function variable($a){
    $x=0;$var=null;$frd=null;
    $override = new OverideData();
    $v1=$override->getValue1($a);//print_r($v1);
    foreach($v1 as $vl){
        if($var == null){
            $var[$x] = $vl['varname'];
        }else{
            if(check($var,$vl['varname']) == true){

            }else{
                $var[$x] = $vl['varname'];
            }
        }
        $x++;
    }
    // print_r($var);
    if($var){
        foreach($var as $va){
            foreach($v1 as $f){
                if($f['varname'] == $va){//print_r($f['val']);
                    //$var1[$a] = $f['val'];
                    if(isset($frd[$va])){
                        switch ($va){
                            case 'country':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'institution':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'facility':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'enum':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'interviewer_signature':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'interviewer_id_code':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'date_form_completed':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'signature_of_person_checking_form':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'name':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'id_of_person_checking_form':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'date_form_checked':
                                $frd[$va] .=$f['val'];
                                break;
                        }
                    }else{
                        switch ($va){
                            case 'country':
                                $frd[$va] =$f['val'];
                                break;
                            case 'institution':
                                $frd[$va] =$f['val'];
                                break;
                            case 'facility':
                                $frd[$va] =$f['val'];
                                break;
                            case 'enum':
                                $frd[$va] =$f['val'];
                                break;
                            case 'interviewer_signature':
                                $frd[$va] =$f['val'];
                                break;
                            case 'interviewer_id_code':
                                $frd[$va] =$f['val'];
                                break;
                            case 'date_form_completed':
                                $frd[$va] =$f['val'];
                                break;
                            case 'signature_of_person_checking_form':
                                $frd[$va] =$f['val'];
                                break;
                            case 'name':
                                $frd[$va] =$f['val'];
                                break;
                            case 'id_of_person_checking_form':
                                $frd[$va] =$f['val'];
                                break;
                            case 'date_form_checked':
                                $frd[$va] =$f['val'];
                                break;
                        }
                    }
                    // $a++;
                }
            }
        }
    }
    return $frd;
}$fr=0;

function findText($id,$val){
    $override = new OverideData();
    $inputValue = $override->getValueT($id);//print_r($inputValue);
    if($inputValue){//print_r($inputValue[0]['varname']);echo ' , ';
        foreach ($inputValue as $value){
            switch($value['varname']){
                case $val:
                    $txtVal=$value['val'];
                    return $txtVal;
                    break;
            }
        }
    }else{
        $inputValue='';
        return $inputValue;
    }
}
//variable(1);
//print_r(findText(3,'ward'));
foreach($override->get('forms','qid',27) as $fid){//echo$fr.'  , ';
    $dbv=variable($fid['fid']);$am=null;
    $am=null;$stf='';
    $arr=array('country','institution','facility','enum','interviewer_signature','interviewer_id_code','date_form_completed','signature_of_person_checking_form','name','id_of_person_checking_form','date_form_checked');
    foreach($arr as $ar){//print_r($ar);
        if($dbv){
            if(array_key_exists($ar,$dbv)){
                if(isset($am[$ar])){$am[$ar] .= $dbv[$ar];}else{$am[$ar] = $dbv[$ar];}
            }else {
                if(isset($am[$ar])){$am[$ar] .= '';}else{$am[$ar] = '';}
            }
            $x++;
        }
    }
    try {//print_r( $override->getValueT($fid['fid']));echo ' , ';
        //print_r($am);echo'  ,  ';
        if(findText($fid['fid'],'interviewer_signature')){$sg1=findText($fid['fid'],'interviewer_signature');}else{$sg1='';}
        if(findText($fid['fid'],'signature_of_person_checking_form')){$sg2=findText($fid['fid'],'signature_of_person_checking_form');}else{$sg2='';}
        if(findText($fid['fid'],'name')){$name=findText($fid['fid'],'name');}else{$name='';}
        //print_r($am);
        if($override->selectData4('crf_se_pg04','country',$am['country'],'institution',$am['institution'],'facility',$am['facility'],'enum',$am['enum'])){$dup=true;echo$am['country'].''.$am['institution'].''.$am['facility'].''.$am['enum'].'  ,  ';}else{$dup=false;}//echo$f.' , ';$f++;
        if($dbv && $dup==false){
            $user->createRecord('crf_se_pg034', array(
                'country' => $am['country'],
                'institution' => $am['institution'],
                'facility' => $am['facility'],
                'enum' => $am['enum'],
                'interviewer_signature' => $sg1,
                'interviewer_id_code' => $am['interviewer_id_code'],
                'date_form_completed' => $am['date_form_completed'],
                'signature_of_person_checking_form' => $sg2,
                'name' => $name,
                'id_of_person_checking_form' => $am['id_of_person_checking_form'],
                'date_form_checked' => $am['date_form_checked'],
                'fid' => $fid['fid']
            ));
            //$successMessage = 'Staff have been Successful Registered';
            echo'Good';
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }
    $fr++;

}
