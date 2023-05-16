<?php
require('fpdf/fpdf.php');
require_once "config/db.php";


    

$stmt = $conn->prepare("SELECT DATE_FORMAT(order_date,'%Y') As MyDate ,SUM(amount_paid) as pTotal FROM orders WHERE DATE_FORMAT(`order_date`,'%Y') = ?");
$stmt->execute([$_GET['q']]);
$result = $stmt->fetchAll(); //แสดงข้อมูลทั้งหมด

$total1 =0;
foreach($result as $row)  {
$total1 += $row['pTotal'];
}

                            
$pdf = new FPDF;
define('FPDF_FONTPATH','font/');
$pdf->AddPage();
$pdf->AddFont('angsa','','angsa.php');
$pdf->SetFont('angsa','',12);
//set font to arial, bold, 14pt
$pdf->Cell(0,20,'',0,1,"C");

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130	,5,'KMshop',0,0);
$pdf->Cell(59	,5,iconv( 'UTF-8','TIS-620','ยอดประจำปี'),0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('angsa','',12);

$pdf->Cell(130	,5,iconv( 'UTF-8','TIS-620','ที่อยู่'),0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,iconv( 'UTF-8','TIS-620','259 หมู่ 1 ตำบลหนองบัว อำเภอภูเรือ จังหวัดเลย'),0,0);
$pdf->Cell(25	,5,iconv( 'UTF-8','TIS-620','ปี'),0,0);
$pdf->Cell(34	,5,$_GET['q'],0,1);//end of line

$pdf->Cell(130	,5,iconv( 'UTF-8','TIS-620','').'    '.'',0,0);
$pdf->Cell(25	,5,' ',0,0);
$pdf->Cell(34	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,iconv( 'UTF-8','TIS-620',''),0,0);
$pdf->Cell(34	,5,$row['id'],0,1);//end of line

//make a dummy empty cell as a vertical spacer

//invoice contents
$pdf->SetFont('angsa','',12);

$pdf->Cell(155	,5,iconv( 'UTF-8','TIS-620','ปี'),1,0);
$pdf->Cell(34	,5,iconv( 'UTF-8','TIS-620','จำนวนเงิน'),1,1);//end of line

$pdf->SetFont('angsa','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

$pdf->Cell(155	,5,iconv( 'UTF-8','TIS-620',$_GET['q']),1,0);
$pdf->Cell(34	,5,$total1.iconv( 'UTF-8','TIS-620','   บาท'),1,1,'R');//end of line



$pdf->Cell(155	,5,'',0,0);

$pdf->Cell(34	,5,iconv( 'UTF-8','TIS-620','รวมทั้งหมด').'   '.$total1.iconv( 'UTF-8','TIS-620','   บาท'),1,1,'R');//end of line





















$pdf->Output();
?>
