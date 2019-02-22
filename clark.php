<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
if(!$user->isLoggedIn()) {

}else{
    Redirect::to('index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Webslesson Tutorial | Datatables Jquery Plugin with Php MySql and Bootstrap</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
</head>
<body>
<br /><br />
<div class="container">
    <h3 align="center">Datatables Jquery Plugin with Php MySql and Bootstrap</h3>
    <br />
    <div class="table-responsive">
        <table id="employee_data" class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>Name</td>
                <td>Address</td>
                <td>Gender</td>
                <td>Designation</td>
                <td>Age</td>
            </tr>
            </thead>
            <?php foreach ($override->getData('crf_record') as $data){?>
                <tr>
                    <td><?=$data['crf_id']?></td>
                    <td><?=$data['crf_id']?></td>
                    <td><?=$data['tb_crf_id']?></td>
                    <td><?=$data['crf_id']?></td>
                    <td><?=$data['up_date']?></td>
                </tr>
            <?php }?>
        </table>
    </div>
</div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#employee_data').DataTable();
    });
</script>
