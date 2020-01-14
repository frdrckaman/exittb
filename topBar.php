<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$email = new Email();
$random = new Random();
$countries=null;$checkError=false;
if($user->isLoggedIn()) {
    if (Input::exists('post')) {
        if (Input::get('add_staff')) {
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'firstname' => array(
                    'required' => true,
                    'min' => 3,
                ),
                'lastname' => array(
                    'required' => true,
                    'min' => 3,
                ),
                'country_id' => array(
                    'required' => true,
                ),
                'site_id' => array(
                    'required' => true,
                ),
                'position' => array(
                    'required' => true,
                ),
                'username' => array(
                    'required' => true,
                    'unique' => 'staff'
                ),
                'phone_number' => array(
                    'required' => true,
                    'unique' => 'staff'
                ),
                'email_address' => array(
                    'required' => true,
                    'unique' => 'staff'
                ),
            ));
            if ($validate->passed()) {
                $salt = $random->get_rand_alphanumeric(32);
                $password = $random->get_rand_alphanumeric(8);
                switch (Input::get('position')) {
                    case 'Principle Investigator':
                        $accessLevel = 1;
                        break;
                    case 'Coordinator':
                        $accessLevel = 2;
                        break;
                    case 'Data Manager':
                        $accessLevel = 3;
                        break;
                    case 'Country Coordinator':
                        $accessLevel = 4;
                        break;
                    case 'Country PI':
                        $accessLevel = 4;
                        break;
                    case 'Country Data Manager':
                        $accessLevel = 5;
                        break;
                    case 'Data Clark':
                        $accessLevel = 6;
                        break;
                }
                try {
                    $user->createRecord('staff', array(
                        'firstname' => Input::get('firstname'),
                        'lastname' => Input::get('lastname'),
                        'position' => Input::get('position'),
                        'username' => Input::get('username'),
                        'password' => Hash::make($password,$salt),
                        'salt' => $salt,
                        'reg_date' => date('Y-m-d'),
                        'access_level' => $accessLevel,
                        'phone_number' => Input::get('phone_number'),
                        'email_address' => Input::get('email_address'),
                        'c_id' => Input::get('country_id'),
                        's_id' => Input::get('site_id'),
                        'status' => 1,
                        'pswd' => 0,
                        'last_login'=>'',
                        'picture'=>'',
                        'token' =>'',
                        'power'=>0,
                        'count'=>0,
                        'staff_id'=>$user->data()->id
                    ));
                    if($email->sendEmail(Input::get('email_address'),Input::get('lastname'),Input::get('username'),$password,'EXIT-TB DMS ACCOUNT')){
                        $successMessage = 'Staff Registered Successful' ;
                    }

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else {
                $pageError = $validate->errors();
            }
        }
        elseif (Input::get('add_country')) {
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'country_name' => array(
                    'required' => true,
                ),
                'short_code' => array(
                    'required' => true,
                    'min' => 2,
                )
            ));
            if ($validate->passed()) {
                try {
                    $user->createRecord('country', array(
                        'name' => Input::get('country_name'),
                        'short_code' => Input::get('short_code'),
                        'status' => 1
                    ));
                    $successMessage = 'Country Registered Successful';

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else {
                $pageError = $validate->errors();
            }
        }
        elseif (Input::get('add_site')) {
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'site_name' => array(
                    'required' => true,
                ),
                'short_code' => array(
                    'required' => true,
                    'min' => 2,
                ),
                'country_id' => array(
                    'required' => true,
                ),

            ));
            if ($validate->passed()) {
                try {
                    $user->createRecord('site', array(
                        'name' => Input::get('site_name'),
                        'short_code' => Input::get('short_code'),
                        'c_id' => Input::get('country_id'),
                        'status' => 1
                    ));
                    $successMessage = 'Site Registered Successful';

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else {
                $pageError = $validate->errors();
            }
        }
        elseif (Input::get('blank_crf')) {
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'crf_name' => array(
                    'required' => true,
                ),
                'country' => array(
                    'required' => true,
                ),
                'version' => array(
                    'required' => true,
                ),
            ));
            if (!empty($_FILES['attachment']["tmp_name"])) {
                $cntry=$override->get('country','id',Input::get('country'));
                $attach_file = $_FILES['attachment']['type'];
                if ($attach_file == "application/pdf") {
                    $folderName = 'crf_versions/';
                    $attachment_file = $folderName . basename($_FILES['attachment']['name']);
                    if (@move_uploaded_file($_FILES['attachment']["tmp_name"], $attachment_file)) {
                        $name = $folderName.Input::get('crf_name').'_v'.Input::get('version').'_'.$cntry[0]['short_code'].'_'.date('Y-m-d').'.pdf';
                        $attachment = $user->renameFile($attachment_file,$name);
                        //$attachment = $attachment_file;
                    } else {
                        $checkError = true;
                        $errorMessage = 'Not uploaded to a Server';
                    }
                } else {
                    $checkError = true;
                    $errorMessage = 'Not a Supported Format';
                }
            }
            if ($validate->passed() && $checkError == false) {
                try {
                    $user->createRecord('crf_versions', array(
                        'name' => Input::get('crf_name'),
                        'version' => Input::get('version'),
                        'v_date' => date('Y-m-d'),
                        'c_id' => Input::get('country'),
                        'status' => 0,
                        'attachment' => $attachment,
                        'staff_id' => $user->data()->id
                    ));
                    $successMessage = 'CRFs Uploaded Successful';
                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else {
                $pageError = $validate->errors();
            }
        }
        elseif (Input::get('sop')) {
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'sop_name' => array(
                    'required' => true,
                ),
            ));
            if (!empty($_FILES['attachment']["tmp_name"])) {
                $attach_file = $_FILES['attachment']['type'];
                if ($attach_file == "application/pdf") {
                    $folderName = 'sop/';
                    $attachment_file = $folderName . basename($_FILES['attachment']['name']);
                    if (@move_uploaded_file($_FILES['attachment']["tmp_name"], $attachment_file)) {
                        $attachment = $attachment_file;
                    } else {
                        $checkError = true;
                        $errorMessage = 'Not uploaded to a Server';
                    }
                } else {
                    $checkError = true;
                    $errorMessage = 'Not a Supported Format';
                }
            }
            if ($validate->passed() && $checkError == false) {
                try {
                    $user->createRecord('sop', array(
                        'name' => Input::get('sop_name'),
                        'attachment' => $attachment_file,
                        'staff_id' => $user->data()->id
                    ));
                    $successMessage = 'SOP Uploaded Successful';
                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else {
                $pageError = $validate->errors();
            }
        }
        elseif (Input::get('scan_crf')) {
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
            $c_t=null;$c_t=$override->get('crf_type','id',Input::get('crf_name'));
            if (!empty($_FILES['attachment']["tmp_name"])) {
                $attach_file = $_FILES['attachment']['type'];
                if ($attach_file == "application/pdf") {
                    $folder = '/var/www/quexf.exit-tb.org/public_html/scans/';
                    $folderName = 'scanned_crf/';
                    $attachment_file = $folderName . basename($_FILES['attachment']['name']);
                    $attachment_file1 = $folder . basename($_FILES['attachment']['name']);
                    if (@move_uploaded_file($_FILES['attachment']["tmp_name"], $attachment_file)) {
                        copy($attachment_file, $attachment_file1);
                        $name=$folderName.'EXIT-TB_'.$c_t[0]['code'].'_PG0_'.Input::get('page').'_'.Input::get('tb_crf_id').'_CRFID_'.Input::get('crf_name').'_CID_'.$user->data()->c_id.'.pdf';
                        $name1=$folder.'EXIT-TB_'.$c_t[0]['code'].'_PG0_'.Input::get('page').'_'.Input::get('tb_crf_id').'_CRFID_'.Input::get('crf_name').'_CID_'.$user->data()->c_id.'.pdf';
                        $upload_crf=$user->renameFile($attachment_file,$name);
                        $user->renameFile($attachment_file1,$name1);
                        $checkError = false;
                        $attachment = $attachment_file;
                    } else {
                        $checkError = true;
                        $errorMessage = 'Not uploaded to a Server';
                    }
                } else {
                    $checkError = true;
                    $errorMessage = 'Not a Supported Format';
                }
            }
            if ($validate->passed() && $checkError == false) {
                try {
                    $user->createRecord('crf_record', array(
                        'crf_id' => Input::get('crf_name'),
                        'tb_crf_id' => Input::get('tb_crf_id'),
                        'page' => Input::get('page'),
                        'up_date' => date('Y-m-d'),
                        'c_id' => $user->data()->c_id,
                        'processed' => 0,
                        's_id' => $user->data()->s_id,
                        'attachment' =>  $upload_crf,
                        'staff_id' => $user->data()->id
                    ));
                    $successMessage = 'CRF Uploaded Successful';
                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else {
                $pageError = $validate->errors();
            }
            /*$validate = new validate();
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
            }*/
        }
        elseif (Input::get('crf_type')) {
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'crf_name' => array(
                    'required' => true,
                ),
                'pages' => array(
                    'required' => true,
                ),
            ));
            if ($validate->passed()) {
                try {
                    $user->createRecord('crf_type', array(
                        'name' => Input::get('crf_name'),
                        'pages' => Input::get('pages'),
                        'code' => Input::get('code'),
                        'status' => 1,
                        'staff_id' => $user->data()->id,
                    ));
                    $successMessage = 'CRF Registered Successful';

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else {
                $pageError = $validate->errors();
            }
        }
        elseif (Input::get('suggestion')) {
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'subject' => array(
                    'required' => true,
                ),
                'message' => array(
                    'required' => true,
                    'min' => 10,
                )
            ));
            if ($validate->passed()) {
                try {
                    $user->createRecord('suggestion', array(
                        'subject' => Input::get('subject'),
                        'message' => Input::get('message'),
                        's_date' => date('Y-m-d'),
                        'staff_id' => $user->data()->id
                    ));
                    $successMessage = 'Suggestion Received Successful';

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else {
                $pageError = $validate->errors();
            }
        }
        elseif (Input::get('pswd')) {
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'new_password' => array(
                    'required' => true,
                    'min' => 6,
                ),
                're_password' => array(
                    'required' => true,
                    'matches' => 'new_password'
                )
            ));
            if ($validate->passed()) {
                $salt = $random->get_rand_alphanumeric(32);
                try {
                    $user->update(array(
                        'pswd' => 1,
                        'password' => Hash::make(Input::get('new_password'), $salt),
                        'salt' => $salt
                    ));
                } catch (Exception $e) {
                }
                $successMessage = 'Password changed successfully';
            } else {
                $pageError = $validate->errors();
            }
        }
        elseif (Input::get('search_crf')){
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'crf_id' => array(
                    'required' => true,
                )
            ));
            if ($validate->passed()) {
                $data=$override->getLike('crf_record','tb_crf_id',Input::get('crf_id'));//print_r($data);
                $url='info.php?id=15&c='.$data[0]['id'];
                Redirect::to($url);
            } else {
                $pageError = $validate->errors();
            }
        }
        elseif (Input::get('add_barcode')){
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'crf_name' => array(
                    'required' => true,
                ),
                'page' => array(
                    'required' => true,
                ),
                'barcode' => array(
                    'required' => true,
                    'unique' => 'barcode'
                ),
                'country' => array(
                    'required' => true,
                ),
            ));
            if ($validate->passed()) {
                try {
                    $code=$override->get('crf_type','id',Input::get('crf_name'))[0]['code'];
                    $user->createRecord('barcode', array(
                        'crf_code' => $code,
                        'crf_id' => Input::get('crf_name'),
                        'page' => Input::get('page'),
                        'barcode' => Input::get('barcode'),
                        'version' => Input::get('version'),
                        'c_id' => Input::get('country'),
                        'staff_id' => $user->data()->id,
                    ));
                    $successMessage = 'Barcode Registered Successful';

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else {
                $pageError = $validate->errors();
            }
        }
    }
    
}
?>
<nav class="navbar brb" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-reorder"></span>
        </button>
        <a class="navbar-brand" href="index.php"><img src="img/nimrLogo.png" class="img-thumbnail img-circle"/></a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="index.php">
                    <span class="icon-home"></span> dashboard
                </a>
            </li>
            <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){?>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-globe"></span> Countries</a>
                    <ul class="dropdown-menu">
                        <?php foreach($override->get('country','status',1) as $country){?>
                            <li>
                                <a href="site.php?id=c&c=<?=$country['id']?>&s="><?=$country['name']?><i class="icon-angle-right pull-right"></i></a>
                                <ul class="dropdown-submenu">
                                    <?php foreach($override->getNews('site','c_id',$country['id'],'status',1) as $site){if($site){?>
                                        <li><a href="site.php?id=s&c=<?=$country['id']?>&s=<?=$site['id']?>"><?=$site['name']?></a></li>
                                    <?php }else{?>
                                        <li><a href="#">No Site Available</a></li>
                                    <?php }}?>
                                </ul>
                            </li>
                        <?php }?>
                    </ul>
                </li>
            <?php }?>
            <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-file-text"></span> CRF</a>
                <ul class="dropdown-menu">
                    <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){?>
                        <li><a href="#upload_crf" data-toggle="modal" data-backdrop="static" data-keyboard="false">ADD CRF</a></li>
                        <li><a href="info.php?id=3">MANAGE CRFs</a></li>
                    <?php }?>
                    <li><a href="info.php?id=5">STUDY CRFs</a></li>
                </ul>
            </li>
            <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){?>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-file-text-alt"></span> SCANNED CRFs</a>
                    <ul class="dropdown-menu">
                        <li><a href="#search_crf" data-toggle="modal"  data-keyboard="false">Search CRF</a></li>
                        <?php foreach($override->get('country','status',1) as $country){?>
                            <li>
                                <a href="info.php?id=13&c=<?=$country['id']?>"><?=$country['name']?> CRFs<i class="icon-angle-right pull-right"></i></a>
                                <ul class="dropdown-submenu">
                                    <?php foreach($override->getNews('site','c_id',$country['id'],'status',1) as $site){if($site){?>
                                        <li><a href="info.php?id=14&c=<?=$country['id']?>&s=<?=$site['id']?>"><?=$site['name']?> CRFs</a></li>
                                    <?php }else{?>
                                        <li><a href="#">No Site Available</a></li>
                                    <?php }}?>
                                </ul>
                            </li>
                        <?php }?>
                        <li><a href="info.php?id=6">VIEW ALL SCANNED CRFs</a></li>
                    </ul>
                </li>
            <?php }else{?>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-file-text-alt"></span> SCANNED CRFs</a>
                    <ul class="dropdown-menu">
                        <li><a href="info.php?id=6">VIEW SCANNED CRFs</a></li>
                    </ul>
                </li>
            <?php }?>
            <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-file"></span> SOPs</a>
                <ul class="dropdown-menu">
                    <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){?>
                        <li><a href="#upload_sop" data-toggle="modal" data-backdrop="static" data-keyboard="false">ADD SOP</a></li>
                    <?php }?>
                    <li><a href="info.php?id=4">VIEW SOPs</a></li>
                </ul>
            </li>
            <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){?>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-group"></span> STAFF</a>
                    <ul class="dropdown-menu">
                        <li><a href="#add_staff" data-toggle="modal" data-backdrop="static" data-keyboard="false">ADD STAFF</a></li>
                        <li><a href="info.php?id=1">MANAGE STAFF</a></li>
                    </ul>
                </li>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-gear"></span> MANAGEMENT</a>
                    <ul class="dropdown-menu">
                        <li><a href="#add_country" data-toggle="modal" data-backdrop="static" data-keyboard="false">ADD COUNTRY</a></li>
                        <li><a href="#add_site" data-toggle="modal" data-backdrop="static" data-keyboard="false">ADD SITE</a></li>
                        <?php if($user->data()->power == 1){?>
                            <li><a href="#add_barcode" data-toggle="modal" data-backdrop="static" data-keyboard="false">ADD BARCODE</a></li>
                            <li><a href="#upload_crf_type" data-toggle="modal" data-backdrop="static" data-keyboard="false">ADD STUDY CRFs</a></li>
                            <li><a href="info.php?id=7" >VIEW STUDY CRFs</a></li>
                            <li><a href="info.php?id=20" >VIEW BARCODE</a></li>
                        <?php }?>
                        <li><a href="info.php?id=2">MANAGE SITE / COUNTRIES</a></li>
                    </ul>
                </li>
            <?php }elseif($user->data()->access_level == 4){?>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-group"></span> STAFF</a>
                    <ul class="dropdown-menu">
                        <li><a href="#add_staff" data-toggle="modal" data-backdrop="static" data-keyboard="false">ADD STAFF</a></li>
                        <li><a href="info.php?id=1">MANAGE STAFF</a></li>
                    </ul>
                </li>
            <?php }?>
            <?php if($user->data()->power == 1 ){?>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-file-alt"></span> REVIEW CRF</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href=""> CRF01<i class="icon-angle-right pull-right"></i></a>
                            <ul class="dropdown-submenu">
                                <li><a href="crf01.php">PG01</a> </li>
                                <li><a href="crf02.php" disabled="">PG02</a> </li>
                                <li><a href="#" disabled="">PG03</a> </li>
                            </ul>
                    </ul>
                </li>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-file-text-alt"></span> Resolve Query</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href=""> CRF01<i class="icon-angle-right pull-right"></i></a>
                            <ul class="dropdown-submenu">
                                <li><a href="fixdata.php?id=1">PG01</a> </li>
                                <li><a href="fixdata.php?id=2" disabled="">PG02</a> </li>
                                <li><a href="#" disabled="">PG03</a> </li>
                            </ul>
                    </ul>
                </li>
            <?php }?>
            <li class="">
                <a href="profile.php">
                    <span class="icon-user"></span> Profile
                </a>
            </li>
        </ul>
        <form class="navbar-form navbar-right" role="search" method="get">
            <div class="form-group">
                <input type="text" name="exit_tb_crf_id" class="form-control" placeholder="search..."/>
            </div>
        </form>
    </div>
