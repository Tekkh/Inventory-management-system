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

    if(!empty($_GET['code_prod'])){

       $code_prod = checkInput($_GET['code_prod']);
    }

    $codeError = $orgError = $destError = $descError =  $qteError = $code = $org=  $dest = $desc =  $qte = "";

     if(!empty($_POST)) 
    {
        $code                = checkInput($_POST['code']);
       	$org                 = checkInput($_POST['org']);
        $dest     			     = checkInput($_POST['dest']);
        $desc                = checkInput($_POST['desc']);
        $qte     			       = checkInput($_POST['qte']);
        $isSuccess           = true;


        if(empty($code)) 
        {
            $codeError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($org)) 
        {
            $orgError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($qte)) 
        {
            $destError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
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

          if($isSuccess) 
          {
          
                  $statement = "INSERT INTO deplacement (empl_org, empl_des, desc_dep, qte) VALUES ('$org',  '$dest',  '$desc', $qte)";

                     if ($qte>0)
                    {
                        if ($cnx->query($statement) === TRUE ) {
                                      echo '<div id="succes" class="alert alert-success alert-dismissible">';
                                      echo ' <a href="../index.php" class="close" data-dismiss="alert" aria-label="close">&times</a>';
                                      echo ' Le produit est déplacer avec <strong>succés!</strong>';
                                      echo '</div>';
                        } else {
                                      echo '<div id="echec" class="alert alert-danger alert-dismissible">';
                                      echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times</a>';
                                      echo ' Déplacement de produit est <strong>echoué!</strong>';
                                      echo '</div>';  
                        }
                    } else{

                       echo '<div id="echec" class="alert alert-danger alert-dismissible">';
                       echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times</a>';
                       echo ' Déplacement de produit est <strong>echoué!</strong>';
                       echo '</div>';
                    }        


          }
    }
    else{

        $sql= "SELECT code_prod, code_emp FROM produit where code_prod = '$code_prod'";
        $result= mysqli_query($cnx,$sql) or die("Bad query");
        while($prod =  mysqli_fetch_array($result)){

        $code            = $prod['code_prod'];
        $org     		     = $prod['code_emp'];
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
                <h1><strong>Déplacer un produit</strong></h1>
                <br>
                <form class="form" action="<?php echo 'Deplacer.php'?>" role="form" method="post">

                  <div class="form-group">
                        <label for="code">Code Produit:</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Code" value="<?php echo $code;?>" readonly>
                        <span class="h-inline" style= "color:red"><?php echo $codeError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="org">Emplacement origine:</label>
                         <select class="form-control" id="org" name="org" readonly>
                        	<option><label class="lblsize" >Choisir origine</label></option>
                        <?php
                           require "../connectdb.php";
                           $sql="SELECT code_emp FROM `emplacement` ORDER by code_emp";
                            $res= mysqli_query($cnx,$sql) or die("Bad query");
                            while($row = mysqli_fetch_array($res)) 
                           {
                               if($row['code_emp'] == $org){
                                    echo '<option selected = "selected" value="'. $row['code_emp'] .'">'. $row['code_emp'] . '</option>';
                                }else
                                    {echo '<option value="'. $row['code_emp'] .'">'. $row['code_emp'] . '</option>';}   
                           }
                           
                        ?>
                        </select>
                        <span class="h-inline" style= "color:red"><?php echo $orgError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="dest">Emplacement destination:</label>
                         <select class="form-control" id="dest" name="dest">
                        	<option><label class="lblsize" >Choisir Destination</label></option>
                        <?php
                           require "../connectdb.php";
                           $sql="SELECT code_emp FROM `emplacement` ORDER by code_emp ";
                            $res= mysqli_query($cnx,$sql) or die("Bad query");
                            while($row = mysqli_fetch_array($res)) 
                           {
                                if($row['code_emp'] == $dest){
                                    echo '<option selected = "selected" value="'. $row['code_emp'] .'">'. $row['code_emp'] . '</option>';
                                }else
                                    {echo '<option value="'. $row['code_emp'] .'">'. $row['code_emp'] . '</option>';}   
                           }
                           
                        ?>
                        </select>
                        <span class="h-inline" style= "color:red"><?php echo $destError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="desc">Description Déplacement :</label>
                        <input type="text" class="form-control" id="desc" name="desc" placeholder="Description" value="<?php echo $desc;?>">
                        <span class="h-inline" style= "color:red"><?php echo $descError;?></span>
                    </div>
                     <div class="form-group">
                        <label for="qte">Quantité:</label>
                        <input type="text" class="form-control" id="qte" name="qte" placeholder="Quantité" value="<?php echo $qte;?>">
                        <span class="h-inline" style= "color:red"><?php echo $qteError;?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-transfer"></span> Déplacer</button>
                        <a class="btn btn-primary" href="deplaceprod.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
         </div>   
    </body>
</html>
<?php } else { header('Location: ../../login.php'); } ?>