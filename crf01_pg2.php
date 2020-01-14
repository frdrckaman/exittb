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
                            case 'tbenum':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'tbsx01':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tbsx01days':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'tbsx02':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tbsx02days':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'tbsx03':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tbsx03days':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'tbsx04':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tbsx04days':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'tbsx05':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tbsx05days':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'tbsx06':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tbsx_other':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'tbsx06days':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'cough_care':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                break;
                            case 'carefac':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'othercarefac':
                                $frd[$va] .=$f['val'];
                                break;
                        }
                    }else{
                        switch ($va) {
                            case 'country':
                                $frd[$va] = $f['val'];
                                break;
                            case 'institution':
                                $frd[$va] = $f['val'];
                                break;
                            case 'facility':
                                $frd[$va] = $f['val'];
                                break;
                            case 'tbenum':
                                $frd[$va] = $f['val'];
                                break;
                            case 'tbsx01':
                                $bx = $override->get('boxes', 'bid', $f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tbsx01days':
                                $frd[$va] = $f['val'];
                                break;
                            case 'tbsx02':
                                $bx = $override->get('boxes', 'bid', $f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tbsx02days':
                                $frd[$va] = $f['val'];
                                break;
                            case 'tbsx03':
                                $bx = $override->get('boxes', 'bid', $f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tbsx03days':
                                $frd[$va] = $f['val'];
                                break;
                            case 'tbsx04':
                                $bx = $override->get('boxes', 'bid', $f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tbsx04days':
                                $frd[$va] = $f['val'];
                                break;
                            case 'tbsx05':
                                $bx = $override->get('boxes', 'bid', $f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tbsx05days':
                                $frd[$va] = $f['val'];
                                break;
                            case 'tbsx06':
                                $bx = $override->get('boxes', 'bid', $f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'tbsx_other':
                                $frd[$va] = $f['val'];
                                break;
                            case 'tbsx06days':
                                $frd[$va] = $f['val'];
                                break;
                            case 'cough_care':
                                $bx = $override->get('boxes', 'bid', $f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['value'];
                                break;
                            case 'carefac':
                                $bx = $override->get('boxes', 'bid', $f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                break;
                            case 'othercarefac':
                                $frd[$va] = $f['val'];
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

//qid = 50 , 42
foreach($override->get('forms','qid',50) as $fid){//echo$fr.'  , ';
    $dbv=variable($fid['fid']);$am=null;
    $text=$override->get('formboxverifytext','fid',$fid['fid']);
    if($text){$desc=$text[0]['val'];}else{$desc='';}
    $am=null;$stf='';
    $arr = array('country','institution','facility','tbenum','tbsx01','tbsx01days','tbsx02','tbsx02days','tbsx03','tbsx03days','tbsx04','tbsx04days','tbsx05','tbsx05days','tbsx06','tbsx_other','tbsx06days','cough_care','carefac','othercarefac');
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
        if(findText($fid['fid'],'tbsx_other')){$tbsx_other=findText($fid['fid'],'tbsx_other');}else{$tbsx_other=' ';}//print_r($ward);
        if(findText($fid['fid'],'othercarefac')){$othercarefac=findText($fid['fid'],'othercarefac');}else{$othercarefac=' ';}//print_r($village);

        //print_r($am);echo' , ';
        $study_id = $am['country'].$am['institution'].$am['facility'].$am['tbenum'];
        $cntry=preg_replace('/[^A-Za-z0-9\-]/', '', $am['country']);
        $inst=preg_replace('/[^A-Za-z0-9\-]/', '', $am['institution']);
        $faci=preg_replace('/[^A-Za-z0-9\-]/', '', $am['facility']);
        $tbnum=preg_replace('/[^A-Za-z0-9\-]/', '', $am['tbenum']);
        if($override->selectData4('crf01_pg02','country',$am['country'],'institution',$am['institution'],'facility',$am['facility'],'tbenum',$tbnum)){$dup=true;}else{$dup=false;}//echo$f.' , ';$f++;
        if($dbv && $dup==false){
            //print_r($tbsx_other);
            $user->createRecord('crf01_pg02', array(
                'country' => $cntry,
                'institution' => $inst,
                'facility' => $faci,
                'tbenum' => $tbnum,
                'study_id' => $study_id,
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
                'tbsx06' => $am['tbsx06'],
                'tbsx_other'=> $tbsx_other,
                'tbsx06days' => $am['tbsx06days'],
                'cough_care' => $am['cough_care'],
                'carefac' => $am['carefac'],
                'othercarefac' => $othercarefac,
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