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
                            case 'hospnum':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'vdate':
                                $frd[$va] .=$f['val'];print_r($frd[$va]);echo ' , ';
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
                            case 'hospnum':
                                $frd[$va] =$f['val'];
                                break;
                            case 'vdate':
                                $frd[$va] =$f['val'];print_r($frd[$va]);echo ' , ';
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
//variable(1);
//print_r(findText(3,'ward'));
foreach($override->get('forms','qid',41) as $fid){//echo$fr.'  , ';
    $dbv=variable($fid['fid']);$am=null;
    $text=$override->get('formboxverifytext','fid',$fid['fid']);
    if($text){$desc=$text[0]['val'];}else{$desc='';}
    $am=null;$stf='';
    $arr = array('country','institution','facility','tbenum','hospnum','vdate','clinic','age','gender','marital','occupation','education','location','hivpos','hivposyr','hivres','onart','onartyr','tbcasecontact','chronicillness','chronicdx','alcohol','alcoholpres','tobacco','tobaccopres','drug','drugpres','tbtx','tbtxyr');
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
        // print_r($am['drug']);echo'  ,  ';
        if(findText($fid['fid'],'hospnum')){$hospnum=findText($fid['fid'],'hospnum');}else{$hospnum='';}//print_r($ward);
        if(findText($fid['fid'],'chronicdx')){$chronicdx=findText($fid['fid'],'chronicdx');}else{$chronicdx='';}//print_r($village);

        //print_r($am['drug']);echo' , ';
        if($override->selectData4('crf01_pg01','country',$am['country'],'institution',$am['institution'],'facility',$am['facility'],'tbenum',preg_replace('/[^A-Za-z0-9\-]/', '', $am['tbenum']))){$dup=true;}else{$dup=false;}//echo$f.' , ';$f++;
        //print_r($am);echo '<br>';
        $study_id = $am['country'].$am['institution'].$am['facility'].$am['tbenum'];
        if($dbv && $dup==false){
            $user->createRecord('crf01_pg01', array(
                'country' => $am['country'],
                'institution' => $am['institution'],
                'facility' => $am['facility'],
                'tbenum' => $am['tbenum'],
                'study_id' => $study_id,
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

$arr1 = array('country','institution','facility','tbenum','hospnum','vdate','clinic','age','gender','marital','occupation','education','location','hivpos','hivposyr','hivres','onart','onartyr','tbcasecontact','chronicillness','chronicdx','alcohol','alcoholpres','tobacco','tobaccopres','drug','drugpres','tbtx','tbtxyr');
$arr2 = array('country','institution','facility','tbenum','tbsx01','tbsx01days','tbsx02','tbsx02days','tbsx03','tbsx03days','tbsx04','tbsx04days','tbsx05','tbsx05days','tbsx06','tbsx_other','tbsx06days','cough_care','carefac','othercarefac');
$arr3 = array('country','institution','facility','tbenum','xpertsputum','xpertstool','smear','cxray','tbscore','cxtbcase','formdate');
$arrE1 = array('country','institution','facility','enum','qn01_1','qn01_2','qn01_3','qn01_4','qn01_5','qn02_1','qn02_2','qn02_3','qn02_4');
$arrE2 = array('country','institution','facility','enum','qn02_5','qn02_6','qn02_7','qn02_8a','qn02_8b','qn02_9a','qn02_9b','qn02_10','qn02_11','qn02_12','qn02_13a','qn02_13b','qn02_14a','qn02_14b','qn02_15','qn02_16');
$arrE3 = array('country','institution','facility','enum','qqn02_17','qn02_18','qqn02_19','qn02_20','qn02_21','qn02_22','qn02_23a','qn02_23b','qn02_24a','qn02_24b','qn02_25');
$arrE4 = array('country','institution','facility','enum','intsign','intcode','formdate','compinitials','compsign','compdate');