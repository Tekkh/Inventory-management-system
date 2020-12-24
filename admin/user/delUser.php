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
 
    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

    if(!empty($_POST)) 
    {
        $id = checkInput($_POST['id']);
        $sql = "DELETE FROM users WHERE id = $id";
     	  $res=mysqli_query($cnx,$sql)or die("Bad query");
       	while($user =  mysqli_fetch_row($res)){
        $id = $user['id'];}
        header("Location: ../user.php");
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

	<div class="TKprod" id="del">
		<div class="row">
                <h1><strong>Supprimer un utilisateur</strong></h1>
                <br>
                <form class="form" action="delUser.php" role="form" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                    <p class="alert alert-warning" id="sur">Etês vous sûr de vouloir supprimer ?</p>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-danger">Oui</button>
                      <a class="btn btn-default" href="../user.php">Non</a>
                    </div>
                </form>
            </div>
         </div>   
    </body>
</html>
<?php } else { header('Location: ../login.php'); } ?>