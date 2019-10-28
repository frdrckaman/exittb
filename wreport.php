<?php
require_once'php/core/init.php';

$override = new OverideData();
$email = new Email();
$user = new User();

include 'function.php';$log=null;
$no=0;$crf1=0;$crf2=0;$se_crf=0;$to_crf=0;
$tz=0;$ke=0;$ug=0;$et=0;$su=0;$tc=0;
$a_user=0;$b_user=0;
$log=$override->get('report_logs','status',0);
$staffs=$override->getData('staff');
/*if($log){
    if(date('Y-m-d') == $log[0]['end_date']){
        $url1=$_SERVER['REQUEST_URI'];
        header("Refresh: 5; URL=$url1");
    }
}*/


/******************  WK New***************************/

$crf1Wk = noCrfWk(1,7)+noCrfWk(3,7)+noCrfWk(2,7)+noCrfWk(4,7)+noCrfWk(5,7);
$crf2Wk = noCrfWk(1,8)+noCrfWk(3,8)+noCrfWk(2,8)+noCrfWk(4,8)+noCrfWk(5,8);
$crf3Wk = noCrfWk(1,9)+noCrfWk(3,9)+noCrfWk(2,9)+noCrfWk(4,9)+noCrfWk(5,9);
$se_crfWk = noCrfWk(1,10)+noCrfWk(3,10)+noCrfWk(2,10)+noCrfWk(4,10)+noCrfWk(5,10);

$tzWk = noCrfWk(1,7)+noCrfWk(1,8)+noCrfWk(1,9)+noCrfWk(1,10);
$keWk = noCrfWk(3,7)+noCrfWk(3,8)+noCrfWk(3,9)+noCrfWk(3,10);
$ugWk = noCrfWk(2,7)+noCrfWk(2,8)+noCrfWk(2,9)+noCrfWk(2,10);
$etWk = noCrfWk(4,7)+noCrfWk(4,8)+noCrfWk(4,9)+noCrfWk(4,10);
$suWk = noCrfWk(5,7)+noCrfWk(5,8)+noCrfWk(5,9)+noCrfWk(5,10);

/******************  WK Old ***************************/

$tzWkO = noCrfWk(1,3)+noCrfWk(1,4)+noCrfWk(1,5)+noCrfWk(1,6);
$keWkO = noCrfWk(3,3)+noCrfWk(3,4)+noCrfWk(3,5)+noCrfWk(3,6);
$ugWkO = noCrfWk(2,3)+noCrfWk(2,4)+noCrfWk(2,5)+noCrfWk(2,6);
$etWkO = noCrfWk(4,3)+noCrfWk(4,4)+noCrfWk(4,5)+noCrfWk(4,6);
$suWkO = noCrfWk(5,3)+noCrfWk(5,4)+noCrfWk(5,5)+noCrfWk(5,6);

$crf1WkO = noCrfWk(1,3)+noCrfWk(3,3)+noCrfWk(2,3)+noCrfWk(4,3)+noCrfWk(5,3);
$crf2WkO = noCrfWk(1,4)+noCrfWk(3,4)+noCrfWk(2,4)+noCrfWk(4,4)+noCrfWk(5,4);
$crf3WkO = noCrfWk(1,5)+noCrfWk(3,5)+noCrfWk(2,5)+noCrfWk(4,5)+noCrfWk(5,5);
$se_crfWkO = noCrfWk(1,6)+noCrfWk(3,6)+noCrfWk(2,6)+noCrfWk(4,6)+noCrfWk(5,6);

/************************** ALL Old **********************/

$tzAo = noCrf(1,3)+noCrf(1,4)+noCrf(1,5)+noCrf(1,6);
$keAo = noCrf(3,3)+noCrf(3,4)+noCrf(3,5)+noCrf(3,6);
$ugAo = noCrf(2,3)+noCrf(2,4)+noCrf(2,5)+noCrf(2,6);
$etAo = noCrf(4,3)+noCrf(4,4)+noCrf(4,5)+noCrf(4,6);
$suAo = noCrf(5,3)+noCrf(5,4)+noCrf(5,5)+noCrf(5,6);

