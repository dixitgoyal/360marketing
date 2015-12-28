<?php
session_start();
$_SESSION['id']="logout";

$msg="true";
session_destroy();
echo json_encode($msg);


?>