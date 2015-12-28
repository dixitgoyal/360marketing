<?php
	
	include 'connect.php';
	
	$name=$_POST['domain_name'];
	
	$name1=$name.".360marketing.in";
	
	$sql= "select * from registered_domains where domain_names='$name1'";
	
	$result=$conn->query($sql);
	
	
	
	if($result)
	{
		if($result->num_rows >0)
		{
			echo "false";
		}
		else
		{
			echo $name;
		}
	}
	else
	{
		echo $name;
	}
?>