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
 
    if(!empty($_GET['id'])){

       $id = checkInput($_GET['id']);
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

                         $statement = "UPDATE users SET full_name= '$name', tel = '$phone' ,username= '$usna',password='$pass' WHERE id='$id'";

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
                                echo '<a href="Ajouteruser.php" class="close" data-dismiss="alert" aria-label="close">&times</a>';
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
    else{

        $sql= "SELECT * FROM users where id = '$id'";
        $result= mysqli_query($cnx,$sql) or die("Bad query");
        while($prod =  mysqli_fetch_array($result)){
        $name              = $prod['full_name'];
        $phone             = $prod['tel'];
        $usna              = $prod['username'];
        $pass              = $prod['password'];
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
                <h1><strong>Modifier un utilisateur</strong></h1>
                <br>
                <form class="form" action="<?php echo 'editUser.php?id='.$id;?>" role="form" method="post">
                    <div class="form-group">
                        <label for="name">Nom et Prenom:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom et Prenom " value="<?php echo $name;?>">
                        <span class="h-inline" style= "color:red"><?php echo $nameError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="phone">Telephone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Telephone" value="<?php echo $phone;?>">
                        <span class="h-inline" style= "color:red"><?php echo $phoneError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="pass">Nom d'utilisateur:</label>
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
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                        <a class="btn btn-primary" href="../user.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
         </div>   
    </body>
</html>
<?php } else { header('Location: ../login.php'); } ?>