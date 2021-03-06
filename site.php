<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$pageError = null;$successMessage = null;$errorM = false;$errorMessage = null;
$t_crf=0;$p_crf=0;$w_crf=0;$s_name=null;$c_name=null;$site=null;$country=null;
$study_crf=null;$data_limit=10000;$d_m=null;
if($user->isLoggedIn()) {
    if($_GET['id'] == 'c'){
        $country=$override->get('country','id',$_GET['c']);
        $d_m='Uploaded CRFs FOR '.$country[0]['name'];
    }elseif($_GET['id'] == 's'){
        $site=$override->get('site','id',$_GET['s']);
        $d_m='Uploaded CRFs FOR '.$site[0]['name'];
    }
    $study_crf=$override->get('crf_type','status',1);
    if($_GET['id'] == 'c'){
        $s_name=$site[0]['name'];$c_name=$country[0]['name'];
        $t_crf=$override->countNoRepeat2('crf_record','tb_crf_id','c_id',$_GET['c'],'status',1);
        $p_crf=$override->countNoRepeat3('crf_record','tb_crf_id','processed',1,'c_id',$_GET['c'],'status',1);
        $w_crf=$override->countNoRepeat3('crf_record','tb_crf_id','processed',0,'c_id',$_GET['c'],'status',1);
    }elseif($_GET['id'] == 's'){
        $s_name=$site[0]['name'];$c_name=$country[0]['name'];
        $t_crf=$override->countNoRepeat3('crf_record','tb_crf_id','s_id',$_GET['s'],'c_id',$_GET['c'],'status',1);
        $p_crf=$override->countNoRepeat4('crf_record','tb_crf_id','processed',1,'c_id',$_GET['c'],'s_id',$_GET['s'],'status',1);
        $w_crf=$override->countNoRepeat4('crf_record','tb_crf_id','processed',0,'c_id',$_GET['c'],'s_id',$_GET['s'],'status',1);
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
    <link rel="icon" type="image/ico" href="favicon.ico">
    <link href="css/stylesheets.css" rel="stylesheet" type="text/css">
    <link href="css/morris.css" rel="stylesheet" type="text/css">

    <script type='text/javascript' src='js/plugins/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='js/plugins/jquery/jquery-ui.min.js'></script>
    <script type='text/javascript' src='js/plugins/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='js/plugins/jquery/globalize.js'></script>
    <script type='text/javascript' src='js/plugins/bootstrap/bootstrap.min.js'></script>

    <script type='text/javascript' src='js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'></script>
    <script type='text/javascript' src='js/plugins/uniform/jquery.uniform.min.js'></script>

    <script type='text/javascript' src='js/plugins/knob/jquery.knob.js'></script>
    <script type='text/javascript' src='js/plugins/sparkline/jquery.sparkline.min.js'></script>
    <script type='text/javascript' src='js/plugins/flot/jquery.flot.js'></script>
    <script type='text/javascript' src='js/plugins/flot/jquery.flot.resize.js'></script>

    <script type='text/javascript' src='js/plugins.js'></script>
    <script type='text/javascript' src='js/actions.js'></script>
    <script type='text/javascript' src='js/charts.js'></script>
    <script type='text/javascript' src='js/settings.js'></script>

    <script type='text/javascript' src='js/morris.min.js'></script>
    <script type='text/javascript' src='js/raphael.min.js'></script>

</head>
<body class="bg-img-num1" data-settings="open">

<div class="container">
<div class="row">
    <div class="col-md-12">
        <?php require'topBar.php'?>
    </div>
</div>
<div class="row">

<div class="col-md-2">

    <?php require'sideBar.php'?>

    <div class="block block-drop-shadow">
        <div class="head bg-dot20">
            <h2>QUERIES</h2>
            <div class="side pull-right">
                <ul class="buttons">
                    <li><a href="#"><span class="icon-cogs"></span></a></li>
                </ul>
            </div>
            <div class="head-subtitle">Queries generated from uploaded CRFs</div>
            <div class="head-panel">
                <div class="hp-info hp-simple pull-left hp-inline">
                    <span class="hp-main">Missing Values <span class="icon-angle-right"></span> 0%</span>
                    <div class="hp-sm">
                        <div class="progress progress-small">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="890" aria-valuemin="0" aria-valuemax="1000" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
                <div class="hp-info hp-simple pull-left hp-inline">
                    <span class="hp-main">Missing CRFs <span class="icon-angle-right"></span> 0%</span>
                    <div class="hp-sm">
                        <div class="progress progress-small">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
                <div class="hp-info hp-simple pull-left hp-inline">
                    <span class="hp-main">Abnormal Range <span class="icon-angle-right"></span> 0%</span>
                    <div class="hp-sm">
                        <div class="progress progress-small">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-10">
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
                <b>Error!</b> <?php foreach($pageError as $error){echo $error.' , ';}?>
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
<div class="col-md-10">
    <div class="block">
        <div class="alert alert-info">
            <b>Info!</b> <?=$d_m?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    </div>
</div>
<div class="col-md-5">
    <?php if($study_crf){foreach($study_crf as $st_crf){
        if($_GET['id'] == 'c'){
            $crf_no=$override->countNoRepeat3('crf_record','tb_crf_id','crf_id',$st_crf['id'],'c_id',$_GET['c'],'status',1);
        }elseif($_GET['id'] == 's' ){
            $crf_no=$override->countNoRepeat4('crf_record','tb_crf_id','crf_id',$st_crf['id'],'c_id',$_GET['c'],'s_id',$_GET['s'],'status',1);
        }
        ?>
        <div class="col-md-6">
            <div class="block block-drop-shadow">
                <div class="head bg-dot20">
                    <h2><?=$st_crf['name']?></h2>
                    <div class="side pull-right">
                        <ul class="buttons">
                            <li><a href="#"><span class="icon-cogs"></span></a></li>
                        </ul>
                    </div>
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

<div class="col-md-5">
    <div class="block block-drop-shadow">
        <div class="content np">
            <div class="datepicker"></div>
        </div>
    </div>
    <div class="block block-drop-shadow">
        <div class="head bg-default bg-light-rtl">
            <h2>NOTIFICATIONS</h2>
        </div>
        <div class="content list">
            <!--<div class="list-item">
                <div class="list-datetime">
                    <div class="time">9:45 am</div>
                </div>
                <div class="list-info">
                    <img src="img/example/user/dmitry.jpg" class="img-circle img-thumbnail"/>
                </div>
                <div class="list-text">
                    <a href="#" class="list-text-name">John Doe</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque condimentum nisl velit.</p>
                </div>
                <div class="list-controls">
                    <a href="#" class="widget-icon widget-icon-circle"><span class="icon-rotate-right"></span></a>
                    <a href="#" class="widget-icon widget-icon-circle"><span class="icon-pushpin"></span></a>
                    <a href="#" class="widget-icon widget-icon-circle"><span class="icon-remove"></span></a>
                </div>
            </div>-->
        </div>
        <div class="footer tac">
            <a href="#">Load more messages</a>
        </div>
    </div>
</div>
<!-- Modal Upload -->

<!-- end of modal -->
</div>
<div class="row">
    <?php require'footer.php'?>
</div>
</div>
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
<!--Start of Tawk.to Script-->
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
</html>