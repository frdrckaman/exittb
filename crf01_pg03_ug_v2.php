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
                            case 'ptenum':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'smearDone':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                //$frd[$va] = $bx[0]['value'];
                                $frd[$va] = $bx[0]['label'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'smear':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                //$frd[$va] = $bx[0]['value'];
                                $frd[$va] = $bx[0]['label'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tbscore':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'cxray':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                //$frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'cxtbcaseDone':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'cxtbcase':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                //$frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'lf_Lamdone':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'lf_LamResults':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                //$frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'diagnosis':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'formdate':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                //$frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'dateVerified':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'compiledBy':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                //$frd[$va] = $bx[0]['value'];
                                break;
                            case 'verifiedBy':
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
                            case 'ptenum':
                                $frd[$va] =$f['val'];
                                break;
                            case 'smearDone':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                //$frd[$va] = $bx[0]['value'];
                                $frd[$va] = $bx[0]['label'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'smear':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                //$frd[$va] = $bx[0]['value'];
                                $frd[$va] = $bx[0]['label'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'tbscore':
                                $frd[$va] =$f['val'];
                                break;
                            case 'cxray':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                //$frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'cxtbcaseDone':
                                $frd[$va] =$f['val'];
                                break;
                            case 'cxtbcase':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                //$frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'lf_Lamdone':
                                $frd[$va] =$f['val'];
                                break;
                            case 'lf_LamResults':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                //$frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'diagnosis':
                                $frd[$va] =$f['val'];
                                break;
                            case 'formdate':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                //$frd[$va] = $bx[0]['value'];
                                //$frd[$va] .=$f['val'];
                                break;
                            case 'dateVerified':
                                $frd[$va] .=$f['val'];
                                break;
                            case 'compiledBy':
                                $bx=$override->get('boxes','bid',$f['bid']);//print_r($bx[0]['bid']);echo' , ';
                                $frd[$va] = $bx[0]['label'];
                                //$frd[$va] = $bx[0]['value'];
                                break;
                            case 'verifiedBy':
                                $frd[$va] .=$f['val'];
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
foreach($override->get('forms','qid',76) as $fid){//echo$fr.'  , ';
    $dbv=variable($fid['fid']);$am=null;
    $am=null;$stf='';
    $arr = array('country','institution','facility','tbenum','ptenum','tbsx01','tbsx01days','tbsx02','tbsx02days','tbsx03','tbsx03days','tbsx04','tbsx04days','tbsx05','tbsx05days','tbsx06','tbsx06days','tbsx_other','cough_care','carefac','othercarefac','xpertsputumDone','xpertsputum','xpertstoolDone','xpertstool');
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
    try {
        //print_r($am);
        if($override->selectData4('crf01_pg03_ug_v2','country',$am['country'],'institution',$am['institution'],'facility',$am['facility'],'tbsnum',$am['tbsnum'])){$dup=true;}else{$dup=false;}//echo$f.' , ';$f++;
        $study_id = $am['country'].$am['institution'].$am['facility'].$am['tbsnum'];
        if($dbv && $dup==false){
            $user->createRecord('crf01_pg03_ug_v2', array(
                'country' => $am['country'],
                'institution' => $am['institution'],
                'facility' => $am['facility'],
                'tbsnum' => $am['tbsnum'],
                'study_id' => $study_id,
                'ptenum' => $am['ptenum'],
                'smearDone' => $am['smearDone'],
                'smear' => $am['smear'],
                'tbscore' => $am['tbscore'],
                'cxray' => $am['cxray'],
                'cxtbcaseDone' => $am['cxtbcaseDone'],
                'cxtbcase' => $am['cxtbcase'],
                'lf_Lamdone'=>$am['lf_Lamdone'],
                'lf_LamResults' => $am['lf_LamResults'],
                'diagnosis' => $am['diagnosis'],
                'formdate' => $am['formdate'],
                'dateVerified' => $am['dateVerified'],
                'compiledBy' => $am['compiledBy'],
                'verifiedBy' => $am['verifiedBy'],
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


