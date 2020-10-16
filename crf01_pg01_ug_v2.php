<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$var=null;$x=0;$y=0;$var1=null;
$cnt=null;$frd=null;$dup=false;
$study_id=null;

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
        foreach($var as $va){//print_r($va);echo '<br>';
            foreach($v1 as $f){
                if($f['varname'] == $va){//print_r($f['val']);echo '<br>';
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
                            case 'tbenum':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'ptenum':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'hospnum':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'vdate':
                                $frd[$va] .=$f['val'];//print_r($frd[$va]);echo ' , ';
                                break;
                            case 'clinic':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'age':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'gender':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'marital':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'occupation':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'education':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'location':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'hivpos':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'hivposyr':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'hivres':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'onart':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'onartyr':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'clinicalStage':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'missing':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'whoStage':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'tbcasecontact':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'chronicillness':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'chronicdx':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'alcohol':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'alcoholpres':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tobacco':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tobaccopres':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'drug':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'drugpres':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tbtx':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tbtxyr':
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
                            case 'tbenum':
                                $frd[$va] =$f['val'];
                                break;
                            case 'ptenum':
                                $frd[$va] =$f['val'];
                                break;
                            case 'hospnum':
                                $frd[$va] =$f['val'];
                                break;
                            case 'vdate':
                                $frd[$va] =$f['val'];//print_r($frd[$va]);echo ' , ';
                                break;
                            case 'clinic':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'age':
                                $frd[$va] =$f['val'];
                                break;
                            case 'gender':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'marital':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'occupation':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'education':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'location':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'hivpos':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'hivposyr':
                                $frd[$va] =$f['val'];
                                break;
                            case 'hivres':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'onart':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'onartyr':
                                $frd[$va] =$f['val'];
                                break;
                            case 'clinicalStage':
                                $frd[$va] =$f['val'];
                                break;
                            case 'missing':
                                $frd[$va] =$f['val'];
                                break;
                            case 'whoStage':
                                $frd[$va] =$f['val'];
                                break;
                            case 'tbcasecontact':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'chronicillness':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'chronicdx':
                                $frd[$va] =$f['val'];
                                break;
                            case 'alcohol':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'alcoholpres':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tobacco':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tobaccopres':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'drug':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'drugpres':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tbtx':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tbtxyr':
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
//qid 74
foreach($override->get('forms','qid',74) as $fid){//echo$fr.'  , ';
    $dbv=variable($fid['fid']);$am=null;
    $text=$override->get('formboxverifytext','fid',$fid['fid']);
    if($text){$desc=$text[0]['val'];}else{$desc='';}
    $am=null;$stf='';
    //print_r($dbv);
    $arr = array('country','institution','facility','tbenum','ptenum','hospnum','vdate','clinic','age','gender','marital','occupation','education','location','hivpos','hivposyr','hivres','onart','onartyr','clinicalStage','missing','whoStage','tbcasecontact','chronicillness','chronicdx','alcohol','alcoholpres','tobacco','tobaccopres','drug','drugpres','tbtx','tbtxyr');
    foreach($arr as $ar){//print_r($ar);
        if($dbv){
            if(array_key_exists($ar,$dbv)){
                if(isset($am[$ar])){$am[$ar] .= $dbv[$ar];}else{$am[$ar] = $dbv[$ar];}
            }else {
                if(isset($am[$ar])){$am[$ar] .= ' ';}else{$am[$ar] = ' ';}
            }
            $x++;
        }
    }
    try {//print_r( $override->getValueT($fid['fid']));echo ' , ';
        //print_r($am['drug']);echo'  ,  ';
        if(findText($fid['fid'],'hospnum')){$hospnum=findText($fid['fid'],'hospnum');}else{$hospnum=' ';}//print_r($ward);
        if(findText($fid['fid'],'chronicdx')){$chronicdx=findText($fid['fid'],'chronicdx');}else{$chronicdx=' ';}//print_r($village);

        //print_r($am['drug']);echo' , ';
        if($override->selectData4('crf01_pg01_ug_v2','country',$am['country'],'institution',$am['institution'],'facility',$am['facility'],'tbenum',preg_replace('/[^A-Za-z0-9\-]/', '', $am['tbenum']))){$dup=true;}else{$dup=false;}//echo$f.' , ';$f++;
        //print_r($am);echo '<br>';
        $study_id = $am['country'].$am['institution'].$am['facility'].$am['tbenum'];
        $cntry=preg_replace('/[^A-Za-z0-9\-]/', '', $am['country']);
        $inst=preg_replace('/[^A-Za-z0-9\-]/', '', $am['institution']);
        $faci=preg_replace('/[^A-Za-z0-9\-]/', '', $am['facility']);
        $tbnum=preg_replace('/[^A-Za-z0-9\-]/', '', $am['tbenum']);
        //print_r($fid['fid']);echo ' , ';
        if($dbv && $dup==false){print_r($am);echo ' | ';
            $user->createRecord('crf01_pg01_ug_v2', array(
                'country' => $cntry,
                'institution' => $inst,
                'facility' => $faci,
                'tbenum' => $tbnum,
                'study_id' => $study_id,
                'ptenum'=>$am['ptenum'],
                'hospnum' => $hospnum,
                'vdate' => $am['vdate'],
                'clinic' => $am['clinic'],
                'age' => $am['age'],
                'gender' => $am['gender'],
                'marital' => $am['marital'],
                'occupation' => $am['occupation'],
                'education' => $am['education'],
                'location' => $am['location'],
                'hivpos' => $am['hivpos'],
                'hivposyr' => $am['hivposyr'],
                'hivres' => $am['hivres'],
                'onart'=>$am['onart'],
                'clinicalStage'=>$am['clinicalStage'],
                'missing'=>$am['missing'],
                'whoStage'=>$am['whoStage'],
                'onartyr' => $am['onartyr'],
                'tbcasecontact' => $am['tbcasecontact'],
                'chronicillness' => $am['chronicillness'],
                'chronicdx' => $chronicdx,
                'alcohol' => $am['alcohol'],
                'alcoholpres' => $am['alcoholpres'],
                'tobacco'=>$am['tobacco'],
                'tobaccopres' => $am['tobaccopres'],
                'drug' => $am['drug'],
                'drugpres' => $am['drugpres'],
                'tbtx' => $am['tbtx'],
                'tbtxyr' => $am['tbtxyr'],
                'status' => 1,
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

$arr1 = array('country','institution','facility','tbenum','ptenum','hospnum','vdate','clinic','age','gender','marital','occupation','education','location','hivpos','hivposyr','hivres','onart','onartyr','clinicalStage','missing','whoStage','tbcasecontact','chronicillness','chronicdx','alcohol','alcoholpres','tobacco','tobaccopres','drug','drugpres','tbtx','tbtxyr');
$arr2 = array('country','institution','facility','tbenum','ptenum','tbsx01','tbsx01days','tbsx02','tbsx02days','tbsx03','tbsx03days','tbsx04','tbsx04days','tbsx05','tbsx05days','tbsx06','tbsx06days','tbsx_other','cough_care','carefac','othercarefac','xpertsputumDone','xpertsputum','xpertstoolDone','xpertstool');
$arr3 = array('country','institution','facility','tbenum','ptenum','smearDone','smear','tbscore','cxray','cxtbcaseDone','cxtbcase','lf_Lamdone','lf_LamResults','diagnosis','formdate','dateVerified','compiledBy','verifiedBy');
