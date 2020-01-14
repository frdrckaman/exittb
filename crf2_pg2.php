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
                            case 'tbsnum':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'tbsx01':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tbsx01days':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'tbsx02':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tbsx02days':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'tbsx03':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tbsx03days':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'tbsx04':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tbsx04days':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'tbsx05':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tbsx05days':
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
                            case 'tbsnum':
                                $frd[$va] =$f['val'];
                                break;
                            case 'tbsx01':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tbsx01days':
                                $frd[$va] =$f['val'];
                                break;
                            case 'tbsx02':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tbsx02days':
                                $frd[$va] =$f['val'];
                                break;
                            case 'tbsx03':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tbsx03days':
                                $frd[$va] =$f['val'];
                                break;
                            case 'tbsx04':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tbsx04days':
                                $frd[$va] =$f['val'];
                                break;
                            case 'tbsx05':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tbsx05days':
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
foreach($override->get('forms','qid',23) as $fid){//echo$fr.'  , ';
    $dbv=variable($fid['fid']);$am=null;
    $am=null;$stf='';
    $arr = array('country','institution','facility','tbsnum','tbsx01','tbsx01days','tbsx02','tbsx02days','tbsx03','tbsx03days','tbsx04','tbsx04days','tbsx05','tbsx05days');
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
        /*if(findText($fid['fid'],'ward')){$ward=findText($fid['fid'],'ward');}else{$ward='';}
        if(findText($fid['fid'],'village')){$village=findText($fid['fid'],'village');}else{$village='';}
        if(findText($fid['fid'],'leadertencell')){$leadertencell=findText($fid['fid'],'leadertencell');}else{$leadertencell='';}
        if(findText($fid['fid'],'phone1')){$phone1=findText($fid['fid'],'phone1');}else{$phone1='';}
        if(findText($fid['fid'],'phone2')){$phone2=findText($fid['fid'],'phone2');}else{$phone2='';}
        if(findText($fid['fid'],'chronicillness')){$chronicillness=findText($fid['fid'],'chronicillness');}else{$chronicillness='';}*/

        //print_r($am);
        if($override->selectData4('crf02_pg02','country',$am['country'],'institution',$am['institution'],'facility',$am['facility'],'tbsnum',$am['tbsnum'])){$dup=true;echo$am['country'].''.$am['institution'].''.$am['facility'].''.$am['tbsnum'].'  ,  ';}else{$dup=false;}//echo$f.' , ';$f++;
        if($dbv && $dup==false){
            $user->createRecord('crf02_pg02', array(
                'country' => $am['country'],
                'institution' => $am['institution'],
                'facility' => $am['facility'],
                'tbsnum' => $am['tbsnum'],
                'tbsx01' => $am['tbsx01'],
                'tbsx01days' => $am['tbsx01days'],
                'tbsx02' => $am['tbsx02'],
                'tbsx02days' => $am['tbsx02days'],
                'tbsx03'=>$am['tbsx03'],
                'tbsx03days' => $am['tbsx03days'],
                'tbsx04' => $am['tbsx04'],
                'tbsx04days' => $am['tbsx04days'],
                'tbsx05' => $am['tbsx05'],
                'tbsx05days' => $am['tbsx05days'],
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
$arr_crf1_pg1=array('country','institution','facility','tbsnum','vdate','enum','idxenum','clinic','rchclinic','age','gender','marital','other_marital','occupation','education','ward','village','location','leadertencell','phone1','phone2','hivpo','hivposperiod','onart','onartperiod','tbcasecontact','chronicdx','chronicillness','alcohol','alcoholpres','tobacco','tobaccopres','drug','drugpres','tbtx','tbtxperiod');
$arr_crf1_pg2=array('country','institution','facility','tbsnum','tbsx01','tbsx01date','tbsx02','tbsx02date','tbsx03','tbsx03date','tbsx04','tbsx04date','tbsx05','tbsx05date','tbsx06','tbsx06date','seekcare01','seekcare02','seekcare03','seekcare05','seekcare06','seekcareother');
$arr_crf2_pg1=array('country','institution','facility','tbsnum','vdate','age','gender','marital','other_marital','occupation','education','ward','village','location','tencell','phone1','phone2','hivpos','hivposyr','onart','onartyr','tbcasecontact','chronicdx','chronicillness','alcohol','alcoholpres','tobacco','tobaccopres','drug','drugpres','tbtx','tbtxyr');
$arr_crf2_pg2=array('country','institution','facility','tbsnum','tbsx01','tbsx01days','tbsx02','tbsx02days','tbsx03','tbsx03days','tbsx04','tbsx04days','tbsx05','tbsx05days');