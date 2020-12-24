<?php session_start(); ?>
<?php if (isset($_SESSION["username"])) { ?>

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
<!-- ------------------------------------------------------------------------Navbar ---------------------------------------------------------->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
              <a class="navbar-brand" href="../index.php">
            <img alt="Brand" src="../img/tkm7.png" width="150px" height="70px">
          </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                    <li class="active"><a href="../index.php"><span class="glyphicon glyphicon-home"></span> Accueuil<span class="sr-only">(current)</span></a></li>
                        <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span> Produits <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li><a href="creeprod.php">Créer</a></li>
                    <li><a href="produitentr.php">Entrée</a></li>
                    <li><a href="produitsrt.php">Sortie</a></li>
                    </ul>
                    </li>
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-transfer"></span> Déplacements <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li><a href="../deplacedb/deplaceprod.php">Déplacer Produit</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="../Listes/listedeplace.php">Liste Déplacements</a></li>
                    </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-th"></span> Emplacement <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li><a href="../Emplacedb/Creeremp.php">Créer Emplacement</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="../Listes/listeEmplace.php">Liste Emplacements</a></li>
                    </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-th-list"></span> Stock <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li><a href="../Listes/listeproduit.php">Liste Produits</a></li>
                    <li><a href="../Listes/listeEmplace.php">Liste Emplacements</a></li>
                    <li><a href="../Listes/listedeplace.php">Liste Déplacements</a></li>                 
                   </ul>
                    </li>
                        <li>
                         <li class="nav-item logout">
                             <a class="nav-link" href="../logout.php">
                                <button type="button" class="btn btn-danger navbar-btn btn-lg btn-sm"><span class="glyphicon glyphicon-log-out"></span> Logout</button>
                             </a>
                        </li>
                    </li>
                </ul>
             </div>
        </div>
    </nav>


    <!-- ------------------------------------------------------------------------End of Navbar ---------------------------------------------------------->
    <div  class="TKprod">
         <h1><strong>Sortie Produit </strong></h1><br>

         <table class="table table-strip    ed table-bordered">
            <thead>
                <tr>
                    <th>Code produit</th>
                    <th>Description produit</th>
                    <th>Quantité</th>
                    <th>Emplacement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                    <?php 
                        require '../connectdb.php';
                        $sql="SELECT * FROM `produit` ORDER by code_prod ";
                        $result= mysqli_query($cnx,$sql) or die("Bad query");
                        while($prod = mysqli_fetch_assoc($result)) 
                        {
                            echo '<tr>';
                            echo '<td>'. $prod['code_prod'] . '</td>';
                            echo '<td>'. $prod['desc_prod'] . '</td>';
                            echo '<td>'. $prod['qte'] . '</td>';
                            echo '<td>'. $prod['code_emp'] . '</td>';
                            echo '<td width=110>';
                            echo '<a class="btn btn-danger" href="Sortie.php?code_prod='.$prod['code_prod'].'"> Sortie <span class="glyphicon glyphicon-arrow-right"></span="../</a>';
                            echo ' ';
                            echo '</td>';
                            echo '</tr>';
                        }
            ?>
           
            </tbody>
         </table>
    </div>
             <script src="../js/jquery-3.3.1.min.js"></script>
            <script  src="../js/bootstrap.min.js"></script>


</body>
</html>
<?php } else { ?>
<?php header('Location: ../login.php'); ?>
<?php  } ?>