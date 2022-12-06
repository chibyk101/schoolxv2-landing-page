<?php
function connectToDB(){

		
}
/*
$hostname = "localhost";
$database = "sg_bellanor";
$username = "root";
$password = "";
*/



$hostname = "localhost";
$database = "scho_schoolxsaas_saas";
$username = "scho_schoolxsaas_saasuser";
$password = "#KAI779*tKk2s6#p";
$DB = mysqli_connect($hostname, $username, $password, $database) or die(mysqli_error($DB));

define("PAYMENT_SECRET_KEY", "sk_test_774843bf5c87de68544c3611eb4b953460d7ca92");
define("PAYMENT_PUBLIC_KEY", "pk_test_97c2158352074a81621eab8913cfecba1af394e8");
?>