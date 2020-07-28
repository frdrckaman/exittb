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
                            case 'tencell':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'phone1':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'phone2':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'hivpos':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'hivposyr':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'onart':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'onartyr':
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
                            case 'tbtxyr':
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
                            case 'tencell':
                                $frd[$va] =$f['val'];
                                break;
                            case 'phone1':
                                $frd[$va] =$f['val'];
                                break;
                            case 'phone2':
                                $frd[$va] =$f['val'];
                                break;
                            case 'hivpos':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'hivposyr':
                                $frd[$va] =$f['val'];
                                break;
                            case 'onart':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'onartyr':
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
                            case 'tbtxyr':
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
foreach($override->get('forms','qid',21) as $fid){//echo$fr.'  , ';
    $dbv=variable($fid['fid']);$am=null;
    $text=$override->get('formboxverifytext','fid',$fid['fid']);
    if($text){$desc=$text[0]['val'];}else{$desc='';}
    $am=null;$stf='';
    $arr =array('country','institution','facility','tbsnum','vdate','age','gender','marital','other_marital','occupation','education','ward','village','location','tencell','phone1','phone2','hivpos','hivposyr','onart','onartyr','tbcasecontact','chronicdx','chronicillness','alcohol','alcoholpres','tobacco','tobaccopres','drug','drugpres','tbtx','tbtxyr');
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
        if(findText($fid['fid'],'tencell')){$leadertencell=findText($fid['fid'],'tencell');}else{$leadertencell='';}//print_r($leadertencell);
        if(findText($fid['fid'],'phone1')){$phone1=findText($fid['fid'],'phone1');}else{$phone1='';}//print_r($phone1);
        if(findText($fid['fid'],'phone2')){$phone2=findText($fid['fid'],'phone2');}else{$phone2='';}//print_r($phone2);
        if(findText($fid['fid'],'chronicillness')){$chronicillness=findText($fid['fid'],'chronicillness');}else{$chronicillness='';}//print_r($chronicillness);

        //print_r($am);
        if($override->selectData4('crf02_pg01','country',$am['country'],'institution',$am['institution'],'facility',$am['facility'],'tbsnum',$am['tbsnum'])){$dup=true;echo$am['country'].''.$am['institution'].''.$am['facility'].''.$am['tbsnum'].'  ,  ';}else{$dup=false;}//echo$f.' , ';$f++;
        if($dbv && $dup==false){
            $user->createRecord('crf02_pg01', array(
                'country' => $am['country'],
                'institution' => $am['institution'],
                'facility' => $am['facility'],
                'tbsnum' => $am['tbsnum'],
                'vdate' => $am['vdate'],
                'age' => $am['age'],
                'gender' => $am['gender'],
                'marital' => $am['marital'],
                'other_marital' => $am['other_marital'],
                'occupation' => $am['occupation'],
                'education' => $am['education'],
                'ward'=>$ward,
                'village' => $village,
                'location' => $am['location'],
                'tencell' => $leadertencell,
                'phone1' => $phone1,
                'phone2' => $phone2,
                'hivpos' => $am['hivpos'],
                'hivposyr' => $am['hivposyr'],
                'onart' => $am['onart'],
                'onartyr'=>$am['onartyr'],
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
                'tbtxyr'=>$am['tbtxyr'],
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