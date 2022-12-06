<?php 
include_once("connection.php");
//require_once("../dashboard.schoolx.ng/pages/php/lib.php");

$allSchools = mysqli_fetch_assoc(mysqli_query($DB, "SELECT COUNT(*) FROM schools WHERE status='1'")) or die(mysqli_error($DB));
$allTeachers = mysqli_fetch_assoc(mysqli_query($DB, "SELECT COUNT(*) FROM teacher  WHERE status='1'")) or die(mysqli_error($DB));
 //contact process

?>
<!doctype html>
<html lang="eng">



<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Global site tag (gtag.js) - Google Analytics -->
<?php require_once("analytics.php"); ?>

    
    <meta name="author" content="Learnify Labs Limited">
    <meta name="description" content="SchoolX | One stop school automation software that allows you to manage every aspect of your school from the touch of a button.">
    <meta name="keywords" content="SchoolX | One stop school automation software that allows you to manage every aspect of your school from the touch of a button.">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>SchoolX | One stop school automation software that allows you to manage every aspect of your school from the touch of a button.</title>
    
    <!-- THis make Facebook sharing very catchy -->
    <meta property="og:type" content="product" />
    <meta property="og:site_name" content="SchoolX | One stop school automation software that allows you to manage every aspect of your school from the touch of a button." />
    <meta property="og:title" content="SchoolX | One stop school automation software that allows you to manage every aspect of your school from the touch of a button." />
    <meta property="og:description" content="We simply studied what schools and teachers do termly, and we automated it. So you wouldn't find anything new or strange. Its the same thing you're used to doing, only easier now. You and your teachers can do all your administrative work from anywhere, even on mobile phones. Don't fear, it doesn't consume your data. We thought of that. By computing your schools results online, you automatically have a backup of your schools archive in the cloud. You can get back any terms record, even after 20 years. And we take our backups seriously." />
    <meta property="og:url" content="https://www.schoolx.ng" />
    <meta property="og:image" content="https://www.schoolx.ng/images/demo-1.png" />
    <meta property="og:locale" content="en_NG" />
    <meta name="title" content="SchoolX | One stop school automation software that allows you to manage every aspect of your school from the touch of a button." />
    <meta name="robots" content="index,follow" />
    <meta name="description" content="We simply studied what schools and teachers do termly, and we automated it. So you wouldn't find anything new or strange. Its the same thing you're used to doing, only easier now. You and your teachers can do all your administrative work from anywhere, even on mobile phones. Don't fear, it doesn't consume your data. We thought of that. By computing your schools results online, you automatically have a backup of your schools archive in the cloud. You can get back any terms record, even after 20 years. And we take our backups seriously." />
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png" />
    <!-- Plugin-CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="css/animate.css">
    <!-- Main-Stylesheets -->
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-target=".mainmenu-area">
    <!-- Prealoader-->
    <?php
    //COntact process
    // define variables and set to empty values
