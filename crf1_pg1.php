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
                            case 'vdate':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'enum':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'idxenum':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'clinic':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'rchclinic':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'age':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'gender':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'marital':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'other_marital':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'occupation':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'education':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'ward':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'village':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'location':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'leadertencell':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'phone1':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'phone2':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'hivpo':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'hivposperiod':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'onart':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'onartperiod':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'tbcasecontact':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'chronicdx':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'chronicillness':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'alcohol':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'alcoholpres':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tobacco':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tobaccopres':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'drug':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'drugpres':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tbtx':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tbtxperiod':
                                $frd[$va] .=$f['val'];
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
                            case 'vdate':
                                $frd[$va] =$f['val'];
                                break;
                            case 'enum':
                                $frd[$va] =$f['val'];
                                break;
                            case 'idxenum':
                                $frd[$va] =$f['val'];
                                break;
                            case 'clinic':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'rchclinic':
                                $frd[$va] =$f['val'];
                                break;
                            case 'age':
                                $frd[$va] =$f['val'];
                                break;
                            case 'gender':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'marital':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'other_marital':
                                $frd[$va] =$f['val'];
                                break;
                            case 'occupation':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'education':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'ward':
                                $frd[$va] =$f['val'];
                                break;
                            case 'village':
                                $frd[$va] =$f['val'];
                                break;
                            case 'location':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'leadertencell':
                                $frd[$va] =$f['val'];
                                break;
                            case 'phone1':
                                $frd[$va] =$f['val'];
                                break;
                            case 'phone2':
                                $frd[$va] =$f['val'];
                                break;
                            case 'hivpo':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'hivposperiod':
                                $frd[$va] =$f['val'];
                                break;
                            case 'onart':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'onartperiod':
                                $frd[$va] =$f['val'];
                                break;
                            case 'tbcasecontact':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'chronicdx':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'chronicillness':
                                $frd[$va] =$f['val'];
                                break;
                            case 'alcohol':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'alcoholpres':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tobacco':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tobaccopres':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'drug':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'drugpres':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tbtx':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tbtxperiod':
                                $frd[$va] =$f['val'];
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
foreach($override->get('forms','qid',12) as $fid){//echo$fr.'  , ';
    $dbv=variable($fid['fid']);$am=null;
    $text=$override->get('formboxverifytext','fid',$fid['fid']);
    if($text){$desc=$text[0]['val'];}else{$desc='';}
    $am=null;$stf='';
    $arr = array('country','institution','facility','tbsnum','vdate','enum','idxenum','clinic','rchclinic','age','gender','marital','other_marital','occupation','education','ward','village','location','leadertencell','phone1','phone2','hivpo','hivposperiod','onart','onartperiod','tbcasecontact','chronicdx','chronicillness','alcohol','alcoholpres','tobacco','tobaccopres','drug','drugpres','tbtx','tbtxperiod');
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
        if(findText($fid['fid'],'ward')){$ward=findText($fid['fid'],'ward');}else{$ward='';}//print_r($ward);
        if(findText($fid['fid'],'village')){$village=findText($fid['fid'],'village');}else{$village='';}//print_r($village);
        if(findText($fid['fid'],'leadertencell')){$leadertencell=findText($fid['fid'],'leadertencell');}else{$leadertencell='';}//print_r($leadertencell);
        if(findText($fid['fid'],'phone1')){$phone1=findText($fid['fid'],'phone1');}else{$phone1='';}//print_r($phone1);
        if(findText($fid['fid'],'phone2')){$phone2=findText($fid['fid'],'phone2');}else{$phone2='';}//print_r($phone2);
        if(findText($fid['fid'],'chronicillness')){$chronicillness=findText($fid['fid'],'chronicillness');}else{$chronicillness='';}//print_r($chronicillness);

        //print_r($am);
        if($override->selectData4('crf01_pg01','country',$am['country'],'institution',$am['institution'],'facility',$am['facility'],'tbsnum',$am['tbsnum'])){$dup=true;echo$am['country'].''.$am['institution'].''.$am['facility'].''.$am['tbsnum'].'  ,  ';}else{$dup=false;}//echo$f.' , ';$f++;
        if($dbv && $dup==false){
            $user->createRecord('crf01_pg01', array(
                'country' => $am['country'],
                'institution' => $am['institution'],
                'facility' => $am['facility'],
                'tbsnum' => $am['tbsnum'],
                'vdate' => $am['vdate'],
                'enum' => $am['enum'],
                'idxenum' => $am['idxenum'],
                'clinic' => $am['clinic'],
                'rchclinic'=>$am['rchclinic'],
                'age' => $am['age'],
                'gender' => $am['gender'],
                'marital' => $am['marital'],
                'other_marital' => $am['other_marital'],
                'occupation' => $am['occupation'],
                'education' => $am['education'],
                'ward'=>$ward,
                'village' => $village,
                'location' => $am['location'],
                'leadertencell' => $leadertencell,
                'phone1' => $phone1,
                'phone2' => $phone2,
                'hivpo' => $am['hivpo'],
                'hivposperiod' => $am['hivposperiod'],
                'onart' => $am['onart'],
                'onartperiod'=>$am['onartperiod'],
                'tbcasecontact' => $am['tbcasecontact'],
                'chronicdx' => $am['chronicdx'],
                'chronicillness' => $chronicillness,
                'alcohol' => $am['alcohol'],
                'alcoholpres' => $am['alcoholpres'],
                'tobacco' => $am['tobacco'],
                'tobaccopres'=>$am['tobaccopres'],
                'drug' => $am['drug'],
                'drugpres' => $am['drugpres'],
                'tbtx' => $am['tbtx'],
                'tbtxperiod'=>$am['tbtxperiod'],
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
$arr_crf_se_pg1=array('country','institution','facility','enum','qn01_1','qn01_2','qn01_3','qn01_4','qn01_5','qn02_1','qn02_2','qn02_3','qn02_4');
$arr_crf_se_pg2=array('country','institution','facility','enum','qn02_5','qn02_6','qn02_7','qn02_8a','qn02_8b','qn02_9a','qn02_9b','qn02_10','qn02_11','qn02_12','qn02_13a','qn02_13b','qn02_14a','qn02_14b','qn02_15','qn02_16');
$arr_crf_se_pg3=array('country','institution','facility','enum','qn02_17','qn02_18','qn02_19','qn02_20','qn02_21','qn2_22','qn02_23a','qn02_23b','qn02_24a','qn02_24b','qn02_25');
$arr_crf_se_pg4=array('country','institution','facility','enum','interviewer_signature','interviewer_id_code','date_form_completed','signature_of_person_checking_form','name','id_of_person_checking_form','date_form_checked');
$arr_crf_trm_pg1=array('country','institution','facility','enum','txunit','phone1','phone2','hospnum','birthdate','dxdate','txdate','txcompdate','tbtxoutcome','formdate');