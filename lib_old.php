<?php
//session_start();
//Establishes Connection to the Database
require_once("connection.php");
ini_set("allow_url_fopen", 1);
ini_set ("log_errors", "on");
ini_set ("error_log", "my_php_errors.log");
@session_start();
//ini_set("session.cookie_lifetime", "1");
//Gets the value of an option name

/*
function getOption($id){
   // global $_SESSION['school'];
    $id = $_SESSION['school'];
	global $DB;
	$optionData = mysqli_query($DB, "SELECT * FROM schools WHERE id = '$id' ") or die(mysqli_error($DB));
	$option = mysqli_fetch_assoc($optionData);	
	return $option;
} */

function getOption($name){
   // global $_SESSION['school'];
    $id = $_SESSION['school'];
	global $DB;
	$optionData = mysqli_query($DB, "SELECT $name FROM schools WHERE id = '$id' ") or die(mysqli_error($DB));
	$option = mysqli_fetch_assoc($optionData);	
	
	return $option[$name];
}


define("ROOT_FOLDER", "http://saas.schoolx.ng/");
//define("ROOT_FOLDER", "http://localhost/schoolx/saas_schoolx/");
define("SYSTEM_VERSION", "1.6");
define("SCHOOL_NAME", ucwords(getOption("school_name")));
define("SCHOOL_ID", getOption('id'));
define("SCHOOL_LOGO", getOption('logo'));
//define("SCHOOL_NAME", ucwords(getOption($option['school_name'])));
define("SCHOOL_ADDRESS", ucwords(getOption('school_address')));
define("SCHOOL_PHONE", ucwords(getOption('school_phone')));
define("SCHOOL_EMAIL", ucwords(getOption('school_email')));
define("WEB_ADDRESS", getOption('website'));
define("CURRENT_SESSION", getOption('current_session_id'));
define("CURRENT_TERM", getOption('current_term_id'));

define("ADMIN_ROLE", getOption('ADMIN_ROLE'));
define("FORM_MASTER_ROLE", 2);
define("TEACHER_ROLE", getOption('TEACHER_ROLE'));
define("SCHOOL", $_SESSION['school']);

define("SMS_USERNAME", "DEMO");
define("SMS_PASSWORD", "demo");


//Gets the value of a field given the table and id
function getField($id, $table, $field){
	global $DB;;
	$query = mysqli_query($DB,"SELECT $field FROM `$table` WHERE id = '$id'") or die(mysqli_error($DB));
	$designation = mysqli_fetch_assoc($query);
	return $designation[$field];
}

//Gets the value of a field given the table and id with school id
function getFieldWithId($id, $table, $field){
	global $DB;;
	$query = mysqli_query($DB,"SELECT $field FROM `$table` WHERE school = ".$_SESSION['school']." AND id = '$id'") or die(mysqli_error($DB));
	$designation = mysqli_fetch_assoc($query);
	return $designation[$field];
}

//Verifies whether the invoice number exist on db as a customer
function isCustomer($invoice_no)
{
	global $DB;
	$check_query = mysqli_query($DB,"SELECT * FROM `customers` WHERE invoice_no = '$invoice_no'") or die (mysqli_error($DB));
	if (mysqli_num_rows($check_query) == 1)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}




//Check if customer's uplink have once been paid. This is useful if he ever claimed and unclaimed, so that the uplinks are not paid twice when reclaiming
function isUplinkPaid($invoice_no){
		$customer = getCustomerInfo($invoice_no);
		if($customer['uplink_paid'] == 1){
			return true;
		}
		else{
			return false;
		}
}

//Gets all the info about the admin
function getAdminInfo($username){
	global $DB;
	$check_query = mysqli_query($DB,"SELECT * FROM `teacher` WHERE  school =".$_SESSION['school']." AND email = '$username' and status = '1'") or die (mysqli_error($DB));
	if(mysqli_num_rows($check_query) == 1){
		return  mysqli_fetch_assoc($check_query);
	}
	else{
		return false;
	}
}


//Logs in Admins into the Alocator
// function loginAdmin($username, $password){
// 	global $DB;
// 	$username = mysqli_real_escape_string($DB, $username);
// 	$password = mysqli_real_escape_string($DB, md5($password));

