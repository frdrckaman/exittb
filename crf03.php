<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();$data=null;
$pageError = null;$successMessage = null;$errorM = false;$errorMessage = null;
if($user->isLoggedIn()){
    $data = $override->get('crf01_pg03','study_id','21100007');
    if(Input::exists('post')){
        $validate = new validate();
        $validate = $validate->check($_POST, array(
            'study_id' => array(
                'required' => true,
            ),

        ));
        if ($validate->passed()) {
            try {
                $user->updateRecord('crf01_pg03', array(
                    'study_id' => Input::get('study_id'),
                    'xpertsputum' => Input::get('xpertsputum'),
                    'xpertstool' => Input::get('xpertstool'),
                    'smear' => Input::get('smear'),
                    'cxray' => Input::get('cxray'),
                    'tbscore'=>Input::get('tbscore'),
                    'cxtbcase' => Input::get('cxtbcase'),
                    'formdate' => date('dmY',strtotime(Input::get('formdate'))),
                ),$data[0]['id']);
                $successMessage = 'Changes Made Successful';
                $data = $override->get('crf01_pg03','study_id','21100007');

            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            $pageError = $validate->errors();
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
                    <form method="post">
                        <div class="modal-body clearfix">
                            <div class="controls">
                                <div class="form-row" id="s1">
                                    <div class="col-md-2">STUDY ID:</div>
                                    <div class="col-md-6" id="v_code">
                                        <input type="text" name="study_id" class="form-control" value="<?=$data[0]['study_id']?>" required=""/>
                                    </div>
                                </div>
                                <h6>&nbsp;</h6>
                                <div class="form-row">
                                    <div class="form-row">
                                        <div class="col-md-2">QN 8 (i) GeneXpert(Sputum):</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="xpertsputum" VALUE="T" <?php if($data[0]['xpertsputum'] == 'T'){echo 'checked';}?>/> (T) </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="xpertsputum" VALUE="Ti" <?php if($data[0]['xpertsputum'] == 'Ti'){echo 'checked';}?>/> (Ti) </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="xpertsputum" VALUE="TA" <?php if($data[0]['xpertsputum'] == 'TA'){echo 'checked';}?>/> (TA) </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="xpertsputum" VALUE="RR" <?php if($data[0]['xpertsputum'] == 'RR'){echo 'checked';}?>/> (RR) </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="xpertsputum" VALUE="N" <?php if($data[0]['xpertsputum'] == 'N'){echo 'checked';}?>/> (N) </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="xpertsputum" VALUE="I" <?php if($data[0]['xpertsputum'] == 'I'){echo 'checked';}?>/> (I) </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- -->
                                    <h2>&nbsp;</h2>
                                    <div class="form-row">
                                        <div class="col-md-2">QN 8 (ii) GeneXpert(Stool):</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="xpertstool" value="T" <?php if($data[0]['xpertstool'] == 'T'){echo 'checked';}?>/> (T) </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="xpertstool" value="Ti" <?php if($data[0]['xpertstool'] == 'Ti'){echo 'checked';}?>/> (Ti) </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="xpertstool" value="TA" <?php if($data[0]['xpertstool'] == 'TA'){echo 'checked';}?>/> (TA) </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="xpertstool" value="RR" <?php if($data[0]['xpertstool'] == 'RR'){echo 'checked';}?>/> (RR) </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="xpertstool" value="N" <?php if($data[0]['xpertstool'] == 'N'){echo 'checked';}?>/> (N) </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="xpertstool" value="I" <?php if($data[0]['xpertstool'] == 'I'){echo 'checked';}?>/> (I) </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- -->
                                    <h2>&nbsp;</h2>
                                    <div class="form-row">
                                        <div class="col-md-2">QN 8 (iii):</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="smear" value="Positive" <?php if($data[0]['smear'] == 'Positive'){echo 'checked';}?>/> Positive </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="smear" value="Negative" <?php if($data[0]['smear'] == 'Negative'){echo 'checked';}?>/> Negative </label>
                                            </div>
                                        </div>
                                    </div>
                                    <h2>&nbsp;</h2>
                                    <div class="form-row">
                                        <div class="col-md-2">QN 8 (iv):</div>
                                        <div class="col-md-10">
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="cxray" value="TB Suggestive" <?php if($data[0]['cxray'] == 'TB Suggestive'){echo 'checked';}?>/> TB suggestive </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label><input type="radio" name="cxray" value="Not Suggestive" <?php if($data[0]['cxray'] == 'Not Suggestive'){echo 'checked';}?>/> Not suggestive </label>
                                            </div>
                                        </div>
                                    </div>
                                    <h2>&nbsp;</h2>
                                    <div class="form-row">
                                        <div class="col-md-2">QN 8 (iv):</div>
                                        <div class="col-md-3">
                                            <input type="number" name="tbscore" class="form-control" value="<?=$data[0]['tbscore']?>">
                                        </div>
                                    </div>
                                    <h2>&nbsp;</h2>
                                    <div class="col-md-4">Clinically diagnosed to have TB:</div>
                                    <div class="col-md-8">
                                        <input type="text" name="cxtbcase" class="form-control" value="<?=$data[0]['cxtbcase']?>">
                                    </div>
                                    <!-- -->
                                    <h2>&nbsp;</h2>
                                    <div class="col-md-1">Date:</div>
                                    <div class="col-md-11">
                                        <input type="text" name="formdate" class="datepicker form-control" value="<?=$data[0]['formdate']?>">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="pull-right col-md-3">
                                <input type="submit" name="crf01_pg3" value="SUBMIT" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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