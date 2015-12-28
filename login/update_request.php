
<?php

include '../connect.php';

$mr_id=$_POST['mr_id'];
$sl_id=$_POST['sl_id'];
$pr_id=$_POST['pr_id'];
$status=$_POST['status'];

if($status=='1')
{
	$status='Accepted';
}
else
{
	$status='Rejected';
}

$sql="update mer_seller set status='$status' where merchant_id='$mr_id' and seller_id='$sl_id' and product_id='$pr_id'";

if($conn->query($sql))
{
	echo 'True';
}
else
{
	echo 'false';
}

?>
