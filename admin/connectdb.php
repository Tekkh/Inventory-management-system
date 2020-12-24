<?php
	
    $hote = 'localhost';
	$base = 'pfe';
	$user = 'root';
	$pass = '';
	
	$cnx = mysqli_connect($hote, $user, $pass, $base);
	
	
if (!$cnx) {
    die("Connection failed: " . mysqli_connect_error());
}

?>