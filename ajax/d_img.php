<?php
include_once "functions.php";
checkIfLogin();
?>
<?php
$src = $_POST['src'];
$file_array = explode("/", parse_url($src)['path']);
$file_name = "../posts/" . end($file_array);
unlink($file_name);
