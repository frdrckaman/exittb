<!DOCTYPE html>
<html lang="en">
<head>
    <title>NIMR</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/ico" href="favicon.html">
    <link href="css/stylesheets.css" rel="stylesheet" type="text/css">

    <script type='text/javascript' src='js/plugins/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='js/plugins/jquery/jquery-ui.min.js'></script>
    <script type='text/javascript' src='js/plugins/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='js/plugins/jquery/globalize.js'></script>
    <script type='text/javascript' src='js/plugins/bootstrap/bootstrap.min.js'></script>

    <script type='text/javascript' src='js/plugins/uniform/jquery.uniform.min.js'></script>
    <script type='text/javascript' src='js/plugins/tagsinput/jquery.tagsinput.min.js'></script>
    <script type='text/javascript' src='js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'></script>

    <script type='text/javascript' src='js/plugins/cleditor/jquery.cleditor.min.js'></script>

    <script type='text/javascript' src='js/plugins.js'></script>
    <script type='text/javascript' src='js/actions.js'></script>
    <script type='text/javascript' src='js/settings.js'></script>
</head>
<body class="bg-img-num1">

<div class="container">
<div class="row">
    <div class="col-md-12">
        <?php include'topBar.php'?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Pages</a></li>
            <li class="active">Mail</li>
        </ol>
    </div>
</div>

<div class="row">

<div class="col-md-4">
<div class="block">
    <a class="btn btn-danger btn-block" href="#modal_mail" data-toggle="modal">New Email</a>
</div>
<div class="block">

</div>

