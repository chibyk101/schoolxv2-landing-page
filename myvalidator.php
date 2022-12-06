<?php
// include_once("auth.php");

// // for deleting class

// $user_pass = md5($_POST['user_password']);
// $teacher_pass = $_POST['teacher_pass'];
// if($user_pass == $teacher_pass ){

//     $time = time();
//     $id =  $_POST['class_id'];
//      $updateQuery = mysqli_query($DB, "UPDATE class SET status='0' WHERE id = '$id' ") or die(mysqli_error($DB));
//     if($updateQuery)
//     {
//       echo 'Class Successfully Deleted';
//     }
// }else{
//     echo 'Incorect password';
// }

if(isset($_GET['email'])) {
    $email = $_GET['email'];

    // if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     http_response_code(200);
    //     echo 'The email '.$email.' is valid';
    // } else {
    //     http_response_code(412);
    //     echo 'The email '.$email.' is not valid';
    // }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "Invalid email format";
    }
}


?>
