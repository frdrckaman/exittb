<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
include 'pdftoimage/Pdf.php';

$pageError = null;$successMessage = null;$errorM = false;$errorMessage = null;
if($user->isLoggedIn()){

    if(Input::exists('post')){
        if(Input::get('ok')){
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'study_id' => array(

                ),

            ));
            if ($validate->passed()) {
                try {
                    $user->updateRecord('missing_crf', array(
                        'status' => 4,
                        'date_modified'=>date('Y-m-d'),
                        'staff_id'=>$user->data()->id,

                    ),Input::get('id'));
                    $successMessage = 'Changes Made Successful';
                    unlink(Input::get('img'));
                    $query = $override->lastRow1('missing_crf','status',0,'id');
                    if($query){
                        try {$user->updateRecord('missing_crf', array('status' => 2), $query[0]['id']);} catch (Exception $e) {}
                        $pdf = $override->selectData('crf_record','study_id',$query[0]['study_id'],'page',3,'crf_id',7);
                        if($pdf){
                            $pathToPdf=$pdf[0]['attachment'];
                            $svDoc=$query[0]['study_id'].'_'.$user->data()->id.'_'.date('Y-m-d s');
                            $pdfImg = new Spatie\PdfToImage\Pdf($pathToPdf,$svDoc);
                            $pathToWhereImageShouldBeStored = '/var/www/system.exit-tb.org/public_html/crf_images/';
                            $pdfImg->saveImage($pathToWhereImageShouldBeStored);
                            $imgL='crf_images/'.$svDoc.'.jpg';
                        }else{
                            Redirect::to('mcrf01.php');
                        }
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
        elseif (Input::get('err')){
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'study_id' => array(

                ),

            ));
            if ($validate->passed()) {
                try {
                    $user->updateRecord('missing_crf', array(
                        'status' => 8,
                        'date_modified'=>date('Y-m-d'),
                        'staff_id'=>$user->data()->id,
                    ),Input::get('id'));
                    $successMessage = 'Query added Successful';
                    //try {$user->updateRecord('missing_crf', array('status' => 2), $query[0]['id']);} catch (Exception $e) {}
                    unlink(Input::get('img'));
                    $query = $override->lastRow1('missing_crf','status',0,'id');
                    if($query){
                        try {$user->updateRecord('missing_crf', array('status' => 2), $query[0]['id']);} catch (Exception $e) {}
                        $pdf = $override->selectData('crf_record','study_id',$query[0]['study_id'],'page',3,'crf_id',7);
                        if($pdf){
                            $pathToPdf=$pdf[0]['attachment'];
                            $svDoc=$query[0]['study_id'].'_'.$user->data()->id.'_'.date('Y-m-d s');
                            $pdfImg = new Spatie\PdfToImage\Pdf($pathToPdf,$svDoc);
                            $pathToWhereImageShouldBeStored = '/var/www/system.exit-tb.org/public_html/crf_images/';
                            $pdfImg->saveImage($pathToWhereImageShouldBeStored);
                            $imgL='crf_images/'.$svDoc.'.jpg';
                        }else{
                            Redirect::to('mcrf01.php');
                        }
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
        $query = $override->lastRow1('missing_crf','status',0,'id');
        if($query){
            try {$user->updateRecord('missing_crf', array('status' => 2), $query[0]['id']);} catch (Exception $e) {}
            $pdf = $override->selectData('crf_record','study_id',$query[0]['study_id'],'page',1,'crf_id',7);
            if($pdf){
//                $pathToPdf=$pdf[0]['attachment'];
//                $svDoc=$query[0]['study_id'].'_'.$user->data()->id.'_'.date('Y-m-d s');
//                $pdfImg = new Spatie\PdfToImage\Pdf($pathToPdf,$svDoc);
//                $pathToWhereImageShouldBeStored = '/var/www/system.exit-tb.org/public_html/crf_images/';
//                $pdfImg->saveImage($pathToWhereImageShouldBeStored);
//                $imgL='crf_images/'.$svDoc.'.jpg';
            }else{
                Redirect::to('mcrf01.php');
            }
        }else{
            $successMessage = 'No More Forms Available';
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
    <style>
        .rotate90 {
            -webkit-transform: rotate(180deg);
            -moz-transform: rotate(180deg);
            -o-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            transform: rotate(180deg);
        }
    </style>
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

        </div>
        <?php if($query){?>
            <div class="col-md-offset-2 col-md-8 col-md-offset-2">
                <img src='<?=$imgL?>' width='100%' class="rotate180">
                <img src='img/nimr.jpg' width='100%' class="rotate90">
                <p>&nbsp;</p>
                <div class="pull-right">
                    <form method="post">
                        <input type="hidden" name="id" value="<?=$query[0]['id']?>">
                        <input type="hidden" name="img" value="<?=$imgL?>">
                        <input type="submit" name="err" value="Error, next" class="btn btn-danger">
                        <input type="submit" name="ok" value="OK, next" class="btn btn-success">
                    </form>
                </div>
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
End of Tawk.to Script-->
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