<div class="block block-transparent nm">

    <div class="scroll-mail email-list">

        <div class="email-list-item">
            <div class="item-line">
                <div class="item-line-box">
                    <div class="checkbox"><label><input type="checkbox"/></label></div>
                </div>
                <div class="item-line-title">Angelina Jolie</div>
                <div class="item-line-date">Today 11:00 PM</div>
            </div>
            <div class="item-line">
                <div class="item-line-box">
                    <span class="icon-star active"></span>
                </div>
                <div class="item-line-title">Suspendisse id tristique turpis</div>
            </div>
            <div class="item-line">
                <div class="item-line-content">
                    Aliquam blandit turpis ligula, eget faucibus diam sagittis et.
                </div>
            </div>
        </div>

        <div class="email-list-item list-active">
            <div class="item-line">
                <div class="item-line-box">
                    <div class="checkbox"><label><input type="checkbox"/></label></div>
                </div>
                <div class="item-line-title">John Doe</div>
                <div class="item-line-date"><span class="icon-paper-clip"></span> Today 09:20 PM</div>
            </div>
            <div class="item-line">
                <div class="item-line-box">
                    <span class="icon-star active"></span>
                </div>
                <div class="item-line-title">Duis eu libero pellentesque</div>
                <span class="icon-stop text-primary pull-right"></span>
            </div>
            <div class="item-line">
                <div class="item-line-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque condimentum nisl velit
                </div>
            </div>
        </div>

        <div class="email-list-item">
            <div class="item-line">
                <div class="item-line-box">
                    <div class="checkbox"><label><input type="checkbox"/></label></div>
                </div>
                <div class="item-line-title">Helen Symonchuk</div>
                <div class="item-line-date">Today 06:15 PM</div>
            </div>
            <div class="item-line">
                <div class="item-line-box">
                    <span class="icon-star"></span>
                </div>
                <div class="item-line-title">Re: Lorem ipsum dolor sit amet</div>
            </div>
            <div class="item-line">
                <div class="item-line-content">
                    Morbi tincidunt, tellus ut fermentum accumsan, est justo pretium enim, eget.
                </div>
            </div>
        </div>

        <div class="email-list-item">
            <div class="item-line">
                <div class="item-line-box">
                    <div class="checkbox"><label><input type="checkbox"/></label></div>
                </div>
                <div class="item-line-title">Brad Pitt</div>
                <div class="item-line-date"><span class="icon-paper-clip"></span> Yesterday 05:34 AM</div>
            </div>
            <div class="item-line">
                <div class="item-line-box">
                    <span class="icon-star"></span>
                </div>
                <div class="item-line-title">Re: Lorem ipsum dolor sit amet </div>
                <span class="icon-stop text-warning pull-right"></span>
            </div>
            <div class="item-line">
                <div class="item-line-content">
                    Aliquam blandit turpis ligula, eget faucibus diam sagittis et.
                </div>
            </div>
        </div>

        <div class="email-list-item">
            <div class="item-line">
                <div class="item-line-box">
                    <div class="checkbox"><label><input type="checkbox"/></label></div>
                </div>
                <div class="item-line-title">somemail@mail.com</div>
                <div class="item-line-date">12 Oct</div>
            </div>
            <div class="item-line">
                <div class="item-line-box">
                    <span class="icon-star"></span>
                </div>
                <div class="item-line-title">Suspendisse id tristique turpis</div>
            </div>
            <div class="item-line">
                <div class="item-line-content">
                    Interdum et malesuada fames ac ante ipsum primis in faucibus.
                </div>
            </div>
        </div>

        <div class="email-list-item">
            <div class="item-line">
                <div class="item-line-box">
                    <div class="checkbox"><label><input type="checkbox"/></label></div>
                </div>
                <div class="item-line-title">Brad Pitt</div>
                <div class="item-line-date">11 Oct</div>
            </div>
            <div class="item-line">
                <div class="item-line-box">
                    <span class="icon-star active"></span>
                </div>
                <div class="item-line-title">Re: Lorem ipsum dolor sit amet</div>
            </div>
            <div class="item-line">
                <div class="item-line-content">
                    Morbi tincidunt, tellus ut fermentum accumsan, est justo pretium enim, eget.
                </div>
            </div>
        </div>

        <div class="email-list-item">
            <div class="item-line">
                <div class="item-line-box">
                    <div class="checkbox"><label><input type="checkbox"/></label></div>
                </div>
                <div class="item-line-title">Angelina Jolie</div>
                <div class="item-line-date">10 Oct</div>
            </div>
            <div class="item-line">
                <div class="item-line-box">
                    <span class="icon-star"></span>
                </div>
                <div class="item-line-title">Suspendisse id tristique turpis</div>
            </div>
            <div class="item-line">
                <div class="item-line-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </div>
            </div>
        </div>

        <div class="email-list-item">
            <div class="item-line">
                <div class="item-line-box">
                    <div class="checkbox"><label><input type="checkbox"/></label></div>
                </div>
                <div class="item-line-title">Helen Symonchuk</div>
                <div class="item-line-date">10 Oct</div>
            </div>
            <div class="item-line">
                <div class="item-line-box">
                    <span class="icon-star"></span>
                </div>
                <div class="item-line-title">Re: Lorem ipsum dolor sit amet</div>
            </div>
            <div class="item-line">
                <div class="item-line-content">
                    Morbi tincidunt, tellus ut fermentum accumsan, est justo pretium enim, eget.
                </div>
            </div>
        </div>

        <div class="email-list-item">
            <div class="item-line">
                <div class="item-line-box">
                    <div class="checkbox"><label><input type="checkbox"/></label></div>
                </div>
                <div class="item-line-title">Angelina Jolie</div>
                <div class="item-line-date">9 Oct</div>
            </div>
            <div class="item-line">
                <div class="item-line-box">
                    <span class="icon-star active"></span>
                </div>
                <div class="item-line-title">Suspendisse id tristique turpis</div>
            </div>
            <div class="item-line">
                <div class="item-line-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </div>
            </div>
        </div>
    </div>

</div>

</div>

