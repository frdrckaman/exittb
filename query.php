<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$email = new Email();
$rand = new Random();
$pageError = null;$successMessage = null;$errorM = false;$errorMessage = null;
$pageError2 = null;$successMessage2 = null;$errorM = false;$errorMessage2 = null;
$staffs=null;$data=null;$checkError=false;
$links=array('query.php');
foreach ($links as $link){
    if(basename($_SERVER['REQUEST_URI']) == $link){
        Redirect::to('404.php');
    }
}
if($user->isLoggedIn()) {
    if (Input::exists('post')) {
        if (Input::get('rise_query')) {
        $validate = new validate();
        $validate = $validate->check($_POST, array(
            'site' => array(
                'required' => true,
            ),
        ));
        if ($validate->passed()) {
            $fids=Input::get('fid');$fids=implode('',$fids);
            $fid_array=explode(',',$fids);
            foreach ($fid_array as $fid){
                $get_fid=$override->get('forms','fid',$fid);
                if($get_fid){
                    $qid=$override->get('questionnaires','qid',$get_fid[0]['qid']);
                    $s_id=$override->get('site','id',Input::get('site'));
                    $c_id=$override->get('country','id',$s_id[0]['c_id']);
                    try {
                        $user->createRecord('query_logs', array(
                            'subject' => Input::get('subject'),
                            'details' => Input::get('details'),
                            'crf_id' => $qid[0]['description'],
                            'q_date' => date('Y-m-d'),
                            'staff_id' => $user->data()->id,
                            'status' => 0,
                            'c_id' => $c_id[0]['id'],
                            's_id' => Input::get('site'),
                            'attachment' => $get_fid[0]['description']
                        ));
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                }
            }
            $successMessage = 'Query Raised Successful';
        } else {
            $pageError = $validate->errors();
        }
    }
        elseif (Input::get('solve_query')){
        if (!empty($_FILES['attachment']["tmp_name"])) {
            $attach_file = $_FILES['attachment']['type'];
            if ($attach_file == "application/pdf") {
                $folderName = 'query/';
                $attachment_file = $folderName . basename($_FILES['attachment']['name']);
                if (@move_uploaded_file($_FILES['attachment']["tmp_name"], $attachment_file)) {
                    //$attachment = $attachment_file;
                    $name=$folderName.'QUERY_EXIT-TB_QID_'.Input::get('qid').'_'.date('Y-m-d').'.pdf';
                    $upload_crf=$user->renameFile($attachment_file,$name);
                } else {
                    $checkError = true;
                    $errorMessage = 'Not uploaded to a Server';
                }
            } else {
                $checkError = true;
                $errorMessage = 'Not a Supported Format';
            }
        }
            if ($checkError == false) {
                try {
                    $user->createRecord('query_rep', array(
                        'subject' => Input::get('subject'),
                        'details' => Input::get('details'),
                        'q_date' => date('Y-m-d'),
                        'q_id' => Input::get('qid'),
                        'attachment' => $upload_crf,
                        'staff_id' => $user->data()->id
                    ));
                    $user->updateRecord('query_logs',array('status'=>2),$_GET['id']);
                    $successMessage = 'Sent to Data Manager Successful';
                } catch (Exception $e) {
                    die($e->getMessage());
                }
            }
            else {
                $pageError = $validate->errors();
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
    <script type='text/javascript' src='js/plugins/tagsinput/jquery.tagsinput.min.js'></script>
    <script type='text/javascript' src='js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'></script>

    <script type='text/javascript' src='js/plugins/cleditor/jquery.cleditor.min.js'></script>

    <script type='text/javascript' src='js/plugins.js'></script>
    <script type='text/javascript' src='js/actions.js'></script>
    <script type='text/javascript' src='js/settings.js'></script>
</head>
<body class="bg-img-num1">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php include 'topBar.php'?>
        </div>
    </div>
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
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="dashboard.php">Home</a></li>
                <li class="active">Query</li>
            </ol>
        </div>
    </div>

    <div class="row">

        <div class="col-md-2">
            <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){?>
                <div class="block">
                    <a class="btn btn-danger btn-block" href="#rise_query" data-toggle="modal" data-backdrop="static">Rise Query</a>
                </div>
            <?php }?>
            <div class="block">
                <a class="btn btn-danger btn-block" href="#solve_query" data-toggle="modal" data-backdrop="static">Resolve This Query</a>
            </div>

            <?php $x=1;$no=0;if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){
                $qr=$override->getCount('query_logs','status',0);
                }elseif ($user->data()->access_level == 4 || $user->data()->access_level == 5){
                $qr=$override->countData('query_logs','c_id',$user->data()->c_id,'status',0);
                }elseif ($user->data()->access_level == 6){
                $qr=$override->countData('query_logs','s_id',$user->data()->s_id,'status',0);
                        }?>
            <div class="block block-drop-shadow">
                <div class="content list-group list-group-icons">
                    <a href="info.php?id=16" class="list-group-item"><span class="icon-warning-sign"></span>Queries <span class="label label-warning pull-right"><?=$qr?></span></a>
                    <a href="#" class="list-group-item"><span class="icon-info-sign"></span>Pending Queries</a>
                    <a href="#" class="list-group-item"><span class="icon-ok"></span>Resolve Queries</a>
                    <a href="#" class="list-group-item"><span class="icon-gears"></span>System Queries</a>
                    <a href="#" class="list-group-item"><span class="icon-user"></span>Data Manager Queries</a>
                </div>
            </div>

            <div class="block">
                <div class="head bg-dot20">
                    <h2>STATISTICS</h2>
                    <div class="head-panel nm">
                        <div class="hp-info hp-simple pull-left hp-inline">
                            <span class="hp-main"><a href="#"><span class="text-danger pull-right">0</span> Total Queries</a></span>
                        </div>
                        <div class="hp-info hp-simple pull-left hp-inline">
                            <span class="hp-main"><a href="#"><span class="text-success pull-right">0</span> Total Resolved</a></span>
                        </div>
                        <div class="hp-info hp-simple pull-left hp-inline">
                            <span class="hp-main"><a href="#"><span class="text-warning pull-right"> 0%</span> Queries Percentage</a></span>
                        </div>
                        <div class="hp-info hp-simple pull-left hp-inline">
                            <span class="hp-main"><a href="#"><span class="text-info pull-right">0</span> Total Upload</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-offset-1 col-md-8 col-md-offset-1">
            <div class="block">
                <div class="btn-group">
                    <button class="btn btn-default btn-clean"><span class="icon-exclamation-sign"></span></button>
                    <button class="btn btn-default btn-clean"><span class="icon-trash"></span></button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-default btn-clean"><span class="icon-mail-forward"></span></button>
                    <button class="btn btn-default btn-clean"><span class="icon-mail-reply"></span></button>
                    <button class="btn btn-default btn-clean"><span class="icon-mail-reply-all"></span></button>
                </div>
                <div class="btn-group pull-right">
                    <button class="btn btn-default btn-clean dropdown-toggle" data-toggle="dropdown"><span class="icon-folder-close"></span> Action <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Resolved</a></li>
                        <li><a href="#">Not Resolved</a></li>
                    </ul>
                </div>
            </div>
            <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){
                $data=$override->get('query_logs','id',$_GET['id']);
            }elseif ($user->data()->access_level == 4 || $user->data()->access_level == 5){
                $data=$override->getNews('query_logs','c_id',$user->data()->c_id,'id',$_GET['id']);
            }elseif ($user->data()->access_level == 6){
                $data=$override->getNews('query_logs','s_id',$user->data()->s_id,'id',$_GET['id']);
            }?>
            <div id="waitQ" style="display:none;" class="col-md-offset-5 col-md-1"><img src='img/owl/spinner-mini.gif' width="12" height="12" /><br>Loading..</div>
            <div id="q">
                <div class="block block-drop-shadow">
                    <div id="qd">
                        <div class="head bg-dot30">
                            <h2><?=$data[0]['subject']?></h2>
                            <div class="pull-right"><span class="icon-paper-clip"></span> <?=$data[0]['q_date']?></div>
                        </div>
                    </div>
                    <div class="content">
                        <p>Dear, <?=$user->data()->lastname?></p>
                        <p><?=$data[0]['details']?></p>
                        <br>
                        <?php if($data[0]['attachment']){?>
                            <div class="head bg-dot30">
                                <div class="head-panel nm">
                                    <div class="hp-info hp-simple pull-left hp-inline">
                                        <span class="hp-main" ><a href="read.php?path=<?=$data[0]['attachment']?>" style="color: #2a85cc"><span class="icon-picture"></span> To view or download CLICK HERE!</a></span>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                        <p>&nbsp;</p>
                        <address>
                            <strong>National Institute of Medical Research ( NIMR ).</strong><br>
                            <strong>Muhimbili Medical Research Centre ( MMRC ).</strong><br>
                            P.O.BOX 3436 <br>
                            Dar es Salaam, Tanzania<br>
                        </address>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="solve_query" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">RESOLVE QUERY</h4>
            </div>
            <form enctype="multipart/form-data" method="post">
                <div class="modal-body clearfix">
                    <div class="controls">
                        <div class="form-row">
                            <div class="col-md-3">From:</div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" disabled="disabled" value="frdrck aman"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">
                                To:
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="Data Manager" disabled="disabled"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">
                                Subject:
                            </div>
                            <div class="col-md-9">
                                <input type="hidden" name="subject" class="form-control" value="Resolve <?=$data[0]['subject']?>" />
                                <input type="text" class="form-control" value="Resolve <?=$data[0]['subject']?>" disabled="disabled"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">
                                CRF:
                            </div>
                            <div class="col-md-9">
                                <div class="input-group file">
                                    <input type="text" class="form-control" placeholder="Select CRFs"/>
                                    <input type="file" name="attachment" required=""/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">Browse</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <textarea name="details" rows="4" class="form-control " placeholder="Message"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right col-md-2">
                        <input type="hidden" name="fid" value="">
                        <input type="hidden" name="qid" value="<?=$data[0]['id']?>">
                        <input type="submit" name="solve_query" value="Send" class="pull-right btn btn-success btn-clean">
                    </div>
                    <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="rise_query" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">RISE QUERY</h4>
            </div>
            <form enctype="multipart/form-data" method="post">
                <div class="modal-body clearfix">

                    <div class="controls">
                        <div class="form-row">
                            <div class="col-md-3">From:</div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" disabled="disabled" value="Data Manager"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">
                                To:
                            </div>
                            <div class="col-md-9">
                                <select name="site" class="form-control" required>
                                    <option value="">Select Site</option>
                                    <?php foreach ($override->get('site','status',1) as $site){?>
                                        <option value="<?=$site['id']?>"><?=$site['name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">
                                Query Subject:
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="subject" class="form-control"  value="" required/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">
                                Form ID:
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="fid[]" class="form-control"  value="" required/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <textarea name="details" rows="4" class="form-control " placeholder="Message"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="pull-right col-md-2">
                        <input type="submit" name="rise_query" value="Send" class="btn btn-success btn-clean">
                    </div>
                    <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
        $('#fr').change(function(){
            var site = $(this).val();
            $('#s_i').hide();
            $('#waitQ').show();
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
</html>