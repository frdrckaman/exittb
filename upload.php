<?php

require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$email = new Email();
$rand = new Random();
$pageError = null;$successMessage = null;$errorM = false;$errorMessage = null;
$pageError2 = null;$successMessage2 = null;$errorM = false;$errorMessage2 = null;
$staffs=null;$data=null;
if($user->isLoggedIn()){
    if(Input::exists('post')){
        $validate = new validate();
            $validate = $validate->check($_POST, array(
                'crf_name' => array(
                    'required' => true,
                ),
                'tb_crf_id' => array(
                    'required' => true,
                ),
                'page' => array(
                    'required' => true,
                ),
            ));
            $c_t=null;$s_dr=null;$c_t=$override->get('crf_type','id',Input::get('crf_name'));
            if (!empty($_FILES['attachment']["tmp_name"])) {
                $attach_file = $_FILES['attachment']['type'];
                if ($attach_file == "application/pdf") {
                    $folder = 'scanned_crf/';
                    $folderName = '/var/www/quexf.exit-tb.org/public_html/scans/';
                    //$attachment_file = $folderName . basename($_FILES['attachment']['name']);
                    $attachment_file = $folder . basename($_FILES['attachment']['name']);
                    $pages = $override->getNews('crf_type','id',Input::get('crf_name'),'status',1);
                    $page = $pages[0]['pages'];$f=1;
                    //print_r($user->countPDF($attachment_file));
                        if (@move_uploaded_file($_FILES['attachment']["tmp_name"], $attachment_file)) {
                            if($user->countPDF($attachment_file) == $page){
                                //print_r($user->countPDF($attachment_file));
                                if ($validate->passed()) {
                                    $name=$folder.'EXT-TB_'.$c_t[0]['code'].'_'.Input::get('tb_crf_id').'_CRFID_'.Input::get('crf_name').'_CID_'.$user->data()->c_id.'_'.date('Y-m-d').'.pdf';
                                    $upload_crf=$user->renameFile($attachment_file,$name);
                                    try {
                                        $user->createRecord('crf_record', array(
                                            'crf_id' => Input::get('crf_name'),
                                            'tb_crf_id' => Input::get('tb_crf_id'),
                                            'page' => 0,
                                            'up_date' => date('Y-m-d'),
                                            'processed' => 0,
                                            'c_id' => $user->data()->c_id,
                                            's_id' => $user->data()->s_id,
                                            'attachment' => $upload_crf,
                                            'status' => 1,
                                            'staff_id' => $user->data()->id
                                        ));
                                        while($f <= $page){
                                            $pdf_name = 'EXT-TB_'.$c_t[0]['code'].'_PG_'.$f.'_'.Input::get('tb_crf_id').'_CRFID_'.Input::get('crf_name').'_CID_'.$user->data()->c_id.'_'.date('Y-m-d');
                                            $s_dr='/var/www/quexf.exit-tb.org/public_html/scans/'.$pdf_name;
                                            $user->splitPDF($upload_crf,$f,'/var/www/quexf.exit-tb.org/public_html/scans/'.$pdf_name);
                                            //$user->splitPDF($upload_crf,$f,'/var/www/system.exit-tb.org/public_html/sop/'.$pdf_name);
                                            try {
                                                $user->createRecord('split_pdf', array(
                                                    'crf_id' => Input::get('tb_crf_id'),
                                                    'name' => $pdf_name,
                                                    'page' => $f,
                                                    'split_pdf' => $s_dr,
                                                    'original_pdf' => $upload_crf,
                                                    'split_date' => date('Y-m-d'),
                                                ));
                                            } catch (Exception $e) {
                                                die($e->getMessage());
                                            }
                                            $f++;
                                        }
                                         $successMessage = 'CRF Uploaded Successful';
                                    } catch (Exception $e) {
                                        die($e->getMessage());
                                    }
                                } else {
                                    $pageError = $validate->errors();
                                }
                            }else{
                                $errorMessage = 'There are Missing Pages in this CRF or File is Corrupted. Please check the CRF an upload again '.$$user->countPDF($attachment_file);
                                $user->removePDF($attachment_file);
                            }
                        } else {
                            $checkError = true;
                            $errorMessage = 'Not uploaded to a Server';
                        }

                } else {
                    $checkError = true;
                    $errorMessage = 'Not a Supported Format';
                }
            }
    }
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
        <div class="col-md-offset-1 col-md-10">
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
    </div>
    <form enctype="multipart/form-data" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">UPLOAD CRFs</h4>
        </div>
        <div class="modal-body clearfix">
            <div class="controls">
                <div class="form-row">
                    <div class="col-md-8">
                        <select class="form-control" name="crf_name" id="crf" required="">
                            <option value="">Select CRFs</option>
                            <?php $vsn=null;foreach($override->getData('crf_type') as $crf){
                                if($user->data()->c_id == 1 && ($crf['id'] >=7)){?>
                                <option value="<?=$crf['id']?>"><?=$crf['name']?></option>
                            <?php }elseif ($user->data()->c_id == 2 ){if($crf['id'] >= 7){$vsn='   ( *NEW* )   ';}?>
                                <option value="<?=$crf['id']?>"><?=$crf['name'].$vsn?></option>
                            <?php }elseif($user->data()->c_id != 1 || $user->data()->c_id != 2 ){if($crf['id'] > 6){?>
                                <option value="<?=$crf['id']?>"><?=$crf['name']?></option>
                            <?php }}}?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="tb_crf_id" class="form-control" value="" placeholder="ENTER CRF ID " required/>
                    </div>

                </div>
                <label class="col-md-12"></label>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="input-group file">
                            <input type="text" class="form-control" placeholder="Select CRFs"/>
                            <input type="file" name="attachment" required=""/>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button">Browse</button>
                            </span>
                        </div>
                    </div>
                </div>
                <label class="col-md-12">&nbsp;</label>

            </div>

        </div>
        <div class="modal-footer">
            <div class="pull-right col-md-3">
                <input type="submit" value="Submit CRF" name="scan_crf" class="btn btn-success">
            </div>
        </div>
    </form>
    <div class="col-lg-8">
        <?php
        $file = 'C:\Users\frdrc\Desktop\337331\Fredrick_CV_01_06_2019.pdf';
        $filename = 'C:\Users\frdrc\Desktop\337331\Fredrick_CV_01_06_2019.pdf';
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($file));
        header('Accept-Ranges: bytes');
        @readfile($file);
        ?>
    </div>
</div>
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
