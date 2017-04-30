<!DOCTYPE html>
<html lang="en" >
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>My Specialist</title>
    <base href="/">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="/node_modules/bootstrap/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./build/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/node_modules/ng-tags-input/build/ng-tags-input.min.css">
    <script type="text/javascript" src="./node_modules/angular/angular.min.js"></script>
    <!-- <script type="text/javascript" src="/node_modules/angular-route/angular-route.min.js"></script> -->
    <script type="text/javascript" src="./node_modules/angular-ui-router/release/angular-ui-router.min.js"></script>
    
</head>
<body ng-app="specialist" ng-controller="MainCtrl">
<header>
        <nav class="navbar navbar-default" style="margin-bottom:0px">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./">QuickSpecialist</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="javascript:void(0)" ng-click="openLightbox('registrationLightBox');"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="javascript:void(0)" ng-click="openLightbox('loginform');"><span class="glyphicon glyphicon-log-in"></span> {{loginStatusString}}</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Blogs</a></li>
                    <li><a href="{{::doctorPatientUrl}}">{{::doctorPatient}}</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- <ng-view></ng-view> -->
    <ui-view></ui-view>
    <div class="lgtBoxCont" ng-style="lgtStyle"">
    </div>
    <div id="registrationLightBox" class="container lightBoxContainer" ng-show="registrationLightBox">
        <form class="well form-horizontal" id="registration_form" ng-submit="sendSignupUser($event)" novalidate>
            <fieldset>
                <legend><center><h2><b>REGISTRATION FORM</b></h2></center></legend><br>
                <div class="form-group">
                    <label class="col-md-4 control-label">First Name</label>  
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input  ng-model="firstname" placeholder="First Name" class="form-control"  type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" >Last Name</label> 
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input ng-model="lastname" placeholder="Last Name" class="form-control"  type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Username</label>  
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input  ng-model="username" placeholder="Username" class="form-control"  type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" >Password</label> 
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input ng-model="pass" placeholder="Password" class="form-control"  type="password">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" >Confirm Password</label> 
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input ng-model="confirmpass" placeholder="Confirm Password" class="form-control"  type="password">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">E-Mail</label>  
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input ng-model="email" placeholder="E-Mail Address" class="form-control"  type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Contact No.</label>  
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <input ng-model="mobileNo" placeholder="(0120)" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <!-- <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div> -->
                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4"><br>
                        <a ng-click="closeLightbox()" class="login-button">CANCEL 
                            <span class="glyphicon"></span>
                        </a>
                    </div>
                    <div class="col-md-4"><br>
                        <a ng-click="sendSignupUser()" class="login-button">SUBMIT 
                            <span class="glyphicon glyphicon-send"></span>
                        </a>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <div id="loginform" class="container lightBoxContainer" ng-show="loginform">
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
                <!-- <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div> -->
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
    <div>
        <div id="loader"></div>
    </div>
<footer class="mtb20">
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
    <script src="/node_modules/ng-tags-input/build/ng-tags-input.min.js"></script>
    <script type="text/javascript" src="./build/js/all.min.js"></script>
</body>

</html>
