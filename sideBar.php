<?php
require_once('php/core/init.php');
$user = new User();
$override = new OverideData();
$site=$override->get('site','id',$user->data()->s_id);
$country=$override->get('country','id',$user->data()->c_id);
?>
<div class="block block-drop-shadow">
    <div class="user bg-default bg-light-rtl">
        <div class="info">
            <a href="#" class="informer informer-three">
                <span><?=$country[0]['short_code']?> / <?=$site[0]['short_code']?></span>
                <?=$user->data()->position?>
            </a>
            <a href="#" class="informer informer-four">
                <span><?=$user->data()->firstname?></span>
                <?=$user->data()->lastname?>
            </a>
            <?php if($user->data()->picture){?>
                <img src="<?=$user->data()->picture?>" class="img-thumbnail img-circle" width="90" height="90"/>
            <?php }else{?>
                <img src="assets/users/blank.png" class="img-thumbnail img-circle"/>
            <?php }?>
        </div>
    </div>
    <!--<div class="content list-group list-group-icons">
        <a href="#upload" data-toggle="modal" class="list-group-item"><span class="icon-bar-chart"></span>Upload CRFs<i class="icon-angle-right pull-right"></i></a>
        <a href="#" class="list-group-item"><span class="icon-envelope"></span>Notification<i class="icon-angle-right pull-right"></i></a>
        <a href="#" class="list-group-item"><span class="icon-cogs"></span>Queries<i class="icon-angle-right pull-right"></i></a>
        <a href="#" class="list-group-item"><span class="icon-edit-sign"></span>Suggestion<i class="icon-angle-right pull-right"></i></a>
        <a href="logout.php" class="list-group-item"><span class="icon-off"></span>Logout<i class="icon-angle-right pull-right"></i></a>
    </div>-->
    <div class="content list-group list-group-icons">
        <a href="#upload" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="list-group-item"><span class="icon-bar-chart"></span>Upload CRFs<i class="icon-angle-right pull-right"></i></a>
        <a href="#r_upload" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="list-group-item" style="color: orangered"><span class="icon-bar-chart" style="color: orangered"></span>Re-upload CRFs<i class="icon-angle-right pull-right"></i></a>
        <!--<a href="mail.php" class="list-group-item"><span class="icon-envelope"></span>Notification<i class="icon-angle-right pull-right"></i></a>
        <a href="info.php?id=8" class="list-group-item"><span class="icon-file-text"></span>Reports<i class="icon-angle-right pull-right"></i></a>
        <a href="charts.php" class="list-group-item"><span class="icon-bar-chart"></span>Statistics<i class="icon-angle-right pull-right"></i></a>-->
        <?php if($user->data()->access_level > 0 && $user->data()->access_level<=5){?>
            <!--<a href="info.php?id=8" class="list-group-item"><span class="icon-file-text"></span>Reports<i class="icon-angle-right pull-right"></i></a>-->
            <!--<a href="info.php?id=8" class="list-group-item"><span class="icon-download"></span>Download<i class="icon-angle-right pull-right"></i></a>-->
        <?php }?>
        <?php if($user->data()->power == 1){?>
            <a href="#upload_data" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="list-group-item"><span class="icon-file-text"></span>Upload Data<i class="icon-angle-right pull-right"></i></a>
            <a href="info.php?id=22" class="list-group-item"><span class="icon-download"></span>Data Download<i class="icon-angle-right pull-right"></i></a>
        <?php }?>
        <a href="info.php?id=21" class="list-group-item"><span class="icon-cogs"></span>Queries<i class="icon-angle-right pull-right"></i></a>
        <a href="#suggestion" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="list-group-item"><span class="icon-edit-sign"></span>Suggestion<i class="icon-angle-right pull-right"></i></a>
        <a href="logout.php" class="list-group-item"><span class="icon-off"></span>Logout<i class="icon-angle-right pull-right"></i></a>
    </div>
</div>