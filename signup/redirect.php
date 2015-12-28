<?php
	include '../connect.php';
	$path = $_GET['path'];
	$domain= $_GET['domain'];
	$tm_id=$_GET['template_id'];
	
	function recurse_copy($src,$dst) {
		$dir = opendir($src); 
		@mkdir($dst); 
		while(false !== ( $file = readdir($dir)) ) { 
			if (( $file != '.' ) && ( $file != '..' )) { 
				if ( is_dir($src . '/' . $file) ) { 
					recurse_copy($src . '/' . $file,$dst . '/' . $file); 
				} 
				else { 
					copy($src . '/' . $file,$dst . '/' . $file); 
				} 
			} 
		} 
		closedir($dir); 
	}
	
	/* Source directory (can be an FTP address) */
	$src = $path;
	
	/* Full path to the destination directory */
	$dst = "../subdomains/".$domain;
	recurse_copy($src,$dst);
	
	
echo 'golu';
		$d_name=$domain.".360marketing.in";
		$sql="update registered_domains set template_id='$tm_id' where domain_names='$d_name'";	
		$conn->query($sql);	
	
	
	
?>
<script>
	window.open('../login/index.php?id=<?php echo $domain; ?>','_self');
	
</script>