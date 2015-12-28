<?php
include '../connect.php';
session_start();

$user=$_SESSION['user_id'];

if($_POST['id'])
{
$id=$_POST['id'];

$sql="select * from products where pr_id='$id' and user_id='$user'";

$result=$conn->query($sql);

$record=$result->fetch_assoc();

$r= array($record['name'],$record['category'],$record['mrp'],$record['discount'],$record['dimension'],$record['description'],$record['availability'],$record['ship_charge']);

echo json_encode($r);
}
?>