</nav>
<div class="modal" id="add_staff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">NEW STAFF</h4>
                </div>
                <div class="modal-body clearfix">
                    <div class="controls">
                        <div class="form-row">
                            <div class="col-md-2">First Name:</div>
                            <div class="col-md-10">
                                <input type="text" name="firstname" class="form-control" value="" required=""/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2">Last Name:</div>
                            <div class="col-md-10">
                                <input type="text" name="lastname" class="form-control" value="" required=""/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2">Country:</div>
                            <div class="col-md-10">
                                <select class="form-control" id="country" name="country_id" required="">
                                    <option value="">Select Country</option>
                                    <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){
                                        $countries=$override->get('country','status',1);
                                    }elseif($user->data()->access_level == 4){
                                        $countries=$override->getNews('country','id',$user->data()->c_id,'status',1);}
                                    foreach($countries as $country){?>
                                        <option value="<?=$country['id']?>"><?=$country['name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div id="waitS" style="display:none;" class="col-md-offset-5 col-md-1"><img src='img/owl/spinner-mini.gif' width="12" height="12" /><br>Loading..</div>
                        <div class="form-row" id="s">
                            <div class="col-md-2">Site:</div>
                            <div class="col-md-10">
                                <select class="form-control" id="site" name="site_id" required="">
                                    <option value="">Select Site</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2">Position:</div>
                            <div class="col-md-10">
                                <select class="form-control" name="position" required="">
                                    <!-- you need to properly manage positions -->
                                    <option value="">Select Position</option>
                                    <?php foreach($override->getData('position') as $position){if($user->data()->access_level == 1 && $user->data()->power == 1){?>
                                        <option value="<?=$position['name']?>"><?=$position['name']?></option>
                                    <?php }elseif($user->data()->access_level == 1 && $position['name'] != 'Principle Investigator'){?>
                                        <option value="<?=$position['name']?>"><?=$position['name']?></option>
                                    <?php }elseif($user->data()->access_level == 2 || $user->data()->access_level == 3 && $position['name'] != 'Coordinator' && $position['name'] != 'Principle Investigator'){?>
                                        <option value="<?=$position['name']?>"><?=$position['name']?></option>
                                    <?php }elseif ($user->data()->access_level == 4 && $position['name'] != 'Coordinator' && $position['name'] != 'Principle Investigator' && $position['name'] !='Data Manager' /*&& $position['name'] !='Country Coordinator'*/ ){?>
                                        <option value="<?=$position['name']?>"><?=$position['name']?></option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2">Username:</div>
                            <div class="col-md-10">
                                <input type="text" name="username" class="form-control" value="" required=""/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2">Phone:</div>
                            <div class="col-md-10">
                                <input type="text" name="phone_number" class="form-control" value="" required=""/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2">Email:</div>
                            <div class="col-md-10">
                                <input type="text" name="email_address" class="form-control" value="" required=""/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right col-md-3">
                        <input type="submit" name="add_staff" value="ADD" class="btn btn-success btn-clean">
                    </div>
                    <div class="pull-right col-md-2">
                        <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="add_country" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">ADD COUNTRY</h4>
                </div>
                <div class="modal-body clearfix">
                    <div class="controls">
                        <div class="form-row">
                            <div class="col-md-2">Name:</div>
                            <div class="col-md-10">
                                <input type="text" name="country_name" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2">Short Code:</div>
                            <div class="col-md-10">
                                <input type="text" name="short_code" class="form-control" value="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right col-md-3">
                        <input type="submit" name="add_country" value="ADD" class="btn btn-success btn-clean">
                    </div>
                    <div class="pull-right col-md-2">
                        <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="add_site" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">NEW SITE</h4>
                </div>
                <div class="modal-body clearfix">
                    <div class="controls">
                        <div class="form-row">
                            <div class="col-md-2">Name:</div>
                            <div class="col-md-10">
                                <input type="text" name="site_name" class="form-control" value="" required=""/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2">Short Code:</div>
                            <div class="col-md-10">
                                <input type="text" name="short_code" class="form-control" value="" required=""/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2">Country:</div>
                            <div class="col-md-10">
                                <select class="form-control" name="country_id" required="">
                                    <option value="">Select Country</option>
                                    <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2){
                                        $countries=$override->get('country','status',1);
                                    }elseif($user->data()->access_level == 4){
                                        $countries=$override->getNews('country','id',$user->data()->c_id,'status',1);}
                                    foreach($countries as $country){?>
                                        <option value="<?=$country['id']?>"><?=$country['name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right col-md-3">
                        <input type="submit" name="add_site" value="ADD" class="btn btn-success btn-clean">
                    </div>
                    <div class="pull-right col-md-2">
                        <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">UPLOAD CRFs</h4>
                </div>
                <div class="modal-body clearfix">
                    <div class="controls">
                        <div class="form-row">
                            <div class="col-md-5">
                                <select class="form-control" name="crf_name" id="crf" required="">
                                    <option value="">Select CRFs</option>
                                    <?php $vsn=null;foreach($override->getData('crf_type') as $crf){
                                        if($user->data()->c_id == 1 && $crf['id'] >=7 ){$vsn=''?>
                                        <option value="<?=$crf['id']?>"><?=$crf['name'].' '.$vsn?></option>
                                    <?php }elseif ($user->data()->c_id == 2 ){if($crf['id'] >= 7){$vsn='';}?>
                                        <option value="<?=$crf['id']?>"><?=$crf['name'].$vsn?></option>
                                    <?php }elseif($user->data()->c_id != 1 || $user->data()->c_id != 2 ){if($crf['id'] > 6){?>
                                        <option value="<?=$crf['id']?>"><?=$crf['name']?></option>
                                    <?php }}}?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="tb_crf_id" class="form-control" value="" placeholder="ENTER CRF ID " required/>
                            </div>
                            <div class="col-md-3" >
                                <div id="waitP" style="display:none;" class="col-md-offset-5 col-md-1"><img src='img/owl/spinner-mini.gif' width="12" height="12" /></div>
                                <div id="p">
                                    <select class="form-control" name="page" id="pg" required="">
                                        <option value="">Select Page</option>
                                    </select>
                                </div>
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
                        <label class="col-md-12" style="color: #4673cc;font-style: italic;font-weight: bold">Enter Screening ID for Screening Forms and Study ID for Enrollment,Biomedical,clinical follow up ,Missed Appointment and Socio-Economic </label>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="pull-right col-md-3">
                        <input type="submit" value="Submit CRF" name="scan_crf" class="btn btn-success btn-clean">
                    </div>
                    <div class="pull-right col-md-2">
                        <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="upload_crf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">UPLOAD BLANK CRFs</h4>
                </div>
                <div class="modal-body clearfix">
                    <div class="controls">
                        <div class="form-row">
                            <div class="col-md-5">
                                <select class="form-control" name="crf_name">
                                    <option value="">Select CRF</option>
                                    <?php foreach ($override->getData('crf_type') as $crf){?>
                                        <option value="<?=$crf['name']?>"><?=$crf['name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-md-1">Country:</div>
                            <div class="col-md-3">
                                <select class="form-control" id="country" name="country" required="">
                                    <option value="">Select Country</option>
                                    <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){
                                        $countries=$override->get('country','status',1);
                                    }elseif($user->data()->access_level == 4){
                                        $countries=$override->getNews('country','id',$user->data()->c_id,'status',1);}
                                        foreach($countries as $country){?>
                                            <option value="<?=$country['id']?>"><?=$country['name']?></option>
                                        <?php }?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="version" required>
                                    <option value="">Version</option>
                                    <?php $x=1;while($x<=8){?>
                                        <option value="<?=$x?>"><?='V.'.$x?></option>
                                        <?php $x++;}?>
                                </select>
                            </div>
                        </div>
                        <label class="col-md-12"></label>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="input-group file">
                                    <input type="text" class="form-control" placeholder="Select CRFs"/>
                                    <input type="file" name="attachment"/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">Browse</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <div class="pull-right col-md-3">
                        <input type="submit" name="blank_crf" value="Submit CRF" class="btn btn-success btn-clean">
                    </div>
                    <div class="pull-right col-md-2">
                        <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="upload_sop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">UPLOAD SOP</h4>
                </div>
                <div class="modal-body clearfix">
                    <div class="controls">
                        <div class="form-row">
                            <div class="col-md-12">
                                <input type="text" name="sop_name" class="form-control" value="" placeholder="SOP Name" required=""/>
                            </div>
                        </div>
                        <label class="col-md-12"></label>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="input-group file">
                                    <input type="text" class="form-control" placeholder="Select SOP"/>
                                    <input type="file" name="attachment" required=""/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">Browse</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <div class="pull-right col-md-3">
                        <input type="submit" name="sop" value="Submit" class="btn btn-success btn-clean">
                    </div>
                    <div class="pull-right col-md-2">
                        <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="upload_crf_type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">CRFs USED</h4>
                </div>
                <div class="modal-body clearfix">
                    <div class="controls">
                        <div class="form-row">
                            <div class="col-md-6">
                                <input type="text" name="crf_name" class="form-control" value="" placeholder="CRF Name" required=""/>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="code" class="form-control" value="" placeholder="CRF Code" required=""/>
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="pages" class="form-control" value="" placeholder="Pages" required=""/>
                            </div>
                        </div>
                        <label class="col-md-12"></label>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="pull-right col-md-3">
                        <input type="submit" name="crf_type" value="Submit" class="btn btn-success btn-clean">
                    </div>
                    <div class="pull-right col-md-2">
                        <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="suggestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">SUGGESTIONS</h4>
                </div>
                <div class="modal-body clearfix">
                    <div class="controls">
                        <div class="form-row">
                            <div class="col-md-12">
                                <input type="text" name="subject" class="form-control" value="" placeholder="Enter Subject" required=""/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <textarea class="form-control" name="message" placeholder="Your Suggestions" ROWS="8" required=""></textarea>
                            </div>
                        </div>
                        <label class="col-md-12"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right col-md-3">
                        <input type="submit" name="suggestion" value="Submit" class="btn btn-success btn-clean">
                    </div>
                    <div class="pull-right col-md-2">
                        <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="change_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <h4 class="modal-title" style="color: #cc8c18;font-weight: bolder;">YOU HAVE LOGIN FOR THE FIRST TIME, YOUR REQUIRED TO CHANGE YOUR PASSWORD</h4>
                </div>
                <div class="modal-body clearfix">
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
                    <?php }?>
                    <div class="controls">
                        <div class="form-row">
                            <div class="col-md-12">
                                <input type="password" name="new_password" class="form-control" value="" placeholder="Enter New Password" required=""/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <input type="password" name="re_password" class="form-control" value="" placeholder="Re-type Password" required=""/>
                            </div>
                        </div>
                        <label class="col-md-12"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right col-md-3">
                        <input type="submit" name="pswd" value="Submit" class="btn btn-success btn-clean">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="search_crf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post">
                <div class="modal-body clearfix">
                    <div class="controls">
                        <div class="form-row">
                            <div class="col-md-9">
                                <input type="text" name="crf_id" class="form-control" value="" placeholder="ENTER STUDY/SCREENING ID" required=""/>
                            </div>
                            <div class="col-md-3">
                                <input type="submit" name="search_crf" value="Search" class="btn btn-success btn-clean">
                            </div>
                        </div>
                        <label class="col-md-12"></label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="add_barcode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">ADD BARCODE VALUE</h4>
                </div>
                <div class="modal-body clearfix">
                    <div class="controls">
                        <div class="form-row">
                            <div class="col-md-1">CRF:</div>
                            <div class="col-md-8">
                                <select class="form-control" name="crf_name" id="crfB" required="">
                                    <option value="">Select CRFs</option>
                                    <?php $vsn=null;foreach($override->getData('crf_type') as $crf){ if($user->data()->c_id == 1 && ($crf['id'] >=3 && $crf['id'] <= 6)){$vsn='( PILOT TZ)'?>
                                        <option value="<?=$crf['id']?>"><?=$crf['name'].' '.$vsn?></option>
                                    <?php }elseif ($user->data()->c_id == 2 ){if($crf['id'] >= 7){$vsn='   ( *NEW* )   ';}?>
                                        <option value="<?=$crf['id']?>"><?=$crf['name'].$vsn?></option>
                                    <?php }elseif($user->data()->c_id != 1 || $user->data()->c_id != 2 ){if($crf['id'] > 6){?>
                                        <option value="<?=$crf['id']?>"><?=$crf['name']?></option>
                                    <?php }}}?>
                                </select>
                            </div>
                            <div class="col-md-3" >
                                <div id="waitB" style="display:none;" class="col-md-offset-5 col-md-1"><img src='img/owl/spinner-mini.gif' width="12" height="12" /></div>
                                <div id="b">
                                    <select class="form-control" name="page" id="pgN" required="">
                                        <option value="">Select Page</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-1">Barcode:</div>
                            <div class="col-md-5">
                                <input type="text" name="barcode" class="form-control" value="" required=""/>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" id="" name="version" >
                                    <option value="">Select Version</option>
                                    <option value="1">v1</option>
                                    <option value="2">v2</option>
                                    <option value="3">v3</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" id="country" name="country" required="">
                                    <option value="">Select Country</option>
                                    <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){
                                        $countries=$override->get('country','status',1);
                                    }elseif($user->data()->access_level == 4){
                                        $countries=$override->getNews('country','id',$user->data()->c_id,'status',1);}
                                    foreach($countries as $country){?>
                                        <option value="<?=$country['id']?>"><?=$country['name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right col-md-3">
                        <input type="submit" name="add_barcode" value="ADD" class="btn btn-success btn-clean">
                    </div>
                    <div class="pull-right col-md-2">
                        <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#country').change(function(){
            var site = $(this).val();
            $('#s').hide();
            $('#waitS').show();
            $.ajax({
                url:"process.php?content=site",
                method:"GET",
                data:{site:site},
                dataType:"text",
                success:function(data){
                    $('#site').html(data);
                    $('#s').show();
                    $('#waitS').hide();
                }
            });
        });
        $('#crf').change(function(){
            var page = $(this).val();
            $('#p').hide();
            $('#waitP').show();
            $.ajax({
                url:"process.php?content=pages",
                method:"GET",
                data:{page:page},
                dataType:"text",
                success:function(data){
                    $('#pg').html(data);
                    $('#p').show();
                    $('#waitP').hide();
                }
            });
        });
        $('#crfB').change(function(){
            var page = $(this).val();
            $('#b').hide();
            $('#waitB').show();
            $.ajax({
                url:"process.php?content=pages",
                method:"GET",
                data:{page:page},
                dataType:"text",
                success:function(data){
                    $('#pgN').html(data);
                    $('#b').show();
                    $('#waitB').hide();
                }
            });
        });
    });
</script>