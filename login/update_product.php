<?php
include '../connect.php';
session_start();
$user=$_SESSION['user_id'];
if($_POST['id'])
{
$id=$_POST['id'];
$name=$_POST['name'];
$cat=$_POST['category'];
$mrp=$_POST['mrp'];
$dis=$_POST['discount'];
$dim=$_POST['dimension'];
$des=$_POST['description'];
$available=$_POST['availability'];
$ship=$_POST['ship_charge'];
$sql="update products set name='$name' , category='$cat' , mrp='$mrp' ,discount='$dis' , dimension='$dim' , description='$des' , availability='$available' , ship_charge='$ship' where pr_id='$id' and user_id='$user'";
if($conn->query($sql))
{
echo $name;
}
else
{
echo "false";
}
}
?>