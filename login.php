<!DOCTYPE html>
<html>
<head>
	<title> TK Management</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="img/style.css">
	<link rel="stylesheet" href="css/bootstrap.css">

	<?php
			require "connectdb.php";
			session_start();

		if(isset($_POST['submit'])){

			if(!empty($_POST['username']) && !empty($_POST['password']))
		
		{
			$user=$_POST['username'];
			$pass=$_POST['password'];

			$sql="SELECT * from admin where username= '".$user . "' and password ='".$pass."'";

				$run=mysqli_query($cnx, $sql);

				if($rows=mysqli_fetch_array($run)) {
						session_start();
                		$_SESSION["admin"] = $user;
						header('Location: admin/index.php');}
						
			
			if($sql1="SELECT * from users where username= '".$user . "' and password ='".$pass."'"){

				$run=mysqli_query($cnx, $sql1);

				if($rows=mysqli_fetch_array($run)) {
							session_start();
	                		$_SESSION["username"] = $user;
							header('Location: index.php');
				} else{
					echo '<div class="alert alert-danger" role="alert">Vérifier vos données </div>';
				}
			}
			
		}
			else if (empty($_POST['username']) && !empty($_POST['password'])){

			echo '<div class="alert alert-danger" role="alert">Saisir votre username </div>';
		}
			else if (!empty($_POST['username']) && empty($_POST['password'])){

			echo '<div class="alert alert-danger" role="alert">Saisir votre mot de passe</div>';
		}
			else{

			echo '<div class="alert alert-danger" role="alert"> Remplir les champs </div>';
		}}
		

	?>

</head>
<body>
	<div class="login ">
		<img src="img/tkm1.jpg" class="filiz">
		<h1> TK <sub> Management </sub> </h1>
		<form method="post" action="login.php">
		<p> Username </p>
		<div class="textbox">
		<input type="text" name="username" placeholder="Enter username"></div>
		<p> Password </p>
		<div class="textbox">
		<input type="password" name="password" placeholder="Enter password"><br></div>
		<input type="submit" name="submit" value="Login"><br>
		 </form>
	</div> 


	<script src="jquery-3.3.1.min.js"></script>
	<script  src="js/bootstrap.min.js"></script>
</body>
</html>