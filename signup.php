<?php 
include_once("connection.php");
require_once("../dashboard.schoolx.ng/pages/php/lib.php");
 //contact process

// define variables and set to empty values
$name = $school = $email = $state = $city = $phone = $url = $range = $address  = $success = "";


?>


<!doctype html>
<html class="no-js" lang="en">



<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php require_once("analytics.php"); ?>
    
    <meta name="author" content="Daveshoope Webmasters & Cheyis Hub">
    <meta name="description" content="SchoolX is a world-class school result automation Software-as-a-Service that powers dozens of Nigerian schools. It allows parents access results using access codes online.">
    <meta name="keywords" content="SchoolX, Result Automation Software, online result checking, school result software, school management application or software">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>SchoolX | Sign Up | Create your school account in seconds and start using schoolx free</title>
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
    
    <!-- Bootstrap Form Helpers -->
	<link href="BootstrapFormHelpers/dist/css/bootstrap-formhelpers.min.css" rel="stylesheet" media="screen">
    
    <!-- Main-Stylesheets -->
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <!--<script src="https://www.google.com/recaptcha/api.js?render=6Lflk9UUAAAAAIyHhGsRPVPv2mmsD9o6Z9-qoxA0"></script>-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .flex-row{
    display:flex;
    flex-wrap:wrap;
        }
    .center{
    margin-top:auto;
    margin-bottom:auto;
    }
    .horizontal-align{
        margin-left:auto;
        margin-right:auto;
    }
    .form-remake{
        padding:40px;
        box-sizing:border-box;
        border:6px solid rgba(0,0,0,0.1);
        box-shadow:2px 2px 10px rgba(0,0,0,0.1), -2px -2px 10px rgba(0,0,0,0.1);
        border-radius:25px;
    }
    </style>
<!--Google CAPTCHA load function -->    
<!--     <script type="text/javascript">-->
<!--      var onloadCallback = function() {-->
<!--        grecaptcha.render('html_element', {-->
<!--          'sitekey' : '6LfJFNUUAAAAAC1bdo0R9wo9V0JFnzqSph7_ebQF'-->
<!--        });-->
<!--      };-->
<!--    </script>-->
<!--<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"-->
<!--        async defer>-->
<!--    </script>-->

</head>

<body data-spy="scroll" data-target=".mainmenu-area">
    <!-- Prealoader-->
    
    <nav class="navbar mainmenu-area" data-spy="affix" data-offset-top="200" style="background-color: #289DF3;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainmenu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="mainmenu">
                <div class="navbar-header navbar-right hidden visible-lg padding-left-50">
                    <!--<a href="http://demo.schoolx.com.ng" class="bttn-1 ">Demo</a>-->
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="index.php">Home</a></li>
                    <!--<li><a href="index.php?#service-page">Services</a></li>-->
                    <li><a href="index.php?#feature-page">Features</a></li>
                    <li><a href="index.php?#contact-page">Contact</a></li>
                    <li><a href="http://schoolx.com.ng/blog" target="_blank">Blog</a></li>
                    <li><a href="http://dashboard.schoolx.ng/pages/login.php">Login</a></li>
                    &nbsp;&nbsp;&nbsp;
                   
                </ul>
            </div>
        </div>
    </nav>

    <section id="contact-page" class="section-padding contact-area" style="background: url('images/welcome-4-Shape.png') no-repeat scroll center left 10px / 600px 100%;">
        <div class="container">

            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center">
                    <div class="space-10"></div>
                </div>
            </div>
            
            <div class="row flex-row">
                

                <div class="col-xs-12 col-sm-10 col-md-4 center horizontal-align">
                    <div class="page-title ">
                        <h4 class="heading-4 title" style="text-align:center">Signup Now! It's 100% Free To Start</h4>
                        <p style="text-align:center">Get started in seconds and gain access to all features. You have up to 14 Days before you make up your mind to pay.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-10 col-md-8 center horizontal-align">
                    <form class="contactform validate-form form-remake" action="" method="post"> 
                      
                    <?php
