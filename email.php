<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$email = new Email();
$rand = new Random();
//$staffs=$override->getData('staff');
/*foreach ($staffs as $staff){
   /* if($email->systemUpdate($staff['email_address'],'EXIT-TB SYSTEM UPDATES')){
        echo 'Good , ';
    }
}*/
$crf=$override->get('crf_record','crf_id',7);
print_r(count($override->get('crf_record','tb_crf_id','12110014')));
?>
<html>
    <body>

        <h4> LESS THAN 3 PAGES</h4>
        <table border="1">
            <thead>
            <th>#</th>
            <th>STUDY ID</th>
            <th>PAGES</th>
            </thead>
            <tbody>
            <?php $x=1;foreach ($crf as $data){
                $dt = $override->get('crf_record','crf_id',7,'tb_crf_id',$data['tb_crf_id']);
                if(count($dt)<3){?>
                    <tr>
                        <td><?=$x?></td>
                        <td><?=$data['tb_crf_id']?></td>
                        <td><?=count($dt)?></td>
                    </tr>
                    <?php $x++;}}?>
            </tbody>
        </table>
    </body>
</html>


