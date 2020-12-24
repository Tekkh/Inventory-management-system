<?php session_start();
if (isset($_SESSION["admin"])) { ?>

	<?php 
		require '../connectdb.php';

		function checkInput($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		 $prodError = $achatError = $descError =  $qteError = $emplError = $desc =  $qte = $empl = $achat = $produit ="";

	if(!empty($_POST)) 
    {
        $achat               = checkInput($_POST['achat']);    
        $desc                = checkInput($_POST['desc']);
        $qte     			 = checkInput($_POST['qte']);
        $empl          	     = checkInput($_POST['empl']);	
        $isSuccess           = true;
        $sql = "SELECT * FROM produit WHERE desc_prod='$desc'";
        if ($resultat=mysqli_query($cnx,$sql)) 
        {
            if (mysqli_num_rows($resultat)>0) 
            {
                echo '<div id="echec" class="alert alert-danger alert-dimissible">';
                echo '<a href="Creeprod.php" class="close" data-dimiss="alert" aria-label="close">&times</a>';
                echo 'Le produit deja existé !';
                echo '</div>';
            }
            else
        	{

		         if(empty($desc)) 
		        {
		            $descError = 'Ce champ ne peut pas être vide';
		            $isSuccess = false;
		        }
		        if(empty($qte)) 
		        {
		            $qteError = 'Ce champ ne peut pas être vide';
		            $isSuccess = false;
		        } 
		        if(empty($empl)) 
		        {
		            $emplError = 'Ce champ ne peut pas être vide';
		            $isSuccess = false;
		        } 
		         if(empty($achat)) 
		        {
		            $achatError = 'Ce champ ne peut pas être vide';
		            $isSuccess = false;
		        }
		        if($isSuccess) 
                {
                	if(is_numeric($achat)&&$achat>0)
                   { 
                   	 		$statement = "INSERT INTO produit (desc_prod,qte,code_emp) values('$desc', $qte, '$empl')"; 
                            $stat = "INSERT INTO achat (code_achat) values('$achat')";

                    	if (is_numeric($qte)&&$qte>0)
                      {
	                      	if ($cnx->query($statement) === TRUE && $cnx->query($stat) === TRUE ) 
	                      	{		 		
	                      		 echo '<div id="succes" class="alert alert-success alert-dismissible">';
	                             echo ' <a href="../index.php" class="close" data-dismiss="alert" aria-label="close">&times</a>';
	                             echo ' Le produit est Crée avec <strong>succés!</strong>';
	                             echo '</div>';
	                        }else{

	                        		echo '<div id="echec" class="alert alert-danger alert-dismissible">';
	                                echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times</a>';
	                                echo 'Création de produit est <strong>echoué!</strong>';
	                                echo '</div>';
	                        	 }
                   	  }else{

                   	  		  echo '<div id="echec" class="alert alert-danger alert-dismissible">';
                              echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times</a>';
                              echo 'Création est <strong>Echoué!</strong> Vérifier la Quantité';
                              echo '</div>'; 
                   	  	   }
                   }else{

                   	  		  echo '<div id="echec" class="alert alert-danger alert-dismissible">';
                              echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times</a>';
                              echo 'Création est <strong>Echoué!</strong> Vérifier Code achat';
                              echo '</div>'; 
                   	  	   }
                }
       		}		
   		}
    }

  				$sql = "SELECT MAX(code_prod)+1 FROM Produit";
    			$res= mysqli_query($cnx,$sql) or die("Bad query");
                            while($row = mysqli_fetch_array($res)) 
                           {
                                $produit=$row[0];
                           }    
	?>
	<!DOCTYPE html>
<html>
<head>
	<title>TK Management</title>
	<meta charset="UTF-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>

	<div class="TKprod">
		<div class="row">
                <h1><strong>Créer un produit</strong></h1>
                <br>
                <form class="form" action="Creeprod.php" role="form" method="post">
                    <div class="form-group">
                        <label for="prod">Code Produit:</label>
                        <input type="text" class="form-control" id="prod" name="prod" placeholder="code Produit" value="<?php echo $produit;?>" readonly>
                        <span class="h-inline" style= "color:red"><?php echo $prodError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="desc">Description produit:</label>
                        <input type="text" class="form-control" id="desc" name="desc" placeholder="Description" value="<?php echo $desc;?>">
                        <span class="h-inline" style= "color:red"><?php echo $descError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="qte">Quantité:</label>
                        <input type="text" class="form-control" id="qte" name="qte" placeholder="" value="1">
                        <span class="h-inline" style= "color:red"><?php echo $qteError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="empl">Emplacement:</label>
                        <select class="form-control" id="empl" name="empl">
                        	<option><label class="lblsize" >Choisir Emplacement</label></option>
                        <?php
                           require "../connectdb.php";
                           $sql="SELECT code_emp FROM `emplacement` ORDER by code_emp ";
                            $res= mysqli_query($cnx,$sql) or die("Bad query");
                            while($row = mysqli_fetch_array($res)) 
                           {
                                echo '<option value="'. $row['code_emp'] .'">'. $row['code_emp'] . '</option>';;
                           }
                           
                        ?>
                        </select>
                        <span class="h-inline" style= "color:red"><?php echo $emplError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="desc">Code d'achat:</label>
                        <input type="text" class="form-control" id="achat" name="achat" placeholder="code d'achat" value="<?php echo $achat;?>">
                        <span class="h-inline" style= "color:red"><?php echo $achatError;?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Créer</button>
                        <a class="btn btn-primary" href="../index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
         </div>   
    </body>
</html>
<?php } else { header('Location: ../login.php'); } ?>