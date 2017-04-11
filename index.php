<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>My Specialist</title>
    <base href="/">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="/node_modules/bootstrap/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/build/css/all.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.min.js"></script>
    <!-- <script type="text/javascript" src="/node_modules/angular-route/angular-route.min.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.4.2/angular-ui-router.min.js"></script>
    
</head>

<body ng-app="specialist">
    <header>
        <nav class="navbar navbar-default" style="margin-bottom:0px">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./">QuickSpecialist</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="javascript:void(0)" onclick="openLightbox('registrationLightBox');"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="javascript:void(0)" onclick="openLightbox('loginform');"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Blogs</a></li>
                    <li><a href="doctorPortal">For Doctors</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- <ng-view></ng-view> -->
    <ui-view></ui-view>
    <div id="registrationLightBox" class="container lightBoxContainer" style="display: none;">
        <form class="well form-horizontal" action=" " method="post" id="registration_form" ng-submit="">
            <fieldset>
                <legend><center><h2><b>REGISTRATION FORM</b></h2></center></legend><br>
                <div class="form-group">
                    <label class="col-md-4 control-label">First Name</label>  
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" >Last Name</label> 
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="last_name" placeholder="Last Name" class="form-control"  type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Username</label>  
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input  name="user_name" placeholder="Username" class="form-control"  type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" >Password</label> 
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="user_password" placeholder="Password" class="form-control"  type="password">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" >Confirm Password</label> 
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="confirm_password" placeholder="Confirm Password" class="form-control"  type="password">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">E-Mail</label>  
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="email" placeholder="E-Mail Address" class="form-control"  type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Contact No.</label>  
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <input name="contact_no" placeholder="(0120)" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>
                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4"><br>
                        <button type="submit" class="login-button" >SUBMIT 
                            <span class="glyphicon glyphicon-send"></span>
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <div id="loginform" class="container lightBoxContainer" style="display: none;">
        <form class="well form-horizontal" action=" " method="post"  id="login_form">
            <fieldset>
                <legend><center><h2><b>LOGIN</b></h2></center></legend><br>
                <div class="form-group">
                    <label class="col-md-4 control-label">E-Mail</label>  
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="email" placeholder="E-Mail Address" class="form-control"  type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" >Password</label> 
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="user_password" placeholder="Password" class="form-control"  type="password">
                        </div>
                    </div>
                </div>
                <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>
                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4"><br>
                        <button type="submit" class="login-button">SIGN IN 
                            <span class="glyphicon glyphicon-send"></span>
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8">
                        <h5><i>ABOUT QUICKSPECIALIST</i></h5>
                        <hr>
                    <div class="footerBody">
                        QuickSpecialist is Building the Future of Physical Health Care, we brings physiotherapy services to your door. Whether you are recovering at home post surgery or just unable to leave the office for an appointment, QuickSpecialist will provide treatment in the convenience of your own location or helps you to select a specialist clinic for your problem.
                        <br/> Physio on demand…
                        <br/> Rapid treatment to reduce recovery times
                        <br/> Assessment, diagnosis, treatment & rehabilitation
                        <br/> For sports injuries, acute back and neck pain, repetitive strain, post-operative, postural & chronic conditions
                        <br/> Professional, reliable, trustworthy service.
                        <br/> We certify the specialist by our tests and work hard to provide you the best specialist for your issue.
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <h5><i>TERMS & LEGAL</i></h5>
                    <hr>
                    <div class="footerBody">
                        Terms of Use<br>
                        Privacy Policy<br>
                        Press Release<br>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row footerCopyright">
                <div class="col-xs-12 mtb20">
                    © 2017 QuickSpecialist, Inc. All rights reserved.
                </div>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="/build/js/all.min.js"></script>
    <script type="text/javascript">
        function openLightbox(container){
            if(container == 'loginform')
                uglipop({class:'lightBoxContainer', //styling class for Modal
                    source:'div',
                    content:'loginform'
                });
            else if(container == 'registrationLightBox') {
                uglipop({class:'lightBoxContainer', //styling class for Modal
                    source:'div',
                    content:'registrationLightBox'
                });
            }
        }
        
    </script>
</body>

</html>
