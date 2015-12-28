<?php

include '../connect.php';

$mr_id=$_POST['mr_id'];
$sl_id=$_POST['sl_id'];
$pr_id=$_POST['pr_id'];

$sql="select * from mer_seller where merchant_id='$mr_id' and seller_id='$sl_id' and product_id='$pr_id'";

$result=$conn->query($sql);

if($result->num_rows)
{
echo 'already';	
}
else
{

$sql="insert into mer_seller(merchant_id,seller_id,product_id,status) values('$mr_id','$sl_id','$pr_id','requested')";

if($conn->query($sql))
{
	echo 'true';
}
else
{
	echo 'false';
}
}

?>