<?php
require_once('php/core/init.php');
$user = new User();
$override = new OverideData();
if(basename($_SERVER['REQUEST_URI']) != 'export.php'){
    if($user->isLoggedIn()){
        if($user->data()->access_level == 1 || $user->data()->access_level == 2 || $user->data()->access_level == 3){
           if($_GET['c']){
               /************************* CRF01 ****************************/
               $table = '<table class="" border="1">
    <thead>
    <tr>
         <th>country</th>
         <th>institution</th>
         <th>facility</th>
         <th>tbsnum</th>
         <th>vdate</th>
         <th>enum</th>
         <th>clinic1</th>
         <th>clinic2</th>
         <th>rchclinic</th>
         <th>age</th>
         <th>gender</th>
         <th>marital</th>
         <th>other_marital</th>
         <th>occupation</th>
         <th>education</th>
         <th>ward</th>
         <th>village</th>
         <th>location</th>
         <th>leadertencell</th>
         <th>hivpos</th>
         <th>hivposperiod</th>
         <th>onart</th>
         <th>onartperiod</th>
         <th>tbcasecontact</th>
         <th>chronicdx</th>
         <th>chronicillness</th>
         <th>alcohol</th>
         <th>alcoholpres</th>
         <th>tobacco</th>
         <th>tobaccopres</th>
         <th>drug</th>
         <th>drugpres</th>
         
         
         
        
         <th>tbtx</th>
         <th>tbtxperiod</th> 
         <th>tbsx01</th>  
         <th>tbsx01date</th>     
         <th>tbsx02</th>
         <th>tbsx02date</th>
         <th>tbsx03</th>
         <th>tbsx03date</th>
         <th>tbsx04</th>
         <th>tbsx04date</th>
         <th>tbsx05</th>
         <th>tbsx05date</th>
         <th>tbsx06</th>
         <th>tbsx06date</th>
         <th>tbsx_other</th>        
         <th>seekcare01</th>
         <th>seekcare02</th>
         <th>seekcare03</th>
         <th>seekcare05</th>
         <th>seekcare06</th>
         <th>seekcare07</th>
         <th>seekcare08</th>
         <th>seekcare09</th>
         <th>seekcareother</th>
         
    </tr>
    </thead>
    <tbody>';
               $x=1;foreach($override->crf01Data($_GET['c']) as $data) {
                   ;
                   $table .= '
        <tr>
            <td>'.$data["country"].'</td>
            <td>'.$data["institution"].'</td>
            <td>'.$data["facility"].'</td>
            <td>'.$data["tbsnum"].'</td>
            <td>'.$data["vdate"].'</td>
            <td>'.$data["enum"].'</td>
            <td>'.$data["idxenum"].'</td>
            <td>'.$data["clinic"].'</td>
            <td>'.$data["rchclinic"].'</td>
            <td>'.$data["age"].'</td>
            <td>'.$data["gender"].'</td>
            <td>'.$data["marital"].'</td>
            <td>'.$data["other_marital"].'</td>
            <td>'.$data["occupation"].'</td>
            <td>'.$data["education"].'</td>
            <td>'.$data["ward"].'</td>
            <td>'.$data["village"].'</td>
            <td>'.$data["location"].'</td>
            <td>'.$data["leadertencell"].'</td>          
            <td>'.$data["hivpos"].'</td>
            <td>'.$data["hivposperiod"].'</td>
            <td>'.$data["onart"].'</td>
            <td>'.$data["onartperiod"].'</td>
            <td>'.$data["tbcasecontact"].'</td>
            <td>'.$data["chronicdx"].'</td>
            <td>'.$data["chronicillness"].'</td>
            <td>'.$data["alcohol"].'</td>
            <td>'.$data["alcoholpres"].'</td>
            <td>'.$data["tobacco"].'</td>
            <td>'.$data["tobaccopres"].'</td>
            <td>'.$data["drug"].'</td>
            <td>'.$data["drugpres"].'</td>
            <td>'.$data["tbtx"].'</td>
            <td>'.$data["tbtxperiod"].'</td>
           
            
            
            <td>'.$data["tbtx"].'</td>
            <td>'.$data["tbtxperiod"].'</td>
            <td>'.$data["tbsx01"].'</td>                        
            <td>'.$data["tbsx01date"].'</td>
            <td>'.$data["tbsx02"].'</td>
            <td>'.$data["tbsx02date"].'</td>
            <td>'.$data["tbsx03"].'</td>
            <td>'.$data["tbsx03date"].'</td>
            <td>'.$data["tbsx04"].'</td>
            <td>'.$data["tbsx04date"].'</td>
            <td>'.$data["tbsx05"].'</td>
            <td>'.$data["tbsx05date"].'</td>
            <td>'.$data["tbsx06"].'</td>
            <td>'.$data["tbsx06date"].'</td>
            <td>'.$data["tbsx_other"].'</td>
            <td>'.$data["seekcare01"].'</td>
            <td>'.$data["seekcare02"].'</td>
            <td>'.$data["seekcare03"].'</td>
            <td>'.$data["seekcare04"].'</td>
            <td>'.$data["seekcare05"].'</td>
            <td>'.$data["seekcare06"].'</td>
            <td>'.$data["seekcare07"].'</td>
            <td>'.$data["seekcare08"].'</td>
            <td>'.$data["seekcare09"].'</td>
            <td>'.$data["seekcareother"].'</td>
           
        </tr>';
                   $x++;}
               $table .='</tbody></table>';
               /************************* CRF02 ***********************************/

               /************************* ZIP FILES *****************************/
               $file = 'CRF01.xls';
               //$file1 = 'CRF02.xls';

               file_put_contents($file, $table);
               //file_put_contents($file1, $table1);

               //$files = array('CRF01.xls','CRF02.xls');
               $files = array('CRF01.xls');
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
           }
           elseif ($_GET['a']){
               $table = '<table class="" border="1">
    <thead>
    <tr>
         <th>country</th>
         <th>institution</th>
         <th>facility</th>
         <th>tbsnum</th>
         <th>vdate</th>
         <th>enum</th>
         <th>clinic1</th>
         <th>clinic2</th>
         <th>rchclinic</th>
         <th>age</th>
         <th>gender</th>
         <th>marital</th>
         <th>other_marital</th>
         <th>occupation</th>
         <th>education</th>
         <th>ward</th>
         <th>village</th>
         <th>location</th>
         <th>leadertencell</th>
         <th>hivpos</th>
         <th>hivposperiod</th>
         <th>onart</th>
         <th>onartperiod</th>
         <th>tbcasecontact</th>
         <th>chronicdx</th>
         <th>chronicillness</th>
         <th>alcohol</th>
         <th>alcoholpres</th>
         <th>tobacco</th>
         <th>tobaccopres</th>
         <th>drug</th>
         <th>drugpres</th>
      
         
         
        
         <th>tbtx</th>
         <th>tbtxperiod</th> 
         <th>tbsx01</th>  
         <th>tbsx01date</th>     
         <th>tbsx02</th>
         <th>tbsx02date</th>
         <th>tbsx03</th>
         <th>tbsx03date</th>
         <th>tbsx04</th>
         <th>tbsx04date</th>
         <th>tbsx05</th>
         <th>tbsx05date</th>
         <th>tbsx06</th>
         <th>tbsx06date</th>
         <th>tbsx_other</th>        
         <th>seekcare01</th>
         <th>seekcare02</th>
         <th>seekcare03</th>
         <th>seekcare05</th>
         <th>seekcare06</th>
         <th>seekcare07</th>
         <th>seekcare08</th>
         <th>seekcare09</th>
         <th>seekcareother</th>
        
    </tr>
    </thead>
    <tbody>';
               $x=1;foreach($override->crf01DataAll() as $data) {
                   ;
                   $table .= '
         <tr>
            <td>'.$data["country"].'</td>
            <td>'.$data["institution"].'</td>
            <td>'.$data["facility"].'</td>
            <td>'.$data["tbsnum"].'</td>
            <td>'.$data["vdate"].'</td>
            <td>'.$data["enum"].'</td>
            <td>'.$data["idxenum"].'</td>
            <td>'.$data["clinic"].'</td>
            <td>'.$data["rchclinic"].'</td>
            <td>'.$data["age"].'</td>
            <td>'.$data["gender"].'</td>
            <td>'.$data["marital"].'</td>
            <td>'.$data["other_marital"].'</td>
            <td>'.$data["occupation"].'</td>
            <td>'.$data["education"].'</td>
            <td>'.$data["ward"].'</td>
            <td>'.$data["village"].'</td>
            <td>'.$data["location"].'</td>
            <td>'.$data["leadertencell"].'</td>          
            <td>'.$data["hivpos"].'</td>
            <td>'.$data["hivposperiod"].'</td>
            <td>'.$data["onart"].'</td>
            <td>'.$data["onartperiod"].'</td>
            <td>'.$data["tbcasecontact"].'</td>
            <td>'.$data["chronicdx"].'</td>
            <td>'.$data["chronicillness"].'</td>
            <td>'.$data["alcohol"].'</td>
            <td>'.$data["alcoholpres"].'</td>
            <td>'.$data["tobacco"].'</td>
            <td>'.$data["tobaccopres"].'</td>
            <td>'.$data["drug"].'</td>
            <td>'.$data["drugpres"].'</td>
            <td>'.$data["tbtx"].'</td>
            <td>'.$data["tbtxperiod"].'</td>
           
            
           
            <td>'.$data["tbtx"].'</td>
            <td>'.$data["tbtxperiod"].'</td>
            <td>'.$data["tbsx01"].'</td>                        
            <td>'.$data["tbsx01date"].'</td>
            <td>'.$data["tbsx02"].'</td>
            <td>'.$data["tbsx02date"].'</td>
            <td>'.$data["tbsx03"].'</td>
            <td>'.$data["tbsx03date"].'</td>
            <td>'.$data["tbsx04"].'</td>
            <td>'.$data["tbsx04date"].'</td>
            <td>'.$data["tbsx05"].'</td>
            <td>'.$data["tbsx05date"].'</td>
            <td>'.$data["tbsx06"].'</td>
            <td>'.$data["tbsx06date"].'</td>
            <td>'.$data["tbsx_other"].'</td>
            <td>'.$data["seekcare01"].'</td>
            <td>'.$data["seekcare02"].'</td>
            <td>'.$data["seekcare03"].'</td>
            <td>'.$data["seekcare04"].'</td>
            <td>'.$data["seekcare05"].'</td>
            <td>'.$data["seekcare06"].'</td>
            <td>'.$data["seekcare07"].'</td>
            <td>'.$data["seekcare08"].'</td>
            <td>'.$data["seekcare09"].'</td>
            <td>'.$data["seekcareother"].'</td>
          
        </tr>';
                   $x++;}
               $table .='</tbody></table>';
               /*header('Content-Type: application/xls');
               header('Content-Disposition: attachment; filename=all_data.xls');
               echo $table;*/

               /********************************CRF02*******************************************/

               $table1 = '<table class="" border="1">
    <thead>
    <tr>
         <th>country</th>
         <th>institution</th>
         <th>facility</th>
         <th>tbsnum</th>
         <th>vdate</th>
         <th>enum</th>
         <th>idxenum</th>
         <th>clinic</th>
         <th>rchclinic</th>
         <th>age</th>
         <th>gender</th>
         <th>marital</th>
         <th>other_marital</th>
         <th>occupation</th>
         <th>education</th>
         <th>ward</th>
         <th>village</th>
         <th>location</th>
         <th>leadertencell</th>
         <th>phone1</th>
         <th>phone2</th>
         <th>hivpo</th>
         <th>hivposperiod</th>
         <th>onart</th>
         <th>onartperiod</th>
         <th>tbcasecontact</th>
         <th>chronicdx</th>
         <th>chronicillness</th>
         <th>alcohol</th>
         <th>alcoholpres</th>
         <th>tobacco</th>
         <th>tobaccopres</th>
         <th>drug</th>
         <th>drugpres</th>
         <th>tbtx</th>
         <th>tbtxperiod</th>
         <th>fid</th>
         <th>country</th>
         <th>institution</th>
         <th>facility</th>
         <th>tbsnum</th>
         <th>tbsx01</th>
         <th>tbsx01date</th>
         <th>tbsx02</th>
         <th>tbsx02date</th>
         <th>tbsx03</th>
         <th>tbsx03date</th>
         <th>tbsx04</th>
         <th>tbsx04date</th>
         <th>tbsx05</th>
         <th>tbsx05date</th>
         <th>tbsx06</th>
         <th>tbsx06date</th>
         <th>seekcare01</th>
         <th>seekcare02</th>
         <th>seekcare03</th>
         <th>seekcare05</th>
         <th>seekcare06</th>
         <th>seekcareother</th>
         <th>fid</th>
    </tr>
    </thead>
    <tbody>';
               $x=1;foreach($override->crf02DataAll() as $data) {
                   ;
                   $table1 .= '
        <tr>
            <td>'.$data["country"].'</td>
            <td>'.$data["institution"].'</td>
            <td>'.$data["facility"].'</td>
            <td>'.$data["tbsnum"].'</td>
            <td>'.$data["vdate"].'</td>
            <td>'.$data["age"].'</td>
            <td>'.$data["gender"].'</td>
            <td>'.$data["marital"].'</td>
            <td>'.$data["other_marital"].'</td>
            <td>'.$data["occupation"].'</td>
            <td>'.$data["education"].'</td>
            <td>'.$data["ward"].'</td>
            <td>'.$data["village"].'</td>
            <td>'.$data["location"].'</td>
            <td>'.$data["tencell"].'</td>
            <td>'.$data["phone1"].'</td>
            <td>'.$data["phone2"].'</td>
            <td>'.$data["hivpos"].'</td>
            <td>'.$data["hivposyr"].'</td>
            <td>'.$data["onart"].'</td>
            <td>'.$data["onartyr"].'</td>
            <td>'.$data["tbcasecontact"].'</td>
            <td>'.$data["chronicdx"].'</td>
            <td>'.$data["chronicillness"].'</td>
            <td>'.$data["alcohol"].'</td>
            <td>'.$data["alcoholpres"].'</td>
            <td>'.$data["tobacco"].'</td>
            <td>'.$data["tobaccopres"].'</td>
            <td>'.$data["drug"].'</td>
            <td>'.$data["drugpres"].'</td>
            <td>'.$data["tbtx"].'</td>
            <td>'.$data["tbtxyr"].'</td>
            <td>'.$data["fid"].'</td>
            <td>'.$data["country"].'</td>
            <td>'.$data["institution"].'</td>
            <td>'.$data["facility"].'</td>
            <td>'.$data["tbsnum"].'</td>
            <td>'.$data["tbsx01"].'</td>
            <td>'.$data["tbsx01days"].'</td>
            <td>'.$data["tbsx02"].'</td>
            <td>'.$data["tbsx02days"].'</td>
            <td>'.$data["tbsx03"].'</td>
            <td>'.$data["tbsx03days"].'</td>
            <td>'.$data["tbsx04"].'</td>
            <td>'.$data["tbsx04days"].'</td>
            <td>'.$data["tbsx05"].'</td>
            <td>'.$data["tbsx05days"].'</td>
            <td>'.$data["fid"].'</td>
        </tr>';
                   $x++;}
               $table1 .='</tbody></table>';
               /*header('Content-Type: application/xls');
               header('Content-Disposition: attachment; filename=all_data.xls');
               echo $table1;*/
               /**SE_CRF**/
               /**OUT_CRF**/

               /************************* ZIP FILES *****************************/
               $file = 'CRF01.xls';
              // $file1 = 'CRF02.xls';

               file_put_contents($file, $table);
              // file_put_contents($file1, $table1);

               //$files = array('CRF01.xls','CRF02.xls');
               $files = array('CRF01.xls');
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
           }
           elseif ($_GET['s']){}
           elseif ($_GET['crf']){}
        }elseif ($user->data()->access_level == 4 || $user->data()->access_level == 5){
            if($_GET['c']){}elseif ($_GET['s']){}elseif ($_GET['crf']){}
        }else{
            Redirect::to('403.php');
        }
    }else{Redirect::to('index.php');}
}else{Redirect::to('dashboard.php');}




