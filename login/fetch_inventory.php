<?php

include '../connect.php';

$id=$_POST['id'];


$sql="select * from products where user_id <> '$id'";

$result=$conn->query($sql);

$data = array();

if($result->num_rows)
{
	while($record=$result->fetch_assoc())
	{
$r=$record['user_id'];
$sql1="select * from user where id = '$r'";

$result1=$conn->query($sql1);

$record1=$result1->fetch_assoc();

array_push($data,$record['user_id'], $record['name'],$record['pr_id'], $record1['name']);	
	}
}
//$data = array('dixit');
echo json_encode($data);
?>