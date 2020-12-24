
<?php session_start(); ?>
<?php if (isset($_SESSION["username"])) { ?>
<?php
     
    require '../connectdb.php';

            function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
 
    $code_empError = $descError =  $code_emp = $desc = "";
     if(!empty($_POST)) 
    {
        $code_emp            = checkInput($_POST['code_emp']);
        $desc                = checkInput($_POST['desc']);
        $isSuccess           = true;

         if(empty($code_emp)) 
        {
            $code_empError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($desc)) 
        {
            $descError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }

                if($isSuccess) 
                {
                    if(((preg_match("/^A/", $code_emp)) && (preg_match("/Rangee A/", $desc))) 
                        || ((preg_match("/^B/", $code_emp)) && (preg_match("/Rangee B/", $desc)))
                        || ((preg_match("/^C/", $code_emp)) && (preg_match("/Rangee C/", $desc)))
                    ){
                     $statement = "INSERT INTO emplacement (code_emp, desc_emp) values('$code_emp', '$desc')";
                     if ($cnx->query($statement) === TRUE) {
                                    echo '<div id="succes" class="alert alert-success alert-dismissible">';
                                    echo ' <a href="../index.php" class="close" data-dismiss="alert" aria-label="close">&times</a>';
                                    echo ' Emplacement crée avec <strong>succés!</strong>';
                                    echo '</div>';
                    } else {
                                   echo '<div id="echec" class="alert alert-danger alert-dismissible">';
                                   echo '<a href="Creeremp.php" class="close" data-dismiss="alert" aria-label="close">&times</a>';
                                   echo 'Emplacement est déjà <strong>existé!</strong>';
                                   echo '</div>';
                                
                    }

                    }else{
                                   echo '<div id="echec" class="alert alert-danger alert-dismissible">';
                                   echo '<a href="Creeremp.php" class="close" data-dismiss="alert" aria-label="close">&times</a>';
                                   echo 'Emplacement est déja <strong>echoué!</strong>';
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
                <h1><strong>Créer un Emplacement</strong></h1>
                <br>
                <form class="form" action="Creeremp.php" role="form" method="post">
                    <div class="form-group">
                        <label for="code_emp">Code emplacement:</label>
                        <input type="text" class="form-control" id="code_emp" name="code_emp" placeholder="Code" value="<?php echo $code_emp;?>">
                        <span class="h-inline" style= "color:red"><?php echo $code_empError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="desc">Description emplacement:</label>
                         <select class="form-control" id="desc" name="desc">
                            <option><label class="lblsize" >Choisir Emplacement</label></option>
                        <?php
                           require "../connectdb.php";
                           $sql="SELECT DISTINCT     desc_emp FROM `emplacement`  ";
                            $res= mysqli_query($cnx,$sql) or die("Bad query");
                            while($row = mysqli_fetch_array($res)) 
                           {
                                echo '<option value="'. $row['desc_emp'] .'">'. $row['desc_emp'] . '</option>'; 
                           }
                           
                        ?>
                        </select>
                        <span class="h-inline" style= "color:red"><?php echo $descError;?></span>
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
<?php } else { ?>
<?php header('Location: ../login.php'); ?>
<?php  } ?>