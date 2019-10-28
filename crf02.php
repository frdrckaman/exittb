<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();$data=null;
$pageError = null;$successMessage = null;$errorM = false;$errorMessage = null;
if($user->isLoggedIn()){
    $data = $override->get('crf01_pg02','study_id','21200028');
    if(Input::exists('post')){
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
                    'tbsx01days' => date('dmY',strtotime(Input::get('tbsx01days'))) ,
                    'tbsx02' => Input::get('tbsx02'),
                    'tbsx02days' =>date('dmY',strtotime(Input::get('tbsx02days'))),
                    'tbsx03'=>Input::get('tbsx03'),
                    'tbsx03days' => date('dmY',strtotime(Input::get('tbsx03days'))),
                    'tbsx04' => Input::get('tbsx04'),
                    'tbsx04days' => date('dmY',strtotime(Input::get('tbsx04days'))),
                    'tbsx05' => Input::get('tbsx05'),
                    'tbsx05days' => date('dmY',strtotime(Input::get('tbsx05days'))),
                    'tbsx06' => Input::get('tbsx06'),
                    'tbsx_other'=> Input::get('tbsx_other'),
                    'tbsx06days' => date('dmY',strtotime(Input::get('tbsx06days'))),
                    'cough_care' => Input::get('cough_care'),
                    'carefac' => Input::get('carefac'),
                    'othercarefac' => Input::get('othercarefac'),
                ),$data[0]['id']);
                $successMessage = 'Changes Made Successful';
                $data = $override->get('crf01_pg02','study_id','21200028');

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
                                                <input type="text" name="tbsx01days" class="datepicker form-control" value="<?=$data[0]['tbsx01days']?>">
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
                                                <input type="text" name="tbsx02days" class="datepicker form-control" value="<?=$data[0]['tbsx02days']?>">
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
                                                <input type="text" name="tbsx03days" class="datepicker form-control" value="<?=$data[0]['tbsx03days']?>">
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
                                                <input type="text" name="tbsx04days" class="datepicker form-control" value="<?=$data[0]['tbsx04days']?>">
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
                                                <input type="text" name="tbsx05days" class="datepicker form-control" value="<?=$data[0]['tbsx05days']?>">
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
                                                <input type="text" name="tbsx06days" class="datepicker form-control" value="<?=$data[0]['tbsx06days']?>">
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