<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$email = new Email();
$rand = new Random();
$pageError = null;$successMessage = null;$errorM = false;$errorMessage = null;
$pageError2 = null;$successMessage2 = null;$errorM = false;$errorMessage2 = null;
$staffs=null;$data=null;
$links=array('site.php','info.php?id=14','info.php?id=13','info.php?id=9','info.php?id=18');
foreach ($links as $link){
    if(basename($_SERVER['REQUEST_URI']) == $link){
        Redirect::to('404.php');
    }
}

if($user->isLoggedIn()) {
    if ($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3) {
        if (Input::exists('post')) {
            if (Input::get('delete_staff')) {
                try {
                    $user->updateRecord('staff', array(
                        'status' => 0,
                    ),Input::get('id'));
                    $successMessage = 'Staff Deleted Successful';

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            }
            elseif(Input::get('edit_staff')){
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
                    ),
                    'phone_number' => array(
                        'required' => true,
                    ),
                ));
                if ($validate->passed()) {
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
                        case 'Country Data Manager':
                            $accessLevel = 5;
                            break;
                        case 'Statistician':
                            $accessLevel = 6;
                            break;
                        case 'Data Clark':
                            $accessLevel = 7;
                            break;
                    }
                    try {
                        $user->updateRecord('staff', array(
                            'firstname' => Input::get('firstname'),
                            'lastname' => Input::get('lastname'),
                            'position' => Input::get('position'),
                            'username' => Input::get('username'),
                            'access_level' => $accessLevel,
                            'phone_number' => Input::get('phone_number'),
                            'email_address' => Input::get('email_address'),
                            'c_id' => Input::get('country_id'),
                            's_id' => Input::get('site_id'),
                            'status' => 1
                        ), Input::get('id'));
                        $successMessage = 'Staff Info Updated Successful';

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                }else {
                    $pageError = $validate->errors();
                }
            }
            elseif(Input::get('delete_site')){
                try {
                    $user->updateRecord('site', array(
                        'status' => 0,
                    ),Input::get('id'));
                    $successMessage = 'Site Deleted Successful';

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            }
            elseif(Input::get('delete_country')){
                try {
                    $user->updateRecord('country', array(
                        'status' => 0,
                    ),Input::get('id'));
                    $successMessage = 'Country Deleted Successful';

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            }
            elseif(Input::get('edit_site')){
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
                    )
                ));
                if ($validate->passed()) {
                    try {
                        $user->updateRecord('site', array(
                            'name' => Input::get('site_name'),
                            'short_code' => Input::get('short_code'),
                            'c_id' => Input::get('country_id')
                        ),Input::get('id'));
                        $successMessage = 'Site Updated Successful';

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                } else {
                    $pageError = $validate->errors();
                }
            }
            elseif(Input::get('edit_country')){
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
                        $user->updateRecord('country', array(
                            'name' => Input::get('country_name'),
                            'short_code' => Input::get('short_code'),
                        ),Input::get('id'));
                        $successMessage = 'Country Updated Successful';

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                } else {
                    $pageError = $validate->errors();
                }
            }
            elseif(Input::get('reset_password')){
               // $salt = Hash::salt(32);
                //$password = '123456';
                $token = $rand->get_rand_alphanumeric(8);
                try{
                    $user->updateRecord('staff',array(
                        'token'=>$token
                    ),Input::get('id'));
                    $link='https://system.exit-tb.org/reset.php?token='.$token;//reset url
                    if($email->resetPassword(Input::get('email'),Input::get('lastname'),'Reset Password',$link)){
                        $successMessage = 'Email with Password Reset Link sent Successful';
                    }
                }
                catch (PDOException $e){
                    $e->getMessage();
                } catch (Exception $e) {
                }
                /*$salt = Hash::salt(32);
                $password = '123456';
                try{
                    $user->updateRecord('staff',array(
                        'password' => Hash::make($password, $salt),
                        'salt' => $salt,
                        'pswd'=>0
                    ),Input::get('id'));
                    $successMessage = 'Password Reset to Default Successful';
                }
                catch (PDOException $e){
                    $e->getMessage();
                } catch (Exception $e) {
                }*/
            }
            elseif(Input::get('activate_crf')){
                try {
                    $user->updateRecord('crf_versions', array(
                        'status' => Input::get('active'),
                    ),Input::get('id'));
                    $successMessage = 'CRF Activated Successful';

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            }
            elseif(Input::get('edit_c_type')){
                $validate = new validate();
                $validate = $validate->check($_POST, array(
                    'crf_name' => array(
                        'required' => true,
                    ),
                ));
                if ($validate->passed()) {
                    try {
                        $user->updateRecord('crf_type', array(
                            'name' => Input::get('crf_name'),
                        ),Input::get('id'));
                        $successMessage = 'CRF Updated Successful';

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                } else {
                    $pageError = $validate->errors();
                }
            }
            elseif(Input::get('delete_c_type')){
                try {
                    $user->updateRecord('crf_type', array(
                        'status' => 0,
                    ),Input::get('id'));
                    $successMessage = 'CRF Deleted Successful';

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            }
            elseif (Input::get('search')){
                $validate = new validate();
                $validate = $validate->check($_POST, array(
                    'crf_id' => array(
                        'required' => true,
                    )
                ));
                if ($validate->passed()) {
                    $data=$override->getLike('crf_record','tb_crf_id',Input::get('crf_id'));//print_r($data);
                } else {
                    $pageError = $validate->errors();
                }
            }
            elseif (Input::get('rise_query')) {
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
        <?php if($_GET['id'] == 1){?>
            <div class="block">
                <div class="header">
                    <h2>STAFF</h2>
                </div>
                <div class="content">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th width="20%">NAME</th>
                            <th width="10%">USERNAME</th>
                            <th width="10%">POSITION</th>
                            <th width="10%">COUNTRY</th>
                            <th width="10%">SITE</th>
                            <th width="10%">PHONE</th>
                            <th width="10%">EMAIL</th>
                            <th width="20%">MANAGE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $y=0;$x=1;if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){$staffs=$override->get('staff','status',1);}
                        elseif($user->data()->access_level == 4){$staffs=$override->getNews('staff','status',1,'c_id',$user->data()->c_id);}
                        foreach($staffs as $staff){if($user->data()->access_level != 1 || $user->data()->id != $staff['id']){
                            if($user->data()->access_level == 1){$power=1;}else{$power=0;}
                            $site=$override->get('site','id',$staff['s_id']);
                            $country=$override->get('country','id',$staff['c_id']);?>
                            <tr>
                                <td><?=$x?></td>
                                <td><?=$staff['firstname'].' '.$staff['lastname']?></td>
                                <td><?=$staff['username']?></td>
                                <td><?=$staff['position']?></td>
                                <td><?=$country[0]['name']?></td>
                                <td><?=$site[0]['name']?></td>
                                <td><?=$staff['phone_number']?></td>
                                <td><?=$staff['email_address']?></td>
                                <td>
                                    <?php if($staff['access_level'] != 2 || $power == 1){?>
                                        <a href="#edit_staff<?=$y?>" data-toggle="modal" class="widget-icon" title="Edit Staff Information"><span class="icon-pencil"></span></a>
                                        <a href="#reset_password<?=$y?>" data-toggle="modal" class="widget-icon" title="Reset Password to Default"><span class="icon-refresh"></span></a>
                                        <a href="#delete_staff<?=$y?>" data-toggle="modal" class="widget-icon" title="Delete Staff"><span class="icon-trash"></span></a>
                                    <?php }?>
                                </td>
                            </tr>
                            <div class="modal" id="edit_staff<?=$y?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">EDIT STAFF</h4>
                                            </div>
                                            <div class="modal-body clearfix">
                                                <div class="controls">
                                                    <div class="form-row">
                                                        <div class="col-md-2">First Name:</div>
                                                        <div class="col-md-10">
                                                            <input type="text" name="firstname" class="form-control" value="<?=$staff['firstname']?>" required=""/>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-2">Last Name:</div>
                                                        <div class="col-md-10">
                                                            <input type="text" name="lastname" class="form-control" value="<?=$staff['lastname']?>" required=""/>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-2">Country:</div>
                                                        <div class="col-md-10">
                                                            <select class="form-control" id="c" name="country_id" required="">
                                                                <option value="<?=$country[0]['id']?>"><?=$country[0]['name']?></option>
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
                                                    <div id="w" style="display:none;" class="col-md-offset-5 col-md-1"><img src='img/owl/spinner-mini.gif' width="12" height="12" /><br>Loading..</div>
                                                    <div class="form-row" id="s_i">
                                                        <div class="col-md-2">Site:</div>
                                                        <div class="col-md-10">
                                                            <select class="form-control" id="site_i" name="site_id" required="">
                                                                <option value="<?=$site[0]['id']?>"><?=$site[0]['name']?></option>
                                                                <?php foreach($override->get('site','status',1) as $site){?>
                                                                    <option value="<?=$site['id']?>"><?=$site['name']?></option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-2">Position:</div>
                                                        <div class="col-md-10">
                                                            <select class="form-control" name="position" required="">
                                                                <!-- you need to properly manage positions -->
                                                                <option value="<?=$staff['position']?>"><?=$staff['position']?></option>
                                                                <?php foreach($override->getData('position') as $position){if($user->data()->access_level == 1 && $user->data()->power == 1){?>
                                                                    <option value="<?=$position['name']?>"><?=$position['name']?></option>
                                                                <?php }elseif($user->data()->access_level == 1 && $position['name'] != 'Principle Investigator'){?>
                                                                    <option value="<?=$position['name']?>"><?=$position['name']?></option>
                                                                <?php }elseif($user->data()->access_level == 2 && $position['name'] != 'Coordinator' && $position['name'] != 'Principle Investigator'){?>
                                                                    <option value="<?=$position['name']?>"><?=$position['name']?></option>
                                                                <?php }}?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-2">Username:</div>
                                                        <div class="col-md-10">
                                                            <input type="text" name="username" class="form-control" value="<?=$staff['username']?>" required=""/>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-2">Phone:</div>
                                                        <div class="col-md-10">
                                                            <input type="text" name="phone_number" class="form-control" value="<?=$staff['phone_number']?>" required=""/>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-2">Email:</div>
                                                        <div class="col-md-10">
                                                            <input type="text" name="email_address" class="form-control" value="<?=$staff['email_address']?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="pull-right col-md-3">
                                                    <input type="hidden" name="id" value="<?=$staff['id']?>">
                                                    <input type="submit" name="edit_staff" value="Submit" class="btn btn-success btn-clean">
                                                </div>
                                                <div class="pull-right col-md-2">
                                                    <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal modal-info" id="reset_password<?=$y?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">YOU SURE YOU WANT TO RESET PASSWORD FOR THIS STAFF ?</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-md-2 pull-right">
                                                    <input type="hidden" name="lastname" value="<?=$staff['lastname']?>">
                                                    <input type="hidden" name="email" value="<?=$staff['email_address']?>">
                                                    <input type="hidden" name="id" value="<?=$staff['id']?>">
                                                    <input type="submit" name="reset_password" value="RESET" class="btn btn-default btn-clean">
                                                </div>
                                                <div class="col-md-2 pull-right">
                                                    <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal modal-danger" id="delete_staff<?=$y?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">YOU SURE YOU WANT TO DELETE THIS STAFF ?</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-md-2 pull-right">
                                                    <input type="hidden" name="id" value="<?=$staff['id']?>">
                                                    <input type="submit" name="delete_staff" value="DELETE" class="btn btn-default btn-clean">
                                                </div>
                                                <div class="col-md-2 pull-right">
                                                    <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php $x++;}$y++;}?>
                        </tbody>
                    </table>

                </div>
            </div>
        <?php }
        elseif($_GET['id'] == 2){?>
            <div class="row">
                <div class="col-md-6">
                    <div class="block">
                        <div class="header">
                            <h2>COUNTRIES</h2>
                        </div>
                        <div class="content">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                    <th>SHORT CODE</th>
                                    <th>MANAGE</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $x=1;foreach($override->get('country','status',1) as $country){?>
                                        <tr>
                                            <td><?=$x?></td>
                                            <td><?=$country['name']?></td>
                                            <td><?=$country['short_code']?></td>
                                            <td>
                                                <a href="#edit_country<?=$x?>" data-toggle="modal" class="widget-icon" title="Edit Site Information"><span class="icon-pencil"></span></a>
                                                <a href="#delete_country<?=$x?>" data-toggle="modal" class="widget-icon" title="Delete Site"><span class="icon-trash"></span></a>
                                            </td>
                                        </tr>
                                        <div class="modal" id="edit_country<?=$x?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="post">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title">EDIT COUNTRY</h4>
                                                        </div>
                                                        <div class="modal-body clearfix">
                                                            <div class="controls">
                                                                <div class="form-row">
                                                                    <div class="col-md-2">Name:</div>
                                                                    <div class="col-md-10">
                                                                        <input type="text" name="country_name" class="form-control" value="<?=$country['name']?>" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="col-md-2">Short Code:</div>
                                                                    <div class="col-md-10">
                                                                        <input type="text" name="short_code" class="form-control" value="<?=$country['short_code']?>" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="pull-right col-md-3">
                                                                <input type="hidden" name="id" value="<?=$country['id']?>">
                                                                <input type="submit" name="edit_country" value="Submit" class="btn btn-success btn-clean">
                                                            </div>
                                                            <div class="pull-right col-md-2">
                                                                <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal modal-danger" id="delete_country<?=$x?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="post">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title">YOU SURE YOU WANT TO DELETE THIS COUNTRY</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="col-md-2 pull-right">
                                                                <input type="hidden" name="id" value="<?=$country['id']?>">
                                                                <input type="submit" name="delete_country" value="DELETE" class="btn btn-default btn-clean">
                                                            </div>
                                                            <div class="col-md-2 pull-right">
                                                                <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php $x++;}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block">
                        <div class="header">
                            <h2>SITES</h2>
                        </div>
                        <div class="content">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                    <th>SHORT CODE</th>
                                    <th>COUNTY</th>
                                    <th>MANAGE</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $x=1;foreach($override->get('site','status',1) as $site){$country=$override->get('country','id',$site['c_id'])?>
                                    <tr>
                                        <td><?=$x?></td>
                                        <td><?=$site['name']?></td>
                                        <td><?=$site['short_code']?></td>
                                        <td><?=$country[0]['name']?></td>
                                        <td>
                                            <a href="#edit_site<?=$x?>" data-toggle="modal" class="widget-icon" title="Edit Site Information"><span class="icon-pencil"></span></a>
                                            <a href="#delete_site<?=$x?>" data-toggle="modal" class="widget-icon" title="Delete Site"><span class="icon-trash"></span></a>
                                        </td>
                                    </tr>
                                    <div class="modal" id="edit_site<?=$x?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="post">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title">EDIT SITE</h4>
                                                    </div>
                                                    <div class="modal-body clearfix">
                                                        <div class="controls">
                                                            <div class="form-row">
                                                                <div class="col-md-2">Name:</div>
                                                                <div class="col-md-10">
                                                                    <input type="text" name="site_name" class="form-control" value="<?=$site['name']?>" />
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-md-2">Short Code:</div>
                                                                <div class="col-md-10">
                                                                    <input type="text" name="short_code" class="form-control" value="<?=$site['short_code']?>" />
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-md-2">Country:</div>
                                                                <div class="col-md-10">
                                                                    <select class="form-control" name="country_id">
                                                                        <option value="<?=$country[0]['id']?>"><?=$country[0]['name']?></option>
                                                                        <?php foreach($override->getData('country') as $country){?>
                                                                            <option value="<?=$country['id']?>"><?=$country['name']?></option>
                                                                        <?php }?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="pull-right col-md-3">
                                                            <input type="hidden" name="id" value="<?=$site['id']?>">
                                                            <input type="submit" name="edit_site" value="Submit" class="btn btn-success btn-clean">
                                                        </div>
                                                        <div class="pull-right col-md-2">
                                                            <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal modal-danger" id="delete_site<?=$x?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="post">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">YOU SURE YOU WANT TO DELETE THIS SITE</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="col-md-2 pull-right">
                                                        <input type="hidden" name="id" value="<?=$site['id']?>">
                                                        <input type="submit" name="delete_site" value="DELETE" class="btn btn-default btn-clean">
                                                    </div>
                                                    <div class="col-md-2 pull-right">
                                                        <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $x++;}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        elseif($_GET['id'] == 3){?>
            <div class="block">
                <div class="header">
                    <h2>CRFs VERSIONS</h2>
                </div>
                <div class="content">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="30%">CRF NAME</th>
                            <th width="30%">COUNTRY</th>
                            <th width="10%">VERSION</th>
                            <th width="10%">VERSION DATE</th>
                            <th width="10%">STATUS</th>
                            <th width="15%">VIEW CRF</th>
                            <th width="20%">MANAGE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x=1;foreach($override->getData('crf_versions') as $crf){$country=$override->get('country','id',$crf['c_id'])?>
                            <tr>
                                <td><?=$x?></td>
                                <td><?=$crf['name']?></td>
                                <td><?=$country[0]['name']?></td>
                                <td><?='V. '.$crf['version']?></td>
                                <td><?=$crf['v_date']?></td>
                                <td><div class="btn-group btn-group-xs"> <?php if($crf['status'] == 1){?><button class="btn btn-success">ACTIVE</button> <?php }else{?><button class="btn btn-warning">INACTIVE</button><?php }?></div></td>
                                <td><div class="btn-group btn-group-xs"><a href="read.php?path=<?=$crf['attachment']?>" target="_blank" class="btn btn-success btn-clean">Click to View CRF</a></div></td>
                                <td>
                                    <a href="#crf_active<?=$x?>" data-toggle="modal" class="widget-icon" title="CRF Activation"><span class="icon-gear"></span></a>
                                </td>
                            </tr>
                            <div class="modal" id="crf_active<?=$x?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form enctype="multipart/form-data" method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">MANAGE CRFs</h4>
                                            </div>
                                            <div class="modal-body clearfix">
                                                <div class="controls">
                                                    <div class="form-row">
                                                        <div class="col-md-2">Activate CRF:</div>
                                                        <div class="col-md-2">
                                                            <label class="switch">
                                                                <input type="checkbox" name="active" class="skip" value="1" <?php if($crf['status'] == 1){echo'checked';}else{echo'';}?>/>
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    <div class="item active">
                                                                        <div class="carousel-content">
                                                                            <p>Activate CRF this to be used as standard CRF for collecting date throughout the entire project</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item">
                                                                        <div class="carousel-content">
                                                                            <p>When Activated, this CRF will be available for download by all staff throughout the project </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                                                    <span class="icon-chevron-left"></span>
                                                                </a>
                                                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                                                    <span class="icon-chevron-right"></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label class="col-md-12"></label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="pull-right col-md-3">
                                                    <input type="hidden" value="<?=$crf['id']?>" name="id">
                                                    <input type="submit" name="activate_crf" value="Submit" class="btn btn-success btn-clean">
                                                </div>
                                                <div class="pull-right col-md-2">
                                                    <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php $x++;}?>
                        </tbody>
                    </table>

                </div>
            </div>
        <?php }
        elseif($_GET['id'] == 4){?>
            <div class="block">
                <div class="header">
                    <h2>SOPs</h2>
                </div>
                <div class="content">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="30%">SOP NAME</th>
                            <th width="15%">VIEW SOP</th>
                            <th width="20%">DOWNLOAD</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x=1;foreach($override->getData('sop') as $sop){?>
                            <tr>
                                <td><?=$x?></td>
                                <td><?=$sop['name']?></td>
                                <td><div class="btn-group btn-group-xs"><a href="read.php?path=<?=$sop['attachment']?>" target="_blank" class="btn btn-info btn-clean"><span class="icon-eye-open"></span> Click to View SOP</a></div></td>
                                <td><div class="btn-group btn-group-xs"><a href="download.php?file=<?=$sop['attachment']?>" class="btn btn-success btn-clean"><span class="icon-download"></span> Click to Download</a></div></td>
                            </tr>
                            <?php $x++;}?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php }
        elseif($_GET['id'] == 5){?>
            <div class="block">
                <div class="header">
                    <h2>CRFs</h2>
                </div>
                <div class="content">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="30%">CRF NAME</th>
                            <th width="15%">VIEW CRF</th>
                            <th width="20%">DOWNLOAD</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x=1;foreach($override->get('crf_versions','status',1) as $crf){?>
                            <tr>
                                <td><?=$x?></td>
                                <td><?=$crf['name']?></td>
                                <td><div class="btn-group btn-group-xs"><a href="read.php?path=<?=$crf['attachment']?>" target="_blank" class="btn btn-info btn-clean"><span class="icon-eye-open"></span> Click to View CRF</a></div></td>
                                <td><div class="btn-group btn-group-xs"><a href="download.php?file=<?=$crf['attachment']?>" class="btn btn-success btn-clean"><span class="icon-download"></span> Click to Download</a></div></td>
                            </tr>
                            <?php $x++;}?>
                        </tbody>
                    </table>

                </div>
            </div>
        <?php }
        elseif($_GET['id'] == 6){?>
            <div class="block">
                <div class="header">
                    <h2 style="color: #1DC116">ALL SCANNED CRFs FOR ALL COUNTRIES</h2>
                </div>
                <div class="content">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">CRF NAME</th>
                            <th width="10%">QUANTITY</th>
                            <th width="15%">VIEW</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x=1;$no=0;foreach($override->getData('crf_type') as $crf){$check=$override->get('crf_record','crf_id',$crf['id']);
                            if($check){ if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){
                                $no=$override->countNoRepeat1('crf_record','tb_crf_id','crf_id',$crf['id']);
                            }elseif ($user->data()->access_level == 4 || $user->data()->access_level == 5){
                                $no=$override->countNoRepeat2('crf_record','tb_crf_id','crf_id',$crf['id'],'c_id',$user->data()->c_id);
                            }elseif ($user->data()->access_level == 6){
                                $no=$override->countNoRepeat3('crf_record','tb_crf_id','crf_id',$crf['id'],'c_id',$user->data()->c_id,'s_id',$user->data()->s_id);
                            }
                            }else{$no=0;}?>
                            <tr>
                                <td><?=$x?></td>
                                <td><?=$crf['name']?></td>
                                <td><div class="btn-group btn-group-xs"><button class="btn btn-info">&nbsp;<?=$no?>&nbsp;</button></div></td>
                                <td><div class="btn-group btn-group-xs"><a href="info.php?id=11&crf=<?=$crf['id']?>" class="btn btn-info btn-clean"><span class="icon-eye-open"></span> Click to View</a></div></td>
                            </tr>
                            <?php $x++;}?>
                        </tbody>
                    </table>

                </div>
            </div>
        <?php }
        elseif($_GET['id'] == 7){?>
            <div class="block">
                <div class="header">
                    <h2>CRFs USED</h2>
                </div>
                <div class="content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>NAME</th>
                            <th>MANAGE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x=1;foreach($override->get('crf_type','status',1) as $c_type){?>
                            <tr>
                                <td><?=$x?></td>
                                <td><?=$c_type['name']?></td>
                                <td>
                                    <a href="#edit_type<?=$x?>" data-toggle="modal" class="widget-icon" title="Edit CRF Information"><span class="icon-pencil"></span></a>
                                    <a href="#delete_type<?=$x?>" data-toggle="modal" class="widget-icon" title="Delete CRF"><span class="icon-trash"></span></a>
                                </td>
                            </tr>
                            <div class="modal" id="edit_type<?=$x?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">EDIT CRFs</h4>
                                            </div>
                                            <div class="modal-body clearfix">
                                                <div class="controls">
                                                    <div class="form-row">
                                                        <div class="col-md-2">Name:</div>
                                                        <div class="col-md-10">
                                                            <input type="text" name="crf_name" class="form-control" value="<?=$c_type['name']?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="pull-right col-md-3">
                                                    <input type="hidden" name="id" value="<?=$c_type['id']?>">
                                                    <input type="submit" name="edit_c_type" value="Submit" class="btn btn-success btn-clean">
                                                </div>
                                                <div class="pull-right col-md-2">
                                                    <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal modal-danger" id="delete_type<?=$x?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">YOU SURE YOU WANT TO DELETE THIS CRF</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-md-2 pull-right">
                                                    <input type="hidden" name="id" value="<?=$c_type['id']?>">
                                                    <input type="submit" name="delete_c_type" value="DELETE" class="btn btn-default btn-clean">
                                                </div>
                                                <div class="col-md-2 pull-right">
                                                    <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php $x++;}?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php }
        elseif($_GET['id'] == 8){include 'function.php';?>
            <div class="row">
                <div class="col-md-offset-1 col-md-10">
                    <div class="block">
                        <div class="header">
                            <h2>COUNTRY SUMMARY REPORT</h2>
                            <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){?>
                                <button onclick="location.href='export.php?a=a&c='" class="btb btn-info pull-right" >Download All Data</button>
                            <?php }?>
                        </div>
                        <div class="content">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>COUNTRY NAME</th>
                                    <th>SHORT CODE</th>
                                    <th>No.</th>
                                    <th>SITE</th>
                                    <th>DOWNLOAD</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){
                                    $countries=$override->get('country','status',1);
                                }elseif ($user->data()->access_level == 4 || $user->data()->access_level == 5){
                                    $countries=$override->getNews('country','id',$user->data()->c_id,'status',1);
                                }$x=1;foreach ($countries as $country){?>
                                    <tr>
                                        <td><?=$x?></td>
                                        <td><?=$country['name']?></td>
                                        <td><?=$country['short_code']?></td>
                                        <td><div class="btn-group btn-group-xs"><button class="btn btn-info"><?=noCrf($country['id'],4)+noCrf($country['id'],5)+noCrf($country['id'],6)+noCrf($country['id'],3)?></button></div></td>
                                        <td><div class="btn-group btn-group-xs"><a href="#" class="btn btn-success btn-clean">VIEW BY SITE</a></div></td>
                                        <td>
                                            <div class="btn-group btn-group-xs"><button  onclick="location.href='export.php?c=<?=$country['id']?>'" class="btn btn-success btn-clean">EXCEL FORMAT</button></div>&nbsp;&nbsp;
                                            <!--<div class="btn-group btn-group-xs"><button href="#"  class="btn btn-success btn-clean">STATA FORMAT</button></div>-->
                                        </td>
                                    </tr>
                                    <?php $x++;}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        elseif($_GET['id'] == 9) {?>
            <div class="block">
                <div class="header">
                    <h2>SITE SUMMARY REPORT</h2>
                </div>
                <div class="content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>SITE NAME</th>
                            <th>Short Code</th>
                            <th>No.</th>
                            <td>CRFs</td>
                            <th>Download</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){
                            $sites=$override->get('site','status',1);
                        }elseif ($user->data()->access_level == 4 || $user->data()->access_level == 5){
                            $sites=$override->getNews('site','c_id',$user->data()->c_id,'status',1);
                        }$x=1;foreach ($sites as $site){?>
                            <tr>
                                <td><?=$x?></td>
                                <td><?=$site['name']?></td>
                                <td><?=$site['short_code']?></td>
                                <td><div class="btn-group btn-group-xs"><button class="btn btn-info">4</button></div></td>
                                <td><div class="btn-group btn-group-xs"><a href="info.php?id=10" class="btn btn-success btn-clean">VIEW BY CRFs</a></div></td>
                                <td>
                                    <div class="btn-group btn-group-xs"><a href="#" target="_blank" class="btn btn-success btn-clean">EXCEL FORMAT</a></div>&nbsp;&nbsp;
                                    <div class="btn-group btn-group-xs"><a href="#" target="_blank" class="btn btn-success btn-clean">STATA FORMAT</a></div>
                                </td>
                            </tr>
                        <?php $x++;}?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php }
        elseif($_GET['id'] == 10){?>
            <div class="block">
                <div class="header">
                    <h2>AMANA SITE SUMMARY REPORT</h2>
                </div>
                <div class="content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>CRF NAME</th>
                            <th>No.</th>
                            <th>Download</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>SCREENING CRF</td>
                            <td><div class="btn-group btn-group-xs"><button class="btn btn-info">4</button></div></td>
                            <td>
                                <div class="btn-group btn-group-xs"><a href="#" target="_blank" class="btn btn-success btn-clean">EXCEL FORMAT</a></div>&nbsp;&nbsp;
                                <div class="btn-group btn-group-xs"><a href="#" target="_blank" class="btn btn-success btn-clean">STATA FORMAT</a></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php }
        elseif ($_GET['id'] == 11){?>
            <div class="block block-drop-shadow">
                <div class="header">
                    <h2>SEARCH FOR CRF</h2>
                </div>
                <div class="content controls">
                    <form method="post">
                        <div class="form-row">
                            <div class="col-md-6">
                                <input type="text" name="crf_id" class="form-control" placeholder="ENTER CRF ID" required/>
                            </div>
                            <div class="col-md-2">
                                <input type="submit" name="search" value="Search" class="btn btn-info">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php if($data){?>
                <div class="block">
                    <div class="header">
                        <h2>SCANNED CRFs</h2>
                    </div>
                    <div class="content">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="55%">CRF ID</th>
                                <th width="10%">SITE</th>
                                <th width="10%">DATE</th>
                                <th width="15%">VIEW</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x=1;$no=0;
                            foreach($data as $crf){$site=$override->get('site','id',$crf['s_id']) ?>
                                <tr>
                                    <td><?=$x?></td>
                                    <td><?=$crf['tb_crf_id']?></td>
                                    <td><?=$site[0]['short_code']?></td>
                                    <td><?=$crf['up_date']?></td>
                                    <td><div class="btn-group btn-group-xs"><a href="info.php?id=12&crf=<?=$crf['tb_crf_id']?>" class="btn btn-info btn-clean"><span class="icon-eye-open"></span> Click to View </a></div></td>
                                </tr>
                                <?php $x++;}?>
                            </tbody>
                        </table>

                    </div>
                </div>
            <?php }else{?>
                <div class="block">
                    <div class="header">
                        <h2>SCANNED CRFs</h2>
                    </div>
                    <div class="content">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="55%">CRF ID</th>
                                <th width="10%">SITE</th>
                                <th width="10%">DATE</th>
                                <th width="15%">VIEW</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x=1;$no=0;$site=null;if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){
                                $data = $override->getNoRepeatD3('crf_record','tb_crf_id','up_date','s_id','crf_id',$_GET['crf']);
                            }elseif ($user->data()->access_level == 4 || $user->data()->access_level == 5){
                                $data = $override->getSelectNoRepeat3('crf_record','tb_crf_id','up_date','s_id','crf_id',$_GET['crf'],'c_id',$user->data()->c_id);
                            }elseif ($user->data()->access_level == 6){
                                $data = $override->getSelectData3('crf_record','tb_crf_id','up_date','s_id','crf_id',$_GET['crf'],'c_id',$user->data()->c_id,'s_id',$user->data()->s_id);
                            }
                            foreach($data as $crf){$site=$override->get('site','id',$crf['s_id']) ?>
                                <tr>
                                    <td><?=$x?></td>
                                    <td><?=$crf['tb_crf_id']?></td>
                                    <td><?=$site[0]['short_code']?></td>
                                    <td><?=$crf['up_date']?></td>
                                    <td><div class="btn-group btn-group-xs"><a href="info.php?id=12&crf=<?=$crf['tb_crf_id']?>" class="btn btn-info btn-clean"><span class="icon-eye-open"></span> Click to View </a></div></td>
                                </tr>
                                <?php $x++;}?>
                            </tbody>
                        </table>

                    </div>
                </div>
            <?php }?>
        <?php }
        elseif ($_GET['id'] == 12){?>
            <div class="block">
                <div class="header">
                    <h2>SCANNED CRFs</h2>
                </div>
                <div class="content">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="20%">CRF ID#</th>
                            <th width="10%">PAGE No.</th>
                            <th width="15%">UPLOADED DATE</th>
                            <th width="15%">VIEW CRF</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x=1;if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){
                            $data = $override->get('crf_record','tb_crf_id',$_GET['crf']);
                        }elseif($user->data()->access_level == 4 || $user->data()->access_level == 5){
                            $data = $override->getNews('crf_record','c_id',$user->data()->c_id,'tb_crf_id',$_GET['crf']);
                        }elseif ($user->data()->access_level == 6){
                            $data = $override->selectData('crf_record','c_id',$user->data()->id,'s_id',$user->data()->s_id,'crf_id',$_GET['crf']);
                        }
                        foreach($data as $crf){$name=$override->get('crf_type','id',$crf['crf_id'])?>
                            <tr>
                                <td><?=$x?></td>
                                <td><?=$crf['tb_crf_id']?></td>
                                <td><?=$crf['page']?></td>
                                <td><?=$crf['up_date']?></td>
                                <td><div class="btn-group btn-group-xs"><a href="read.php?path=<?=$crf['attachment']?>" target="_blank" class="btn btn-info btn-clean"><span class="icon-eye-open"></span> Click to View CRF</a></div></td>
                            </tr>
                            <?php $x++;}?>
                        </tbody>
                    </table>

                </div>
            </div>
        <?php }
        elseif ($_GET['id'] == 13){?>
            <div class="block">
                <div class="header">
                    <h2 style="color: #1DC116">ALL SCANNED CRFs FOR <?=$override->get('country','id',$_GET['c'])[0]['name']?></h2>
                </div>
                <div class="content">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">CRF NAME</th>
                            <th width="10%">QUANTITY</th>
                            <th width="15%">VIEW</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x=1;$no=0;foreach($override->getData('crf_type') as $crf){$check=$override->get('crf_record','c_id',$_GET['c']);
                            if($check){
                                $no=$override->countNoRepeat2('crf_record','tb_crf_id','crf_id',$crf['id'],'c_id',$user->data()->c_id);
                            }else{$no=0;}?>
                            <tr>
                                <td><?=$x?></td>
                                <td><?=$crf['name']?></td>
                                <td><div class="btn-group btn-group-xs"><button class="btn btn-info">&nbsp;<?=$no?>&nbsp;</button></div></td>
                                <td><div class="btn-group btn-group-xs"><a href="info.php?id=11&crf=<?=$crf['id']?>" class="btn btn-info btn-clean"><span class="icon-eye-open"></span> Click to View</a></div></td>
                            </tr>
                            <?php $x++;}?>
                        </tbody>
                    </table>

                </div>
            </div>
        <?php }
        elseif ($_GET['id'] == 14){?>
            <div class="block">
                <div class="header">
                    <h2 style="color: #1DC116">ALL SCANNED CRFs FOR <?=$override->get('site','id',$_GET['s'])[0]['name']?></h2>
                </div>
                <div class="content">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">CRF NAME</th>
                            <th width="10%">QUANTITY</th>
                            <th width="15%">VIEW</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x=1;$no=0;foreach($override->getData('crf_type') as $crf){$check=$override->get('crf_record','c_id',$_GET['c']);
                            if($check){
                                $no=$override->countNoRepeat3('crf_record','tb_crf_id','crf_id',$crf['id'],'c_id',$_GET['c'],'s_id',$_GET['s']);
                            }else{$no=0;}?>
                            <tr>
                                <td><?=$x?></td>
                                <td><?=$crf['name']?></td>
                                <td><div class="btn-group btn-group-xs"><button class="btn btn-info">&nbsp;<?=$no?>&nbsp;</button></div></td>
                                <td><div class="btn-group btn-group-xs"><a href="info.php?id=11&crf=<?=$crf['id']?>" class="btn btn-info btn-clean"><span class="icon-eye-open"></span> Click to View</a></div></td>
                            </tr>
                            <?php $x++;}?>
                        </tbody>
                    </table>

                </div>
            </div>
        <?php }
        elseif ($_GET['id'] == 15){?>
            <?php if($_GET['c']){?>
                <div class="block">
                    <div class="header">
                        <h2>SCANNED CRFs</h2>
                    </div>
                    <div class="content">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="55%">CRF ID</th>
                                <th width="10%">SITE</th>
                                <th width="10%">DATE</th>
                                <th width="15%">VIEW</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x=1;$no=0;$data=$override->get('crf_record','id',$_GET['c']);
                            foreach($data as $crf){$site=$override->get('site','id',$crf['s_id'])?>
                                <tr>
                                    <td><?=$x?></td>
                                    <td><?=$crf['tb_crf_id']?></td>
                                    <td><?=$site[0]['short_code']?></td>
                                    <td><?=$crf['up_date']?></td>
                                    <td><div class="btn-group btn-group-xs"><a href="info.php?id=12&crf=<?=$crf['tb_crf_id']?>" class="btn btn-info btn-clean"><span class="icon-eye-open"></span> Click to View </a></div></td>
                                </tr>
                                <?php $x++;}?>
                            </tbody>
                        </table>

                    </div>
                </div>
            <?php }else{?>
                <div class="block">
                    <div class="header">
                        <h2>SCANNED CRFs</h2>
                    </div>
                    <div class="content">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="55%">CRF ID</th>
                                <th width="10%">SITE</th>
                                <th width="10%">DATE</th>
                                <th width="15%">VIEW</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            <?php }?>
        <?php }
        elseif ($_GET['id'] == 16){?>
            <div class="block">
                <div class="header">
                    <h2>LIST OF QUERIES</h2>
                    <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){?>
                        <a class="pull-right btn btn-danger" href="#rise_query" data-toggle="modal" data-backdrop="static">Rise Query</a>
                    <?php }?>
                    <a class="pull-right btn btn-info" href="info.php?id=17">Pending Query</a>
                    <a class="pull-right btn btn-success" href="info.php?id=19">Solved Query</a>
                </div>
                <div class="content">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="15%">SUBJECT</th>
                            <th width="25%">DETAILS</th>
                            <th width="15%">CRF</th>
                            <th width="10%">DATE</th>
                            <th width="10%">STATUS</th>
                            <th width="10">GENERATED BY</th>
                            <th width="10%">VIEW</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x=1;$no=0;if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){
                            $data=$override->getSort('query_logs','status',0,'id');
                        }elseif ($user->data()->access_level == 4 || $user->data()->access_level == 5){
                            $data=$override->getSort2('query_logs','c_id',$user->data()->c_id,'status',0,'id');
                        }elseif ($user->data()->access_level == 6){
                            $data=$override->getSort2('query_logs','s_id',$user->data()->s_id,'status',0,'id');
                        }
                        foreach($data as $crf){$site=$override->get('site','id',$crf['s_id']) ?>
                            <tr>
                                <td><?=$x?></td>
                                <td><?=$crf['subject']?></td>
                                <td><?=$user->customStringLength($crf['details'],80)?></td>
                                <td><?=$crf['crf_id']?></td>
                                <td><?=$crf['q_date']?></td>
                                <td><div class="btn-group btn-group-xs"> <?php if($crf['status'] == 1){?><button class="btn btn-success">SOLVED</button> <?php }else{?><button class="btn btn-danger">NOT SOLVED</button><?php }?></div></td>
                                <td><?php if($crf['staff_id'] == 2){echo 'System';}else{echo 'Data Manager';}?></td>
                                <td><div class="btn-group btn-group-xs"><a href="query.php?id=<?=$crf['id']?>" class="btn btn-info btn-clean"><span class="icon-eye-open"></span> Click to View </a></div></td>
                            </tr>
                            <?php $x++;}?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php }
        elseif ($_GET['id'] == 17){?>
            <div class="block">
                <div class="header">
                    <h2>PENDING QUERIES</h2>
                </div>
                <div class="content">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="15%">SUBJECT</th>
                            <th width="25%">DETAILS</th>
                            <th width="15%">CRF</th>
                            <th width="10%">DATE</th>
                            <th width="10%">STATUS</th>
                            <th width="10">GENERATED BY</th>
                            <th width="10%">VIEW</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x=1;$no=0;if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){
                            $data=$override->getSort('query_logs','status',2,'id');
                        }elseif ($user->data()->access_level == 4 || $user->data()->access_level == 5){
                            $data=$override->getSort2('query_logs','c_id',$user->data()->c_id,'status',2,'id');
                        }elseif ($user->data()->access_level == 6){
                            $data=$override->getSort2('query_logs','s_id',$user->data()->s_id,'status',2,'id');
                        }
                        foreach($data as $crf){$site=$override->get('site','id',$crf['s_id']) ?>
                            <tr>
                                <td><?=$x?></td>
                                <td><?=$crf['subject']?></td>
                                <td><?=$user->customStringLength($crf['details'],80)?></td>
                                <td><?=$crf['crf_id']?></td>
                                <td><?=$crf['q_date']?></td>
                                <td><div class="btn-group btn-group-xs"> <?php if($crf['status'] == 2){?><button class="btn btn-info">PENDING</button> <?php }else{?><button class="btn btn-danger">NOT SOLVED</button><?php }?></div></td>
                                <td><?php if($crf['staff_id'] == 2){echo 'System';}else{echo 'Data Manager';}?></td>
                                <td><div class="btn-group btn-group-xs"><a href="info.php?id=18&q=<?=$crf['id']?>" class="btn btn-info btn-clean"><span class="icon-eye-open"></span> Click to View </a></div></td>
                            </tr>
                            <?php $x++;}?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php }
        elseif ($_GET['id'] == 18){?>
            <div class="block">
                <div class="header">
                    <h2>PENDING QUERIES</h2>
                </div>
                <div class="content">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="15%">SUBJECT</th>
                            <th width="30%">DETAILS</th>
                            <th width="10%">DATE</th>
                            <th width="10%">UPLOADED BY</th>
                            <th width="10%">VIEW</th>
                            <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){?>
                                <th width="20%">ACTION</th>
                            <?php }?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x=1;$no=0;$data=$override->get('query_rep','q_id',$_GET['q']);
                        foreach($data as $crf){$staff=$override->get('staff','id',$crf['staff_id']) ?>
                            <tr>
                                <td><?=$x?></td>
                                <td><?=$crf['subject']?></td>
                                <td><?=$crf['details']?></td>
                                <td><?=$crf['q_date']?></td>
                                <td><?=$staff[0]['firstname'].' '.$staff[0]['lastname']?></td>
                                <td><div class="btn-group btn-group-xs"><a href="read.php?path=<?=$crf['attachment']?>" class="btn btn-info btn-clean" target="_blank"><span class="icon-eye-open"></span> Click to View </a></div></td>
                                <?php if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){?>
                                    <td>
                                        <div class="btn-group btn-group-xs"><a href="#clear<?=$x?>" class="btn btn-success btn-clean" data-toggle="modal"><span class="icon-gear"></span> CLEAR </a></div>
                                        <div class="btn-group btn-group-xs"><a href="#" class="btn btn-warning btn-clean" target="_blank"><span class="icon-gear"></span> RESOLVE </a></div>
                                    </td>
                                <?php }?>
                            </tr>
                            <div class="modal" id="clear<?=$x?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form enctype="multipart/form-data" method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">CLEAR QUERY</h4>
                                            </div>
                                            <div class="modal-body clearfix">
                                                <div class="controls">
                                                    <div class="form-row">
                                                        <div class="col-md-2">Clear Query:</div>
                                                        <div class="col-md-2">
                                                            <label class="switch">
                                                                <input type="checkbox" name="active" class="skip" value="1" <?php /*if($crf['status'] == 1){echo'checked';}else{echo'';}*/?>/>
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    <div class="item active">
                                                                        <div class="carousel-content">
                                                                            <p>Query will me marked as solved</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item">
                                                                        <div class="carousel-content">
                                                                            <p>You can turn reverse this action if query is not solved</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                                                    <span class="icon-chevron-left"></span>
                                                                </a>
                                                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                                                    <span class="icon-chevron-right"></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label class="col-md-12"></label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="pull-right col-md-3">
                                                    <input type="hidden" value="<?=$crf['id']?>" name="id">
                                                    <input type="submit" name="clearQ" value="Clear" class="btn btn-success btn-clean">
                                                </div>
                                                <div class="pull-right col-md-2">
                                                    <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php $x++;}?>
                        </tbody>
                    </table>

                </div>
            </div>
        <?php }
        elseif ($_GET['id'] == 19){?>
            <div class="block">
                <div class="header">
                    <h2>SOLVED QUERIES</h2>
                </div>
                <div class="content">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="15%">SUBJECT</th>
                            <th width="25%">DETAILS</th>
                            <th width="15%">CRF</th>
                            <th width="10%">DATE</th>
                            <th width="10%">STATUS</th>
                            <th width="10">GENERATED BY</th>
                            <th width="10%">VIEW</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x=1;$no=0;if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){
                            $data=$override->getSort('query_logs','status',1,'id');
                        }elseif ($user->data()->access_level == 4 || $user->data()->access_level == 5){
                            $data=$override->getSort2('query_logs','c_id',$user->data()->c_id,'status',1,'id');
                        }elseif ($user->data()->access_level == 6){
                            $data=$override->getSort2('query_logs','s_id',$user->data()->s_id,'status',1,'id');
                        }
                        foreach($data as $crf){$site=$override->get('site','id',$crf['s_id']) ?>
                            <tr>
                                <td><?=$x?></td>
                                <td><?=$crf['subject']?></td>
                                <td><?=$user->customStringLength($crf['details'],80)?></td>
                                <td><?=$crf['crf_id']?></td>
                                <td><?=$crf['q_date']?></td>
                                <td><div class="btn-group btn-group-xs"> <?php if($crf['status'] == 1){?><button class="btn btn-info">SOLVED</button> <?php }else{?><button class="btn btn-danger">NOT SOLVED</button><?php }?></div></td>
                                <td><?php if($crf['staff_id'] == 2){echo 'System';}else{echo 'Data Manager';}?></td>
                                <td><div class="btn-group btn-group-xs"><a href="info.php?id=18&q=<?=$crf['id']?>" class="btn btn-info btn-clean"><span class="icon-eye-open"></span> Click to View </a></div></td>
                            </tr>
                            <?php $x++;}?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php }?>
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