if(isset($_POST['submit'])){
    define("SYSTEM_CURRENT_TERM", "2");
    define("SYSTEM_CURRENT_SESSION", "6");
    //Verify reCatcha
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
	        
        $school_name = mysqli_real_escape_string($DB,$_POST['school_name']);
        //$email = mysqli_real_escape_string($DB,$_POST['email']);
        $country = mysqli_real_escape_string($DB,$_POST['country']);
        $state = mysqli_real_escape_string($DB,$_POST['state']);
        $city = mysqli_real_escape_string($DB,$_POST['city']);
        $school_phone = mysqli_real_escape_string($DB,$_POST['school_phone']);
        //$url = mysqli_real_escape_string($DB,$_POST['url']);
        $range = mysqli_real_escape_string($DB,$_POST['range']);
        //$address = mysqli_real_escape_string($DB,$_POST['address']);
        
        
        $name = mysqli_real_escape_string($DB,$_POST['name']);
		$email = mysqli_real_escape_string($DB,$_POST['email']);
		$school_email = mysqli_real_escape_string($DB,$_POST['school_email']);
		$phone = mysqli_real_escape_string($DB,$_POST['phone']);
		$reason = mysqli_real_escape_string($DB,$_POST['reason']);
		$reg_role = mysqli_real_escape_string($DB,$_POST['reg_role']);
		$school_type = mysqli_real_escape_string($DB,$_POST['school_type']);
		$birthday_sms = "Keep growing in strength as you increase in age. Happy birthday from all of us at ". $school_name;
		
        //$pass = '12345';
		$password = mysqli_real_escape_string($DB, md5($_POST['password']));
 		$role = '3';		//Super Admin Role
		$time = time();
		$check_staff = mysqli_query($DB, "SELECT * FROM `teacher` WHERE  email = '$email'") or die (mysqli_error($DB));
		if (mysqli_num_rows($check_staff) == 0)
		{	
    		$check_query = mysqli_query($DB, "SELECT * FROM `schools` WHERE  school_name = '$school_name' AND school_phone = '$school_phone'") or die (mysqli_error($DB));
    				
    		if (mysqli_num_rows($check_query) == 0)
    		{	
        			$insert = mysqli_query($DB, "INSERT into schools (`contact_person`, `school_name`, `school_email`, `country`, `state`, `city`, `school_phone`,`website`,`current_plan`,`school_address`,`current_session_id`,`current_term_id`,`ADMIN_ROLE`,`TEACHER_ROLE`, `purpose_of_registering`, `role_of_registrar`, `school_type`, `birthday_sms`)
        								VALUES ('$name ', '$school_name', '$school_email', '$country', '$state', '$city', '$school_phone', '', '$range', '','".SYSTEM_CURRENT_SESSION."','".SYSTEM_CURRENT_TERM."','3','1', '$reason', '$reg_role', '$school_type', '$birthday_sms')") or die(mysqli_error($DB));
        			if(mysqli_affected_rows($DB) == 1){
        			    $school_id = mysqli_insert_id($DB);
        			    
        			    //Insert school term details
        			    $bill = getField($range, "plans", "termly_fee");
        			    $insert_teacher = mysqli_query($DB, "INSERT into school_terms (`school_id`, `term_id`, `session_id`, `plan`, `bill`, `discount`, `amount_paid`,  `time`)
        								VALUES ('$school_id', '".SYSTEM_CURRENT_TERM."','".SYSTEM_CURRENT_SESSION."', '".$range."', '$bill', '0', '0', '$time')") or die(mysqli_error($DB));
        								
        			    //Insert Teacher
        			   	$insert_teacher = mysqli_query($DB, "INSERT into teacher (`role_id`, `teacher`, `password`, `phone`, `email`, `time`,school)
        								VALUES ('$role', '$name','$password', '$phone', '$email', '$time','$school_id')") or die(mysqli_error($DB));
        				$teacher_id = mysqli_insert_id($DB);
        				
        				//Insert template
        				$insert_report_teplate = mysqli_query($DB, "INSERT into report_template (`report_template`, `description`, `school`, `time`)
								VALUES ('Sample Report Format', 'Created By SchoolX (Edit as desired)', '".$school_id."', '$time')") or die(mysqli_error($DB));
						$template_id = mysqli_insert_id($DB);
						$insert_report_field = mysqli_query($DB, "INSERT into report_fields (`template_id`, `title`, `slug`, `formular`, `order`, `max`, `school`, `time`)
								VALUES ('$template_id', '1st Test', '1st_ca', '', '1', '10',  '$school_id', '$time'), ('$template_id', '2nd Test', '2nd_ca', '', '2', '10',  '$school_id', '$time'), ('$template_id', 'Exam', 'exam', '', '3', '80',  '$school_id', '$time')") or die(mysqli_error($DB));
						
						//Insert Class
        				$insert_class = mysqli_query($DB, "INSERT into class (`class`, `teacher_id`, `template_id`, `school_fees`,`school`)
                                VALUES ('Grade 1', '$teacher_id', '$template_id', '5000','$school_id')") or die(mysqli_error($DB));
                        $class_id = mysqli_insert_id($DB);
                        
                        //Insert 3 Subjects
                        $insert_subject1 = mysqli_query($DB, "INSERT into subject (`subject`, `class_id`, `teacher_id`,school)
								VALUES ('Mathematics', '$class_id', '$teacher_id','$school_id'), ('English Language', '$class_id', '$teacher_id','$school_id'), ('Basic Science', '$class_id', '$teacher_id','$school_id')") or die(mysqli_error($DB));
						
						//Insert 2 Students and assign class
        				$insert_student = mysqli_query($DB, "INSERT into student (`admission_no`, `firstname`, `middlename`, `surname`, `gender`, `dob`, `parent_phone`, `parent_email`, `parent_address`, `passport`, `time`,school)
								VALUES ('001', 'Gabriel',  'Musa', 'Titus (Sample)', 'male', '09/12/2013', '$phone', '$email', 'No 1, Surulere', 'passport_0.jpg', '$time','$school_id')") or die(mysqli_error($DB));
						$student_id = mysqli_insert_id($DB);
						$insert_class_binding = mysqli_query($DB, "INSERT into `class_bindings` (`student_id`, `class_id`, `session_id`, `term_id`,`school`)VALUES ('$student_id', '$class_id', '".SYSTEM_CURRENT_SESSION."', '".SYSTEM_CURRENT_TERM."','$school_id')") or die(mysqli_error($DB));
						
						$insert_student = mysqli_query($DB, "INSERT into student (`admission_no`, `firstname`, `middlename`, `surname`, `gender`, `dob`, `parent_phone`, `parent_email`, `parent_address`, `passport`, `time`,school)
								VALUES ('002', 'Safiya',  'Musa', 'Dare (Sample)', 'female', '09/12/2010', '$phone', '$email', 'No 1, kamara', 'passport_0.jpg', '$time','$school_id')") or die(mysqli_error($DB));
					    $student_id = mysqli_insert_id($DB);
					    $insert_class_binding = mysqli_query($DB, "INSERT into `class_bindings` (`student_id`, `class_id`, `session_id`, `term_id`,`school`)VALUES ('$student_id', '$class_id', '".SYSTEM_CURRENT_SESSION."', '".SYSTEM_CURRENT_TERM."','$school_id')") or die(mysqli_error($DB));
					    
					    
        		
        				
            		        if(mysqli_affected_rows($DB) == 1){
                				echo "<div class='alert alert-success alert-dismissible'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                				echo "Congratulation $school_name<br> Your account has been created. We even created sample students and classes for you. Check your email for a mail from us to verify your email and then you can proceed to <a href='http://dashboard.schoolx.ng/pages/login.php' target='_blank' style='text-decoration: none;'><strong><font style='color: blue; text-align: center; font-size: 20px;'> Login <i class='fa fa-arrow-right'></i></font></strong></a>, and start experiencing the power of SchoolX. Cheers! </div>";
                		        //send the email
                		        $mailcontent = "
                		        <h2>Welcome Home</h2>
                		        
                		        <p>Congratulations $name, you just created a SchoolX Account for <strong>$school_name</strong>. You are now part of a community of hundreds of forward thinkers taking their schools to the next level with SchoolX. We will send you a few tips over the next few weeks to get you starting using this platform.</p>
                                
                                <br>
                                <h3>There is so much you can do with SchoolX.</h3>
                                <p><strong>Manage Your Finances</strong></p>
                                <p>You can process school fees payment, prepare receipts, manage expenses, generate reports, view list of debtors and even send them reminders with just the click of a button.</p>
                                
                                <p><strong>School Administration</strong></p>
                                <p>Manage Classes, Subjects, Teachers, Students and even timetables from within the system.</p>
                                
                                <p><strong>Prepare & Distribute Report Sheets</strong></p>
                                <p>Without doing any manual work, you can prepare report sheets termly or yearly for your students and parents can access it online.</p>
                                
                                <p><strong>Computer Based Tests & Exams</strong></p>
                                <p>You can set tests and exams for your students to take from home. The system will mark the tests automatically and record the scores into the report sheets</p>
                                
                                
                                
                		        <p>If you have not yet logged into your dashboard, <a href='https://dashboard.schoolx.ng'>please login here </a> and begin to experience why hundreds of schools have chosen to use SchoolX.</p>
                		        
                		        
                		        <p>Our Relationship Managers will get across to you soon in case you need any help in configuring or setting up your school account. Meanwhile, if you need help before they reach you, you can chat with us right from within your dashboard or simply reply this email. Don't hesitate to give us feedback or ask for new features you will want us to include in future updates. Our team is listening keenly.</p>

                		        <p>This is to your success.</p>
                		        
                		        ";
                		        $send = welcomemail($email, "Welcome to SchoolX", $mailcontent);
                		        
                		            // API to mailchimp ########################################################
                                    $list_id = '0c703c21b5';
                                    $authToken = 'e0eac6bd83f7b02099f67c9fa4bda08b-us4';
                                    // The data to send to the API
                                    
                                    $postData = array(
                                        "email_address" => trim($_POST["email"]), 
                                        "status" => "subscribed", 
                                        "merge_fields" => array(
                                        "FNAME"=> trim($_POST["name"]),
                                        "PHONE"=> trim($_POST["phone"]))
                                    );
                                    
                                    $postData2 = array(
                                        "email_address" => trim($_POST["school_email"]), 
                                        "status" => "subscribed", 
                                        "merge_fields" => array(
                                        "FNAME"=> trim($_POST["school_name"]),
                                        "PHONE"=> trim($_POST["school_phone"]))
                                    );
                                    
                                    // Setup cURL
                                    $ch = curl_init('https://us4.api.mailchimp.com/3.0/lists/'.$list_id.'/members/');
                                    curl_setopt_array($ch, array(
                                        CURLOPT_POST => TRUE,
                                        CURLOPT_RETURNTRANSFER => TRUE,
                                        CURLOPT_HTTPHEADER => array(
                                            'Authorization: apikey '.$authToken,
                                            'Content-Type: application/json'
                                        ),
                                        CURLOPT_POSTFIELDS => json_encode($postData)
                                    ));
                                    // Send the request
                                    $response = curl_exec($ch);
                                    unset($ch);
                                    
                                    $ch = curl_init('https://us4.api.mailchimp.com/3.0/lists/'.$list_id.'/members/');
                                    curl_setopt_array($ch, array(
                                        CURLOPT_POST => TRUE,
                                        CURLOPT_RETURNTRANSFER => TRUE,
                                        CURLOPT_HTTPHEADER => array(
                                            'Authorization: apikey '.$authToken,
                                            'Content-Type: application/json'
                                        ),
                                        CURLOPT_POSTFIELDS => json_encode($postData2)
                                    ));
                                    
                                    // Send the second request
                                    $response = curl_exec($ch);
                                    // #######################################################################                		        
            		            
            		            
            		        }else{
                		            echo "<div class='alert alert-danger alert-dismissible'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                		            An error occured while creating Your account. If this perssist please chat with our support team from the chatbox (bottom right corner of screen).
                		            </div>";
                		        }
        			}else{
    				echo "<div class='alert alert-danger'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    				echo "School was not created, please try again</div>";
    		        }
        										
    		} else{
    			echo "<div class='alert alert-danger'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    			echo "School Already exists</div>";
    		}
		} else{
    		echo "<div class='alert alert-danger'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    		echo "An account has already been created by someone using the same email. Is this is mistake?</div>";
    	}
    
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
                
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                            <h1>School Information</h1>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="input-box validate-input form-group" data-validate = "School name is required">
                                    <label for="form-name">Your School Name *</label>
                                    <input type="text" name="school_name" class="form-control" placeholder="School Name" value="<?php echo isset($_POST['submit'])? $_POST['school_name']:''; ?>" required>
                                </div>
                            </div>
                         
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="input-box validate-input form-group" data-validate = "State is required">
                                    <label for="form-name">Country*</label>
            		    		    <select id="countries_states1" name="country" class="form-control bfh-countries" data-country="NG"  required></select>
                                <!--    <input type="text" name="state" class="input100 form-input form-control">-->
                                </div>
                            </div>
                            <!--</div>-->
                            <!--<div class="row">-->
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="input-box validate-input form-group" data-validate = "State is required">
                                    <label for="form-name">State*</label>
                                    <select class="form-control bfh-states" name="state" data-country="countries_states1" required></select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="input-box  form-group" >
                                    <label for="form-phone">City*</label>
                                     <input type="text" name="city" class="form-control" placeholder="city" value"<?php echo isset($_POST['submit'])? $_POST['city']:''; ?>" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="input-box validate-input form-group" data-validate = "Valid phone number is required">
                                    <label for="form-phone">Phone Number*</label>
                                    <!--<input type="text" name="phone" class="input100 form-input form-control">-->
                                    <!--<input type="text" class="form-control input-medium bfh-phone" data-country="">-->
                                    <input type="text" name="school_phone" class="form-control input-medium bfh-phone" required data-country="" data-format="dddddddddddddd" placeholder="" value="<?php echo isset($_POST['submit'])? $_POST['school_phone']:''; ?>">
                                </div>
                            </div>
                             <div class="col-xs-12 col-md-4">
                                <div class="input-box validate-input form-group" data-validate = "Valid email is required">
                                    <label for="form-email">School Email* </label>
                                    <input class="form-control" type="email" name="school_email" id="email-input" placeholder="Valid School Email" required>

                                    <br/>
                                    <span id="email-validate"></span>

                                </div>
                            </div>
                            <!--<div class="col-xs-12 col-md-4">
                                <div class="input-box">
                                    <label for="form-website">School Website if Any</label>
                                    <input type="text" name="url" class="form-control" placeholder="School Website">
                                </div>
                            </div>-->
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                                <div class="input-box">
                                    <label for="form-website">Student Range</label>
                                    <select type="text" name="range" class="form-control" required>
                                        <option <?php echo isset($_POST['range']) && $_POST['range']=='1'? 'selected':''; ?> value="1">1 - 70 Pupils</option>
                                        <option <?php echo isset($_POST['range']) && $_POST['range']=='2'? 'selected':''; ?> value="2">71 - 250 Pupils</option>
                                        <option <?php echo isset($_POST['range']) && $_POST['range']=='3'? 'selected':''; ?> value="3">251 - 500 Pupils</option>
                                        <option <?php echo isset($_POST['range']) && $_POST['range']=='4'? 'selected':''; ?> value="4">501 - 1,000 Pupils</option>
                                         <option <?php echo isset($_POST['range']) && $_POST['range']=='5'? 'selected':''; ?> value="5">1000+ Pupils</option>

                                    </select>
                                </div>
                            </div>
                            
                             <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="input-box">
                                    <label for="form-website">Type of School</label>
                                    <select type="text" name="school_type" class="form-control" required>
                                        <option value="Nursery and Primary">Nursery and Primary</option>
                                        <option value="Secondary Only">Secondary Only</option>
                                        <option value="Nursery, Primary and Secondary">Nursery, Primary and Secondary</option>
                                        <option value="Tertiary">Tertiary</option>
                                         <option value="Not really a school">None of the Above</option>

                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
                                <div class="input-box">
                                    <label for="form-website">What's your role in the school?</label>
                                    <select type="text" name="reg_role" class="form-control" required>
                                        <option value="Proprietor">Proprietor/Proprietress</option>
                                        <option value="Principal or Headteacher">Principal/Head Teacher</option>
                                        <option value="Administrator">School Administrator</option>
                                        <option value="Teacher">Teacher</option>
                                         <option value="Not a Staff">I don't work there</option>

                                    </select>
                                </div>
                            </div>
                            <!--<div class="col-xs-12 col-md-4">-->
                            <!--    <div class="input-box">-->
                            <!--        <label for="form-website">How did you hear about us</label>-->
                            <!--        <select type="text" name="about" class="form-input">-->
                            <!--            <option>Social media</option>-->
                            <!--            <option>Google search</option>-->
                            <!--            <option>Event/fair</option>-->
                            <!--            <option>Referred by a friend</option>-->
                            <!--            <option>A marketer came to my school</option>-->
                            <!--            <option>Others</option>-->
                            <!--        </select>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="col-xs-12 col-md-4">
                                <div class="input-box validate-input" data-validate = "Message is required">
                                    <label for="form-message">School Address *</label>
                                    <textarea name="address" cols="3" rows="2" class=" form-control form-input input100" placeholder="School Address" required></textarea>
                                </div>
                            </div>-->
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <h1>Your Account</h1>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="input-box validate-input form-group" data-validate = "Contact name is required">
                                    <label for="form-name">Your Name *</label>
                                    <input type="text" name="name" class="form-control" required value="<?php echo isset($_POST['submit'])? $_POST['name']:''; ?>">
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="input-box validate-input form-group" data-validate = "Email is required">
                                    <label for="form-name">Your Email *</label>
                                    <input type="email" name="email" class="form-control" required value="<?php echo isset($_POST['submit'])? $_POST['email']:''; ?>">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="input-box validate-input form-group" data-validate = "Phone Number is required">
                                    <label for="form-name">Your Phone Number *</label>
                                    <input type="text" name="phone" class="form-control" required value="<?php echo isset($_POST['submit'])? $_POST['phone']:''; ?>">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="input-box validate-input form-group" data-validate = "Password is required">
                                    <label for="form-name">Set Your Password *</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="input-box">
                                    <label for="form-website">Which of these explains why you're signing up?</label>
                                    <select type="text" name="reason" class="form-control" required>
                                        <option value="We need it">We plan to use this for our school</option>
                                        <option value="We want to check it out">Just want to check it out to see if it fits</option>
                                        <option value="Show my boss">I want to show my boss</option>
                                        <option value="Reseller">I want to be a reseller</option>
                                         <option value="Do not know why I am here">Other reason</option>

                                    </select>
                                </div>
                            </div>
                             <!--<div class="g-recaptcha" data-sitekey="6LfJFNUUAAAAAC1bdo0R9wo9V0JFnzqSph7_ebQF"></div>-->
                             
      <br/>
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
                            <span>By proceeeding to sign-up, you agree to our <a href = "https://schoolx.ng/privacy.html" target = "_blank" >Privacy Policy </a> and our Terms and Conditions.</span>
                                <div class="row flex-row">
                                    <div class="col-xs-12 col-md-8 horizontal-align">
                                        <button class="btn btn-primary btn-lg btn-block" name="submit" id="submit" type="submit" disabled>Sign Up &nbsp;&nbsp;<i class="fa fa-paper-plane"></i></button>
                                    </div>

                                </div>                              
                            
                            <div class="col-xs-12" style="color: green; text-align: center; font-size: 14px;"><?= $success; ?></div>

                        </div>
                    </form>
                </div>

            </div>
        <!--    <div class="row">
                        <div class="col-xs-12 col-sm-4 wow fadeInLeft">
                            <div class="single-service">
                                <div class="service-icon">
                                    <img src="images/service-icon-1.png" alt="Service Icon">
                                </div>
                                <h4 class="title">1X</h4>
                                <p>These are schools with student between (1 - 70).</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 wow fadeInUp">
                            <div class="single-service">
                                <div class="service-icon">
                                    <img src="images/service-icon-2.png" alt="Service Icon">
                                </div>
                                <h4 class="title">2X</h4>
                                <p>These are schools with student between (71 - 250).</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 wow fadeInRight">
                            <div class="single-service">
                                <div class="service-icon">
                                    <img src="images/service-icon-3.png" alt="Service Icon">
                                </div>
                                <h4 class="title">3X</h4>
                                <p>These are schools with student between (251 - 500).</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 wow fadeInRight">
                            <div class="single-service">
                                <div class="service-icon">
                                    <img src="images/service-icon-3.png" alt="Service Icon">
                                </div>
                                <h4 class="title">4X</h4>
                                <p>These are schools with student between (501 - 1000).</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 wow fadeInRight">
                            <div class="single-service">
                                <div class="service-icon">
                                    <img src="images/service-icon-3.png" alt="Service Icon">
                                </div>
                                <h4 class="title">5X</h4>
                                <p>These are schools with student upto 1000+.</p>
                            </div>
                        </div>
                    </div>


            -->
            
            
            
            
            

            
            
            
            
            
            
            <br><br><br>
           
        </div>
    </section>
    
    <footer class="footer-area v4" style="background-image: url('images/footer-bg.png');">
        <div class="container">
            <div class="row">
              
            <div class="space-60"></div>
            <div class="row footer-widget-area">
                <div class="col-xs-12 col-sm-3">
                    <div class="widget">
                        <img src="images/schoolx-alone.png" alt="">
                        <div class="space-10"></div>
                        <p>We provide you all<br>
                        the tools you need to manage<br>
                        any primary or secondary school,
                        Right from the web, on any device.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                    
                </div>
                <div class="col-xs-12 col-sm-3">
                   
                </div>
                <div class="col-xs-12 col-sm-3">
                    <div class="widget">
                        <h5 class="widget-title">Get in touch</h5>
                        <div class="social-menu">
                            <a href="http://facebook.com/myschoolx"><i class="fa fa-facebook"></i></a>
                            <a href="http://twitter.com/mySchoolX"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.linkedin.com/company/13062814"><i class="fa fa-linkedin"></i></a>
                            
                        </div>
                        <ul>
                            <li><a href="tel: +2349064383647">Tel : +2348077544056</a></li>
                            <li><a href="tel: +2348077544056">Tel : +2348136698217</a></li>
                            <li>Lagos | Uyo | Jos </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <div class="" style="text-align: center;">
                        <div class="copyright">Powered by 
                            <a href="http://www.schoolx.ng" target="_blank">Learnify Labs Limited</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--Vendor-JS-->
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    
    <!-- Bootstrap Form Helpers -->
	<script src="BootstrapFormHelpers/dist/js/bootstrap-formhelpers.min.js"></script>
    
       <script>
    jQuery(function($) {

    // When the user types something in the input
    $('#email-input').on('keyup', function(e) {

        // set the variables
        var $input = $(this)
        ,   value  = $input.val()
        ,   data   = {
                email: value   
        };

        // perform an ajax call
        $.ajax({
            url: 'myvalidator.php', // this is the target
            method: 'get', // method
            data: data, // pass the input value to server
            success: function(r) { // if the http response code is 200
                // $('#email-validate').css('color', 'green').html(r);
                $('#email-validate').css('color', 'red').html(r);
                //$('button').removeAttr('disabled');
            }
            // ,
            // error: function(r) { // if the http response code is other than 200
            //     $('#email-validate').css('color', 'red').html(r);
            //     $('button').attr('disabled', 'disabled');
            // }

        });
    });

});
    
</script>     
  
    
    
    
    
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