$crf1Ao = noCrf(1,4)+noCrf(3,4)+noCrf(2,4)+noCrf(4,4)+noCrf(5,4);
$crf2Ao = noCrf(1,5)+noCrf(3,5)+noCrf(2,5)+noCrf(4,5)+noCrf(5,5);
$crf3Ao = noCrf(1,3)+noCrf(3,3)+noCrf(2,3)+noCrf(4,3)+noCrf(5,3);
$se_crfAo = noCrf(1,6)+noCrf(3,6)+noCrf(2,6)+noCrf(4,6)+noCrf(5,6);

/******************** OVERALL ***********************************/

$crf1A = noCrf(1,7)+noCrf(3,7)+noCrf(2,7)+noCrf(4,7)+noCrf(5,7)+noCrf(1,4)+noCrf(3,4)+noCrf(2,4)+noCrf(4,4)+noCrf(5,4);
$crf2A = noCrf(1,8)+noCrf(3,8)+noCrf(2,8)+noCrf(4,8)+noCrf(5,8)+noCrf(1,5)+noCrf(3,5)+noCrf(2,5)+noCrf(4,5)+noCrf(5,5);
$crf3A = noCrf(1,9)+noCrf(3,9)+noCrf(2,9)+noCrf(4,9)+noCrf(5,9)+noCrf(1,3)+noCrf(3,3)+noCrf(2,3)+noCrf(4,3)+noCrf(5,3);
$se_crfA = noCrf(1,10)+noCrf(3,10)+noCrf(2,10)+noCrf(4,10)+noCrf(5,10)+noCrf(1,6)+noCrf(3,6)+noCrf(2,6)+noCrf(4,6)+noCrf(5,6);

$tzA = noCrf(1,7)+noCrf(1,8)+noCrf(1,9)+noCrf(1,10)+noCrf(1,3)+noCrf(1,4)+noCrf(1,5)+noCrf(1,6);
$keA = noCrf(3,7)+noCrf(3,8)+noCrf(3,9)+noCrf(3,10)+noCrf(3,3)+noCrf(3,4)+noCrf(3,5)+noCrf(3,6);
$ugA = noCrf(2,7)+noCrf(2,8)+noCrf(2,9)+noCrf(2,10)+noCrf(2,3)+noCrf(2,4)+noCrf(2,5)+noCrf(2,6);
$etA = noCrf(4,7)+noCrf(4,8)+noCrf(4,9)+noCrf(4,10)+noCrf(4,3)+noCrf(4,4)+noCrf(4,5)+noCrf(4,6);
$suA = noCrf(5,7)+noCrf(5,8)+noCrf(5,9)+noCrf(5,10)+noCrf(5,3)+noCrf(5,4)+noCrf(5,5)+noCrf(5,6);


//$tc = $tz+$ke+$ug+$et+$su;
$tcA = $tzA+$keA+$ugA+$etA+$suA;
$tcWk = $tzWk+$keWk+$ugWk+$etWk+$suWk;
$tcWkO = $tzWkO+$keWkO+$ugWkO+$etWkO+$suWkO;
$tcAo = $tzAo+$keAo+$ugAo+$etAo+$suAo;


