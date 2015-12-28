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
$sql="insert into products(name,category,mrp,discount,dimension,description,availability,ship_charge,user_id,status) values('$name','$cat','$mrp','$dis','$dim','$des','$available','$ship','$id','private')";
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