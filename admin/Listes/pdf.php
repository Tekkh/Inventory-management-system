<?php session_start();
 if (isset($_SESSION["admin"])) { ?>

<?php
	require("../fpdf181/fpdf.php");
	require '../connectdb.php';

	class myPDF extends FPDF{
		function header(){
			$this->image('../img/tkm3.jpg',10,10, -280);
			$this->SetFont('arial', 'B', 30);
			$this->Cell(276,50,'Liste des Produits', 0,0,'C');
			$this->Line(20,50,270,50);
			$this->ln(5);
			$this->ln();
			$this->ln(5);
			


		}
		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial', '', 8);
			$this->Cell(0,10,'Page'.$this->PageNo() .'/{nb}' , 0,0,'C');
		}
		function headerTable(){
			$this->SetFont('Times', 'B', 12);
			$this->Cell(63,10,'Code Produit', 1,0,'C');
			$this->Cell(85,10,'Description Produit', 1,0,'C');
			$this->Cell(63,10,'Quantite', 1,0,'C');
			$this->Cell(63,10,'Emplacement', 1,0,'C');
			$this->ln();
		}
		function viewTable($cnx){
			$this->SetFont('Times', '', 12);

						$sql="SELECT * FROM `produit` ORDER by code_prod ";
		 				$result= mysqli_query($cnx,$sql) or die("Bad query");
                        while($data = mysqli_fetch_array($result)) 
                        {
                        	$this->Cell(63,10, $data['code_prod'], 1,0,'C');
                            $this->Cell(85,10, $data['desc_prod'], 1,0,'C');
                            $this->Cell(63,10, $data['qte'], 1,0,'C');
                            $this->Cell(63,10, $data['code_emp'], 1,0,'C');
                            $this->ln();
  
                        }

		}

	}

	$pdf = new myPDF();
	$pdf->SetTitle('TK Management');
	$pdf->AliasNbPages(); 
	$pdf->AddPage('L', 'A4' , 0);
	$pdf->headerTable();
	$pdf->viewTable($cnx);
	$pdf->Output();
 ?>
<?php } else { header('Location: ../../login.php'); } ?>