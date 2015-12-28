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
			?>
			
			<html>
				<head>
					<title>360 Marketing</title>
					<meta name="viewport" content="width=device-width, initial-scale=1.0" />
					<link rel="stylesheet" href="../css/bootstrap_cdn.css" type="text/css" />
					<link rel="stylesheet" href="../css/login_style.css" type="text/css" />
					<script src="../js/jquery_cdn.js" type="text/javascript"></script>
					<script src="../js/bootstrap_cdn.js" type="text/javascript"></script>
					<script src="../js/angular_cdn.js" type="text/javascript"></script>
					<script src="../js/multiupload.js" type="text/javascript"></script>
					<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
					<script src="http://malsup.github.com/jquery.form.js"></script>
					
					<script type="text/javascript">
						var config = {
							support : "image/jpg,image/png,image/bmp,image/jpeg,image/gif",		// Valid file formats
							form: "demoFiler",					// Form ID
							dragArea: "dragAndDropFiles",		// Upload Area ID
							uploadUrl: "upload1.php"				// Server side upload url
						}
						$(document).ready(function(){
							initMultiUploader(config);
						});
					</script>
					
					<style>
						#progress 
						{ 
						position:relative; 
						width:100%; 
						border: 1px solid #ddd; 
						padding: 1px; 
						border-radius: 3px; 
						}
						#bar 
						{ 
						background-color: #B4F5B4; 
						width:0%; 
						height:20px; 
						border-radius: 3px;
						}
						#percent 
						{ 
						position:absolute; 
						display:inline-block; 
						top:3px; 
						left:48%; 
						}
						td
						{
						padding:10px;
						}
						table
						{
						border-collapse:collapse;	
						width:100%;
						}
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
					
					<div class="container">
						<center><h1>Notifications</h1></center>
						<table border="2">
							
							<?php
								
								
								$sql="select * from mer_seller where merchant_id='$id' and status='requested'";
								
								$result=$conn->query($sql);
								
								if($result->num_rows)
								{
									while($record=$result->fetch_assoc())
									{
										$r=$record['seller_id'];
										$sql1="select * from user where id='$r'";
										$result1=$conn->query($sql1);
										
										$record1=$result1->fetch_assoc();
										$r=$record['product_id'];
										$sql1="select * from products where pr_id='$r'";
										$result1=$conn->query($sql1);
										
										$record2=$result1->fetch_assoc();
										
										
										
										echo "<tr><td rowspan='2'><b>Merchant Name : </b>".$record1['name']." <br>requested for <br><b>Product name : </b>".$record2['name']."</td><td><button type='button' class='btn btn-primary' onclick='update_request(".$id.",".$record['seller_id'].",".$record['product_id'].",1);'>Accept</button></td></tr><tr><td><button type='button' class='btn btn-primary' onclick='update_request(".$id.",".$record['seller_id'].",".$record['product_id'].",0);' >Decline</button></td></tr>";
									}
									
								}
								
								
								
								$sql="select * from mer_seller where seller_id='$id' and status='Accepted'";
								
								$result=$conn->query($sql);
								
								if($result->num_rows)
								{
									while($record=$result->fetch_assoc())
									{
										
										$r=$record['product_id'];
										$sql1="select * from products where pr_id='$r'";
										$result1=$conn->query($sql1);
										
										$record2=$result1->fetch_assoc();
										
										
										
										echo "<tr><td><b>Congratulations, Your requested for <br>Product name : </b>".$record2['name']."<br/>has been accepted by the owner and successfully added to your inventory</td></tr>";
									}
									
								}
								
								$sql="select * from mer_seller where seller_id='$id' and status='Rejected'";
								
								$result=$conn->query($sql);
								
								if($result->num_rows)
								{
									while($record=$result->fetch_assoc())
									{
										
										$r=$record['product_id'];
										$sql1="select * from products where pr_id='$r'";
										$result1=$conn->query($sql1);
										
										$record2=$result1->fetch_assoc();
										
										
										
										echo "<tr><td>Sorry, Your requested for <br><b>Product name : </b>".$record2['name']."has been rejected by the owner </td></tr>";
									}
									
								}
								
								
								
							?>
						</table>
					</div>
					
					<div class="container" style="margin-top:30px;">
						
						<div class="row">
							<div class="col-md-3">
								
								<?php
									
									$filename = '../subdomains/'.$_GET['id'];
									
									if (file_exists($filename)) {
										
									?>
									<a href="../subdomains/<?php echo $_GET['id']; ?>" target="_blank"><button type="button" class="btn btn-primary btn-block">VIEW YOUR SITE</button></a>
									<br/>
									<a href="dashboard.php?id=<?php echo $_GET['id']; ?>" target="_top"><button type="button" class="btn btn-primary btn-block">Dashboard</button></a>
									<br>
									
									<?php
									}
									else
									{
									?>
									<a href="../signup/index.php?tid=<?php echo md5(md5(md5('dhrsynsgtrsntynrnrs'))); ?>&id=<?php echo $id;?>&domain=<?php echo $_GET['id'];?>&pid=<?php echo md5(md5(md5('23564vdgvynsgtrsntynrnrs'))); ?>" target="_top"><button type="button" class="btn btn-primary btn-block">Select you template</button></a>
									<?php
									}
								?>
								<button onclick="user_logout();" type="button" class="btn btn-primary btn-block">LOGOUT</button>
								
								<button type="button" data-toggle="modal" data-target="#add_product_modal" class="btn btn-primary btn-block">ADD INVENTORY</button>
								<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#shared_inventory_modal">SHARED INVENTORY</button>
								<button type="button" class="btn btn-primary btn-block" onclick="download_inventory();">DOWNLOAD INVENTORY</button>
								<button type="button" class="btn btn-primary btn-block">BROWSE INVENTORY</button>
							</div>
							<div class="col-md-6">
								<h2>Products</h2>
								<table border='1'>
									
									<tr>
										<td><b>Product Name</b></td>
										<td><b>Public</b></td>
										<td><b>Edit Product</b></td>
										<td><b>Delete Product</b></td>
										<td><b>Upload Pictures</b></td>
										<td><b>Status</b></td>
									</tr>
									<?php
										
										$sql1="select * from products where user_id='$id'";
										
										$result1=$conn->query($sql1);
										
										if($result1)
										{
											while($record1=$result1->fetch_assoc())
											{
												
												echo "<tr><td width='20%'>".$record1['name']."</td><td width='10%'><input type='checkbox' id='public".$record1['pr_id']."' onclick='make_public(".$record1['pr_id'].");'/></td><td width='20%'><a href='#' onclick='edit_product(".$record1['pr_id'].")'>Edit</a></td><td width='20%'><a href='#' onclick='delete_product(".$record1['pr_id'].")'>Delete</a></td><td width='25%'><a href='#' onclick='upload_image(".$record1['pr_id'].");' '>Upload Images</a></td><td width='10%'>".$record1['status']."</td></tr>";
											}	
										}
									?>
								</table>
							</div>
							<div class="col-md-3">
								<h2>Bulk Upload</h2>
								<a href="sample_inventorySheet.csv"> Download Sample </a><br/><br/>
								<form id="myForm" action="upload.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="user_id" value="<?php  echo $id; ?>"/>
									<input type="file" name="myfile" required><br>
									<div id="progress">
										<div id="bar"></div>
										<div id="percent">0%</div >
									</div>
									<br>
									<input type="submit" value="SUBMIT">
								</form>
								<br/>
								<div id="message"></div>
							</div>
						</div>
					</div>
					
					
					
					<div id="upload_modal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Upload Product Images</h4>
								</div>
								<div class="modal-body">
									<div id="dragAndDropFiles" class="uploadArea"><h1>Drop Images Here</h1></div><form name="demoFiler" id="demoFiler" enctype="multipart/form-data"><input type="file" name="multiUpload" id="multiUpload" multiple required /> <input type="submit" name="submitHandler" id="submitHandler" value="Upload" class="buttonUpload" />
										<input type="hidden" id="user_domain" value="<?php echo $_GET['id'];?>"/>
									</form><div class="progressBar"><div class="status"></div></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					
					
					
					
					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Edit Product</h4>
								</div>
								<div class="modal-body">
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					
					
					<div id="download_inventory_modal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Download Inventory</h4>
								</div>
								<div class="modal-body">
									<table ></table>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					
					<div id="shared_inventory_modal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Shared Inventory</h4>
								</div>
								<div class="modal-body">
									<table>
										<tr>
											<td>Merchant Name</td>
											<td>Product Name</td>
											<td>Seller Name</td>
										</tr>
										<?php
											$sql="select * from mer_seller where merchant_id='$id' and status='Accepted'";
											$result=$conn->query($sql);
											if($result->num_rows)
											{
												while($record=$result->fetch_assoc())
												{
											$sql1="select * from user where id='$record[seller_id]'";
											$result1=$conn->query($sql1);
											$record1=$result1->fetch_assoc();
											
											$sql2="select * from products where pr_id='$record[product_id]'";
											$result2=$conn->query($sql2);
											$record2=$result2->fetch_assoc();
											
											
													echo "<tr><td>You</td><td>".$record2['name']."</td><td>".$record1['name']."</td></tr>";
												}
											}
										
										$sql="select * from mer_seller where seller_id='$id' and status='Accepted'";
											$result=$conn->query($sql);
											if($result->num_rows)
											{
												while($record=$result->fetch_assoc())
												{
											$sql1="select * from user where id='$record[merchant_id]'";
											$result1=$conn->query($sql1);
											$record1=$result1->fetch_assoc();
											
											$sql2="select * from products where pr_id='$record[product_id]'";
											$result2=$conn->query($sql2);
											$record2=$result2->fetch_assoc();
											
											
													echo "<tr><td>".$record1['name']."</td><td>".$record2['name']."</td><td>You</td></tr>";
												}
											}
										
										?>
									</table>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					
					
					
					
					<div id="add_product_modal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Add New Product</h4>
								</div>
								<div class="modal-body">
									<form role="form" >
										<div class="form-group">
											<label for="email">Name:</label>
											<input type="text" class="form-control" id="pr_name" required />
										</div>
										<div class="form-group">
											<label for="pwd">Category:</label>
											<input type="text" class="form-control" id="pr_category" required />
										</div>
										<div class="form-group" >
											<label for="pwd">M.R.P:</label>
											<input type="text" class="form-control" id="pr_mrp" required />
										</div>
										<div class="form-group">
											<label for="pwd">Discount:</label>
											<input type="text" class="form-control" id="pr_discount" required />
										</div>
										<div class="form-group">
											<label for="pwd">Dimension:</label>
											<input type="text" class="form-control" id="pr_dimension" 
											required />
										</div>
										<div class="form-group">
											<label for="pwd">Description:</label>
											<input type="text" class="form-control" id="pr_description" required />
										</div>
										<div class="form-group">
											<label for="pwd">Availability:</label>
											<input type="text" class="form-control" id="pr_availability" required />
										</div>
										<div class="form-group">
											<label for="pwd">Shipping Charges:</label>
											<input type="text" class="form-control" id="pr_ship_charge"  required />
										</div>
									<button type="button" onclick="add_product();" class="btn btn-default">Add</button></form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					
					
					
					
					<script>
						
						function delete_product(i)
						{
							$('#ajax_loader').show();
							
							$.ajax({
								url: 'delete_product.php',
								type: 'POST',
								data: { id:i } ,
								success: function (response) {
									if(response=="true")
									{
										$('#ajax_loader').hide();
										window.location.reload();
									}
									else
									{
										alert("error");
									}
								},
							}); 
						}
						
						function product_update()
						{
							var name=document.getElementById('pr_name').value;
							var category=document.getElementById('pr_category').value;
							var	mrp=document.getElementById('pr_mrp').value;
							var discount=document.getElementById('pr_discount').value;
							var dimension=document.getElementById('pr_dimension').value;
							var description=document.getElementById('pr_description').value;
							var availability=document.getElementById('pr_availability').value;
							var ship_charge=document.getElementById('pr_ship_charge').value;
							var id =document.getElementById('pr_id').value;
							
							$('#ajax_loader').show();
							$.ajax({
								url: 'update_product.php',
								type: 'post',
								data: {
									'name'             : name,
									'category'         : category,
									'mrp'              : mrp,
									'discount'         : discount,
									'dimension'        : dimension,
									'description'      : description,
									'availability'     : availability,
									'ship_charge'      : ship_charge,
									'id'               : id
								} ,
								success: function (response) {
									if(response!='false')
									{
										alert('success');
										$('#ajax_loader').hide();
										$('#myModal').modal('toggle');
									}
									else
									{
										$('#ajax_loader').hide();
										$('#myModal').modal('toggle');
										alert('Error');
									}
								}
							});
						}
						
						
						
						function edit_product(i)
						{
							$('#ajax_loader').show();
							var id=i;
							$.ajax({
								url: 'fetch_product.php',
								type: 'POST',
								data: { id:i } ,
								dataType: 'json',
								success: function (response) {
									$('#ajax_loader').hide();
									$('#myModal .modal-content .modal-body').html('<form role="form" ><input type="hidden" id="pr_id" value="'+id+'"/><div class="form-group"><label for="email">Name:</label><input type="text" class="form-control" id="pr_name" value="'+response[0]+'"/></div><div class="form-group"><label for="pwd">Category:</label><input type="text" class="form-control" id="pr_category" value="'+response[1]+'"/></div><div class="form-group" ><label for="pwd">M.R.P:</label><input type="text" class="form-control" id="pr_mrp" value="'+response[2]+'"/></div><div class="form-group"><label for="pwd">Discount:</label><input type="text" class="form-control" id="pr_discount" value="'+response[3]+'"/></div><div class="form-group"><label for="pwd">Dimension:</label><input type="text" class="form-control" id="pr_dimension" value="'+response[4]+'"/></div><div class="form-group"><label for="pwd">Description:</label><input type="text" class="form-control" id="pr_description" value="'+response[5]+'"/></div><div class="form-group"><label for="pwd">Availability:</label><input type="text" class="form-control" id="pr_availability" value="'+response[6]+'"/></div><div class="form-group"><label for="pwd">Shipping Charges:</label><input type="text" class="form-control" id="pr_ship_charge"  value="'+response[7]+'"/></div><button type="button" onclick="product_update();" class="btn btn-default">Update Product Details</button></form>');
									$('#myModal').modal('toggle');
								},
							}); 
						}
						
						
						function user_logout()
						{
							var formData = 
							{
								'username': 'golu'
							};
							$('#ajax_loader').show();
							$.ajax({
								url: '../logout.php',
								type: 'post',
								data:  formData,
								dataType: 'json',
								success: function (response) {
									if(response=='true')
									{
										$('#ajax_loader').hide();
										console.log('Successfully Logout');
									}
								},
								error: function () {
									alert("error");
								}
							});
							window.open("../index.php","_self");
						}
						
						function upload_image(id)
						{
							$('#demoFiler').append('<input type="hidden" value="'+id+'" id="pr_id"/>')
							$('#upload_modal').modal('toggle');
						}
						
						
						function add_product()
						{
						    var name=document.getElementById('pr_name').value;
							var category=document.getElementById('pr_category').value;
							var	mrp=document.getElementById('pr_mrp').value;
							var discount=document.getElementById('pr_discount').value;
							var dimension=document.getElementById('pr_dimension').value;
							var description=document.getElementById('pr_description').value;
							var availability=document.getElementById('pr_availability').value;
							var ship_charge=document.getElementById('pr_ship_charge').value;
							var id='<?php echo $id; ?>';
							
							if(name=='' || category=='' || mrp=='' || discount=='' || dimension=='' || description=='' || availability=='' || ship_charge=='')
							{
								alert('Please enter all fields');
							}
							else
							{
								$('#ajax_loader').show();
								$.ajax({
									url: 'add_product.php',
									type: 'post',
									data: {
										'name'             : name,
										'category'         : category,
										'mrp'              : mrp,
										'discount'         : discount,
										'dimension'        : dimension,
										'description'      : description,
										'availability'     : availability,
										'ship_charge'      : ship_charge,
										'id'               : id
									} ,
									success: function (response) {
										if(response!='false')
										{
											alert('success');
											$('#ajax_loader').hide();
											$('#add_product_modal').modal('toggle');
											window.location.reload();
										}
										else
										{
											$('#ajax_loader').hide();
											$('#add_product_modal').modal('toggle');
											alert('Error');
										}
									}
								});
							}
						}
						
						function make_public(id)
						{
							var st='';
							if($('#public'+id).is(":checked"))
							{
								st='public';
							}
							else
							{
								st='private';
							}
							
							
							$('#ajax_loader').show();
							
							$.ajax({
								url: 'status_update.php',
								type: 'POST',
								data: { id:id, status:st } ,
								success: function (response) {
									if(response=="true")
									{
										$('#ajax_loader').hide();
										window.location.reload();
									}
									else
									{
										alert("error");
									}
								},
							});
						}
						
						function download_inventory()
						{
							var i='<?php echo $id;?>';
							$('#ajax_loader').show();
							
							$.ajax({
								url: 'fetch_inventory.php',
								type: 'POST',
								data: { id:i } ,
								dataType: 'json',
								success: function (response)
								{
									$('#download_inventory_modal .modal-content .modal-body table').html('');
									$('#download_inventory_modal .modal-content .modal-body table').append('<tr><td width="30%"><b>Merchant Name</b> </td><td width="30%"><b>Product Name</b></td><td width="40%"><b>Request Product</td></tr>');
									for(var j=0;j<response.length;j+=4)
									{
										$('#download_inventory_modal .modal-content .modal-body table').append('<tr><td width="30%" text-align="center">'+response[j+3]+'</td><td width="30%" text-align="center">'+response[j+1]+'</td><td width="40%" text-align="center"><button type="button" class="btn btn-primary" onclick="request_inventory('+response[j]+','+response[j+2]+');">Request</button></td></tr>');
									}
									
									$('#ajax_loader').hide();
									$('#download_inventory_modal').modal('toggle');
								}
							});
						}
						
						function request_inventory(mr_id,pr_id)
						{
							var i='<?php echo $id;?>';
							
							$('#ajax_loader').show();
							$.ajax({
								url: 'request_inventory.php',
								type: 'POST',
								data: { mr_id:mr_id, sl_id:i, pr_id:pr_id } ,
								success: function (response) {
									if(response=="true")
									{
										if(response=='already')
										{
											alert('Your have already requested this product');
										}
										else
										{
											alert('Your request has been successfully sent to the merchant');
										}
										
										$('#ajax_loader').hide();
										$('#download_inventory_modal').modal('toggle');
									}
									else
									{
										alert("error");
									}
								}
							});
						}
						
						function update_request(mr_id,sl_id,pr_id,status)
						{
							$('#ajax_loader').show();
							$.ajax({
								url: 'update_request.php',
								type: 'POST',
								data: { mr_id:mr_id, sl_id:sl_id, pr_id:pr_id,status:status } ,
								success: function (response) {
									
									if(response!="false")
									{
										alert('Your messege has been successfully sent to the merchant');
								        $('#ajax_loader').hide();
										location.reload();
									}
									else
									{
										alert("error");
									}
								}
							});
						}
						
						
						
						$(document).ready(function()
						{
							var options = { 
								beforeSend: function() 
								{
									$("#progress").show();
									//clear everything
									$("#bar").width('0%');
									$("#message").html("");
									$("#percent").html("0%");
								},
								uploadProgress: function(event, position, total, percentComplete) 
								{
									$("#bar").width(percentComplete+'%');
									$("#percent").html(percentComplete+'%');
								},
								success: function() 
								{
									$("#bar").width('100%');
									$("#percent").html('100%');
									
								},
								complete: function(response) 
								{
									$("#message").html("<font color='green'>"+response.responseText+"</font>");
									window.location.reload();
								},
								error: function()
								{
									$("#message").html("<font color='red'> ERROR: unable to upload files</font>");
									
								}
							}; 
							$("#myForm").ajaxForm(options);
						});
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