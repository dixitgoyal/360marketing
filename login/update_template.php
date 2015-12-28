<?php
	
	include '../connect.php';

	if(isset($_POST['submit']))
	{

        $domain=$_POST['domain_name'];
		$user_id=$_POST['user_id'];
		
		if(isset($_POST['logo_text']))
		{
			$logo_name= $_POST['logo_text'];
			$sql="select * from logo_name where user_id='$user_id'";
			$result=$conn->query($sql);
			if($result->num_rows)
			{
				$sql="update logo_name set name='$logo_name' where user_id='$user_id'";
				$conn->query($sql);
			}
			else
			{
				$sql="insert into logo_name(name,user_id) values('$logo_name','$user_id')";
				$conn->query($sql);
			}
		}
		
		
		if(isset($_POST['logo_image']))
		{
			$target_dir = "../subdomains/".$domain."/images/";
			$target_file = $target_dir . "logo.jpg";
			if (move_uploaded_file($_FILES["logo_image"]["tmp_name"], $target_file)) 
			{
				echo "The file ". basename( $_FILES["logo_image"]["name"]). " has been uploaded.";
			} 
			else 
			{
				echo "Sorry, there was an error uploading your file.";
			}
		}
		
		if(isset($_POST['slide_count']))
		{
			$count=$_POST['slide_count'];
			for($i=1;$i<=$count;$i++)
			{
				$check = getimagesize($_FILES["slide".$i]["tmp_name"]);
			    if($check!='false')
				{
					$target_dir = "../subdomains/".$domain."/images/";
					$target_file = $target_dir . "slider".$i.".jpg";
					if (move_uploaded_file($_FILES["slide".$i]["tmp_name"], $target_file)) 
					{
						echo "The file ". basename( $_FILES["slide".$i]["name"]). " has been uploaded.";
					} 
					else 
					{
						echo "Sorry, there was an error uploading your file.";
					}
				}
			}
		}
		
		if(isset($_POST['about_content']))
		{
			$content= $_POST['about_content'];
			$sql="select * from about_us where user_id='$user_id'";
			$result=$conn->query($sql);
			if($result->num_rows)
			{
				$sql="update about_us set data='$content' where user_id='$user_id'";
				
				$conn->query($sql);
			}
			else
			{
				$sql="insert into about_us(data,user_id) values('$content','$user_id')";
				
				$conn->query($sql);
			}
		}
	}
?>

<script>window.open('dashboard.php?id=<?php echo $domain; ?>','_self');</script>