<?php

include 'connect.php';

$name=$_POST['name'];
$email=$_POST['email'];
$contact=$_POST['contact'];
$username=$_POST['username'];
$password=$_POST['password'];
$domain=$_POST['domain'];

$sql1="select * from user where email='$email' or contact='$contact'";

$result1=$conn->query($sql1);

if(!$result1->num_rows)
{
$sql="insert into user(name,email,contact,username,password,domain_name) values('$name','$email','$contact','$username','$password','$domain')";

$sql1="insert into registered_domains(domain_names) values('$domain')";

if($conn->query($sql))
{
$id=$conn->insert_id;
$domain1=explode('.360marketing.in',$domain);
if($conn->query($sql1))
{
$msg= array($id,$domain1[0]);
echo json_encode($msg);
}
}
else
{
$msg1="false";
echo json_encode($msg1);
}
}
else
	{
$msg1="exist";
echo json_encode($msg1);
	
	}

?>