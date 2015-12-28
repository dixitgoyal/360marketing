hello


<?php 
	
	session_start();
	
	if(!isset($_SESSION['id']))
	{
		$_SESSION['id']='logout';
	}
	else
	{
		if($_SESSION['id']=='login')
		{
			if(isset($_SESSION['name']))
			{
				$do=explode('.360marketing.in',$_SESSION['name']);
				echo header("location:login/index.php?id=".$do[0]."");
			}
		}
	}
?>
<html>
	<head>
		<title>360 Marketing</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap_cdn.css" type="text/css" />
		<link rel="shortcut icon" href="images/favicon.png" />
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<script src="js/jquery_cdn.js" type="text/javascript"></script>
		<script src="js/bootstrap_cdn.js" type="text/javascript"></script>
		<script src="js/angular_cdn.js" type="text/javascript"></script>
		<script src="js/main_javascript.js" type="text/javascript"></script>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	</head>
	
	<!--By Dixit -->
	<body ng-app="360_market" ng-controller="main_ctrl" >
		
		<!-- Naviagtion Bar Start -->
		<nav class="navbar navbar-default" ng-init="upd();">
			<div class="container-fluid">
				
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">360 Marketing</a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
					<ul class="nav navbar-nav navbar-right">
						<li ng-if="status =='logout'" data-toggle="modal" data-target="#login-overlay"><a href="#">LOGIN</a></li>
						<li ng-if="status =='logout'" data-toggle="modal" data-target="#signup-overlay"><a href="#">SIGNUP</a></li>
						<li class="dropdown" ng-if="status == 'login'">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <?php if(isset($_SESSION['id'])){if(isset($_SESSION['name']))
								{
									echo $_SESSION['name'];
								}} ?> <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="#">View Profile</a></li>
									<li><a href="#">Your Orders</a></li>
									<li ng-if="status == 'login'"  ng-click="logout();"><a href="#">Logout</a></li>
								</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- Navigation Bar End -->
		
		<!-- Ajax Loader -->
		<div class="container-fluid" id="ajax_loader" style="display:none;height:100%;position:fixed; width:100%; left:0px; top:0px; z-index:1102; background:rgba(0,0,0,0.3);"><img src="images/Loading.gif" width="200" height="200"></div>
		<!-- Ajax Loader -->
		
		<div class="top_area" ng-if="status =='logout'">
			<div class="container">
				<div class="search_box">
					<form role="form">
						<div class="row">
							<div class="col-md-7">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Enter any name ..." id="search_domain_input" >
								</div>
							</div>
							<div class="col-md-3"><div id="fix_website_name">.360marketing.in</div></div>
							<div class="col-md-2"><button type="button" onclick="search_domain();" class="btn btn-primary btn-block">Search Domain</button></div> 
						</div>
					</form>
				</div>
				
				<div id="search_result"></div>
			</div>
		</div>
		
		<!-- Login Modal Start By Dixit -->
		<div class="container"> 
			<div id="login-overlay" class="modal fade" role="dialog" >
				<div class="modal-dialog">
					
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">Close</button>
							<h4 class="modal-title" id="myModalLabel">Login to 360marketing.com</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-xs-12">
									<div class="well">
										<form id="loginForm">
											<div class="form-group">
												<label for="username" class="control-label">Username</label>
												<input type="text" class="form-control" ng-model="user_name" required title="Please enter you username" placeholder="Enter username">
												<span class="help-block"></span>
											</div>
											<div class="form-group">
												<label for="password" class="control-label">Password</label>
												<input type="password" class="form-control" ng-model="user_password" required title="Please enter your password" placeholder="Enter password">
												<span class="help-block"></span>
											</div>
											<span id="login_error"></span>
											<button  ng-click="login();" class="btn btn-success btn-block">LOGIN</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<!-- Login Modal End By Dixit -->
		
		
		<!-- Signup Modal Start By Dixit -->
		<div class="container"> 
			<div id="signup-overlay" class="modal fade" role="dialog" >
				<div class="modal-dialog">
					
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">Close</button>
							<h4 class="modal-title" id="myModalLabel" >Signup to 360marketing.com</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-xs-12">
									<div class="well">
										<form id="loginForm"  >
											<div class="form-group">
												<label for="name" class="control-label">Name</label>
												<input type="text" class="form-control" ng-model="name"  title="Please enter you name" placeholder="Enter your name" required/>
												<span class="help-block"></span>
											</div>
											<div class="form-group">
												<label for="email" class="control-label">Email</label>
												<input type="email" class="form-control" ng-model="email"  title="Please enter your email" placeholder="Enter your email" required/>
												<span class="help-block"></span>
											</div>
											<div class="form-group">
												<label for="contact" class="control-label">Contact No</label>
												<input type="text" maxlength="10" class="form-control" ng-model="contact"  title="Please enter your contact no" placeholder="Enter your contact details" required />
												<span class="help-block"></span>
											</div>
											<div class="form-group">
												<label for="username" class="control-label">Username</label>
												<input type="text" class="form-control" ng-model="username"  title="Please enter your username" placeholder="Enter your username" required />
												<span class="help-block"></span>
											</div>
											<div class="form-group">
												<label for="password" class="control-label">Password</label>
												<input type="password" class="form-control" ng-model="password"  title="Please enter any password" placeholder="Enter your password" required/>
												<span class="help-block"></span>
											</div>
											
											<div class="form-group">
												<label for="domian_name" class="control-label">Domain Name</label>
												<input type="text" class="form-control" ng-model="domain_name"  title="Please enter any domain name" id="domain_name_input" placeholder="example.360marketing.in" disabled required/>
												<span class="help-block"></span>
											</div>
											
											<button ng-click="signup();" class="btn btn-primary">SIGNUP</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<!-- Signup Modal End By Dixit -->
		
		<script type="text/javascript">
			var app = angular.module('360_market', []);
			app.controller('main_ctrl', function($scope) {
				
				<!-- Signup Function Start -->
				var d='<?php echo $_SESSION['id']?>';
				if(d=='logout')
				{
					$scope.status='logout';
				}
				$scope.signup = function() {
					
					if(!$scope.name || !$scope.email || !$scope.contact || !$scope.username || !$scope.password || !$scope.domain_name)
					{
						if(!$scope.domain_name && $scope.name && $scope.email && $scope.contact && $scope.username && $scope.password)
						{
							alert('Please search your domain name first');
						}
						else
						{
							alert('Please enter the required fields');
						}
					}
					else
					{
						$('#ajax_loader').show();
						var formData = 
						{
							'name'        : $scope.name,
							'email'       : $scope.email,
							'contact'     : $scope.contact,
							'username'    : $scope.username,
							'password'    : $scope.password,
							'domain'      : $scope.domain_name
						};
						$.ajax({
							url: 'signup.php',
							type: 'post',
							data: formData ,
							dataType: 'json',
							success: function (response) {
								if(response!='false')
								{
									if(response=='exist')
									{
										alert('Sorry, given email or contact is already registered with us');
										$('#signup-overlay').modal('toggle');
										$('#login-overlay').modal('toggle');
										$('#ajax_loader').hide();
									}
									else
									{
										$('#signup-overlay').modal('toggle');
										$('#ajax_loader').hide();
										window.open('signup/index.php?tid=<?php echo md5(md5(md5('dhrsynsgtrsntynrnrs'))); ?>&id='+response[0]+'&domain='+response[1]+'&pid=<?php echo md5(md5(md5('23564vdgvynsgtrsntynrnrs'))); ?>','_self');
									}
								}
							},
							error: function () {
								alert("error");
								$('#ajax_loader').hide();
								
							}
						});
					}
				}
				<!-- Signup Function End -->
				
				
				
				<!-- Login function start -->
				$scope.login = function() 
				{
					if(!$scope.user_name || !$scope.user_password)
					{
						alert('Please enter all fields');
					}
					else
					{
						$('#ajax_loader').show();
						var formData = 
						{
							'username'    : $scope.user_name,
							'password'    : $scope.user_password
						};
						
						$.ajax({
							url: 'login.php',
							type: 'post',
							data: formData ,
							dataType: 'json',
							success: function (response) {
								if(response!='false')
								{
									document.getElementById('login_error').innerHTML="";
									$('#login-overlay').modal('toggle');
									$('#ajax_loader').hide();
									window.open('login/index.php?id='+response+'','_self');  				
								}
								else
								{
									
									document.getElementById('login_error').innerHTML="<font color='red'>Invalid Username or passoword</font>";
									$('#ajax_loader').hide();
									
								}
							},
							error: function () {
								alert("error");
							}
						});	
					}
				}
				
				<!-- Login Function End -->
				
				<!-- Logout Function Start-->
				$scope.logout = function() 
				{
					$scope.status='logout';
					var formData = 
					{
						'username': 'golu'
					};
					
					$('#ajax_loader').show();
					
					$.ajax
					({
						url: 'logout.php',
						type: 'post',
						data:  formData,
						dataType: 'json',
						success: function (response) {
							if(response=='true')
							{
								$('#ajax_loader').hide();
								console.log('Successfully Logout');
							location.reload();
							}
						},
						error: function () {
							alert("error");
						}
					});	
				}
				
				<!-- Logout Function End -->
				
				<!-- Update Status of user Start -->
				$scope.upd=function() {
					$scope.status='<?php echo $_SESSION['id'];?>';
				}
				<!-- Update Status of user End -->
			});
			
			
			<!-- DropDown Menu Script Start -->  
			$(function(){
				$(".dropdown").hover(            
				function() {
					$('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
					$(this).toggleClass('open');
					$('b', this).toggleClass("caret caret-up");                
				},
				function() {
					$('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
					$(this).toggleClass('open');
					$('b', this).toggleClass("caret caret-up");                
				});
			});
			<!-- DropDown Menu Script End -->
		</script>
	</body>
	<!-- By Dixit -->
</html>		