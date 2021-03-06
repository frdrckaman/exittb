<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$pageError = null;$successMessage = null;$errorM = false;$errorMessage = null;$ctp=null;
$study_crf=null;$data_limit=10000;$crf_c=null;$i=0;$num=0;$crf_typ=null;$tpn=null;
if($user->isLoggedIn()) {
    $site=$override->get('site','id',$user->data()->s_id);
    $country=$override->get('country','id',$user->data()->c_id);
    $study_crf=$override->get('crf_type','status',1);
    if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){
        $s_name='ALL';$c_name='ALL';$x=0;
        $cntry=$override->get('country','status',1);
        foreach($cntry as $c){
            foreach($override->get('crf_type','status',1) as $cr_ty){
                //$num[$x] = $override->countNoRepeat2('crf_record','study_id','crf_id',$cr_ty['id'],'c_id',$c['id']);
                //$ctp[$x]=$cr_ty['name'];$x++;
            }
            $crf_c .= "{ Country:'".$c['name']."',".$cr_ty['name'].":".$num.",";$i++;
        }$j=0;foreach($cntry as $c){$crf_c .= "{ Country:'".$c['name']."',".$ctp[$j].":".$num.",";$j++;}
        $t_crf=$override->countNoRepeatAll('crf_record','study_id');
        $p_crf=$override->countNoRepeat('crf_record','study_id','processed',1);
        $w_crf=$override->countNoRepeat('crf_record','study_id','processed',0);
    }elseif($user->data()->access_level == 4 || $user->data()->access_level == 5){
        $s_name=$site[0]['name'];$c_name=$country[0]['name'];
        $t_crf=$override->countNoRepeat('crf_record','study_id','c_id',$user->data()->c_id);
        $p_crf=$override->countNoRepeat2('crf_record','study_id','processed',1,'c_id',$user->data()->c_id);
        $w_crf=$override->countNoRepeat2('crf_record','study_id','processed',0,'c_id',$user->data()->c_id);
    }elseif($user->data()->access_level == 7 ){
        $t_crf=$override->countNoRepeat2('crf_record','study_id','s_id',$user->data()->s_id,'c_id',$user->data()->c_id);
        $p_crf=$override->countNoRepeat3('crf_record','study_id','processed',1,'c_id',$user->data()->c_id,'s_id',$user->data()->s_id);
        $w_crf=$override->countNoRepeat3('crf_record','study_id','processed',0,'c_id',$user->data()->c_id,'s_id',$user->data()->s_id);
    }else{
        Redirect::to('403.php');
    }
}else{
    Redirect::to('index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>NIMR</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/ico" href="favicon.html">
    <link href="css/stylesheets.css" rel="stylesheet" type="text/css">


    <script type='text/javascript' src='js/plugins/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='js/plugins/jquery/jquery-ui.min.js'></script>
    <script type='text/javascript' src='js/plugins/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='js/plugins/jquery/globalize.js'></script>
    <script type='text/javascript' src='js/plugins/bootstrap/bootstrap.min.js'></script>

    <script type='text/javascript' src='js/plugins/uniform/jquery.uniform.min.js'></script>

    <script type='text/javascript' src='js/plugins/knob/jquery.knob.js'></script>
    <script type='text/javascript' src='js/plugins/sparkline/jquery.sparkline.min.js'></script>

    <script type='text/javascript' src='js/plugins/flot/jquery.flot.js'></script>
    <script type='text/javascript' src='js/plugins/flot/jquery.flot.pie.js'></script>
    <script type='text/javascript' src='js/plugins/flot/jquery.flot.resize.js'></script>

    <script type='text/javascript' src='js/morris.min.js'></script>
    <script type='text/javascript' src='js/raphael.min.js'></script>

    <script type='text/javascript' src='js/plugins.js'></script>
    <script type='text/javascript' src='js/actions.js'></script>
    <script type='text/javascript' src='js/charts.js'></script>
    <script type='text/javascript' src='js/settings.js'></script>
</head>
<body class="bg-img-num1">

<div class="container">
<div class="row">
    <div class="col-md-12">
        <?php require'topBar.php'?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Components</a></li>
            <li class="active"><?php ?></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <?php if($study_crf){foreach($study_crf as $st_crf){
            if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){
                $crf_no=$override->countNoRepeat('crf_record','study_id','crf_id',$st_crf['id']);
            }elseif($user->data()->access_level == 4 || $user->data()->access_level == 5){
                $crf_no=$override->countNoRepeat2('crf_record','study_id','crf_id',$st_crf['id'],'c_id',$user->data()->c_id);
            }elseif($user->data()->access_level == 7 ){
                $crf_no=$override->countNoRepeat3('crf_record','study_id','crf_id',$st_crf['id'],'c_id',$user->data()->c_id,'s_id',$user->data()->s_id);
            }
            ?>
            <div class="col-md-6">
                <div class="block block-drop-shadow">
                    <div class="head bg-dot20">
                        <h2><?=$st_crf['name']?></h2>
                        <div class="head-subtitle"></div>
                        <div class="head-panel nm tac" style="line-height: 0px;">
                            <div class="knob">
                                <input type="text" data-fgColor="#3F97FE" data-min="0" data-max="<?=$data_limit?>" data-width="100" data-height="100" value="<?=$crf_no?>" data-readOnly="true"/>
                            </div>
                        </div>
                        <div class="head-panel nm">
                            <div class="hp-info hp-simple pull-left">
                                <span class="hp-main"></span>
                                <span class="hp-sm"></span>
                            </div>
                            <div class="hp-info hp-simple pull-right">
                                <span class="hp-main"></span>
                                <span class="hp-sm"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
            <div class="col-md-6">
                <div class="block block-drop-shadow">
                    <div class="head bg-dot20">
                        <h2>Uploaded CRFs</h2>
                        <div class="side pull-right">
                            <ul class="buttons">
                                <li><a href="#"><span class="icon-cogs"></span></a></li>
                            </ul>
                        </div>
                        <div class="head-subtitle">Progress of Uploaded CRFs in the System</div>
                        <div class="head-panel tac">
                            <div class="sparkline">
                                <span sparkType="pie" sparkWidth="100" sparkHeight="100"><?=$t_crf.','.$w_crf.','.$p_crf?></span>
                            </div>
                        </div>
                        <div class="head-panel">
                            <div class="hp-info hp-simple pull-left hp-inline">
                                <span class="hp-main"><span class="icon-circle"></span> Total Uploaded CRFs [ <?php print_r($t_crf)?> ]</span>
                            </div>
                            <div class="hp-info hp-simple pull-left hp-inline">
                                <span class="hp-main"><span class="icon-circle text-info"></span> Waiting to be Processed [ <?php print_r($w_crf)?> ]</span>
                            </div>
                            <div class="hp-info hp-simple pull-left hp-inline">
                                <span class="hp-main"><span class="icon-circle text-primary"></span> Processed CRFs [ <?php print_r($p_crf)?> ]</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block block-drop-shadow">
                    <div class="head bg-dot20">
                        <h2>Total CRFs Uploaded</h2>
                        <div class="side pull-right">
                            <ul class="buttons">
                                <li><a href="#"><span class="icon-cogs"></span></a></li>
                            </ul>
                        </div>
                        <div class="head-subtitle"><strong>Site: <?=$s_name?> &nbsp;&nbsp; Country: <?=$c_name?> </strong></div>
                        <div class="head-panel tac" style="line-height: 0px;">
                            <div class="knob">
                                <input type="text" data-fgColor="#3F97FE" data-max="<?=$data_limit?>" data-min="0"  data-width="100" data-height="100" value="<?php print_r($t_crf)?>" data-readOnly="true"/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php }else{?>
            <div class="col-md-12">
                <div class="block col-md-12">
                    <div class="alert alert-danger">
                        <b>Oops! </b> No CFRs Available
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
    <div class="col-md-9">
        <div class="col-md-12">
            <!-- START USERS ACTIVITY BLOCK -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title-box">

                    </div>
                </div>
                <div class="panel-body padding-0">
                    <div class="chart-holder" id="ch" style="height: 200px;"></div>
                </div>
            </div>
            <!-- END USERS ACTIVITY BLOCK -->
        </div>
    </div>
</div>

</div>
<script>
    new Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'ch',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [<?=$crf_cd?>],
        // The name of the data record attribute that contains x-values.
        xkey: ['Country'],
        // A list of names of data record attributes that contain y-values.
        ykeys: ['Number'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        hideHover:'auto'
    });
</script>
</body>

</html>