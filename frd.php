<?php
require_once 'php/core/init.php';
$user = new User();
$override = new OverideData();$usr=null;
$email = new Email();$st=null;
$random = new Random();
/*foreach ($override->get('staff','status',1) as $staff){
    print_r($staff['email_address']);
    //print_r($email->systemMail($staff['email_address'],'SYSTEM MAINTENANCE'));echo ' , ';
}
//print_r($email->systemMail('frdrckaman@gmail.com','SYSTEM MAINTENANCE'));*/
print_r(Hash::make($password,$salt));
//print_r($user->loginUser('FEC/337331','123456','staff'));
$string='123456';
$salt = 'ã�I«uK:^eý¦ûÅi{—>¡ñF;/B“~Íbx';
//print_r($user->data()->salt);echo'<br>';
//echo 'ãI«uK:^eý¦ûÅi{—>¡ñF;/B“~Íbx';
//print_r($user->findUser('FEC/337331','staff'));
print_r(hash('sha256',$string.$user->data()->salt));
echo '<br>';
print_r(hash('sha256','123456'.$user->frd('FEC/337331','123456','staff')));
echo '<br>';
print_r(hash('sha256','123456'.$override->get('staff','username','FEC/337331')[0]['salt']));
print_r(hash('sha256','123456'.$user->loginUser('FEC/337331','123456','staff')));