$name = $school = $email = $state = $city = $phone = $url = $range = $about = $subject = $message = $success = "";
if (isset($_POST['submit'])) {
   if(isset($_POST['g-recaptcha-response'])){
$data = array(
'secret' => '6LeV7dYUAAAAAPS85XTfS0KwfG6Eif9nmLtPmmHc',
'response' => $_POST['g-recaptcha-response']
);
$url = "https://www.google.com/recaptcha/api/siteverify";

$postString = http_build_query($data, '', '&');
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	//curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
	
	
	$contents = curl_exec($ch);
	$contents = json_decode($contents);
	if (!curl_errno($ch)) {
	    if($contents->success){
   
   
  $name = $_POST['name'];
   $school = $_POST['school'];
    $email = $_POST['email'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $url = $_POST['url'];
    $range = $_POST['range'];
    $about = $_POST['about'];
//echo $name;


    $subject = "SchoolX Customer Information Request";
    $message = $_POST['message']; 

    $mailTo = "support@schoolx.ng";
    $headers = "From: <$email>"."\r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $txt = "You have received an e-mail from .\n\n <br>".$name.".\n\n<br>".$school.".\n\n<br>".$email.".\n\n<br>".$state.".\n\n<br>".$city.".\n\n<br>".$phone.".\n\n<br>".$url.".\n\n<br>".$range.".\n\n<br>".$about."\n\n<br>".$message;

//echo $txt;
    mail($mailTo, $subject, $txt, $headers);
    $success = "Message sent, an email has been sent to your mail.<br>Thank you for cotacting us!";
//CLose catcha if statement
	    }else{
	        echo "<div class='alert alert-danger'>Humans Only! Please Click the reCaptcha CheckBox.</div>";
	    }
    } else {
        echo  "<div class='alert alert-danger'>Could not verify reCaptcha</div>";
    }
    curl_close($ch);
   }
    
}
?>
    <nav class="navbar mainmenu-area" data-spy="affix" data-offset-top="200">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainmenu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"><img src="images/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="mainmenu">
                <div class="navbar-header navbar-right hidden visible-lg padding-left-50">
                    
                    <!--<a href="http://dashboard.schoolx.ng" class="bttn-1">Demo</a>-->
                    <!-- <a href="signup.php" class="bttn-1">Free Signup</a>-->
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#home-page">Home</a></li>
                    
                    <li><a href="#feature-page">Features</a></li>
                     <li><a href="#plans">Pricing</a></li>
                    <li><a href="#contact-page">Contact</a></li>
                    <li><a href="http://schoolx.ng/blog" target="_blank">Blog</a></li>
                    <li><a href="http://dashboard.schoolx.ng/pages/demo_login.php" target="_blank">Demo</a></li>
                    &nbsp;&nbsp;&nbsp; 
                    <a href="https://dashboard.schoolx.ng/parent/login.php" class="bttn-1">Student</a>
                   <a href="https://dashboard.schoolx.ng/pages/login.php" class="bttn-1">Teacher</a>
                    <a href="signup.php" class="bttn-1">School Signup</a>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-Area -->
    <header class="header-area text-white xs-center v4" style="background-image: url('images/header-bg.png'); background-position: center top; background-size: 100% 100%;" id="home-page">
        <div class="table-cell">
            <div class="container">
                <div class="row middle-row">
                    <div class="col-xs-12 col-md-5 dip"><br>
                        <h2 class="heading-2 text-white wow fadeInUp" data-wow-delay="0.3s">Everything you need to manage any school.</h2>
                      <!--  <h3 class="heading-3 text-white wow fadeInUp" data-wow-delay="0.4s">This is all you need.</h3>
                     <!--   <p class="wow fadeInUp" data-wow-delay="0.5s">SchoolX takes paperwork off collating, computing and delivering termly results, generates access codes for result downloads, allowing you focus on whats most important - educating your students.</p>
                     -->
                        <p class="wow fadeInUp" data-wow-delay="0.5s">All the tools needed to run and manage your school from anywhere, accessible on any device. Fees Payments, Accounts, E-Learning, Online Tests & Exams, Online Result Checking, Communication with Parents by Email or SMS, and Much More.</p> 
                         <!--<p class="wow fadeInUp" data-wow-delay="0.5s">In light of the outbreak of COVID-19, use Computer Based Testing to administer tests and exams to students from home. Our software will mark, record and prepare report sheets automatically and parents can access it from anywhere on any device.</p> -->
                        
                        <div class="space-30"></div>
                        <a href="signup.php" class="bttn-5 wow fadeInUp" data-wow-delay="0.7s">Start Here for Free</a> <a href="https://dashboard.schoolx.ng/parent/login.php" class="bttn-5 wow fadeInUp" data-wow-delay="0.7s">Student</a>
                        <div class="space-60 hidden visible-xs visible-sm"></div>
                    </div>
                    <div class="hidden-xs col-md-6 col-md-offset-1">
                        <figure class="dip single-image wow fadeInUp">
                            <img src="images/boss.png" alt="Productivity" height="200px">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header-Area / -->
   
   
    <!-- Service-Area -->
    <section class="section-padding" id="service-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4 wow fadeInLeft">
                    <div class="single-service">
                        <div class="service-icon">
                            <img src="images/service-icon-1.png" alt="Service Icon">
                        </div>
                        <h4 class="title">Easy to Use</h4>
                        <p>We simply studied what schools and teachers do termly, and we automated it. So you wouldn't find anything new or strange. Its the same thing you're used to doing, only easier now.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 wow fadeInUp">
                    <div class="single-service">
                        <div class="service-icon">
                            <img src="images/service-icon-2.png" alt="Service Icon">
                        </div>
                        <h4 class="title">Fast & Flexible</h4>
                        <p>You and your teachers can do all your administrative work from anywhere, even on mobile phones. Don't fear, it doesn't consume your data. We thought of that.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 wow fadeInRight">
                    <div class="single-service">
                        <div class="service-icon">
                            <img src="images/service-icon-3.png" alt="Service Icon">
                        </div>
                        <h4 class="title">Secure & Intelligent</h4>
                        <p>By computing your schools results online, you automatically have a backup of your schools archive in the cloud. You can get back any terms record, even after 20 years. And we take our backups seriously.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service-Area / -->

    <!-- Project-Area -->
    <section class="section-padding" style="background-image: url(images/section-bg-1.png); background-position: right center;">
        <div class="container">
            <div class="row middle-row">
                <div class="col-xs-12 col-md-5 wow fadeInLeft">
                    <h6 class="upper text-blue">REGAIN PRIORITY</h6>
                    <h4 class="heading-4">Focus on educating students, not on cumbersome paperwork</h4>
                    <p>We have made the process of entering school results very easy. Your teachers can even enter them offline and click a button to synchronize them to the database. Thats about all you need to do.</p>
                    <div class="space-15"></div>
                    <a href="https://dashboard.schoolx.ng/pages/demo_login.php" class="bttn-2">View the Demo</a>
                    <div class="space-60 hidden visible-xs visible-sm"></div>
                </div>
                <div class="col-xs-12 col-md-7">
                    <figure class="wow fadeInRight">
                        <img src="images/dashboard.png" alt="demo">
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <!-- Project-Area / -->

    <!-- Project-Area -->
    <section class="section-padding" style="background-image: url(images/section-bg-1.png);">
        <div class="container">
            <div class="row middle-row">
                <div class="col-xs-12 col-md-7">
                    <figure class="wow fadeInRight">
                        <img src="images/elearn2.png" alt="demo">
                    </figure>
                    <div class="space-60 hidden visible-xs visible-sm"></div>
                </div>
                <div class="col-xs-12 col-md-5 wow fadeInLeft">
                    <h6 class="upper text-blue">NEW FEATURE ALERT</h6>
                    <h4 class="heading-4">E-Learning: Teach your students from anywhere</h4>
                    <p>Our e-learning portal allows teachers to upload learning content for the students who can login and view classes. The system supports learning contents in texts, videos and external links.</p>
                    <div class="space-15"></div>
                    <a href="signup.php" class="bttn-2">Get started today</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Project-Area / -->

    <!-- Feature-Area -->
    <section id="feature-page" class="section-padding" style="background-image: url('images/section-bg-2.png'); background-position: center center; background-size: 100% 100%;">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                    <div class="page-title">
                        <h4 class="heading-4 title">Special Features of SchoolX</h4>
                        <p>This is not just another school management software. We built this with you in mind.</p>
                    </div>
                    <div class="space-80"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <div class="single-feature wow fadeInRight" data-wow-delay="0.2s">
                        <div class="feature-icon">
                            <img src="images/feature-icon-1.png" alt="Easy Intregration">
                        </div>
                        <h5 class="title">Manage Your Money</h5>
                    <!-- <p>In one location, you have a complete record of all your students. You can get any information you need from anywhere within seconds. Allows student picture uploads.</p> -->
                    
                        <p>Process School Fees payments, autogenerate and send receipts, manage your expense register, generate debtors list in one click, automatically send fee reminders, generate professional looking financial reports and account summaries.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="single-feature wow fadeInRight" data-wow-delay="0.4s">
                        <div class="feature-icon">
                            <img src="images/feature-icon-2.png" alt="Latest Technology">
                        </div>
                        <h5 class="title">Administer Your School</h5>
                        <p>Have the flexibility to create, edit and remove classes, subjects, teachers and students. Handle all postings, transfers and team roles. Generate your school timetable automatically and sync to all teachers dashboards.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="single-feature wow fadeInRight" data-wow-delay="0.6s">
                        <div class="feature-icon">
                            <img src="images/feature-icon-3.png" alt="Cloud Service">
                        </div>
                        <h5 class="title">Prepare School Reports</h5>
                        <p>Configure the look and feel of your report template, insert scores for pupils, record pupil psychomotor ratings and performaance, result comments from teachers & directors, generate access codes for parents to view results.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="single-feature wow fadeInRight" data-wow-delay="0.8s">
                        <div class="feature-icon">
                            <img src="images/feature-icon-4.png" alt="Team Collaboration">
                        </div>
                        <h5 class="title">Communicate With Stakeholders</h5>
                        <p>You can send SMS and emails directly to parents according to different flexible criteria from within the system. Send internal messages to teachers and staff too by SMS and respond to parents feedback.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="single-feature wow fadeInRight" data-wow-delay="1s">
                        <div class="feature-icon">
                            <img src="images/feature-icon-5.png" alt="User Permissions">
                        </div>
                        <h5 class="title">Tests and Exams</h5>
                        <p>Set tests and exams and adminster them online. SchoolX supports different question types. Objective and single word answers can be marked automatically and the scores recorded by the software</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="single-feature wow fadeInRight" data-wow-delay="1.2s">
                        <div class="feature-icon">
                            <img src="images/feature-icon-6.png" alt="Unlimited Storage">
                        </div>
                        <h5 class="title">Generate Access Codes</h5>
                        <p>Instantly generate access codes (like scratch cards) for each student. The code grants access to the student portal for e-learning, tests and exams and for parents to view results.</p>
                </div>
               
                
                
                
            </div>
        </div>
    </section>
    <!-- Feature-Area / -->

<section class="section-padding bg-primary" id="testimonial-page">
        <!--<div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                    <div class="page-title">
                        <h4 class="heading-4 title">Thank you Nigeria for Trusting Us</h4>
                        <p>This is how we know we are meeting a need</p>
                    </div>
                    <div class="space-80"></div>
                </div>
            </div>
        </div>-->
        
        <div class="container text-white">
            <div class="row">

                <!-- item -->
                <!--<div class="col-md-6 text-center">
                    <div class="panel">
                        <div class="panel-heading">
                            <i class="fa fa-house"></i>
                            <h1>Teachers</h1>
                        </div>
                        <div class="panel-body text-center">
                            <span style="font-size:50px" ><?php echo $allTeachers['COUNT(*)']; ?></span>
                        </div>
                    </div>
                </div>-->
                <div class="col-md-6 text-left">
                    <div class="">
                        <div class="panel-body text-left">
                            <div class="page-title">
                        <h2 class="heading-2 text-white">Thank you Nigeria for Trusting Us</h2>
                        <p>This is how we know we are meeting a need</p>
                    </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="">
                        <div class="">
                            <i class="fa fa-bank"></i>
                            <h1 class="text-white">Schools</h1>
                        </div>
                        <div class="panel-body text-center">
                            <span style="font-size:50px" ><?php echo $allSchools['COUNT(*)']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

    <!-- Testimonail-Area -->
    <section class="section-padding" id="testimonial-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <div class="testimonials">
                        <div class="single-testimonial">
                            <div class="desc">When we told our PTA that we were going paperless, they were scared becuase they thought it was a complex process. At the end of the term we simple gave them access codes to enter online and in one click, they could see their childrens result, the same way it was on paper. The transition was too smooth.</div>
                            <div class="pic">
                                <img src="images/testimonial-1.png" alt="">
                            </div>
                            <h5 class="name">Dr. Elizabeth Ogunshola</h5>
                            <span class="position">Brainy Hive Schools, Uyo</span>
                        </div>
                        <div class="single-testimonial">
                            <div class="desc">End of the term is usually hectic. We have just a week from completion of exams to vacation. The pressure of getting results ready gives rise to mistakes and errors. With SchoolX, we work from home on our phones, with ease. Within 2 days, we complete what we struggle to do in a week.</div>
                            <div class="pic">
                                <img src="images/testimonial-1.png" alt="">
                            </div>
                            <h5 class="name">Ejiro Adigwe</h5>
                            <span class="position">Classroom Teacher</span>
                        </div>
                        <div class="single-testimonial">
                            <div class="desc">As a Head Teacher, I comment on every childs termly report. I now can do that from anywhere in the world. And then I can send emails or SMS to all the parents in a particular class, from my phone, anywhere. It's now I feel like a boss.</div>
                            <div class="pic">
                                <img src="images/testimonial-1.png" alt="">
                            </div>
                            <h5 class="name">Mr Peter Mubashi</h5>
                            <span class="position">Creme De La Creme Schools, Jos</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonail-Area / -->

    <!-- Gallery-Area -->
    <section class="section-padding-top" id="gallery-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                    <div class="page-title">
                        <h4 class="heading-4 title">App Screenshot</h4>
                        <p>Notifications keep you informed of all updates. Customize them to receive as many, or as few, as you want.</p>
                    </div>
                    <div class="space-80"></div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="gallery-slider">
                        <div class="item">
                            <img src="images/screen1.png" alt="">
                        </div>
                        <div class="item">
                            <img src="images/screen2.png" alt="">
                        </div>
                        <div class="item">
                            <img src="images/screen3.png" alt="">
                        </div>
                        <div class="item">
                            <img src="images/screen4.png" alt="">
                        </div>
                        <div class="item">
                            <img src="images/shot-2.png" alt="">
                        </div>
                        <div class="item">
                            <img src="images/shot-3.png" alt="">
                        </div>
                        <div class="item">
                            <img src="images/screen5.png" alt="">
                        </div>
                        <div class="item">
                            <img src="images/screen6.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <style>
        .huge{
            font-size:25px;
        }
        .huge-m{
            font-size:18px;
        }
        .bg-grey{
            background-color:#EEEEEE;
        }
    </style>
      <!-- Pricing Area -->
    <section id="plans" class="section-padding" style="background-image: url('images/section-bg-2.png'); background-position: center center; background-size: 100% 100%;">
     
    
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                    <div class="page-title">
                        <h4 class="heading-4 title">Affordable Pricing</h4>
                        <p>You do not pay per student, we have bundle pricing.<br> The price you pay is for the whole term, and you don't have to review your pricing unless you exceed the number of students allowed for that plan. SchoolX supports you while you grow. <br><strong>Sign up now. Check it out for up to 14 Days before you make your first payment.</strong></p>
                    
                    </div>
                    <div class="space-80"></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

                <!-- item -->
                <div class="col-md-4 text-center">
                    <div class="panel panel-success panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h3>1X</h3>
                            <h4>1 - 70 Pupils/Students</h4>
                        </div>
                        <div class="panel-body text-center bg-grey">
                            <p><span class="huge"><strong>₦45,000</strong></span>/Term<br>
                         <!--   OR<br>
                            <span class="huge-m"><strong>₦100,000</strong></span>/Year -->
                        </div>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-check"></i> Access to All Features</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> Instant Setup</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> 14 Days Free before you Pay</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> 24/7 live support</li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-success" href="https://schoolx.ng/signup.php">CREATE YOUR ACCOUNT!</a>
                        </div>
                    </div>
                </div>
                <!-- /item -->
                
                <!-- item -->
                <div class="col-md-4 text-center">
                    <div class="panel panel-warning panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h3>2X</h3>
                            <h4>71 – 250 Pupils/Students</h4>
                        </div>
                        <div class="panel-body text-center bg-grey">
                            <p><span class="huge"><strong>₦75,000</strong></span>/Term<br>
                           <!-- OR<br>
                            <span class="huge-m"><strong>₦160,000</strong></span>/Year -->
                        </div>
                        <ul class="list-group text-center">
                             <li class="list-group-item"><i class="fa fa-check"></i> Access to All Features</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> Instant Setup</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> 14 Days Free before you Pay</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> 24/7 live support</li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-warning" href="https://schoolx.ng/signup.php">CREATE YOUR ACCOUNT!</a>
                        </div>
                    </div>
                </div>
                <!-- /item -->
                
                <!-- item -->
                <div class="col-md-4 text-center">
                    <div class="panel panel-danger panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h3>3X</h3>
                            <h4>251 – 500 Pupils/Students</h4>
                        </div>
                        <div class="panel-body text-center bg-grey">
                            <p><span class="huge"><strong>₦110,000</strong></span>/Term<br>
                        <!--    OR<br>
                            <span class="huge-m"><strong>₦250,000</strong></span>/Year -->
                        </div>
                        <ul class="list-group text-center">
                             <li class="list-group-item"><i class="fa fa-check"></i> Access to All Features</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> Instant Setup</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> 14 Days Free before you Pay</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> 24/7 live support</li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-danger" href="https://schoolx.ng/signup.php">CREATE YOUR ACCOUNT!</a>
                        </div>
                    </div>
                </div>
                <!-- /item -->
                
                <!-- item -->
                <div class="col-md-4 text-center">
                    <div class="panel panel-info panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h3>4X</h3>
                            <h4>501 - 1,000 Pupils/Students</h4>
                        </div>
                        <div class="panel-body text-center bg-grey">
                            <p><span class="huge"><strong>₦180,000</strong></span>/Term<br>
                      <!--      OR<br>
                            <span class="huge-m"><strong>₦400,000</strong></span>/Year -->
                        </div>
                        <ul class="list-group text-center">
                             <li class="list-group-item"><i class="fa fa-check"></i> Access to All Features</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> Instant Setup</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> 14 Days Free before you Pay</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> 24/7 live support</li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-info" href="https://schoolx.ng/signup.php">CREATE YOUR ACCOUNT!</a>
                        </div>
                    </div>
                </div>
                <!-- /item -->
                
                <!-- item -->
                <div class="col-md-4 text-center">
                    <div class="panel panel-primary panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h3>5X</h3>
                            <h4>1000+ Pupils/Students</h4>
                        </div>
                        <div class="panel-body text-center bg-grey">
                            <p><span class="huge"><strong>₦280,000</strong></span>/Term<br>
                       <!--     OR<br>
                            <span class="huge-m"><strong>₦700,000</strong></span>/Year -->
                        </div>
                        <ul class="list-group text-center">
                             <li class="list-group-item"><i class="fa fa-check"></i> Access to All Features</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> Instant Setup</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> 14 Days Free before you Pay</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> 24/7 live support</li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-primary" href="https://schoolx.ng/signup.php">CREATE YOUR ACCOUNT!</a>
                        </div>
                    </div>
                </div>
                <!-- /item -->
                
            </div>
        </div>
    </section>
    
    
    <section id="contact-page" class="section-padding contact-area" style="background: url('images/welcome-4-Shape.png') no-repeat scroll center left 10px / 600px 100%;">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                    <div class="page-title">
                        <h4 class="heading-4 title">Contact us for support today</h4>
                        <p>Get in touch with us and let us get your started in just a few days. Don't forget, you can sign up before you pay. No credit card required for sign up.</p>
                    </div>
                    <div class="space-80"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <form class="contactform validate-form" action="" method="post"> 
                        <div class="col-xs-12 col-md-4">
                            <div class="input-box validate-input" data-validate = "Name is required">
                                <label for="form-name">Your Name *</label>
                                <input type="text" name="name" class="input100 form-input form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="input-box validate-input" data-validate = "School name is required">
                                <label for="form-name">Your School Name *</label>
                                <input type="text" name="school" class="input100 form-input form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="input-box validate-input" data-validate = "Valid email is required">
                                <label for="form-email">Your Email *</label>
                                <input type="text" name="email" class="input100 form-input form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="input-box validate-input" data-validate = "State is required">
                                <label for="form-name">State of Residence*</label>
                                <input type="text" name="state" class="input100 form-input form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="input-box validate-input" data-validate = "City is required">
                                <label for="form-name">City of Residence*</label>
                                <input type="text" name="city" class="input100 form-input form-control ">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="input-box validate-input" data-validate = "Valid phone number is required">
                                <label for="form-phone">Phone Number*</label>
                                <input type="text" name="phone" class="input100 form-input form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="input-box">
                                <label for="form-website">School Website if Any</label>
                                <input type="url" name="text" class="form-input form-control ">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="input-box">
                                    <label for="form-website">Student Range</label>
                                    <select type="text" name="range" class="form-control" required>
                                        <option value="1">1 - 70 Pupils</option>
                                        <option value="2">71 - 250 Pupils</option>
                                        <option value="3">251 - 500 Pupils</option>
                                        <option value="4">501 - 1,000 Pupils</option>
                                         <option value="5">1000+ Pupils</option>

                                    </select>
                                </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="input-box">
                                <label for="form-website">How did you hear about us</label>
                                <select name="about" class="form-control">
                                    <option>Social media</option>
                                    <option>Google search</option>
                                    <option>Event/fair</option>
                                    <option>Referred by a friend</option>
                                    <option>A marketer came to my school</option>
                                    <option>Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="input-box validate-input" data-validate = "Message is required">
                                <label for="form-message">Message *</label>
                                <textarea name="message" cols="30" rows="5" class="form-input input100 form-control"></textarea>
                            </div>
                        </div>
                        <div class="row flex-row">
                                    <div class="col-xs-12 col-md-12 text-center">
                                        <center><div class="g-recaptcha" data-sitekey="6LeV7dYUAAAAACejuM3Kj_xxfqVTyTJQl5JVlYvW" data-callback="validate_catcha"></div><br></center>
                                    </div>

                                </div>                              
                            <script>
                                function validate_catcha(response){
                                    document.getElementById('submit').disabled=false;
                                }
                                
                            </script>
                        <div class="col-xs-12">
                            <button class="bttn-3 btn-disabled" name="submit" id="submit" disabled type="submit">Submit &nbsp;&nbsp;<i class="fa fa-paper-plane"></i></button>
                        </div>
                        <div class="col-xs-12" style="color: green; text-align: center; font-size: 14px;"><?= $success; ?></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ-Area -->
    <section class="section-padding-top" id="faq-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                    <div class="page-title">
                        <h4 class="heading-4 title">Frequently asked questions</h4>
                        <p>Let's save you from having to email us to get some basic questions answered.</p>
                    </div>
                    <div class="space-80"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="faq-box">
                        <h4 class="title">Is there a discount on pricing?</h4>
                        <p>Yes, while we are open to negotiations expecially for peculair cases, we give a standard 20% discount if you are paying yearly, that is for 3 terms at once. Also, as the number of students grows, we can review and renegotiate pricing.</p>
                    </div>
                    <div class="faq-box">
                        <h4 class="title">After the free term trial, can we cancel?</h4>
                        <p>Absolutely. If you don't like the application and wish to cancel, you are free to do so without obligations.</p>
                    </div>
                    <div class="faq-box">
                        <h4 class="title">How secure is our data?</h4>
                        <p>We ensure we deploy an SSL certificate to every client site to ensure data encryption, and we provide weekly backups to your database for disaster recovery in the worst event.</p>
                    </div>
                    <div class="faq-box">
                        <h4 class="title">Can we buy off the application and own it?</h4>
                        <p>No, SchoolX is runs as a SaaS (Software-as-a-Service). We are constantly updating and optimizing it for use. If you however wish to own a fully customized version, our developers can discuss your requirements and give you a quote.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="faq-box">
                        <h4 class="title">Can we still print our results if we want to?</h4>
                        <p>Yes, SchoolX reproduces the exact same result you have been using. If you wish to print hard copies for some parents who may not have internet access, you still can.</p>
                    </div>
                    <div class="faq-box">
                        <h4 class="title">How do we get technical support?</h4>
                        <p>Our tech support team is available almost 24/7. We can resolve most technical issues remotely online, but if the support requires our physical presence, we will send someone to your school (not guaranteed during free term trial)</p>
                    </div>
                    <div class="faq-box">
                        <h4 class="title">We don't have an online account, how do parents pay fees online?</h4>
                        <p>As long as your school is registered with the Corporate Affairs Commission or respective government agency, we will create an online account for you.</p>
                    </div>
                    <div class="qustion-box-2">
                        <div class="qustion-icon">
                            <img src="images/q-icon.png" alt="">
                        </div>
                        <h4 class="title">Do you have any questions?</h4>
                        <p>Would be happy to hear how I can help you out.</p>
                        <a href="mailto:support@schoolx.ng"><i class="fa fa-envelope-o" ></i> support@schoolx.ng</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--<section id="faq" class="section faq">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-md-12">-->
                    <!--<h3 class="section-title">SCHOOLX FAQs</h3>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="row">-->
    <!--            <div class="col-md-12">-->
    <!--                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">-->
                        

    <!--                        <div class="panel panel-info">-->
    <!--                                <div class="panel-heading" role="tab" id="headingTwo">-->
    <!--                                    <h4 class="panel-title">-->
    <!--                                        <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> The SCHOOLX ?</a>-->
    <!--                                    </h4>-->
    <!--                                </div>-->
        
    <!--                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">-->
    <!--                                    <div class="panel-body">-->
                                            <!--<h3>A Life-Changing Leadership Event</h3>-->
                                            <!--<p>-->
                                            <!-- What is the Global Leadership Summit? It’s an amazing  leadership -->
                                            <!-- conference that impacts 260,000 leaders across 875 cities in 120 countries, -->
                                            <!-- providing vision, inspiration, and countless practical skills you can put to -->
                                            <!-- work Monday morning. Experience it for yourself right here in Uyo Akwa Ibom.-->
                                            <!-- No matter what level of leadership you want to achieve, there’s nothing like learning-->
                                            <!--from like-minded individuals in a stimulating environment, and we hope to see you at this incredible event.-->
                                            <!--</p>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </div>-->




    <!--                    <div class="panel panel-info">-->
    <!--                        <div class="panel-heading" role="tab" id="headingOne">-->
    <!--                            <h4 class="panel-title">-->
    <!--                                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> What is the price?</a>-->
    <!--                            </h4>-->
    <!--                        </div>-->

    <!--                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">-->
    <!--                            <div class="panel-body">-->
                                    <!--<h3>The Global Leadership Summit Uyo 2019</h3>-->
                                    <!--<p>Regular #3000 ONLY</p>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->

                        
  
    <!--                    <div class="panel panel-info">-->
    <!--                        <div class="panel-heading" role="tab" id="headingThree">-->
    <!--                            <h4 class="panel-title">-->
    <!--                                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">BETWEEN THE SCHOOLX</a>-->
    <!--                            </h4>-->
    <!--                        </div>-->

    <!--                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">-->
    <!--                            <div class="panel-body">-->
                                    <!--<P>-->
                                    <!--Bring the powerful content of this years Summit experience to the -->
                                    <!--next level by learning how to apply and integrate core GLS principles -->
                                    <!--into your organization. Dive deeper into content from the Leadership-->
                                    <!-- Summit while creating transformational growth opportunities for you and your team-->
                                    <!--</P>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->

    <!--                    <div class="panel panel-info">-->
    <!--                        <div class="panel-heading" role="tab" id="headingFour">-->
    <!--                            <h4 class="panel-title">-->
    <!--                                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> The Driving Vision behind the SCHOOLX</a>-->
    <!--                            </h4>-->
    <!--                        </div>-->

    <!--                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">-->
    <!--                            <div class="panel-body">-->
                                <!--<p>-->
                                <!--        Any time leaders improve – whatever it is they’re leading wins. Quality leadership -->
                                <!--        is what brings success, and when that leadership is constantly improving, that success will consistently grow.-->
                                <!--</p>-->
                                <!--<p>-->
                                <!--        n partnership with the Willow Creek Association, NuStreams and our local -->
                                <!--        corporate and nonprofit partners are continuing to bring world-class leadership -->
                                <!--        training and inspiration to Ibadan and all of The South West Region through this life-changing event.-->
                                <!--</p>-->
                                <!--<p>-->
                                <!--        Our hope is that whether you’re a young, emerging leader or a seasoned veteran who’s-->
                                <!--         been leading for years, you’ll come and -->
                                <!--        join us as we raise the leadership bar here in our community and our city and region to win like never before.-->
                                <!--</p>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->

    <!--                    <div class="panel panel-info">-->
    <!--                        <div class="panel-heading" role="tab" id="headingFive">-->
    <!--                            <h4 class="panel-title">-->
    <!--                                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive"> I have specific questions that are not addressed here. Who can help me ?</a>-->
    <!--                            </h4>-->
    <!--                        </div>-->

    <!--                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">-->
    <!--                            <div class="panel-body">-->
    <!--                                <P>You are free to chat us</P>-->
                                <!--<p>Email : <a href="mailto:glsuyo@gmail.com">glsuyo@gmail.com</a></p> -->
                                <!--<p>Phone: +2348100000000</p>   -->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--</section>-->

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- Sponsor-Area -->
    <div class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                    <div class="page-title">
                        <h4 class="heading-4 title">Trusted by Schools all over Nigeria</h4>
                        <p>Forward thinking and reputable schools have deployed SchoolX across the country.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="footer-area v4" style="background-image: url('images/footer-bg.png');">
        
        <div class="container">
            <div class="row">
         
                
                <div class="col-xs-12 col-md-6">
                    <h4 class="heading-4">Want to Get Started ?</h4>
                    <p>Let our Relationship Management team get across to you.</p>
                </div>
                <div class="col-xs-12 col-md-6">
                     <!-- Begin Mailchimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; width:100%;}
	/* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="https://schoolx.us4.list-manage.com/subscribe/post?u=51ed09d1ec53cd80ce18d98f4&amp;id=0c703c21b5" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
	<label for="mce-EMAIL"></label>
	<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_51ed09d1ec53cd80ce18d98f4_0c703c21b5" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
</form>
</div>

<!--End mc_embed_signup-->
                </div>
            </div>
            <div class="space-60"></div>
            <div class="row footer-widget-area">
                <div class="col-xs-12 col-sm-3">
                    <div class="widget">
                        <img src="images/schoolx-alone.png" alt="">
                        <div class="space-10"></div>
                        <p>School result automation<br>
                        software with several added<br>
                        features, compatible for Nursery,<br>
                        Primary and Secondary Schools.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <div class="widget">
                        <h5 class="widget-title">Company</h5>
                        <ul>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Contact us</a></li>
                            <li><a href="#">Core value</a></li>
                            <li><a href="privacy.html">Privacy and Data Protection Policy</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-3">
                    <div class="widget">
                        <h5 class="widget-title">Get in touch</h5>
                        <div class="social-menu">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="http://twitter.com/mySchoolX"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                        </div>
                        <ul>
                            <li><a href="tel: +2349064383647">Tel : +2348077544056</a></li>
                            <li><a href="tel: +2348077544056">Tel : +2348136698217</a></li>
                            <li>Office All Over Nigeria</li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <div class="" style="text-align: center;">
                        <div class="copyright">A Product of
                            <a href ="#" target = "_blank">Learnify Labs Limited</a> 
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--Vendor-JS-->
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <!--Plugin-JS-->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/ajaxchimp.js"></script>
    <script src="js/magnific-popup.min.js"></script>
    <script src="js/contact-form.js"></script>
    <script src="js/slicknav.min.js"></script>
    <script src="js/scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <!--Main-active-JS-->
    <script src="js/main.js"></script>
    <script src="js/ant.js"></script>
    
   <!--Start of Tawk.to Script-->

<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5dc41336154bf74666b7ff99/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>



</html>

