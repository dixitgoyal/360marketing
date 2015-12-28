<?php
	
	include '../connect.php';
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$id=$_POST['id'];
		$domain=$_POST['domain'];
		if(!is_dir('../subdomains/'.$domain.'/product_images'))
		{
			mkdir('../subdomains/'.$domain.'/product_images');
		}
		if(!is_dir('../subdomains/'.$domain.'/product_images/'.$id))
		{
			mkdir('../subdomains/'.$domain.'/product_images/'.$id);
		}
		if(move_uploaded_file($_FILES['file']['tmp_name'], '../subdomains/'.$domain.'/product_images/'.$id."/".$_FILES['file']['name'])){
			echo($_POST['index']);
		}
		else
		{
	echo 'false';
		}
		exit;
	}
?>