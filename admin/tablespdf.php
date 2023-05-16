<?php
require('fpdf/fpdf.php');
require_once "config/db.php";


    $id = $_GET['id'];
    $stmt = $conn->query("SELECT * FROM orders WHERE id = $id");
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

                            
$pdf = new FPDF;
define('FPDF_FONTPATH','font/');
$pdf->AddPage();
$pdf->AddFont('angsa','','angsa.php');
$pdf->SetFont('angsa','',12);
//set font to arial, bold, 14pt
$pdf->Cell(0,20,'',0,1,"C");

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130	,5,'KMshop',0,0);
$pdf->Cell(59	,5,iconv( 'UTF-8','TIS-620','ใบกำกับภาษี'),0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('angsa','',12);

$pdf->Cell(130	,5,iconv( 'UTF-8','TIS-620','ที่อยู่'),0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,iconv( 'UTF-8','TIS-620','259 หมู่ 1 ตำบลหนองบัว อำเภอภูเรือ จังหวัดเลย'),0,0);
$pdf->Cell(25	,5,iconv( 'UTF-8','TIS-620','วัน'),0,0);
$pdf->Cell(34	,5,$row['order_date'],0,1);//end of line

$pdf->Cell(130	,5,iconv( 'UTF-8','TIS-620','เบอร์โทรศัพท์').'    '.'0641896800',0,0);
$pdf->Cell(25	,5,'Invoice #',0,0);
$pdf->Cell(34	,5,'[1234567]',0,1);//end of line

$pdf->Cell(130	,5,'Fax [+12345678]',0,0);
$pdf->Cell(25	,5,iconv( 'UTF-8','TIS-620','รหัสลูกค้า'),0,0);
$pdf->Cell(34	,5,$row['id'],0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//billing address
$pdf->Cell(100	,5,'',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,iconv( 'UTF-8','TIS-620','ชื่อ').'    '.iconv( 'UTF-8','TIS-620',$row['name']),0,1);

$pdf->Cell(10	,5,'',0,0);

$pdf->Cell(10	,5,iconv( 'UTF-8','TIS-620','ที่อยู่'),0,0);
$pdf->Cell(90	,5,iconv( 'UTF-8','TIS-620',$row['address']),0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,iconv( 'UTF-8','TIS-620','เบอร์โทรศัพท์').'    '.$row['phone'],0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('angsa','',12);

$pdf->Cell(130	,5,iconv( 'UTF-8','TIS-620','รายการสินค้า'),1,0);
$pdf->Cell(25	,5,iconv( 'UTF-8','TIS-620','ภาษี'),1,0);
$pdf->Cell(34	,5,iconv( 'UTF-8','TIS-620','ราคา'),1,1);//end of line

$pdf->SetFont('angsa','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

$pdf->Cell(130	,5,iconv( 'UTF-8','TIS-620',$row['products']),0,0);
$pdf->Cell(25	,5,'-',0,0);
$pdf->Cell(34	,5,$row['amount_paid'].iconv( 'UTF-8','TIS-620','   บาท'),0,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);



$pdf->Cell(130	,5,'',0,0);


//summary
$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Subtotal',0,0);
$pdf->Cell(4	,5,'$',0,0);
$pdf->Cell(30	,5,'4,450',0,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);

$pdf->Cell(4	,5,'',0,0);
$pdf->Cell(30	,5,'',0,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,iconv( 'UTF-8','TIS-620','ค่าส่ง'),0,0);
$pdf->Cell(4	,5,'',0,0);
$pdf->Cell(30	,5,iconv( 'UTF-8','TIS-620','ฟรี'),0,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,iconv( 'UTF-8','TIS-620','ราคารวมทั้งหมด'),0,0);
$pdf->Cell(4	,5,'',0,0);
$pdf->Cell(30	,5,$row['amount_paid'].iconv( 'UTF-8','TIS-620','   บาท'),0,1,'R');//end of line





















$pdf->Output();
?>
