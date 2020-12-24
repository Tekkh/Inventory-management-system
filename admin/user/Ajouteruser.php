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
 
    $nameError =  $phoneError = $usnaError = $passError = $name =  $phone = $usna = $pass = "";
     if(!empty($_POST)) 
    {
        $name                = checkInput($_POST['name']);
        $phone               = checkInput($_POST['phone']);
        $usna                = checkInput($_POST['usna']);
        $pass                = checkInput($_POST['pass']);
        $isSuccess           = true;

         if(empty($name)) 
        {
            $nameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($phone)) 
        {
            $phoneError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        
        if(empty($usna)) 
        {
            $usnaError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
         if(empty($pass)) 
        {
            $passError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 

                if($isSuccess) 
                {
                    
                    if (preg_match("/^06[0-9]{8}$|^07[0-9]{8}$|^02126[0-9]{8}$|^02127[0-9]{8}$/", $phone))
                    {
                       if(strlen($pass)>7)
                        {

                         $statement = "INSERT INTO users (full_name,tel,username,password) values('$name', $phone, '$usna','$pass')";

                            if ($cnx->query($statement) === TRUE) {
                                    echo '<div id="succes" class="alert alert-success alert-dismissible">';
                                    echo ' <a href="../user.php" class="close" data-dismiss="alert" aria-label="close">&times</a>';
                                    echo ' Utilisateur est ajouté avec <strong>succés!</strong>';
                                    echo '</div>';
                            } else {
                                   echo '<div id="echec" class="alert alert-danger alert-dismissible">';
                                   echo '<a href="Ajouteruser.php" class="close" data-dismiss="alert" aria-label="close">&times</a>';
                                   echo "Ajout d'utilisateur est <strong>échoué !</strong>";
                                   echo '</div>';
                            }
                        }else{
                                echo '<div id="echec" class="alert alert-danger alert-dismissible">';
                                echo '<a href="editUser.php" class="close" data-dismiss="alert" aria-label="close">&times</a>';
                                echo 'Mot de passe doit être <strong>8 charactères ou plus</strong>';
                                echo '</div>';
                             }

                    }else{
                                   echo '<div id="echec" class="alert alert-danger alert-dismissible">';
                                   echo '<a href="Ajouteruser.php" class="close" data-dismiss="alert" aria-label="close">&times</a>';
                                   echo 'Vérifier <strong>Téléphone !</strong>';
                                   echo '</div>';
                    }
                    
                }
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
                <h1><strong>Ajouter un utilisateur</strong></h1>
                <br>
                <form class="form" action="AjouterUser.php" role="form" onsubmit="return verification()" method="post">
                    <div class="form-group">
                        <label for="name">Nom et Prenom:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom et Prenom" value="<?php echo $name;?>">
                        <span class="h-inline" style= "color:red"><?php echo $nameError;?></span>
                    </div>
                    <div class="form-group" >
                        <label for="phone">Telephone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Telephone" value="<?php echo $phone;?>" >
                        <span class="h-inline" style= "color:red"><?php echo $phoneError;?></span>
                    </div>

                    <div class="form-group">
                        <label for="usna">Nom d'utilisateur:</label>
                       <input type="text" class="form-control" id="usna" name="usna" placeholder="Nom d'utilisateur" value="<?php echo $usna;?>">
                        <span class="h-inline" style= "color:red"><?php echo $usnaError;?></span>
                    </div>
                     <div class="form-group">
                        <label for="pass">Mot de passe:</label>
                       <input type="text" class="form-control" id="pass" name="pass" placeholder="Mot de passe" value="<?php echo $pass;?>">
                        <span class="h-inline" style= "color:red"><?php echo $passError;?></span>
                    </div>

                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil""></span> Ajouter</button>
                        <a class="btn btn-primary" href="../user.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
         </div> 


  <script src="js/jquery-3.3.1.min.js"></script>
     <script  src="js/bootstrap.min.js"></script>
<?php } else { header('Location: ../login.php');  } ?>