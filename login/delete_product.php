<?php

include '../connect.php';
session_start();

$user=$_SESSION['user_id'];

if($_POST['id'])
{
$id=$_POST['id'];

$sql="delete from products where pr_id='$id' and user_id='$user'";

if($conn->query($sql))
{
echo "true";
}
else
{
echo "false";
}
}



?>