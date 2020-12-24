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
 
    if(!empty($_GET['code_prod'])){

       $code_prod = checkInput($_GET['code_prod']);
    }
    $codeError = $descError = $emplError =  $qteError = $code = $empl = $desc =  $qte = "";
     if(!empty($_POST)) 
    {

        $code                     = checkInput($_POST['code']);
        $desc                     = checkInput($_POST['desc']);
        $empl                     = checkInput($_POST['empl']);
        $qte     			      = checkInput($_POST['qte']);
        $isSuccess                = true;

        if(empty($code))
        {
            $codeError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
    
         if(empty($desc)) 
        {
            $descError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
          if(empty($empl)) 
        {
            $emplError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($qte)) 
        {
            $qteError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 

                if($isSuccess) 
                {
                    
                    $statement = "UPDATE produit SET qte = qte-$qte wHERE code_prod='$code_prod' ";

                    $sq = "SELECT qte FROM produit wHERE 'qte>0'";
                    $res = mysqli_query($cnx, $sq) or die ("Bad query");
                    while($prod=mysqli_fetch_array($res)){
                        $qte = $prod['qte'];
                    }

                     if ($qte>0)
                    {
        					if ($cnx->query($statement) === TRUE && $cnx->query($sq) === TRUE) {
        					    echo '<div id="succes" class="alert alert-success alert-dismissible">';
                                echo ' <a href="../index.php" class="close" data-dismiss="alert" aria-label="close">&times</a>';
                                echo ' Le produit est sortie avec <strong>succés!</strong>';
                                echo '</div>';
        					} else {
        					    echo '<div id="echec" class="alert alert-danger alert-dismissible">';
                                echo '<a href="produitsrt.php" class="close" data-dismiss="alert" aria-label="close">&times</a>';
                                echo ' Sortie de produit est <strong>echoué!</strong>';
                                echo '</div>';
        					}
                    } else{

                       echo '<div id="echec" class="alert alert-danger alert-dismissible">';
                       echo '<a href="produitsrt.php" class="close" data-dismiss="alert" aria-label="close">&times</a>';
                       echo ' Sortie de produit est <strong>echoué!</strong>';
                       echo '</div>';
                    }        

                }
    }
    else{

        $sql= "SELECT code_prod, desc_prod, code_emp FROM produit where code_prod = '$code_prod'";
        $result= mysqli_query($cnx,$sql) or die("Bad query");
        while($prod =  mysqli_fetch_array($result)){
        $code = $prod['code_prod'];
        $desc = $prod['desc_prod'];
        $empl = $prod['code_emp'];
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
                <h1><strong>Sortie Produit</strong></h1>
                <br>
                <form class="form" action="<?php echo 'Sortie.php?code_prod='.$code_prod;?>" role="form" method="post">
                    <div class="form-group">
                        <label for="code">Code produit:</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Code" readonly value="<?php echo $code;?>">
                        <span class="h-inline" style= "color:red"><?php echo $codeError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="desc">Description produit:</label>
                        <input type="text" class="form-control" id="desc" name="desc" placeholder="Description" readonly value="<?php echo $desc;?>">
                        <span class="h-inline" style= "color:red"><?php echo $descError;?></span>
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
                                if($row['code_emp'] == $code_emp){
                                    echo '<option selected = "selected" value="'. $row['code_emp'] .'">'. $row['code_emp'] . '</option>';
                                }else
                                    {echo '<option value="'. $row['code_emp'] .'">'. $row['code_emp'] . '</option>';}   
                           }
                           
                        ?>
                        </select>
                        <span class="h-inline" style= "color:red"><?php echo $emplError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="qte">Quantité:</label>
                        <input type="text" class="form-control" id="qte" name="qte" placeholder="Quantité" value="<?php echo $qte;?>">
                        <span class="h-inline" style= "color:red"><?php echo $qteError;?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-danger"> Sortir <span class="glyphicon glyphicon-arrow-right"></span></button>
                        <a class="btn btn-primary" href="produitsrt.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
         </div>   
    </body>
</html>
<?php } else { ?>
<?php header('Location: ../login.php'); ?>
<?php  } ?>