<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>My Specialist</title>
    <base href="/">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/build/css/carousal.css">
    <script type="text/javascript" src="/node_modules/angular/angular.min.js"></script>
    <script type="text/javascript" src="/node_modules/angular-route/angular-route.min.js"></script>
    <script type="text/javascript" src="/build/js/all.min.js"></script>
</head>

<body ng-app="specialist">
<header>
        <nav class="navbar navbar-default" style="margin-bottom:0px">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./">QuickSpecialist</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Blogs</a></li>
                    <li><a href="doctorPortal">For Doctors</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <ng-view></ng-view>
<footer>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div>
                        About QuickSpecialist
                    </div>
                    <div>
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
                    <div>Term of use</div>
                    <div>Privacy Policy</div>
                    <div>Press</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-8 mtb20">
                    © 2017 QuickSpecialist, Inc. All rights reserved.
                </div>
            </div>
        </div>
    </footer>
    
</body>

</html>
