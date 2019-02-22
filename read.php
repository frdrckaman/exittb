<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
if($user->isLoggedIn()){
    if($_GET){
        $path=$_GET['path'];
        if($path) {
            $file = $path;
            $filename = 'Document.pdf';
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $filename . '"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($file));
            header('Accept-Ranges: bytes');
            echo file_get_contents($file);
        }
    }
}else{
    Redirect::to('403.php');
}
