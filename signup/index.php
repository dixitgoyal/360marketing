<?php
$id= $_GET['id'];
$dom=$_GET['domain'];	
?>
<html>
	<head>
	<title>360 Marketing Signup</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../css/bootstrap_cdn.css" type="text/css" />
		<link rel="stylesheet" href="../css/signup.css" type="text/css" />
		
		<script src="../js/jquery_cdn.js" type="text/javascript"></script>
		<script src="../js/bootstrap_cdn.js" type="text/javascript"></script>
		<script src="../js/angular_cdn.js" type="text/javascript"></script>
		
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	</head>
	<body>
	<div class="template_box container">
	<div class="row">
	<!--<div class="col-md-4">	
	<div id="template"><a href="../templates/template1/"><img src="../templates/template1/img/product-6.jpg" width="300" height="300"/></a><br><a href="redirect.php?id=<?php //echo md5(md5(md5('../templates/template1/')));?>&template_id=1&path=../templates/template1&p=<?php //echo md5(md5(md5('dixitgosgtrshsyjdtyxnetjryej64rj')));?>&domain=<?php //echo $dom; ?>">Choose This Template</a></div>	
	</div>
	<div class="col-md-4">	
	<div id="template"><a href="../templates/template2/"><img src="../templates/template1/img/product-6.jpg" width="300" height="300"/></a><br><a href="redirect.php?id=<?php //echo md5(md5(md5('../templates/template2/')));?>&template_id=2&path=../templates/template2&p=<?php //echo md5(md5(md5('dixitgosgtrshsyjdtyxnetjryej64rj')));?>&domain=<?php //echo $dom; ?>">Choose This Template</a></div>	
	</div>-->
	<div class="col-md-4">	
	<div id="template"><a href="../templates/template3/"><img src="../templates/template1/img/product-6.jpg" width="300" height="300"/></a><br><a href="redirect.php?id=<?php echo md5(md5(md5('../templates/template3/')));?>&template_id=3&path=../templates/template3&p=<?php echo md5(md5(md5('dixitgosgtrshsyjdtyxnetjryej64rj')));?>&domain=<?php echo $dom; ?>">Choose This Template</a></div>
	</div>
	</div>
	</div>
	</body>
	</html>