<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
include 'pdftoimage/Pdf.php';

$pageError = null;$successMessage = null;$errorM = false;$errorMessage = null;
if($user->isLoggedIn()){
    $table = 'crf01_ug_pg01';
    //$table = 'crf01_pg01';
    /*$querys = $override->get('fix_data','pg',2);print_r($query);
    $qfid = $query[0]['fid'];
    foreach ($querys as $query){
        $crfData = $override->get($table,'study_id',$query['study_id']);
        //$crfData = $override->get('crf01_pg02','study_id',$query['study_id']);
        if($crfData){
            try {
                $user->updateRecord('fix_data', array('fid' => $crfData[0]['fid']), $query['id']);
                echo 'Good';
            } catch (Exception $e) {
            }

        }
    }*/


    if ($_GET['id'] == 1){
        if(Input::exists('post')){
            if(Input::get('crf01_pg1')){
                $validate = new validate();
                $validate = $validate->check($_POST, array(
                    'study_id' => array(
                        'required' => true,
                    ),

                ));
                if ($validate->passed()) {
                    try {
                        $user->updateRecord($table, array(
                            'study_id' => Input::get('study_id'),
                            'hospnum' => Input::get('hospnum'),
                            'vdate' => Input::get('vdate'),
                            'clinic' => Input::get('clinic'),
                            'age' => Input::get('age'),
                            'gender' => Input::get('gender'),
                            'marital' => Input::get('marital'),
                            'occupation' => Input::get('occupation'),
                            'education' => Input::get('education'),
                            'location' => Input::get('location'),
                            'hivpos' => Input::get('hivpos'),
                            'hivposyr' => Input::get('hivposyr'),
                            'hivres' => Input::get('hivres'),
                            'onart'=>Input::get('onart'),
                            'onartyr' => Input::get('onartyr'),
                            'tbcasecontact' => Input::get('tbcasecontact'),
                            'chronicillness' => Input::get('chronicillness'),
                            'chronicdx' => Input::get('chronicdx'),
                            'alcohol' => Input::get('alcohol'),
                            'alcoholpres' => Input::get('alcoholpres'),
                            'tobacco'=>Input::get('tobacco'),
                            'tobaccopres' => Input::get('tobaccopres'),
                            'drug' => Input::get('drug'),
                            'drugpres' => Input::get('drugpres'),
                            'tbtx' => Input::get('tbtx'),
                            'tbtxyr' => Input::get('tbtxyr'),
                        ),Input::get('sid'));
                        $successMessage = 'Changes Made Successful';
                        try {$user->updateRecord('fix_data', array('status' => 1), Input::get('id'));} catch (Exception $e) {}
                        unlink(Input::get('img'));
                        //$query = $override->lastRow2('data_qry','status',0,'pg',1,'id');
                        $query = $override->lastRow2('fix_data','status',0,'pg',1,'id');//print_r($query);
                        if($query){
                            $data = $override->get($table,'study_id',$query[0]['study_id']);
                            try {$user->updateRecord('fix_data', array('status' => 2), $query[0]['id']);} catch (Exception $e) {}
                            $pdf = $override->get('forms','fid',$query[0]['fid']);
                            $pathToPdf=$pdf[0]['description'];
                            $svDoc=$query[0]['study_id'].'_'.$user->data()->id.'_'.date('Y-m-d s');
                            $pdfImg = new Spatie\PdfToImage\Pdf($pathToPdf,$svDoc);
                            $pathToWhereImageShouldBeStored = '/var/www/system.exit-tb.org/public_html/crf_images/';
                            $pdfImg->saveImage($pathToWhereImageShouldBeStored);
                            $imgL='crf_images/'.$svDoc.'.jpg';
                        }else{
                            $successMessage = 'No More Forms Available';
                        }

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                } else {
                    $pageError = $validate->errors();
                }
            }
            elseif (Input::get('cl_qry')){
                $validate = new validate();
                $validate = $validate->check($_POST, array(
                    'study_id' => array(
                        'required' => true,
                    ),

                ));
                if ($validate->passed()) {
                    try {
                        $user->updateRecord($table, array(
                            'study_id' => Input::get('study_id'),
                            'hospnum' => Input::get('hospnum'),
                            'vdate' => Input::get('vdate'),
                            'clinic' => Input::get('clinic'),
                            'age' => Input::get('age'),
                            'gender' => Input::get('gender'),
                            'marital' => Input::get('marital'),
                            'occupation' => Input::get('occupation'),
                            'education' => Input::get('education'),
                            'location' => Input::get('location'),
                            'hivpos' => Input::get('hivpos'),
                            'hivposyr' => Input::get('hivposyr'),
                            'hivres' => Input::get('hivres'),
                            'onart'=>Input::get('onart'),
                            'onartyr' => Input::get('onartyr'),
                            'tbcasecontact' => Input::get('tbcasecontact'),
                            'chronicillness' => Input::get('chronicillness'),
                            'chronicdx' => Input::get('chronicdx'),
                            'alcohol' => Input::get('alcohol'),
                            'alcoholpres' => Input::get('alcoholpres'),
                            'tobacco'=>Input::get('tobacco'),
                            'tobaccopres' => Input::get('tobaccopres'),
                            'drug' => Input::get('drug'),
                            'drugpres' => Input::get('drugpres'),
                            'tbtx' => Input::get('tbtx'),
                            'tbtxyr' => Input::get('tbtxyr'),
                        ),Input::get('sid'));
                        $successMessage = 'Query added Successful';
                        try {$user->updateRecord('fix_data', array('status' => 3), Input::get('id'));} catch (Exception $e) {}
                        unlink(Input::get('img'));
                        //$query = $override->lastRow2('data_qry','status',0,'pg',1,'id');
                        $query = $override->lastRow2('fix_data','status',0,'pg',1,'id');//print_r($query);
                        if($query){
                            $data = $override->get($table,'study_id',$query[0]['study_id']);
                            try {$user->updateRecord('fix_data', array('status' => 2), $query[0]['id']);} catch (Exception $e) {}
                            $pdf = $override->get('forms','fid',$query[0]['fid']);
                            $pathToPdf=$pdf[0]['description'];
                            $svDoc=$query[0]['study_id'].'_'.$user->data()->id.'_'.date('Y-m-d s');
                            $pdfImg = new Spatie\PdfToImage\Pdf($pathToPdf,$svDoc);
                            $pathToWhereImageShouldBeStored = '/var/www/system.exit-tb.org/public_html/crf_images/';
                            $pdfImg->saveImage($pathToWhereImageShouldBeStored);
                            $imgL='crf_images/'.$svDoc.'.jpg';
                        }else{
                            $successMessage = 'No More Forms Available';
                        }

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                } else {
                    $pageError = $validate->errors();
                }
            }
        }else{
            //$query = $override->lastRow2('data_qry','status',0,'pg',1,'id');
            $query = $override->lastRow2('fix_data','status',0,'pg',1,'id');//print_r($query);
            if($query){
                $data = $override->get($table,'study_id',$query[0]['study_id']);

                try {$user->updateRecord('fix_data', array('status' => 2), $query[0]['id']);} catch (Exception $e) {}
                $pdf = $override->get('forms','fid',$query[0]['fid']);
                $pathToPdf=$pdf[0]['description'];
                $svDoc=$query[0]['study_id'].'_'.$user->data()->id.'_'.date('Y-m-d s');
                $pdfImg = new Spatie\PdfToImage\Pdf($pathToPdf,$svDoc);
                $pathToWhereImageShouldBeStored = '/var/www/system.exit-tb.org/public_html/crf_images/';
                $pdfImg->saveImage($pathToWhereImageShouldBeStored);
                $imgL='crf_images/'.$svDoc.'.jpg';
            }else{
                $successMessage = 'No More Forms Available';
            }
        }
    }
    elseif ($_GET['id'] == 2){
        if(Input::exists('post')){
            if(Input::get('crf01_pg2')){
                $validate = new validate();
                $validate = $validate->check($_POST, array(
                    'study_id' => array(
                        'required' => true,
                    ),
                ));
                if ($validate->passed()) {
                    try {
                        $user->updateRecord('crf01_pg02', array(
                            'study_id' => Input::get('study_id'),
                            'tbsx01' => Input::get('tbsx01'),
                            'tbsx01days' => Input::get('tbsx01days') ,
                            'tbsx02' => Input::get('tbsx02'),
                            'tbsx02days' => Input::get('tbsx02days'),
                            'tbsx03'=>Input::get('tbsx03'),
                            'tbsx03days' => Input::get('tbsx03days'),
                            'tbsx04' => Input::get('tbsx04'),
                            'tbsx04days' => Input::get('tbsx04days'),
                            'tbsx05' => Input::get('tbsx05'),
                            'tbsx05days' => Input::get('tbsx05days'),
                            'tbsx06' => Input::get('tbsx06'),
                            'tbsx_other'=> Input::get('tbsx_other'),
                            'tbsx06days' => Input::get('tbsx06days'),
                            'cough_care' => Input::get('cough_care'),
                            'carefac' => Input::get('carefac'),
                            'othercarefac' => Input::get('othercarefac'),
                        ),Input::get('sid'));
                        $successMessage = 'Changes Made Successful';
                        try {$user->updateRecord('fix_data', array('status' => 1), Input::get('id'));} catch (Exception $e) {}
                        unlink(Input::get('img'));
                        $query = $override->lastRow2('fix_data','status',0,'pg',2,'id');//print_r($query);
                        if($query){
                            $data = $override->get('crf01_pg02','study_id',$query[0]['study_id']);
                            try {$user->updateRecord('fix_data', array('status' => 2), $query[0]['id']);} catch (Exception $e) {}
                            $pdf = $override->get('forms','fid',$query[0]['fid']);
                            $pathToPdf=$pdf[0]['description'];
                            $svDoc=$query[0]['study_id'].'_'.$user->data()->id.'_'.date('Y-m-d s');
                            $pdfImg = new Spatie\PdfToImage\Pdf($pathToPdf,$svDoc);
                            $pathToWhereImageShouldBeStored = '/var/www/system.exit-tb.org/public_html/crf_images/';
                            $pdfImg->saveImage($pathToWhereImageShouldBeStored);
                            $imgL='crf_images/'.$svDoc.'.jpg';
                        }else{
                            $successMessage = 'No More Forms Available';
                        }
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                } else {
                    $pageError = $validate->errors();
                }
            }
            elseif (Input::get('cl_qry')){
                $validate = new validate();
                $validate = $validate->check($_POST, array(
                    'study_id' => array(
                        'required' => true,
                    ),
                ));
                if ($validate->passed()) {
                    try {
                        $user->updateRecord('crf01_pg02', array(
                            'study_id' => Input::get('study_id'),
                            'tbsx01' => Input::get('tbsx01'),
                            'tbsx01days' => Input::get('tbsx01days') ,
                            'tbsx02' => Input::get('tbsx02'),
                            'tbsx02days' => Input::get('tbsx02days'),
                            'tbsx03'=>Input::get('tbsx03'),
                            'tbsx03days' => Input::get('tbsx03days'),
                            'tbsx04' => Input::get('tbsx04'),
                            'tbsx04days' => Input::get('tbsx04days'),
                            'tbsx05' => Input::get('tbsx05'),
                            'tbsx05days' => Input::get('tbsx05days'),
                            'tbsx06' => Input::get('tbsx06'),
                            'tbsx_other'=> Input::get('tbsx_other'),
                            'tbsx06days' => Input::get('tbsx06days'),
                            'cough_care' => Input::get('cough_care'),
                            'carefac' => Input::get('carefac'),
                            'othercarefac' => Input::get('othercarefac'),
                        ),$data[0]['id']);
                        $successMessage = 'Query added Successful';
                        try {$user->updateRecord('fix_data', array('status' => 3), Input::get('id'));} catch (Exception $e) {}
                        unlink(Input::get('img'));
                        $query = $override->lastRow2('fix_data','status',0,'pg',1,'id');//print_r($query);
                        if($query){
                            $data = $override->get('crf01_pg02','study_id',$query[0]['study_id']);
                            try {$user->updateRecord('fix_data', array('status' => 2), $query[0]['id']);} catch (Exception $e) {}
                            $pdf = $override->get('forms','fid',$query[0]['fid']);
                            $pathToPdf=$pdf[0]['description'];
                            $svDoc=$query[0]['study_id'].'_'.$user->data()->id.'_'.date('Y-m-d s');
                            $pdfImg = new Spatie\PdfToImage\Pdf($pathToPdf,$svDoc);
                            $pathToWhereImageShouldBeStored = '/var/www/system.exit-tb.org/public_html/crf_images/';
                            $pdfImg->saveImage($pathToWhereImageShouldBeStored);
                            $imgL='crf_images/'.$svDoc.'.jpg';
                        }else{
                            $successMessage = 'No More Forms Available';
                        }
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                } else {
                    $pageError = $validate->errors();
                }
            }
        }
        else{
            $query = $override->lastRow2('fix_data','status',0,'pg',2,'id');//print_r($query);
            if($query){
                $data = $override->get('crf01_pg02','study_id',$query[0]['study_id']);
                try {$user->updateRecord('fix_data', array('status' => 2), $query[0]['id']);} catch (Exception $e) {}
                $pdf = $override->get('forms','fid',$query[0]['fid']);
                $pathToPdf=$pdf[0]['description'];
                $svDoc=$query[0]['study_id'].'_'.$user->data()->id.'_'.date('Y-m-d s');
                $pdfImg = new Spatie\PdfToImage\Pdf($pathToPdf,$svDoc);
                $pathToWhereImageShouldBeStored = '/var/www/system.exit-tb.org/public_html/crf_images/';
                $pdfImg->saveImage($pathToWhereImageShouldBeStored);
                $imgL='crf_images/'.$svDoc.'.jpg';
            }else{
                $successMessage = 'No More Forms Available';
            }
        }
    }

}else{
    Redirect::to('index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> EXIT-TB </title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/ico" href="favicon.ico">
    <link href="css/stylesheets.css" rel="stylesheet" type="text/css">

    <script type='text/javascript' src='js/plugins/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='js/plugins/jquery/jquery-ui.min.js'></script>
    <script type='text/javascript' src='js/plugins/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='js/plugins/jquery/globalize.js'></script>
    <script type='text/javascript' src='js/plugins/bootstrap/bootstrap.min.js'></script>

    <script type='text/javascript' src='js/plugins/uniform/jquery.uniform.min.js'></script>
    <script type='text/javascript' src='js/plugins/datatables/jquery.dataTables.min.js'></script>

    <!--<script type='text/javascript' src='js/jquery.dataTables.js'></script>
    <script type='text/javascript' src='js/dataTables.bootstrap.min.js'></script>-->

    <script type='text/javascript' src='js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'></script>
    <script type='text/javascript' src='js/plugins/uniform/jquery.uniform.min.js'></script>

    <script type='text/javascript' src='js/plugins/noty/jquery.noty.js'></script>
    <script type='text/javascript' src='js/plugins/noty/layouts/topCenter.js'></script>
    <script type='text/javascript' src='js/plugins/noty/layouts/topLeft.js'></script>
    <script type='text/javascript' src='js/plugins/noty/layouts/topRight.js'></script>
    <script type='text/javascript' src='js/plugins/noty/themes/default.js'></script>

    <script type='text/javascript' src='js/morris.min.js'></script>
    <script type='text/javascript' src='js/raphael.min.js'></script>

    <script type='text/javascript' src='js/plugins.js'></script>
    <script type='text/javascript' src='js/actions.js'></script>
    <script type='text/javascript' src='js/settings.js'></script>
    <script src="/js/pdfobject.js"></script>
</head>
<body class="bg-img-num1">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php include'topBar.php'?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-0 col-md-6">
            <?php if($errorMessage){?>
                <div class="block">
                    <div class="alert alert-danger">
                        <b>Error!</b> <?=$errorMessage?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            <?php }elseif($pageError){?>
                <div class="block col-md-12">
                    <div class="alert alert-danger">
                        <b>Error!</b> <?php foreach($pageError2 as $error){echo $error.' , ';}?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            <?php }elseif($successMessage){?>
                <div class="block">
                    <div class="alert alert-success">
                        <b>Success!</b> <?=$successMessage?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            <?php }?>
            <div class="block">
                <div class="content">
                    <?php if($query){if($_GET['id'] == 1){?>
                        <form method="post">
                            <div class="modal-body clearfix">
                                <div class="controls">
                                    <input type="hidden" name="img" value="<?=$imgL?>">
                                    <input type="hidden" name="sid" value="<?=$data[0]['id']?>">
                                    <input type="hidden" name="id" value="<?=$query[0]['id']?>">
                                    <div class="form-row" id="s1">
                                        <div class="col-md-1">STUDY ID:</div>
                                        <div class="col-md-3" id="v_code">
                                            <input type="text" name="study_id" class="form-control" value="<?=$data[0]['study_id']?>" required=""/>
                                        </div>
                                        <div class="col-md-1">HOSPITAL No:</div>
                                        <div class="col-md-3" id="v_code">
                                            <input type="text" name="hospnum" class="form-control" value="<?=$data[0]['hospnum']?>" />
                                        </div>
                                        <div class="col-md-1">VISIT DATE:</div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="text" name="vdate" class="form-control" value="<?=$data[0]['vdate']?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>&nbsp;</h6>
                                    <div class="form-row">
                                        <div class="col-md-1">CLINIC:</div>
                                        <div class="col-md-11">
                                            <div class="radio-inline">
                                                <label><input type="radio" value="OPD" name="clinic" <?php if($data[0]['clinic'] == 'OPD'){echo 'checked';}?>/> OPD</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" value="CTC/CCC" name="clinic" <?php if($data[0]['clinic'] == 'CTC/CCC'){echo 'checked';}?>/> CTC/CCC</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" value="DIABETIC" name="clinic" <?php if($data[0]['clinic'] == 'DIABETIC'){echo 'checked';}?>/> DIABETIC</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" value="ANC" name="clinic" <?php if($data[0]['clinic'] == 'ANC'){echo 'checked';}?>/> ANC</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" value="PMCT" name="clinic" <?php if($data[0]['clinic'] == 'PMCT'){echo 'checked';}?>/> PMCT</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" value="LABOUR WARD" name="clinic" <?php if($data[0]['clinic'] == 'LABOUR WARD'){echo 'checked';}?>/> LABOUR WARD</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" value="FP" name="clinic" <?php if($data[0]['clinic'] == 'FP'){echo 'checked';}?>/> FP</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" value="Post-natal/MCH" name="clinic" <?php if($data[0]['clinic'] == 'Post-natal/MCH'){echo 'checked';}?>/> Post-natal/MCH</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="clinic" /> <strong>Uncheck</strong></label>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>&nbsp;</h6>
                                    <div class="form-row" id="s1">
                                        <div class="col-md-1">AGE:</div>
                                        <div class="col-md-2" id="v_code">
                                            <input type="number" name="age" value="<?=$data[0]['age']?>" class="form-control"  />
                                        </div>
                                        <div class="col-md-2">GENDER:</div>
                                        <div class="col-md-7">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="gender" value="Male" <?php if($data[0]['gender'] == 'Male'){echo 'checked';}?>/> MALE</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="gender" value="Female" <?php if($data[0]['gender'] == 'Female'){echo 'checked';}?>/> FEMALE</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="gender" /> <strong>Uncheck</strong></label>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>&nbsp;</h6>
                                    <div class="form-row">
                                        <div class="col-md-2">MARITAL STATUS:</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="marital" value="Single" <?php if($data[0]['marital'] == 'Single'){echo 'checked';}?>/> Single</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="marital" value="Married" <?php if($data[0]['marital'] == 'Married'){echo 'checked';}?>/> Married</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="marital" value="Divorced" <?php if($data[0]['marital'] == 'Divorced'){echo 'checked';}?>/> Divorced</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="marital" value="Separated" <?php if($data[0]['marital'] == 'Separated'){echo 'checked';}?>/> Separated</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="marital" value="Cohabited" <?php if($data[0]['marital'] == 'Cohabited'){echo 'checked';}?>/> Cohabited</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="marital" value="Widow/Widower" <?php if($data[0]['marital'] == 'Widow/Widower'){echo 'checked';}?>/> Widow/Widower</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="marital" /> <strong>Uncheck</strong></label>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>&nbsp;</h6>
                                    <div class="form-row">
                                        <div class="col-md-2">OCCUPATION:</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="occupation" value="None" <?php if($data[0]['occupation'] == 'None'){echo 'checked';}?>/> None</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="occupation" value="Employed" <?php if($data[0]['occupation'] == 'Employed'){echo 'checked';}?>/> Employed</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="occupation" value="Peasant" <?php if($data[0]['occupation'] == 'Peasant'){echo 'checked';}?>/> Peasant</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="occupation" value="Business" <?php if($data[0]['occupation'] == 'Business'){echo 'checked';}?>/> Business/Vendor/Petty traders</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="occupation" value="Housewife" <?php if($data[0]['occupation'] == 'Housewife'){echo 'checked';}?>/> Housewife</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="occupation" value="Student" <?php if($data[0]['occupation'] == 'Student'){echo 'checked';}?>/> Student</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="occupation" value="Not applicable" <?php if($data[0]['occupation'] == 'Not applicable'){echo 'checked';}?>/> Not applicable</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="occupation" /> <strong>Uncheck</strong></label>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>&nbsp;</h6>
                                    <div class="form-row">
                                        <div class="col-md-2">EDUCATION LEVEL:</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="education" value="Never attended" <?php if($data[0]['education'] == 'Never attended'){echo 'checked';}?>/> Never attended</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="education" value="Primary education" <?php if($data[0]['education'] == 'Primary education'){echo 'checked';}?>/> Primary education</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="education" value="Secondary education" <?php if($data[0]['education'] == 'Secondary education'){echo 'checked';}?>/> Secondary education</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="education" value="Tertiary education" <?php if($data[0]['education'] == 'Tertiary education'){echo 'checked';}?>/> Tertiary education</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="education" value="Adult education" <?php if($data[0]['education'] == 'Adult education'){echo 'checked';}?>/> Adult education</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="education" value="Vocational training" <?php if($data[0]['education'] == 'Vocational training'){echo 'checked';}?>/> Vocational training</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="education" value="Religious education" <?php if($data[0]['education'] == 'Religious education'){echo 'checked';}?>/> Religious education</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="education" /> <strong>Uncheck</strong></label>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>&nbsp;</h6>
                                    <div class="form-row">
                                        <div class="col-md-2">LOCATION:</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="location" value="Urban" <?php if($data[0]['location'] == 'Urban'){echo 'checked';}?>/> Urban</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="location" value="Rural" <?php if($data[0]['location'] == 'Rural'){echo 'checked';}?>/> Rural</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="location" /> <strong>Uncheck</strong></label>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>&nbsp;</h6>
                                    <h6>&nbsp;</h6>
                                    <div class="form-row">
                                        <div class="col-md-2">QN1(a):</div>
                                        <div class="col-md-4">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="hivpos" value="Yes" <?php if($data[0]['hivpos'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="hivpos" value="No" <?php if($data[0]['hivpos'] == 'No'){echo 'checked';}?>/> No</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="hivpos" /> <strong>Uncheck</strong></label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">Year tested:</div>
                                        <div class="col-md-3" id="v_code">
                                            <input type="text" name="hivposyr" class="form-control"  required="" value="<?=$data[0]['hivposyr']?>" />
                                        </div>
                                    </div>
                                    <h6>&nbsp;</h6>
                                    <div class="form-row">
                                        <div class="col-md-2">QN 1(b):</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="hivres" value="Positive" <?php if($data[0]['hivres'] == 'Positive'){echo 'checked';}?>/> Positive</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="hivres" value="Negative" <?php if($data[0]['hivres'] == 'Negative'){echo 'checked';}?>/> Negative</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="hivres" value="I don’t want to disclose" <?php if($data[0]['hivres'] == 'I don’t want to disclose'){echo 'checked';}?>/> I don’t want to disclose</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="hivres" /> <strong>Uncheck</strong></label>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>&nbsp;</h6>
                                    <div class="form-row">
                                        <div class="col-md-2">QN 1(c):</div>
                                        <div class="col-md-4">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="onart" value="Yes" <?php if($data[0]['onart'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="onart" value="No" <?php if($data[0]['onart'] == 'No'){echo 'checked';}?>/> No</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="onart" /> <strong>Uncheck</strong></label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">Year started ART:</div>
                                        <div class="col-md-3" id="v_code">
                                            <input type="number" name="onartyr" class="form-control"  value="<?=$data[0]['onartyr']?>"/>
                                        </div>
                                    </div>
                                    <h6>&nbsp;</h6>
                                    <div class="form-row">
                                        <div class="col-md-2">QN 2:</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbcasecontact" value="Yes" <?php if($data[0]['tbcasecontact'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbcasecontact" value="No" <?php if($data[0]['tbcasecontact'] == 'No'){echo 'checked';}?>/> No</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbcasecontact" value="Not sure" <?php if($data[0]['tbcasecontact'] == 'Not sure'){echo 'checked';}?>/> Not sure</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="tbcasecontact" /> <strong>Uncheck</strong></label>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>&nbsp;</h6>
                                    <div class="form-row">
                                        <div class="col-md-2">QN 3:</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="chronicillness" value="Yes" <?php if($data[0]['chronicillness'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="chronicillness" value="No" <?php if($data[0]['chronicillness'] == 'No'){echo 'checked';}?>/> No</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="chronicillness" value="Not sure" <?php if($data[0]['chronicillness'] == 'Not sure'){echo 'checked';}?>/> Not sure</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="chronicillness" /> <strong>Uncheck</strong></label>
                                            </div>
                                        </div>
                                        <h2 class="col-md-12">&nbsp;</h2>
                                        <div class="col-md-3">QN (Specify if Yes):</div>
                                        <div class="col-md-9">
                                            <input type="text" name="chronicdx" class="form-control" value="<?=$data[0]['chronicdx']?>" >
                                        </div>
                                    </div>
                                    <h2></h2>
                                    <div class="form-row">
                                        <div class="col-md-2">QN 4 (i):</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="alcohol" value="Yes" <?php if($data[0]['alcohol'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="alcohol" value="No" <?php if($data[0]['alcohol'] == 'No'){echo 'checked';}?>/> No</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="alcohol" value="N/A" <?php if($data[0]['alcohol'] == 'N/A'){echo 'checked';}?>/> N/A</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="alcohol" /> <strong>Uncheck</strong></label>
                                            </div>
                                            <div class="pull-right">
                                                <label >Current? &nbsp;</label>
                                                <div class="checkbox-inline">
                                                    <label><input type="radio" name="alcoholpres" value="Yes" <?php if($data[0]['alcoholpres'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                                </div>
                                                <div class="checkbox-inline">
                                                    <label><input type="radio" name="alcoholpres" value="No" <?php if($data[0]['alcoholpres'] == 'No'){echo 'checked';}?>/> No</label>
                                                </div>
                                                <div class="checkbox-inline">
                                                    <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="alcoholpres" /> <strong>Uncheck</strong></label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- -->
                                        <div class="col-md-2">QN 4 (ii):</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tobacco" value="Yes" <?php if($data[0]['tobacco'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tobacco" value="No" <?php if($data[0]['tobacco'] == 'No'){echo 'checked';}?>/> No</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tobacco" value="N/A" <?php if($data[0]['tobacco'] == 'N/A'){echo 'checked';}?>/> N/A</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="tobacco" /> <strong>Uncheck</strong></label>
                                            </div>
                                            <div class="pull-right">
                                                <label >Current? &nbsp;</label>
                                                <div class="checkbox-inline">
                                                    <label><input type="radio" name="tobaccopres" value="Yes" <?php if($data[0]['tobaccopres'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                                </div>
                                                <div class="checkbox-inline">
                                                    <label><input type="radio" name="tobaccopres" value="No" <?php if($data[0]['tobaccopres'] == 'No'){echo 'checked';}?>/> No</label>
                                                </div>
                                                <div class="checkbox-inline">
                                                    <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="tobaccopres" /> <strong>Uncheck</strong></label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- -->
                                        <div class="col-md-2">QN 4 (iii):</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="drug" value="Yes" <?php if($data[0]['drug'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="drug" value="No" <?php if($data[0]['drug'] == 'No'){echo 'checked';}?>/> No</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="drug" value="N/A" <?php if($data[0]['drug'] == 'N/A'){echo 'checked';}?>/> N/A</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="drug" /> <strong>Uncheck</strong></label>
                                            </div>
                                            <div class="pull-right">
                                                <label >Current? &nbsp;</label>
                                                <div class="checkbox-inline">
                                                    <label><input type="radio" name="drugpres" value="Yes" <?php if($data[0]['drugpres'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                                </div>
                                                <div class="checkbox-inline">
                                                    <label><input type="radio" name="drugpres" value="No" <?php if($data[0]['drugpres'] == 'No'){echo 'checked';}?>/> No</label>
                                                </div>
                                                <div class="checkbox-inline">
                                                    <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="drugpres" /> <strong>Uncheck</strong></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h2></h2>
                                    <div class="form-row">
                                        <div class="col-md-2">QN 5 :</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbtx" value="Yes" <?php if($data[0]['tbtx'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbtx" value="No" <?php if($data[0]['tbtx'] == 'No'){echo 'checked';}?>/> No</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label style="color: #761c19;font-weight: bolder"><input type="radio" value="" name="tbtx" /> <strong>Uncheck</strong></label>
                                            </div>
                                            <div class="pull-right">
                                                <label >If yes Year </label>
                                                <input type="number" name="tbtxyr" class="form-control" value="<?=$data[0]['tbtxyr']?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="pull-right col-md-3">
                                    <input type="submit" name="crf01_pg1" value="SUBMIT" class="btn btn-success">
                                </div>
                                <div class="pull-left col-md-3">
                                    <input type="submit" name="cl_qry" value="QUERY" class="btn btn-warning">
                                </div>
                            </div>
                        </form>
                    <?php }
                    elseif ($_GET['id'] == 2){?>
                        <form method="post">
                            <div class="modal-body clearfix">
                                <div class="controls">
                                    <input type="hidden" name="img" value="<?=$imgL?>">
                                    <input type="hidden" name="sid" value="<?=$data[0]['id']?>">
                                    <input type="hidden" name="id" value="<?=$query[0]['id']?>">
                                    <div class="form-row" id="s1">
                                        <div class="col-md-2">STUDY ID:</div>
                                        <div class="col-md-6" id="v_code">
                                            <input type="text" name="study_id" class="form-control" value="<?=$data[0]['study_id']?>" required=""/>
                                        </div>
                                    </div>
                                    <h6>&nbsp;</h6>
                                    <div class="form-row">
                                        <div class="col-md-2">(i):</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbsx01" value="Yes" <?php if($data[0]['tbsx01'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbsx01" value="No" <?php if($data[0]['tbsx01'] == 'No'){echo 'checked';}?>/> No</label>
                                            </div>
                                            <div class="pull-right">
                                                <div class="col-md-5">Date Started:</div>
                                                <div class="col-md-7">
                                                    <input type="text" name="tbsx01days" class="form-control" value="<?=$data[0]['tbsx01days']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- -->
                                        <h2>&nbsp;</h2>
                                        <div class="col-md-2">(ii):</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbsx02" value="Yes" <?php if($data[0]['tbsx02'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbsx02" value="No" <?php if($data[0]['tbsx02'] == 'No'){echo 'checked';}?>/> No</label>
                                            </div>
                                            <div class="pull-right">
                                                <div class="col-md-5">Date Started:</div>
                                                <div class="col-md-7">
                                                    <input type="text" name="tbsx02days" class="form-control" value="<?=$data[0]['tbsx02days']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- -->
                                        <h2>&nbsp;</h2>
                                        <div class="col-md-2">(iii):</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbsx03" value="Yes" <?php if($data[0]['tbsx03'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbsx03" value="No" <?php if($data[0]['tbsx03'] == 'No'){echo 'checked';}?>/> No</label>
                                            </div>
                                            <div class="pull-right">
                                                <div class="col-md-5">Date Started:</div>
                                                <div class="col-md-7">
                                                    <input type="text" name="tbsx03days" class="form-control" value="<?=$data[0]['tbsx03days']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <h2>&nbsp;</h2>
                                        <div class="col-md-2">(iv):</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbsx04" value="Yes" <?php if($data[0]['tbsx04'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbsx04" value="No" <?php if($data[0]['tbsx04'] == 'No'){echo 'checked';}?>/> No</label>
                                            </div>
                                            <div class="pull-right">
                                                <div class="col-md-5">Date Started:</div>
                                                <div class="col-md-7">
                                                    <input type="text" name="tbsx04days" class="form-control" value="<?=$data[0]['tbsx04days']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <h2>&nbsp;</h2>
                                        <div class="col-md-2">(v):</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbsx05" value="Yes" <?php if($data[0]['tbsx05'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbsx05" value="No" <?php if($data[0]['tbsx05'] == 'No'){echo 'checked';}?>/> No</label>
                                            </div>
                                            <div class="pull-right">
                                                <div class="col-md-5">Date Started:</div>
                                                <div class="col-md-7">
                                                    <input type="text" name="tbsx05days" class="form-control" value="<?=$data[0]['tbsx05days']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <h2>&nbsp;</h2>
                                        <div class="col-md-2">(vi):</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbsx06" value="Yes" <?php if($data[0]['tbsx06'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="tbsx06" value="No" <?php if($data[0]['tbsx06'] == 'No'){echo 'checked';}?>/> No</label>
                                            </div>
                                            <div class="pull-right">
                                                <div class="col-md-5">Date Started:</div>
                                                <div class="col-md-7">
                                                    <input type="text" name="tbsx06days" class="form-control" value="<?=$data[0]['tbsx06days']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <h2>&nbsp;</h2>
                                        <div class="col-md-1">Specify:</div>
                                        <div class="col-md-11">
                                            <input type="text" name="tbsx_other" class="form-control" value="<?=$data[0]['tbsx_other']?>">
                                        </div>
                                        <!-- -->
                                        <h2>&nbsp;</h2>
                                        <div class="col-md-2">QN 6:</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="cough_care" value="Yes" <?php if($data[0]['cough_care'] == 'Yes'){echo 'checked';}?>/> Yes</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="cough_care" value="No" <?php if($data[0]['cough_care'] == 'No'){echo 'checked';}?>/> No</label>
                                            </div>
                                        </div>
                                        <h2>&nbsp;</h2>
                                        <div class="form-row">
                                            <div class="col-md-2">QN 7:</div>
                                            <div class="col-md-10">
                                                <div class="checkbox-inline">
                                                    <label><input type="radio" name="carefac" value="Public/mission health facility" <?php if($data[0]['carefac'] == 'Public/mission health facility'){echo 'checked';}?>/> Public/mission health facility</label>
                                                </div>
                                                <div class="checkbox-inline">
                                                    <label><input type="radio" name="carefac" value="Private hospital" <?php if($data[0]['carefac'] == 'Private hospital'){echo 'checked';}?>/> Private hospital</label>
                                                </div>
                                                <div class="checkbox-inline">
                                                    <label><input type="radio" name="carefac" value="Drug Store" <?php if($data[0]['carefac'] == 'Drug Store'){echo 'checked';}?>/> Drug Store</label>
                                                </div>
                                                <div class="checkbox-inline">
                                                    <label><input type="radio" name="carefac" value="Herbalist" <?php if($data[0]['carefac'] == 'Herbalist'){echo 'checked';}?>/> Herbalist</label>
                                                </div>
                                                <div class="checkbox-inline">
                                                    <label><input type="radio" name="carefac" value="Religious/spiritual" <?php if($data[0]['carefac'] == 'Religious/spiritual'){echo 'checked';}?>/> Religious/spiritual</label>
                                                </div>
                                                <div class="checkbox-inline">
                                                    <label><input type="radio" name="carefac" value="Other" <?php if($data[0]['carefac'] == 'Other'){echo 'checked';}?>/> Other</label>
                                                </div>

                                            </div>
                                        </div>
                                        <h2>&nbsp;</h2>
                                        <div class="col-md-1">Specify:</div>
                                        <div class="col-md-11">
                                            <input type="text" name="othercarefac" class="form-control" value="<?=$data[0]['othercarefac']?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="pull-right col-md-3">
                                    <input type="submit" name="crf01_pg2" value="SUBMIT" class="btn btn-success">
                                </div>
                                <div class="pull-left col-md-3">
                                    <input type="submit" name="cl_qry" value="QUERY" class="btn btn-warning">
                                </div>
                            </div>
                        </form>
                    <?php }}?>
                </div>
            </div>
        </div>
        <?php if($query){?>
            <div class="col-md-offset-0 col-md-6">
                <img src='<?=$imgL?>' width='100%'>
            </div>
        <?php }?>
    </div>

</div>
<!--Start of Tawk.to Script
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5c13b96082491369ba9e1d8a/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
</body>
<script>

    <?php if($user->data()->pswd == 0){?>
    $(window).on('load',function(){
        $("#change_password").modal({
            backdrop: 'static',
            keyboard: false
        },'show');
    });
    <?php }?>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<script>
    $(document).ready(function(){
        $('#c').change(function(){
            var site = $(this).val();
            $('#s_i').hide();
            $('#w_i').show();
            $.ajax({
                url:"process.php?content=site",
                method:"GET",
                data:{site:site},
                dataType:"text",
                success:function(data){
                    //$('#site_i').html(data);
                    //$('#s_i').show();
                    //$('#w_i').hide();
                }
            });
        });
    });
</script>
<script>

</script>
</html>