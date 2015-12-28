<?php
session_start();

include 'connect.php';

$username=$_POST['username'];
$password=$_POST['password'];

$sql="select * from user where username='$username' and password='$password'";

$result=$conn->query($sql);

if($result->num_rows==1)
{
	
	$record=$result->fetch_assoc();
	$_SESSION['name']=$record['domain_name'];
	$_SESSION['id']="login";
	$_SESSION['user_id']=$record['id'];
	
	$do=explode('.360marketing.in',$record['domain_name']);
	
	$msg=$do[0];
}
else
{
	$msg="false";
}

echo json_encode($msg);
?>