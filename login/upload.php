<?php
	include '../connect.php';
	$output_dir = "uploads/";
	session_start();
	if(isset($_FILES["myfile"]))
	{
		if ($_FILES["myfile"]["error"] > 0)
		{
			echo "Error: " . $_FILES["file"]["error"] . "<br>";
		}
		else
		{
	        $path_parts = pathinfo($_FILES["myfile"]["name"]);
			$extension = $path_parts['extension'];
			//$id=$_POST['user_id'];
			if($extension=='csv')
			{
		
				move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir. $_FILES["myfile"]["name"]);
				$file = fopen("uploads/".$_FILES["myfile"]["name"]."","r");
				
				$f=fgetcsv($file);
				
				if(sizeof($f)==9)
				{
				$id=$_SESSION['user_id'];
				while(!feof($file))
				{
					$f=fgetcsv($file);
					if(!empty($f))
					{
					$sql="insert into products(name,category,mrp,discount,dimension,description,availability,ship_charge,user_id,status) values('$f[1]','$f[2]','$f[3]','$f[4]','$f[5]','$f[6]','$f[7]','$f[8]','$id','private')";
					$conn->query($sql);
					}
				}
				fclose($file);
				echo "Success";
				}
				else
				{
				echo "Please upload the file in proper format given in sample";
				}
			}
			else
			{
				echo "Please upload file in csv format";
			}
		}
	}
?>