// 	//Check db for exact login credentials
// 	$check_query = mysqli_query($DB,"SELECT * FROM `teacher` WHERE username = '$username' and password = '$password' and status = '1'") or die (mysqli_error($DB));

				
// 		if (mysqli_num_rows($check_query) == 1)
// 		{
// 			$check_detail = mysqli_fetch_assoc($check_query);	//login successful
// 			$_SESSION['admin'] = $check_detail['username'];
// 			return true;
// 		}
// 		else
// 		{
// 			return false;	//does not exist in database
// 		}
// }

	
function loginAdmin($email, $password){
	global $DB;
	$email = mysqli_real_escape_string($DB, $email);
	$password = mysqli_real_escape_string($DB, md5($password));

	//Check db for exact login credentials
	$check_query = mysqli_query($DB,"SELECT * FROM `teacher` WHERE email = '$email' and password = '$password' and status = '1'") or die (mysqli_error($DB));

				
		if (mysqli_num_rows($check_query) == 1)
		{
			$check_detail = mysqli_fetch_assoc($check_query);	//login successful
			$_SESSION['admin'] = $check_detail['email'];
		    $_SESSION['school'] = $check_detail['school'];
			return true;
		}
		else
		{
			return false;	//does not exist in database
		}
}




//Logs in a parent with the code
function loginCode($pin){
	global $DB;
	$pin = mysqli_real_escape_string($DB, $pin);

	//Check db for exact login credentials
	$check_query = mysqli_query($DB,"SELECT * FROM `result_pins` WHERE pin = '$pin' and status = '1'") or die (mysqli_error($DB));
				
		if (mysqli_num_rows($check_query) == 1)
		{
			$check_detail = mysqli_fetch_assoc($check_query);	//login successful
			$_SESSION['pin'] = $check_detail['pin'];
			return true;
		}
		else
		{
			return false;	//does not exist in database
		}
}


//Logs in a parent with the code With school Id
function loginCodeWithId($pin){
	global $DB;
	$pin = mysqli_real_escape_string($DB, $pin);

	//Check db for exact login credentials
	$check_query = mysqli_query($DB,"SELECT * FROM `result_pins` WHERE school = ".$_SESSION['school']." AND pin = '$pin' and status = '1'") or die (mysqli_error($DB));
				
		if (mysqli_num_rows($check_query) == 1)
		{
			$check_detail = mysqli_fetch_assoc($check_query);	//login successful
			$_SESSION['pin'] = $check_detail['pin'];
			return true;
		}
		else
		{
			return false;	//does not exist in database
		}
}



