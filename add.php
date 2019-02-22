<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
use PHPMailer\PHPMailer\PHPMailer;
$mail = new PHPMailer();
$c=$override->getData('site');
$s=$override->getData('country');
$table = '<table class="" border="1">
    <thead>
    <tr>
         <th>ID</th>
         <th>NAME</th>
    </tr>
    </thead>
    <tbody>';
$x=1;foreach($c as $data) {
    ;
    $table .= '
        <tr>
            <td>'.$data["id"].'</td>
            <td>'.$data["name"].'</td>
        </tr>';
    $x++;}
$table .='</tbody></table>';

$table1 = '<table class="" border="1">
    <thead>
    <tr>
         <th>ID</th>
         <th>NAME</th>
    </tr>
    </thead>
    <tbody>';
$x=1;foreach($override->getData('staff') as $data) {
    ;
    $table1 .= '
        <tr>
            <td>'.$data["id"].'</td>
            <td>'.$data["username"].'</td>
        </tr>';
    $x++;}
$table1 .='</tbody></table>';

$file = 'frd.xls';
$file1 = 'aman.xls';

file_put_contents($file, $table);
file_put_contents($file1, $table1);

$files = array('frd.xls','aman.xls');
$zipname = 'file.zip';
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
foreach ($files as $file) {
    $zip->addFile($file);
}
$zip->close();
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);
unlink($zipname);


