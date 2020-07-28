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
                            case 'txunit':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'phone1':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'phone2':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'hospnum':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'birthdate':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'dxdate':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'txdate':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'txcompdate':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'tbtxoutcome':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'formdate':
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
                            case 'txunit':
                                $frd[$va] =$f['val'];
                                break;
                            case 'phone1':
                                $frd[$va] =$f['val'];
                                break;
                            case 'phone2':
                                $frd[$va] =$f['val'];
                                break;
                            case 'hospnum':
                                $frd[$va] =$f['val'];
                                break;
                            case 'birthdate':
                                $frd[$va] =$f['val'];
                                break;
                            case 'dxdate':
                                $frd[$va] =$f['val'];
                                break;
                            case 'txdate':
                                $frd[$va] =$f['val'];
                                break;
                            case 'txcompdate':
                                $frd[$va] =$f['val'];
                                break;
                            case 'tbtxoutcome':
                                $frd[$va] =$f['val'];
                                break;
                            case 'formdate':
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
foreach($override->get('forms','qid',29) as $fid){//echo$fr.'  , ';
    $dbv=variable($fid['fid']);$am=null;
    $am=null;$stf='';
    $arr=array('country','institution','facility','enum','txunit','phone1','phone2','hospnum','birthdate','dxdate','txdate','txcompdate','tbtxoutcome','formdate');
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
        if(findText($fid['fid'],'txunit')){$tre_unit=findText($fid['fid'],'txunit');}else{$tre_unit='';}
        if(findText($fid['fid'],'hospnum')){$hospital=findText($fid['fid'],'hospnum');}else{$hospital='';}
        //print_r($am);
        if($override->selectData4('crf_treat_out','country',$am['country'],'institution',$am['institution'],'facility',$am['facility'],'enum',$am['enum'])){$dup=true;echo$am['country'].''.$am['institution'].''.$am['facility'].''.$am['enum'].'  ,  ';}else{$dup=false;}//echo$f.' , ';$f++;
        if($dbv && $dup==false){
            $user->createRecord('crf_treat_out', array(
                'country' => $am['country'],
                'institution' => $am['institution'],
                'facility' => $am['facility'],
                'enum' => $am['enum'],
                'txunit' => $tre_unit,
                'phone1' => $am['phone1'],
                'phone2' => $am['phone2'],
                'hospnum' => $hospital,
                'birthdate' => $am['birthdate'],
                'dxdate' => $am['dxdate'],
                'txdate' => $am['txdate'],
                'txcompdate' => $am['txcompdate'],
                'tbtxoutcome' => $am['tbtxoutcome'],
                'formdate' => $am['formdate'],
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