//Add a value to the activity log
function addLog($action, $user){
	global $DB;
	//global $admin_agent;
	//$user == ""? $admin_agent:$user;
	$time = time();
	$action = mysqli_real_escape_string($DB, $action);
	$school = $_SESSION['school'];
	$insert = mysqli_query($DB,"INSERT into activity_log (`user_id`, `action`, `time`,`school`)
								VALUES ('$user', '$action', '$time','$school')") or die(mysqli_error($DB));
	if(mysqli_affected_rows($DB) == 1){
		//echo '<div class="alert alert-success">Activity Logged</div>';
	}
	else{
		echo '<div class="alert alert-danger">Could not log activity</div>';
	}		
}

//Gets all the info about the class
function getPINInfo($pin){
	global $DB;
	$pin = mysqli_real_escape_string($DB, $pin);
	$check_query = mysqli_query($DB,"SELECT * FROM `result_pins` WHERE school =".$_SESSION['school']." AND pin= '$pin' and status = '1'") or die (mysqli_error($DB));
	if(mysqli_num_rows($check_query) == 1){
		return  mysqli_fetch_assoc($check_query);
	}
	else{
		return false;
	}
}

//Gets all the info about the class
function getClassInfo($id){
	global $DB;
	$check_query = mysqli_query($DB,"SELECT * FROM `class` WHERE school = ".$_SESSION['school']." AND id = '$id' and status = '1'") or die (mysqli_error($DB));
	if(mysqli_num_rows($check_query) == 1){
		return  mysqli_fetch_assoc($check_query);
	}
	else{
		return false;
	}
}

//Gets all the info about the subject
function getSubjectInfo($id){
	global $DB;
	$check_query = mysqli_query($DB,"SELECT * FROM `subject` WHERE school = ".$_SESSION['school']." and id = '$id' and status = '1'") or die (mysqli_error($DB));
	if(mysqli_num_rows($check_query) == 1){
		return  mysqli_fetch_assoc($check_query);
	}
	else{
		return false;
	}
}

//Gets all the info about the subject
function getTeacherInfo($id){
	global $DB;
	$check_query = mysqli_query($DB,"SELECT * FROM `teacher` WHERE school = ".$_SESSION['school']." and id = '$id' and status = '1'") or die (mysqli_error($DB));
	if(mysqli_num_rows($check_query) == 1){
		return  mysqli_fetch_assoc($check_query);
	}
	else{
		return false;
	}
}

//Gets all the info about the student
function getStudentInfo($id, $term=CURRENT_TERM, $session=CURRENT_SESSION){
	global $DB;
	$check_query = mysqli_query($DB,"SELECT * FROM `student` WHERE school =".$_SESSION['school']." AND id = '$id' and status = '1'") or die (mysqli_error($DB));
	if(mysqli_num_rows($check_query) == 1){
		$student = mysqli_fetch_assoc($check_query);
		
		$query = mysqli_query($DB,"SELECT * FROM `class_bindings` WHERE school =".$_SESSION['school']." AND `student_id` = '".$student['id']."' and session_id ='".$session."' and term_id = '".$term."' and status = '1'") or die (mysqli_error($DB));
		if(mysqli_num_rows($query) > 0){
			$class  = mysqli_fetch_assoc($query);
			$student['class_id'] = $class['class_id'];
			$student['position'] = $class['position'];
			$student['no_of_attendance'] = $class['no_of_attendance'];
			$student['height'] = $class['height'];
			$student['weight'] = $class['weight'];
			$student['sports'] = $class['sports'];
			$student['significant_contribution'] = $class['significant_contribution'];
			$student['office_held'] = $class['office_held'];
			$student['club_membership'] = $class['club_membership'];
			$student['pupil_avg'] = $class['pupil_avg'];
			$student['teacher_id'] = getFieldWithId($student['class_id'], "class", "teacher_id");
			$count_subjects = mysqli_fetch_assoc(mysqli_query($DB, "SELECT COUNT(*) FROM `termly_record` WHERE student_id = '".$student['id']."' and class_id='".$student['class_id']."' and session_id='$session' and term_id='$term' and status='1'")) or die (mysqli_error($DB));
					
			$student['no_of_subjects_offered'] = $count_subjects['COUNT(*)'];
			$student['grand_total'] = $class['grand_total'];
			$student['annual_pupil_avg'] = $class['annual_pupil_avg'];
			$student['annual_position'] = $class['annual_position'];
			$student['has_paid'] = $class['fee_payment_time'] != 0? true:false;
		} else{
			$student['class_id'] = "";
		}
		return  $student;
	}
	else{
		return false;
	}
}

//Gets all the info about the class
function getTimetableInfo($id){
	global $DB;
	$check_query = mysqli_query($DB,"SELECT * FROM `timetable` WHERE school = ".$_SESSION['school']." and id = '$id' and status = '1'") or die (mysqli_error($DB));
	if(mysqli_num_rows($check_query) == 1){



			$timetable = mysqli_fetch_assoc($check_query);


		return $timetable;
	}
	else{
		return false;
	}
}

//Gets all the data from a specified table
function getAllData($table, $order='ASC'){
	global $DB;
	$query = mysqli_query($DB,"SELECT * FROM `$table` WHERE status='1' ORDER BY `id` $order") or die (mysqli_error($DB));
	if(mysqli_num_rows($query) > 0){
			return $query;	//data exists in table
	}
	else
	{
		return false;
	}
}


//Gets all the data from a specified table with specific school id
function getAllDataWithId($table, $order='ASC'){
	global $DB;
	$query = mysqli_query($DB,"SELECT * FROM `$table` WHERE school =".$_SESSION['school']." AND status='1' ORDER BY `id` $order") or die (mysqli_error($DB));
	if(mysqli_num_rows($query) > 0){
			return $query;	//data exists in table
	}
	else
	{
		return false;
	}
}



//Creates a select button with DB values
function createSelect($table, $name, $disabled=false, $defaultIndex=1, $defaultEmpty=false, $required = true){
	echo '<select class="input-block-level form-control" name="' . $name . '" id="' . $name. '"';
	echo $required? 'required="required" ':' ';
	echo $disabled? 'disabled="disabled" ':' ';
	echo '>';
	if($defaultEmpty == true){echo "<option value=''></option>";}	
	$data = getAllData($table);
	if(!($data == false)){
		$info = mysqli_fetch_assoc($data);
		$i = 1;
		do{
    	echo "<option value='" . $info['id'] . "' ";
		echo ($info['id'] == $defaultIndex)? "selected='selected'":" ";
		echo ">" . $info[$table] . "</option>";
		$i++;
		}while($info = mysqli_fetch_assoc($data));
	} 
	echo "</select>";
}



//Creates a select button with DB values with school id
function createSelectWithId($table, $name, $disabled=false, $defaultIndex=1, $defaultEmpty=false, $required = true){
	echo '<select class="input-block-level form-control" name="' . $name . '" id="' . $name. '"';
	echo $required? 'required="required" ':' ';
	echo $disabled? 'disabled="disabled" ':' ';
	echo '>';
	if($defaultEmpty == true){echo "<option value=''></option>";}	
	$data = getAllDataWithId($table);
	if(!($data == false)){
		$info = mysqli_fetch_assoc($data);
		$i = 1;
		do{
    	echo "<option value='" . $info['id'] . "' ";
		echo ($info['id'] == $defaultIndex)? "selected='selected'":" ";
		echo ">" . $info[$table] . "</option>";
		$i++;
		}while($info = mysqli_fetch_assoc($data));
	} 
	echo "</select>";
}







function getCustomerInfo($invoice_no){
	global $DB;
	if(isCustomer($invoice_no)){
		$query = mysqli_query($DB,"SELECT * FROM `customers` WHERE invoice_no = '$invoice_no' and invoice_no != '0' and invoice_no != ''") or die(mysqli_error($DB));
		return  mysqli_fetch_assoc($query);
	}
	else{
		return false;
	}
}

function sendSMS($recipient, $message, $sender="CALEB"){
	$owneremail = "vogunshola@yahoo.com";
	$subacct = SMS_USERNAME;
	$subacctpwd = SMS_PASSWORD;
	
	$url = "http://www.smslive247.com/http/index.aspx?"
	. "cmd=sendquickmsg"
	. "&owneremail=" . UrlEncode($owneremail)
	. "&subacct=" . UrlEncode($subacct)
	. "&subacctpwd=" . UrlEncode($subacctpwd)
	. "&sendto=" . UrlEncode(trim($recipient))
	. "&message=" . UrlEncode($message)
	. "&sender=" . UrlEncode($sender);	

	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	$contents = curl_exec($ch);
	if (curl_errno($ch)) {
	  echo curl_error($ch);
	  echo "\n<br />";
	  $contents = '';
	} else {
	  curl_close($ch);
	}
	if (!is_string($contents) || !strlen($contents)) {
echo "Failed to get contents.";
$contents = '';
}

return $contents;

/*
	if ($f = @fopen($url, "r"))
	{
		return true;
	} else{
		return false;
	}
	*/
}

function smsLogin(){
	$owneremail = "vogunshola@yahoo.com";
	$subacct = SMS_USERNAME;
	$subacctpwd = SMS_PASSWORD;
	$url = "http://www.smslive247.com/http/index.aspx?"
	. "cmd=login"
	. "&owneremail=" . UrlEncode($owneremail)
	. "&subacct=" . UrlEncode($subacct)
	. "&subacctpwd=" . UrlEncode($subacctpwd);

	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	$contents = curl_exec($ch);
	if (curl_errno($ch)) {
	  echo curl_error($ch);
	  echo "\n<br />";
	  $contents = '';
	} else {
	  curl_close($ch);
	}
	if (!is_string($contents) || !strlen($contents)) {
		echo "Failed to get contents.";
		$contents = '';
	}
	@list($response, $code) = preg_split("/:/", $contents);
	return $code;

}
function checkSMSBalance(){
	$owneremail = "vogunshola@yahoo.com";
	$subacct = SMS_USERNAME;
	$subacctpwd = SMS_PASSWORD;
	$session_id = smsLogin();
	
	$url = "http://www.smslive247.com/http/index.aspx?"
	. "cmd=querybalance"
	. "&sessionid=" . UrlEncode($session_id);
	
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	$contents = curl_exec($ch);
	if (curl_errno($ch)) {
	  echo curl_error($ch);
	  echo "\n<br />";
	  $contents = '';
	} else {
	  curl_close($ch);
	}
	if (!is_string($contents) || !strlen($contents)) {
		echo "Failed to get contents.";
		$contents = '';
	}
	@list($response, $code) = preg_split("/:/", $contents);
	return $code;

}

//Send an Email Out
function sendMail($to, $subject, $message){
	
	/* To send HTML mail, you can set the Content-type header. */
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	
	/* additional headers */
	//$headers .= "To: $to \r\n";
	$headers .= "From: ".SCHOOL_NAME." <".SCHOOL_EMAIL.">\r\n";
//	$headers .= "";
	
	/* and now mail it */
	
	$message = "
	<div style='background:#FFFFFF; border:#EA6402 10px solid; max-width:510px; margin-left:auto; margin-right:auto; padding:10px;'>
	<img src='".ROOT_FOLDER."/pages/img/logo.png' width='100%'><br><hr>
	". $message . "
  <p>Thank you.<br>
  <hr>
	<h4 style='text-align:center'>
    ".SCHOOL_NAME.",<br>
    ".SCHOOL_ADDRESS."<br>
	Email: ".SCHOOL_EMAIL."<br>
	Enquiry Line: ".SCHOOL_PHONE." <br>
	<img src='".ROOT_FOLDER."/pages/img/logo.png' width='100px' ></h4>
</div>";		
	return mail($to, $subject, $message, $headers);
}

//Search for a customer
function search($search, $criterion, $class=""){
	global $DB;
	$locationString = $class == ""? "": "and class_id = '$class'";
	if($criterion == "admission_no"){
		$query = mysqli_query($DB,"SELECT * FROM `student` WHERE admission_no LIKE '%$search%' $locationString and school =".$_SESSION['school']." AND status='1'") or die (mysqli_error($DB));
		if(mysqli_num_rows($query) > 0){
		return $query;
		}
		else{
			return false;
		}
		?><!--<script>window.open('customer.php?invoice_no=" . $search . "', '_self')</script>--><?php
	}
	else if($criterion == "name"){
		$query = mysqli_query($DB,"SELECT * FROM `student` WHERE (firstname LIKE '%$search%' or surname LIKE '%$search%' or admission_no LIKE '%$search%') $locationString and school =".$_SESSION['school']." AND status='1'") or die (mysqli_error($DB));
		if(mysqli_num_rows($query) > 0){
		return $query;
		}
		else{
			return false;
		}
	}
	else{
		return false;
	}
}
//Gets the Customer Initials given the type ID
function getInitials($id){
	global $DB;	
	$query = mysqli_query($DB,"SELECT initials FROM `initials` WHERE id = '$id' and `status`='1'") or die(mysqli_error($DB));
	$initials = mysqli_fetch_assoc($query);
	return $initials['initials'];
}

function getItemInfo($id, $table, $school=SCHOOL_ID){
	global $DB;
		$query = mysqli_query($DB,"SELECT * FROM `$table` WHERE id = '$id' and status='1'") or die(mysqli_error($DB));
	if(mysqli_num_rows($query)){
		return  mysqli_fetch_assoc($query);
	}
	else{
		return false;
	}
}

//Gets the Role name name given the ID
function getRoleName($id){
	global $DB;	
	$query = mysqli_query($DB,"SELECT role_title FROM `roles` WHERE id = '$id'") or die(mysqli_error($DB));
	$account_types = mysqli_fetch_assoc($query);
	return $account_types['role_title'];
}

//Gets the Store name name given the ID
function getStoreItemName($id){
	global $DB;	
	$query = mysqli_query($DB,"SELECT store_item FROM `store_item` WHERE school = ".$_SESSION['school']." and id = '$id'") or die(mysqli_error($DB));
	$item = mysqli_fetch_assoc($query);
	return $item['store_item'];
}

//Gets the class name given the ID
function getClassName($id){
	global $DB;
	$query = mysqli_query($DB,"SELECT class FROM `class` WHERE school = ".$_SESSION['school']." AND  id = '$id' and `status`='1'") or die(mysqli_error($DB));
	if(mysqli_num_rows($query) == 1){
		$banks = mysqli_fetch_assoc($query);
		return $banks['class'];
	} else{
		return "No class assigned or assigned class is disabled";
	}
}

//Gets the Teacher name name given the ID
function getTeacherName($id){
	global $DB;	
	$query = mysqli_query($DB,"SELECT teacher FROM `teacher` WHERE school = ".$_SESSION['school']." AND id = '$id' and `status`='1'") or die(mysqli_error($DB));
	$account_types = mysqli_fetch_assoc($query);
	return $account_types['teacher'];
}

//Gets the Subject name name given the ID
function getSubjectName($id){
	global $DB;	
	$query = mysqli_query($DB,"SELECT subject FROM `subject` WHERE school = ".$_SESSION['school']." AND id = '$id' and `status`='1'") or die(mysqli_error($DB));
	$account_types = mysqli_fetch_assoc($query);
	return $account_types['subject'];
}


//Gets the Skill name name given the ID
function getSkillName($id){
	global $DB;	
	$query = mysqli_query($DB,"SELECT name FROM `psychomotor_skills` WHERE school = ".$_SESSION['school']." AND id = '$id' and `status`='1'") or die(mysqli_error($DB));
	$account_types = mysqli_fetch_assoc($query);
	return $account_types['name'];
}


//Gets the Commentator name  given the ID
function getCommentatorName($id){
	global $DB;	
	$query = mysqli_query($DB,"SELECT name FROM `dossier_commentator` WHERE school = ".$_SESSION['school']." AND id = '$id' and `status`='1'") or die(mysqli_error($DB));
	$account_types = mysqli_fetch_assoc($query);
	return $account_types['name'];
}

//Gets the Annual Commentator name  given the ID
function getAnnualCommentatorName($id){
	global $DB;	
	$query = mysqli_query($DB,"SELECT name FROM `annual_commentator` WHERE school = ".$_SESSION['school']." AND id = '$id' and `status`='1'") or die(mysqli_error($DB));
	$account_types = mysqli_fetch_assoc($query);
	return $account_types['name'];
}


//FOrmat refill date
function formatRefillMonth($time, $format="encode"){
	if($format=="encode"){
		$date = getdate($time);
		return $refill_month = $date['mon'] . "-" . $date['year'];
	} else if($format == "decode"){
		$time = explode("-", $time);
		return $date = mktime(0, 0, 0, $time[0], 1, $time[1]);
	}
	
}

//calculate the grade
function calculateGrade($total){
	if ($total < 40) {
		return "F";
	} elseif ($total >= 40 && $total < 55) {
		return "P";
	} elseif ($total >= 55 && $total < 70) {
		return "C";
	} elseif ($total >= 70 && $total < 80) {
		return "B";
	} elseif ($total >= 80 ) {
		return "A";
	} 
}

//Place remark
function calculateRemark($total){
	if ($total < 40) {
		return "Fail";
	} elseif ($total >= 40 && $total < 55) {
		return "Pass";
	} elseif ($total >= 55 && $total < 70) {
		return "Good";
	} elseif ($total >= 70 && $total < 80) {
		return "Excellent";
	} elseif ($total >= 80 ) {
		return "Super Excellent";
	} 
}

//Assign positions to a subject
function calculatePositions($subject_id, $class_id, $term, $session){
	global $DB;
	$check_position = mysqli_query($DB, "SELECT * FROM `termly_record` WHERE subject_id = '$subject_id' and class_id='$class_id' and session_id='$session' and term_id='$term' and status='1' ORDER BY total DESC") or die (mysqli_error($DB));
	$positions = mysqli_fetch_assoc($check_position);
				$p = 0;
				$previousTotal = "";
				$skip = 1;
				do{
					if($previousTotal == $positions['total']){
						$skip += 1;
					}else{
						$p +=$skip;
						$skip=1;
					}
					$update_postion = mysqli_query($DB, "UPDATE termly_record SET `position` = ".$p." WHERE `id`='".$positions['id']."'") or die(mysqli_error($DB));
					
					
					$previousTotal = $positions['total'];
				}while($positions = mysqli_fetch_assoc($check_position));
unset($positions,$check_position);
//Positions for annual report				
		$check_position = mysqli_query($DB, "SELECT * FROM `annual_record` WHERE subject_id = '$subject_id' and class_id='$class_id' and session_id='$session' and status='1' ORDER BY avg DESC") or die (mysqli_error($DB));
	$positions = mysqli_fetch_assoc($check_position);
				$p = 0;
				$previousTotal = "";
				$skip = 1;
				do{
					if($previousTotal == $positions['avg']){	//Confirming if the previous person has the same position
						$skip += 1;
					}else{
						$p +=$skip;
						$skip=1;
					}
					$update_postion = mysqli_query($DB, "UPDATE annual_record SET `position` = ".$p." WHERE `id`='".$positions['id']."'") or die(mysqli_error($DB));
					
					
					$previousTotal = $positions['avg'];
				}while($positions = mysqli_fetch_assoc($check_position));				
}


function finalizeResult($class_id, $term, $session){
	global $DB;
	$check_report = mysqli_query($DB, "SELECT * FROM `termly_record` WHERE class_id='$class_id' and session_id='$session' and term_id='$term' and status='1'") or die (mysqli_error($DB));
	$report = mysqli_fetch_assoc($check_report);
				do{
					$student = getStudentInfo($report['student_id'], $term, $session);
				    $grand_total = mysqli_fetch_assoc(mysqli_query($DB, "SELECT SUM(total) FROM `termly_record` WHERE student_id = '".$report['student_id']."' and class_id='".$report['class_id']."' and session_id='$session' and term_id='$term' and status='1'")) or die (mysqli_error($DB));
					
					$pupil_avg = $student['no_of_subjects_offered'] >0? $grand_total['SUM(total)']/$student['no_of_subjects_offered']:0;
		
					  
					$update_class = mysqli_query($DB, "UPDATE class_bindings SET `grand_total` = '{$grand_total['SUM(total)']}', `pupil_avg`='$pupil_avg' WHERE `student_id`='".$report['student_id']."' and class_id='".$report['class_id']."' and session_id='$session' and term_id='$term' and status='1'") or die(mysqli_error($DB));
					
				}while($report = mysqli_fetch_assoc($check_report));
			
			
				
	$check_position = mysqli_query($DB, "SELECT * FROM `class_bindings` WHERE class_id='$class_id' and session_id='$session' and term_id='$term' and status='1' ORDER BY pupil_avg DESC") or die (mysqli_error($DB));
	$positions = mysqli_fetch_assoc($check_position);
				$p = 0;
				$previousAvg = "";
				$skip = 1;				
				do{
					if($previousAvg == $positions['pupil_avg']){
						$skip += 1;
					}else{
						$p +=$skip;
						$skip=1;
					}
					
					$update_postion = mysqli_query($DB, "UPDATE class_bindings SET `position` = ".$p." WHERE `id`='".$positions['id']."' and status='1'") or die(mysqli_error($DB));
					
					$previousAvg = $positions['pupil_avg'];
				}while($positions = mysqli_fetch_assoc($check_position));
unset($check_report, $report);

//finalize annual report
	$check_report = mysqli_query($DB, "SELECT * FROM `annual_record` WHERE class_id='$class_id' and session_id='$session' and status='1'") or die (mysqli_error($DB));
	$report = mysqli_fetch_assoc($check_report);
				do{
					$student = getStudentInfo($report['student_id'], $term, $session);
				    $grand_total = mysqli_fetch_assoc(mysqli_query($DB, "SELECT SUM(avg), COUNT(*) FROM `annual_record` WHERE student_id = '".$report['student_id']."' and class_id='".$report['class_id']."' and session_id='$session' and status='1'")) or die (mysqli_error($DB));
					$annual_pupil_avg = $grand_total['COUNT(*)'] > 0? $grand_total['SUM(avg)']/$grand_total['COUNT(*)']:0;
		
					  
					$update_class = mysqli_query($DB, "UPDATE class_bindings SET `annual_pupil_avg`='$annual_pupil_avg' WHERE `student_id`='".$report['student_id']."' and class_id='".$report['class_id']."' and session_id='$session' and status='1'") or die(mysqli_error($DB));
					
				}while($report = mysqli_fetch_assoc($check_report));
			
			
				
	$check_position = mysqli_query($DB, "SELECT * FROM `class_bindings` WHERE class_id='$class_id' and session_id='$session' and term_id = '$term' and status='1' ORDER BY annual_pupil_avg DESC") or die (mysqli_error($DB));
	$positions = mysqli_fetch_assoc($check_position);
				$p = 0;
				$previousAvg = "";
				$skip = 1;				
				do{
					if($previousAvg == $positions['annual_pupil_avg']){
						$skip += 1;
					}else{
						$p +=$skip;
						$skip=1;
					}
					
					$update_postion = mysqli_query($DB, "UPDATE class_bindings SET `annual_position` = ".$p." WHERE class_id='$class_id' and student_id='".$positions['student_id']."' and session_id='$session' and status='1'") or die(mysqli_error($DB));
					
					$previousAvg = $positions['annual_pupil_avg'];
				}while($positions = mysqli_fetch_assoc($check_position));


				
}
?>