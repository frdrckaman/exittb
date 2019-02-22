<?php
require_once'../php/core/init.php';
$user = new User();
$override = new OverideData();

$no=0;$crf1=0;$crf2=0;$se_crf=0;$to_crf=0;
$tz=0;$ke=0;$ug=0;$et=0;$su=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
 <!-- If you delete this meta tag, Half Life 3 will never be released. -->
 <meta name="viewport" content="width=device-width" />
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <title></title>
 <link rel="stylesheet" type="text/css" href="stylesheets/email.css" />
</head>
<body bgcolor="#FFFFFF" style="background-color: #cccccc">
<!-- BODY -->
<table class="body-wrap">
 <tr>
  <td></td>
  <td class="container" bgcolor="#FFFFFF">
   <table class="social" width="100%">
    <tr>
     <td>
      <!-- column 1 -->
      <table align="" style="padding: 20px">
       <tr>
        <td align="right"><h3 class="collapse" style="font-weight: bolder">EXIT-TB DATA MANAGEMENT SYSTEM</h3></td>
       </tr>
      </table>
      <!-- /column 1 -->

      <span class="clear"></span>

     </td>
    </tr>
   </table>
   <div class="content">
    <table>
     <tr>
      <td>
       <table border="1" style="text-align: center">
        <thead>
        <tr>
         <th>CRF</th>
         <th>Tanzania</th>
         <th>Kenya</th>
         <th>Uganda</th>
         <th>Ethiopia</th>
         <th>Sudan</th>
         <th>TOTAL</th>
        </tr>
        </thead>
        <tbody>
        <tr>
         <td>CRF01:SYMPTOMS & RISK FACTORS</td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <th></th>
        </tr>

        </tbody>
       </table>
       <!-- Callout Panel -->
       <p class="callout">
        Your advice to login and change your password as soon as possible <a href="#">&nbsp;Login Now &raquo;</a>
       </p><!-- /Callout Panel -->

       <!-- contact Info -->
       <table class="social" width="100%">
        <tr>
         <td>
          <!-- column 1 -->
          <table align="left" class="column">
           <tr>
            <td>
             <p style="font-weight: bolder">Visit our website at : <a href="#">www.exit-tb.org</a></p>
             <p> </p>
            </td>
           </tr>
          </table>
          <!-- /column 1 -->

          <!-- column 2 -->
          <table align="left" class="column">
           <tr>
            <td>
             <p style="font-weight: bolder">Send us an Email : <strong><a href="info@exit-tb.org">info@exit-tb.org</a></strong></p>
            </td>
           </tr>
          </table><!-- /column 2 -->
         </td>
        </tr>
       </table><!-- /contact Info -->

       <!---- footer--->
       <table class="footer-wrap" >
        <tr>
         <td></td>
         <td class="container">

          <!-- content -->
          <div class="content">
           <table>
            <tr>
             <td align="center">
              <p>
               <a href="#">Terms</a> |
               <a href="#">Privacy</a> |
               <a href="#"><unsubscribe>Unsubscribe</unsubscribe></a>
              </p>
             </td>
            </tr>
           </table>
          </div><!-- /content -->

         </td>
         <td></td>
        </tr>
       </table>
       <!-- end of footer -->
      </td>
     </tr>
    </table>
   </div><!-- /content -->
  </td>


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



     <!-- crf01_pg02 -->
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
     <!-- crf02_pg01 -->
     <th>country</th>
     <th>institution</th>
     <th>facility</th>
     <th>tbsnum</th>
     <th>vdate</th>
     <th>age</th>
     <th>gender</th>
     <th>marital</th>
     <th>other_marital</th>
     <th>occupation</th>
     <th>education</th>
     <th>ward</th>
     <th>village</th>
     <th>location</th>
     <th>tencell</th>
     <th>phone1</th>
     <th>phone2</th>
     <th>hivpos</th>
     <th>hivposyr</th>
     <th>onart</th>
     <th>onartyr</th>
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
     <th>tbtxyr</th>
     <th>fid</th>

     <!-- crf02_pg02 -->
     <th>country</th>
     <th>institution</th>
     <th>facility</th>
     <th>tbsnum</th>
     <th>tbsx01</th>
     <th>tbsx01days</th>
     <th>tbsx02</th>
     <th>tbsx02days</th>
     <th>tbsx03</th>
     <th>tbsx03days</th>
     <th>tbsx04</th>
     <th>tbsx04days</th>
     <th>tbsx05</th>
     <th>tbsx05days</th>
     <th>fid</th>

 </tr>
</table><!-- /BODY -->

</body>
</html>