foreach ($staffs as $staff){
    if($staff['access_level'] == 1 || $staff['access_level'] == 2 || $staff['access_level'] == 3){
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                   <html xmlns="http://www.w3.org/1999/xhtml" >
                    <head>
                        <!-- If you delete this meta tag, Half Life 3 will never be released. -->
                        <meta name="viewport" content="width=device-width" />
                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                        <title></title>
                        <link rel="stylesheet" type="text/css" href="stylesheets/email.css" />
                        <style type="text/css">
                            * { 
                        margin:0;
                        padding:0;
                    }
                    * { font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; }
                    
                    img { 
                        max-width: 100%; 
                    }
                    .collapse {
                        margin:0;
                        padding:0;
                    }
                    body {
                        -webkit-font-smoothing:antialiased; 
                        -webkit-text-size-adjust:none; 
                        width: 100%!important; 
                        height: 100%;
                    }
                    
                    a { color: #2BA6CB;}
                    
                    .btn {
                        text-decoration:none;
                        color: #FFF;
                        background-color: #666;
                        padding:10px 16px;
                        font-weight:bold;
                        margin-right:10px;
                        text-align:center;
                        cursor:pointer;
                        display: inline-block;
                    }
                    
                    p.callout {
                        padding:15px;
                        background-color:#ECF8FF;
                        margin-bottom: 15px;
                    }
                    .callout a {
                        font-weight:bold;
                        color: #2BA6CB;
                    }
                    
                    table.social {
                        background-color: #ebebeb;
                        
                    }
                    .social .soc-btn {
                        padding: 3px 7px;
                        font-size:12px;
                        margin-bottom:10px;
                        text-decoration:none;
                        color: #FFF;font-weight:bold;
                        display:block;
                        text-align:center;
                    }
                    a.fb { background-color: #3B5998!important; }
                    a.tw { background-color: #1daced!important; }
                    a.gp { background-color: #DB4A39!important; }
                    a.ms { background-color: #000!important; }
                    
                    .sidebar .soc-btn { 
                        display:block;
                        width:100%;
                    }
                    
                    table.head-wrap { width: 80%;}
                    
                    .header.container table td.logo { padding: 15px; }
                    .header.container table td.label { padding: 15px; padding-left:0px;}
                    
                    table.body-wrap { width: 100%;}
                    
                    table.footer-wrap { width: 100%;	clear:both!important;
                    }
                    .footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
                    .footer-wrap .container td.content p {
                        font-size:10px;
                        font-weight: bold;
                        
                    }
                    
                    h1,h2,h3,h4,h5,h6 {
                    font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
                    }
                    h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }
                    
                    h1 { font-weight:200; font-size: 44px;}
                    h2 { font-weight:200; font-size: 37px;}
                    h3 { font-weight:500; font-size: 27px;}
                    h4 { font-weight:500; font-size: 23px;}
                    h5 { font-weight:900; font-size: 17px;}
                    h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#444;}
                    
                    .collapse { margin:0!important;}
                    
                    p, ul { 
                        margin-bottom: 10px; 
                        font-weight: normal; 
                        font-size:14px; 
                        line-height:1.6;
                    }
                    p.lead { font-size:17px; }
                    p.last { margin-bottom:0px;}
                    
                    ul li {
                        margin-left:5px;
                        list-style-position: inside;
                    }
                    
                    ul.sidebar {
                        background:#ebebeb;
                        display:block;
                        list-style-type: none;
                    }
                    ul.sidebar li { display: block; margin:0;}
                    ul.sidebar li a {
                        text-decoration:none;
                        color: #666;
                        padding:10px 16px;
                    
                        margin-right:10px;
                    
                        cursor:pointer;
                        border-bottom: 1px solid #777777;
                        border-top: 1px solid #FFFFFF;
                        display:block;
                        margin:0;
                    }
                    ul.sidebar li a.last { border-bottom-width:0px;}
                    ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}
                    
                    .container {
                        display:block!important;
                        max-width:600px!important;
                        margin:0 auto!important;
                        clear:both!important;
                    }
                    
                    .content {
                        padding:15px;
                        max-width:600px;
                        margin:0 auto;
                        display:block; 
                    }
                    
                    .content table { width: 100%; }
                    
                    .column {
                        width: 300px;
                        float:left;
                    }
                    .column tr td { padding: 15px; }
                    .column-wrap { 
                        padding:0!important; 
                        margin:0 auto; 
                        max-width:600px!important;
                    }
                    .column table { width:100%;}
                    .social .column {
                        width: 280px;
                        min-width: 279px;
                        float:left;
                    }
                    
                    .clear { display: block; clear: both; }
                    
                    @media only screen and (max-width: 600px) {
                        
                        a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}
                    
                        div[class="column"] { width: auto!important; float:none!important;}
                        
                        table.social div[class="column"] {
                            width:auto!important;
                        }
                    
                    }
                        </style>
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
                                                
                                                <h3>DATA REPORT <strong>( OLD CRFs )</strong> </h3>
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
                                                            <td>CRF01:SYMPTOMS&RISK FACTORS CRFS</td>
                                                            <td>'.noCrf(1,4).'</td>
                                                            <td>'.noCrf(3,4).'</td>
                                                            <td>'.noCrf(2,4).'</td>
                                                            <td>'.noCrf(4,4).'</td>
                                                            <td>'.noCrf(5,4).'</td>
                                                            <th>'.$crf1Ao.'</th>
                                                        </tr>
                                                        <tr>
                                                            <td>CRF02:CONTACT SCREENING CRFS</td>
                                                            <td>'.noCrf(1,5).'</td>
                                                            <td>'.noCrf(3,5).'</td>
                                                            <td>'.noCrf(2,5).'</td>
                                                            <td>'.noCrf(4,5).'</td>
                                                            <td>'.noCrf(5,5).'</td>
                                                            <th>'.$crf2Ao.'</th>
                                                        </tr> 
                                                        <tr>
                                                            <td>CRF03:TREATMENT OUTCOME CRFS</td>
                                                            <td>'.noCrf(1,3).'</td>
                                                            <td>'.noCrf(3,3).'</td>
                                                            <td>'.noCrf(2,3).'</td>
                                                            <td>'.noCrf(4,3).'</td>
                                                            <td>'.noCrf(5,3).'</td>
                                                            <th>'.$crf3Ao.'</th>
                                                        </tr>    
                                                        <tr>
                                                            <td>SOCIO-ECONOMIC</td>
                                                            <td>'.noCrf(1,6).'</td>
                                                            <td>'.noCrf(3,6).'</td>
                                                            <td>'.noCrf(2,6).'</td>
                                                            <td>'.noCrf(4,6).'</td>
                                                            <td>'.noCrf(5,6).'</td>
                                                            <th>'.$se_crfAo.'</th>
                                                        </tr>   
                                                       
                                                        <tr>
                                                            <th>TOTAL</th>
                                                            <th>'.$tzAo.'</th>
                                                            <th>'.$keAo.'</th>
                                                            <th>'.$ugAo.'</th>
                                                            <th>'.$etAo.'</th>
                                                            <th>'.$suAo.'</th>
                                                            <th>'.$tcAo.'</th>
                                                        </tr>   
                                                    </tbody>
                                                </table>
                                                <br/><br/><hr><br/>
                                                <h3>DATA REPORT <strong>( OLD AND NEW CRFs )</strong></h3>
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
                                                            <td>CRF01<!--:TB ENROLMENT FORM--></td>
                                                            <td>'.(noCrf(1,7)+noCrf(1,4)).'</td>
                                                            <td>'.(noCrf(3,7)+noCrf(3,4)).'</td>
                                                            <td>'.(noCrf(2,7)+noCrf(2,4)).'</td>
                                                            <td>'.(noCrf(4,7)+noCrf(4,4)).'</td>
                                                            <td>'.(noCrf(5,7)+noCrf(5,4)).'</td>
                                                            <th>'.$crf1A.'</th>
                                                        </tr>
                                                        <tr>
                                                            <td>CRF02<!--:SCREENING FORM--></td>
                                                            <td>'.(noCrf(1,8)+noCrf(1,5)).'</td>
                                                            <td>'.(noCrf(3,8)+noCrf(3,5)).'</td>
                                                            <td>'.(noCrf(2,8)+noCrf(2,5)).'</td>
                                                            <td>'.(noCrf(4,8)+noCrf(4,5)).'</td>
                                                            <td>'.(noCrf(5,8)+noCrf(5,5)).'</td>
                                                            <th>'.$crf2A.'</th>
                                                        </tr> 
                                                        <tr>
                                                            <td>CRF03<!--:CLIENT FOLLOW UP FORM--></td>
                                                            <td>'.(noCrf(1,9)+noCrf(1,3)).'</td>
                                                            <td>'.(noCrf(3,9)+noCrf(3,3)).'</td>
                                                            <td>'.(noCrf(2,9)+noCrf(2,3)).'</td>
                                                            <td>'.(noCrf(4,9)+noCrf(4,3)).'</td>
                                                            <td>'.(noCrf(5,9)+noCrf(5,3)).'</td>
                                                            <th>'.$crf3A.'</th>
                                                        </tr>    
                                                        <tr>
                                                            <td><!--SOCIO-ECONOMIC-->ECON</td>
                                                            <td>'.(noCrf(1,10)+noCrf(1,6)).'</td>
                                                            <td>'.(noCrf(3,10)+noCrf(3,6)).'</td>
                                                            <td>'.(noCrf(2,10)+noCrf(2,6)).'</td>
                                                            <td>'.(noCrf(4,10)+noCrf(4,6)).'</td>
                                                            <td>'.(noCrf(5,10)+noCrf(5,6)).'</td>
                                                            <th>'.$se_crfA.'</th>
                                                        </tr>   
                                                       
                                                        <tr>
                                                            <th>TOTAL</th>
                                                            <th>'.$tzA.'</th>
                                                            <th>'.$keA.'</th>
                                                            <th>'.$ugA.'</th>
                                                            <th>'.$etA.'</th>
                                                            <th>'.$suA.'</th>
                                                            <th>'.$tcA.'</th>
                                                        </tr>   
                                                    </tbody>
                                                </table>
                                                <br/>
                                                <!-- Callout Panel -->
                                                <p class="callout">
                                                     For more Information, Please Login to our account <a href="'.$no.'">&nbsp;Login Now &raquo;</a>
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
                    
                        </tr>
                    </table><!-- /BODY -->
                    
                    </body>
                    </html>';
        /*if($staff['status'] == 1){
            if($email->emailSend($staff['email_address'],'Weekly Data Updates',$body)){$a_user=1;
                echo ' ****|| Email Sent to PI, CO , DM ||**** ';
            }
        }*/
    }
    elseif ($staff['access_level'] == 4 || $staff['access_level'] == 5){$ttl=0;
        $ttl = noCrf($staff['c_id'],4)+noCrf($staff['c_id'],5)+noCrf($staff['c_id'],6)+noCrf($staff['c_id'],3);
        $body1 = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                   <html xmlns="http://www.w3.org/1999/xhtml" >
                        <head>
    <!-- If you delete this meta tag, Half Life 3 will never be released. -->
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="stylesheets/email.css" />
    <style type="text/css">
        * { 
	margin:0;
	padding:0;
}
* { font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; }

img { 
	max-width: 100%; 
}
.collapse {
	margin:0;
	padding:0;
}
body {
	-webkit-font-smoothing:antialiased; 
	-webkit-text-size-adjust:none; 
	width: 100%!important; 
	height: 100%;
}

a { color: #2BA6CB;}

.btn {
	text-decoration:none;
	color: #FFF;
	background-color: #666;
	padding:10px 16px;
	font-weight:bold;
	margin-right:10px;
	text-align:center;
	cursor:pointer;
	display: inline-block;
}

p.callout {
	padding:15px;
	background-color:#ECF8FF;
	margin-bottom: 15px;
}
.callout a {
	font-weight:bold;
	color: #2BA6CB;
}

table.social {
	background-color: #ebebeb;
	
}
.social .soc-btn {
	padding: 3px 7px;
	font-size:12px;
	margin-bottom:10px;
	text-decoration:none;
	color: #FFF;font-weight:bold;
	display:block;
	text-align:center;
}
a.fb { background-color: #3B5998!important; }
a.tw { background-color: #1daced!important; }
a.gp { background-color: #DB4A39!important; }
a.ms { background-color: #000!important; }

.sidebar .soc-btn { 
	display:block;
	width:100%;
}

table.head-wrap { width: 80%;}

.header.container table td.logo { padding: 15px; }
.header.container table td.label { padding: 15px; padding-left:0px;}

table.body-wrap { width: 100%;}

table.footer-wrap { width: 100%;	clear:both!important;
}
.footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
.footer-wrap .container td.content p {
	font-size:10px;
	font-weight: bold;
	
}

h1,h2,h3,h4,h5,h6 {
font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
}
h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }

h1 { font-weight:200; font-size: 44px;}
h2 { font-weight:200; font-size: 37px;}
h3 { font-weight:500; font-size: 27px;}
h4 { font-weight:500; font-size: 23px;}
h5 { font-weight:900; font-size: 17px;}
h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#444;}

.collapse { margin:0!important;}

p, ul { 
	margin-bottom: 10px; 
	font-weight: normal; 
	font-size:14px; 
	line-height:1.6;
}
p.lead { font-size:17px; }
p.last { margin-bottom:0px;}

ul li {
	margin-left:5px;
	list-style-position: inside;
}

ul.sidebar {
	background:#ebebeb;
	display:block;
	list-style-type: none;
}
ul.sidebar li { display: block; margin:0;}
ul.sidebar li a {
	text-decoration:none;
	color: #666;
	padding:10px 16px;

	margin-right:10px;

	cursor:pointer;
	border-bottom: 1px solid #777777;
	border-top: 1px solid #FFFFFF;
	display:block;
	margin:0;
}
ul.sidebar li a.last { border-bottom-width:0px;}
ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}

.container {
	display:block!important;
	max-width:600px!important;
	margin:0 auto!important;
	clear:both!important;
}

.content {
	padding:15px;
	max-width:600px;
	margin:0 auto;
	display:block; 
}

.content table { width: 100%; }

.column {
	width: 300px;
	float:left;
}
.column tr td { padding: 15px; }
.column-wrap { 
	padding:0!important; 
	margin:0 auto; 
	max-width:600px!important;
}
.column table { width:100%;}
.social .column {
	width: 280px;
	min-width: 279px;
	float:left;
}

.clear { display: block; clear: both; }

@media only screen and (max-width: 600px) {
	
	a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

	div[class="column"] { width: auto!important; float:none!important;}
	
	table.social div[class="column"] {
		width:auto!important;
	}

}
    </style>
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
                            
                            <h3>DATA REPORT FOR <strong>( OLD CRFs )</strong></h3>
                            <table border="1" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>CRF</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>CRF01:SYMPTOMS & RISK FACTORS CRFS</td>
                                        <td>'.noCrf($staff['c_id'],4).'</td>          
                                    </tr>
                                    <tr>
                                        <td>CRF02:CONTACT SCREENING CRFS</td>
                                        <td>'.noCrf($staff['c_id'],5).'</td>
                                    </tr>   
                                    <tr>
                                        <td>CRF03:TREATMENT OUTCOME CRFS</td>
                                        <td>'.noCrf($staff['c_id'],3).'</td>
                                    </tr>   
                                    <tr>
                                        <td>SOCIAL-ECONOMIC</td>
                                        <td>'.noCrf($staff['c_id'],6).'</td>
                                    </tr>  
                                    <tr>
                                        <th>TOTAL</th>
                                        <th>'.(noCrf($staff['c_id'],3)+noCrf($staff['c_id'],4)+noCrf($staff['c_id'],5)+noCrf($staff['c_id'],6)).'</th>
                                    </tr>   
                                </tbody>
                            </table>
                            <br><hr><br>
                            <h3>DATA REPORT <strong>( NEW CRFs )</strong></h3>
                            <table border="1" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>CRF</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>CRF01:TB ENROLMENT FORM</td>
                                        <td>'.noCrf($staff['c_id'],7).'</td>          
                                    </tr>
                                    <tr>
                                        <td>CRF02:TB SCREENING FORM</td>
                                        <td>'.noCrf($staff['c_id'],8).'</td>
                                    </tr>   
                                    <tr>
                                        <td>CRF03:CLIENT FOLLOW UP FORM</td>
                                        <td>'.noCrf($staff['c_id'],9).'</td>
                                    </tr>   
                                    <tr>
                                        <td>SOCIAL-ECONOMIC</td>
                                        <td>'.noCrf($staff['c_id'],10).'</td>
                                    </tr>  
                                    <tr>
                                        <th>TOTAL</th>
                                        <th>'.(noCrf($staff['c_id'],7)+noCrf($staff['c_id'],8)+noCrf($staff['c_id'],9)+noCrf($staff['c_id'],10)).'</th>
                                    </tr>   
                                </tbody>
                            </table>
                            <br><hr><br>
                            <h3>DATA REPORT FOR <strong>( OLD & NEW CRFs )</strong></h3>
                            <table border="1" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>CRF</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>CRF01</td>
                                        <td>'.(noCrf($staff['c_id'],7)+noCrf($staff['c_id'],4)).'</td>          
                                    </tr>
                                    <tr>
                                        <td>CRF02</td>
                                        <td>'.(noCrf($staff['c_id'],8)+noCrf($staff['c_id'],5)).'</td>
                                    </tr>   
                                    <tr>
                                        <td>CRF03</td>
                                        <td>'.(noCrf($staff['c_id'],9)+noCrf($staff['c_id'],3)).'</td>
                                    </tr>   
                                    <tr>
                                        <td>ECON</td>
                                        <td>'.(noCrf($staff['c_id'],10)+noCrf($staff['c_id'],6)).'</td>
                                    </tr>  
                                    <tr>
                                        <th>TOTAL</th>
                                        <th>'.(noCrf($staff['c_id'],7)+noCrf($staff['c_id'],8)+noCrf($staff['c_id'],9)+noCrf($staff['c_id'],10)+noCrf($staff['c_id'],3)+noCrf($staff['c_id'],4)+noCrf($staff['c_id'],5)+noCrf($staff['c_id'],6)).'</th>
                                    </tr>   
                                </tbody>
                            </table>
                            <br><hr><br>
                            <!-- Callout Panel -->
                            <p class="callout">
                                 For more Information, Please Login to our account <a href="http://system.exit-tb.org/">&nbsp;Login Now &raquo;</a>
                            </p><!-- /Callout Panel -->

                            <!-- contact Info -->
                            <table class="social" width="100%">
                                <tr>
                                    <td>
                                        <!-- column 1 -->
                                        <table align="left" class="column">
                                            <tr>
                                                <td>
                                                    <p style="font-weight: bolder">Visit our website at : <a href="http://exit-tb.org/">www.exit-tb.org</a></p>
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

                                </tr>
                            </table><!-- /BODY -->

                        </body>
                    </html>';
        /*if($staff['status'] == 1){
            if($email->emailSend($staff['email_address'],'Weekly Data Updates',$body1)){$b_user=1;
                echo ' |** Email Sent CCO & CDM **| ';
            }
        }*/
        //echo $body1;
    }
}

$next_week = date('Y-m-d', strtotime(date('Y-m-d').' +1 week'));
$last_row = $override->lastRow('wk_report','id');
$date=$override->dateRange('crf_record','up_date','2019-03-01','2019-03-30');

$checkD = $override->getNews('wk_report','start_date',date('Y-m-d'),'end_date',$next_week);
$override->dateRangeNoR('crf_record','tb_crf_id','up_date',$last_row[0]['end_date'],date('d-m-Y'));
if(!$checkD){
    try {
        $user->createRecord('wk_report', array(
            'start_date' => date('Y-m-d'),
            'end_date' => $next_week,
            'a_user' => $a_user,
            'b_user' => $b_user
        ));
        //$successMessage = 'SOP Uploaded Successful';
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

///$email->emailSend('frdrckaman@gmail.com','Weekly Data Updates',$body);
//$next_week = date('d-m-Y', strtotime(date('d-m-Y').' +1 week'));
//print_r($body1);
//print_r($body);
