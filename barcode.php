<?php
require_once 'functions/functions.import.php';
$pdo = null;$pdo = new PDO('mysql:host=localhost;dbname=exittb','admin','afya@3436');
$sql = 'SELECT * FROM processforms WHERE status = 2';
//$sql = "select * from processforms where status = 2 and date < '2019-12-01 00:00:00'";
$query = $pdo->query($sql);
$results = $query->fetchAll(PDO::FETCH_ASSOC);

//print_r($results);
foreach ($results as $result){
    $data = explode('_',$result['filepath']);
    $fileP= $result['filepath'];$pfid=$result['pfid'];
    $c_id=str_split($data[5]);$cid=$c_id[0];
    if($cid == 3){
        if($data[2] == 'CRF01'){
            $sql1 = "SELECT * FROM barcode WHERE crf_code = '$data[2]' AND page = $data[4] AND c_id = 2 AND crf_id = 7";
            $query = $pdo->query($sql1);
            $barcodes = $query->fetchAll(PDO::FETCH_ASSOC);
            $barcode = $barcodes[0]['barcode'];
            print_r($data[5].' : '.$data[4]);echo' , ';
            //print_r($barcode);echo' , ';
            //$sql2 = $pdo->query("UPDATE processforms SET allowanother = 1 WHERE pfid = $pfid");
            //$sql2->execute();
            //importBarcode($result['filepath'],$barcode);

        }elseif ($data[2] == 'TRMNT'){
            print_r($data[5]);echo '<br>';
            $sql1 = "SELECT * FROM barcode WHERE crf_code = 'CRF01' AND page = $data[4] AND c_id = 2 AND crf_id = 4";
            $query = $pdo->query($sql1);
            $barcodes = $query->fetchAll(PDO::FETCH_ASSOC);
            $barcode = $barcodes[0]['barcode'];
            //print_r($barcode);echo' , ';

            //$sql2 = $pdo->query("UPDATE processforms SET allowanother = 1 WHERE pfid = $pfid");
            //$sql2->execute();

            //importBarcode($result['filepath'],$barcode);

        }
    }

}