<div class="col-md-8">

    <div class="block">

    </div>

    <div class="block block-drop-shadow">
        <div class="head bg-dot30">
            <h2>Duis eu libero pellentesque</h2>
            <div class="pull-right"><span class="icon-paper-clip"></span> Today 09:20 PM</div>
            <div class="head-subtitle">John Doe <span class="icon-stop text-primary pull-right"></span></div>
        </div>
        <div class="content">
            <p>Hello, John</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dictum dolor sem, quis pharetra dui ultricies vel. Cras non pulvinar tellus, vel bibendum magna. Morbi tellus nulla, cursus non nisi sed, porttitor dignissim erat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc facilisis commodo lectus. Vivamus vel tincidunt enim, non vulputate ipsum. Ut pellentesque consectetur arcu sit amet scelerisque. Fusce commodo leo eros, ut eleifend massa congue at.</p>
            <p>Nam a nisi et nisi tristique lacinia non sit amet orci. Duis blandit leo odio, eu varius nulla fringilla adipiscing. Praesent posuere blandit diam, sit amet suscipit justo consequat sed. Duis cursus volutpat ante at convallis. Integer posuere a enim eget imperdiet. Nulla consequat dui quis purus molestie fermentum. Donec faucibus sapien eu nisl placerat auctor. Pellentesque quis justo lobortis, tempor sapien vitae, dictum orci.</p>
            <ul>
                <li>Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh.</li>
                <li>Etiam porta sem malesuada magna mollis euismod.</li>
                <li>Donec ullamcorper nulla non metus auctor fringilla.</li>
                <li>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis.</li>
                <li>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</li>
            </ul>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dictum dolor sem, quis pharetra dui ultricies vel. Cras non pulvinar tellus, vel bibendum magna. Morbi tellus nulla, cursus non nisi sed, porttitor dignissim erat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc facilisis commodo lectus. Vivamus vel tincidunt enim, non vulputate ipsum. Ut pellentesque consectetur arcu sit amet scelerisque. Fusce commodo leo eros, ut eleifend massa congue at.</p>
            <address>
                <strong>Twitter, Inc.</strong><br>
                795 Folsom Ave, Suite 600<br>
                San Francisco, CA 94107<br>
                <abbr title="Phone">P:</abbr> (123) 456-7890
            </address>
        </div>
        <div class="head bg-dot30">
            <div class="head-panel nm">
                <div class="hp-info hp-simple pull-left hp-inline">
                    <span class="hp-main"><a href="#"><span class="icon-picture"></span> image.jpg</a></span>
                </div>
                <div class="hp-info hp-simple pull-left hp-inline">
                    <span class="hp-main"><a href="#"><span class="icon-picture"></span> picture.jpg</a></span>
                </div>
                <div class="hp-info hp-simple pull-left hp-inline">
                    <span class="hp-main"><a href="#"><span class="icon-list-alt"></span> index.html</a></span>
                </div>
            </div>
        </div>
    </div>

</div>

</div>

</div>

<div class="modal" id="modal_mail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">New Email</h4>
            </div>
            <div class="modal-body clearfix">

                <div class="controls">
                    <div class="form-row">
                        <div class="col-md-1">
                            To:
                        </div>
                        <div class="col-md-11">
                            <select class="form-control" id="country" name="country_id" required="">
                                <option value="">Select Group</option>
                                <option value="1">Principle Investigator</option>
                                <option value="2">Coordinator</option>
                                <option value="3">Data Manager</option>
                                <option value="4">Countries Coordinators</option>
                                <option value="5">Country Data Manager</option>
                                <option value="6">Data Clark</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12">
                            <textarea class="form-control scle"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning btn-clean">Save</button>
                <button type="button" class="btn btn-success btn-clean">Send</button>
            </div>
        </div>
    </div>
</div>
<script>
    <?php if($user->data()->pswd == 0){?>
    $(window).on('load',function(){
        $("#change_password").modal({
            backdrop: 'static',
            keyboard: false
        },'show');
    });
    <?php }?>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5c13b96082491369ba9e1d8a/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
</body>

</html>