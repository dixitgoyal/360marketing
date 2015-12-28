<?php
	session_start();
	
	if(!isset($_SESSION['id']))
	{
		echo header("location:../index.php");
	}
	else
	{
		if($_SESSION['id']=='login')
		{
			if($_GET['id'])
			{
				include '../connect.php';
				$domain_name=$_GET['id'].".360marketing.in";
				$sql="select * from user where domain_name='$domain_name'";
				$result=$conn->query($sql);
				$record=$result->fetch_assoc();
				$id=$record['id'];
				
				$sql="select * from registered_domains where domain_names='$domain_name'";
				$result=$conn->query($sql);
				$record=$result->fetch_assoc();
				$template_id=$record['template_id'];
				
			?>
			
			<html>
				<head>
					<title>Dashboard</title>
					<meta name="viewport" content="width=device-width, initial-scale=1.0" />
					<link rel="stylesheet" href="../css/bootstrap_cdn.css" type="text/css" />
					<script src="../js/jquery_cdn.js" type="text/javascript"></script>
					<script src="../js/bootstrap_cdn.js" type="text/javascript"></script>
					<script src="../js/angular_cdn.js" type="text/javascript"></script>
					<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
					<style>
						#ajax_loader img
						{
						display: block;
						margin-left: auto;
						margin-right: auto;
						margin-top: 190px;
						}
					</style>
				</head>
				<body>
					
					<!-- Ajax Loader -->
					<div class="container-fluid" id="ajax_loader" style="display:none;height:100%;position:fixed; width:100%; left:0px; top:0px; z-index:1102; background:rgba(0,0,0,0.3);"><img src="../images/Loading.gif" width="200" height="200"></div>
					<!-- Ajax Loader -->
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-3" style="height:100%; background:rgba(0,0,255,0.3);">
								<br>
								<h2>Dashboard</h2>
                                <form action="update_template.php" method="post" enctype="multipart/form-data">
									<input type="hidden" value="<?php echo $id; ?>" name="user_id" required />
									<input type="hidden" value="<?php echo $_GET['id']; ?>" name="domain_name" required />
									<?php 
										
										
										
										$sql="select * from template_details where template_id='$template_id'";
										
										$result=$conn->query($sql);
										
										$record=$result->fetch_assoc();
										
										$logo_image=$record['logo_image'];
										$logo_text=$record['logo_text'];
										$slider=$record['slider'];
										$about_us=$record['about_us'];
										
										if($logo_image=='1')
										{
											echo '<b>Logo Image :<b><br/> <input type="file" name="logo_image" required />';
										}
										
										if($logo_text=='1')
										{
											echo '<b>Logo Name :</b> <br/><input type="text" name="logo_text" required /><br>';
										}
										
										if($slider=='1')
										{
											$sql="select * from slider where user_id='$id'";
											$result=$conn->query($sql);
											$record=$result->fetch_assoc();
											
											$count=$record['count'];
											echo '<input type="hidden" name="slide_count" value="'.$count.'" required />';
											echo '<b>Slider Images: </b><br><br>';
											
											for($i=1;$i<=$count;$i++)
											{
												echo 'Slide '.$i.' : <input type="file" name="slide'.$i.'" /><br/>';
											}
											
										}
										
										if($about_us=='1')
										{
											echo '<b>AboutUs Content :</b><br> <textarea cols="20" name="about_content" placeholder="Start Typig Here ...."></textarea><br>';
										}
										
									?><br>
									<input type="Submit" value="Submit" name="submit" />
								</form>
							</div>
							<div class="col-md-9">
								<iframe src="../subdomains/<?php echo $_GET['id'];?>" id="template_view" style="width:100%; height:100%;">
									<p>Your browser does not support iframes.</p>
								</iframe>
							</div>
						</div>
					</div>
					<script>
						
					</script>
					
				</body>
			</html>
			<?php 
			}
			else
			{
				echo '<script>window.open("../index.php","_self");</script>';
			}
		}
		else
		{
			echo '<script>window.open("../index.php","_self");</script>';
			
		}
	}
?>	