<?php session_start(); ?>
<?php if (isset($_SESSION["username"])) { ?>
<!DOCTYPE html>
<html>
<head>
	<title>TK Management</title>
	<meta charset="UTF-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<!-----------------------------------------------------------------------Navbar--------------------------------------------------------------------------------->
	<nav class="navbar navbar-default">
	  <div class="container-fluid">	    
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	          <a class="navbar-brand" href="index.php">
	        <img alt="Brand" src="img/tkm7.png" width="150px" height="70px">
	      </a>
	    </div>

	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      	<ul class="nav navbar-nav">
	       			<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Accueuil<span class="sr-only">(current)</span></a></li>
	       				<li class="dropdown">
	          			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span> Produits <span class="caret"></span></a>
					<ul class="dropdown-menu">
	           		<li><a href="productdb/creeprod.php">Créer</a></li>
	            	<li><a href="productdb/produitentr.php">Entrée</a></li>
	            	<li><a href="productdb/produitsrt.php">Sortie</a></li>
	        		</ul>
	       			</li>
	       				<li class="dropdown">
	          			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-transfer"></span> Déplacements <span class="caret"></span></a>
					<ul class="dropdown-menu">
	           		<li><a href="deplacedb/deplaceprod.php">Déplacer Produit</a></li>
	           		<li role="separator" class="divider"></li>
	            	<li><a href="Listes/listedeplace.php">Liste Déplacements</a></li>
	            	</ul>
	       			</li>
	       			<li class="dropdown">
	          			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-th"></span> Emplacement <span class="caret"></span></a>
					<ul class="dropdown-menu">
	           		<li><a href="Emplacedb/Creeremp.php">Créer Emplacement</a></li>
	           		<li role="separator" class="divider"></li>
	            	<li><a href="Listes/listeEmplace.php">Liste Emplacements</a></li>
	        		</ul>
	       			</li>
	       			<li class="dropdown">
	          			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-th-list"></span> Stock <span class="caret"></span></a>
					<ul class="dropdown-menu">
	           		<li><a href="Listes/listeproduit.php">Liste Produits</a></li>
	            	<li><a href="Listes/listeEmplace.php">Liste Emplacements</a></li>
	            	<li><a href="Listes/listedeplace.php">Liste Déplacements</a></li>        		
				   </ul>
	       			</li>
						<li>
	       				 <li class="nav-item logout">
	               			 <a class="nav-link" href="logout.php">
	                    		<button type="button" class="btn btn-danger navbar-btn btn-lg btn-sm"><span class="glyphicon glyphicon-log-out"></span> Logout</button>
	               			 </a>
	          			</li>
	        		</li>
	      		</ul>
	   		 </div>
	  	</div>
	</nav>
<!-----------------------------------------------------------------------End of Navbar--------------------------------------------------------------------------------->
	<table>
		<tr>
			<td>
					<a href="productdb/Creeprod.php"> <button type="button" class="btn btn-primary btn-lg butn" id="btn1"> Créer Produit </button> &nbsp; <br> </a>
			</td>
			<td>
					<a href="Emplacedb/Creeremp.php"> <button type="button" class="btn btn-primary btn-lg butn" id="btn2"> Créer Emplacement </button> &nbsp; <br> </a>
			</td>
			<td>
					<a href="Listes/listeEmplace.php"><button type="button" class="btn btn-primary btn-lg butn" id="btn3"> Liste Emplacements </button> &nbsp; <br> </a>
			</td>
		</tr>
		<tr id="trdx">
			<td>
				 	<a href="productdb/produitentr.php"><button type="button" class="btn btn-primary btn-lg butn" id="btn4"> Entrée Produit </button> &nbsp;<br>
			</td>
			<td>
					<a href="Deplacedb/deplaceprod.php"><button type="button" class="btn btn-primary btn-lg butn" id="btn5"> Déplacer Produit </button> &nbsp; <br> </a>
			</td>
			<td>
					<a href="Listes/listedeplace.php"><button type="button" class="btn btn-primary btn-lg butn" id="btn6"> Liste Déplacements </button> &nbsp; <br></a>
			</td>
		</tr>
		<tr>
			<td>
					<a href="productdb/produitsrt.php"><button type="button" class="btn btn-primary btn-lg butn" id="btn7"> Sortie un produit </button> &nbsp;<br></a>
			</td>
			<td>
					<a href="Listes/listeproduit.php"><button type="button" class="btn btn-primary btn-lg butn" id="btn8"> Liste Produits </button> &nbsp; <br></a>
			</td>
			<td>
					<div" id="Bien"> <?php if($_SESSION["username"]==true){echo 'Bienvenue, '.$_SESSION["username"];}?> </div> &nbsp; <br>
			</td>
		</tr>
	</table>

             <script src="js/jquery-3.3.1.min.js"></script>
      		<script  src="js/bootstrap.min.js"></script>

</body>
</html>
<?php } else { ?>
<?php header('Location: login.php'); ?>
<?php  } ?>