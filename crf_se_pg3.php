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
                            case 'qn02_17':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'qn02_18':
                                //$frd[$va] =$f['val'];
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                break;
                            case 'qn02_19':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'qn02_20':
                                //$frd[$va] .=$f['val'];
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                break;
                            case 'qn02_21':
                                //$frd[$va] .=$f['val'];
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                break;
                            case 'qn2_22':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'qn02_23a':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'qn02_23b':
                                //$frd[$va] .=$f['val'];
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                break;
                            case 'qn02_24a':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'qn02_24b':
                                //$frd[$va] .=$f['val'];
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                break;
                            case 'qn02_25':
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
                            case 'qn02_17':
                                $frd[$va] =$f['val'];
                                break;
                            case 'qn02_18':
                                //$frd[$va] =$f['val'];
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                break;
                            case 'qn02_19':
                                $frd[$va] =$f['val'];
                                break;
                            case 'qn02_20':
                                //$frd[$va] .=$f['val'];
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                break;
                            case 'qn02_21':
                                //$frd[$va] .=$f['val'];
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                break;
                            case 'qn2_22':
                                $frd[$va] =$f['val'];
                                break;
                            case 'qn02_23a':
                                $frd[$va] =$f['val'];
                                break;
                            case 'qn02_23b':
                                //$frd[$va] .=$f['val'];
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                break;
                            case 'qn02_24a':
                                $frd[$va] =$f['val'];
                                break;
                            case 'qn02_24b':
                                //$frd[$va] .=$f['val'];
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                break;
                            case 'qn02_25':
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
foreach($override->get('forms','qid',26) as $fid){//echo$fr.'  , ';
    $dbv=variable($fid['fid']);$am=null;
    $am=null;$stf='';
    $arr=array('country','institution','facility','enum','qn02_17','qn02_18','qn02_19','qn02_20','qn02_21','qn2_22','qn02_23a','qn02_23b','qn02_24a','qn02_24b','qn02_25');
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
        if(findText($fid['fid'],'qn02_17')){$qn02_17=findText($fid['fid'],'qn02_17');}else{$qn02_17='';}
        if(findText($fid['fid'],'qn02_19')){$qn02_19=findText($fid['fid'],'qn02_19');}else{$qn02_19='';}
        if(findText($fid['fid'],'qn02_22')){$qn02_22=findText($fid['fid'],'qn02_22');}else{$qn02_22='';}
        //print_r($am);
        if($override->selectData4('crf_se_pg03','country',$am['country'],'institution',$am['institution'],'facility',$am['facility'],'enum',$am['enum'])){$dup=true;echo$am['country'].''.$am['institution'].''.$am['facility'].''.$am['enum'].'  ,  ';}else{$dup=false;}//echo$f.' , ';$f++;
        if($dbv && $dup==false){
            $user->createRecord('crf_se_pg03', array(
                'country' => $am['country'],
                'institution' => $am['institution'],
                'facility' => $am['facility'],
                'enum' => $am['enum'],
                'qn02_17' => $qn02_17,
                'qn02_18' => $am['qn02_18'],
                'qn02_19' => $qn02_19,
                'qn02_20' => $am['qn02_20'],
                'qn02_21' => $am['qn02_21'],
                'qn2_22' => $qn02_22,
                'qn02_23a' => $am['qn02_23a'],
                'qn02_23b' => $am['qn02_23b'],
                'qn02_24a' => $am['qn02_24a'],
                'qn02_24b' => $am['qn02_24b'],
                'qn02_25' => $am['qn02_25'],
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
