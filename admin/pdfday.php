<?php
require('fpdf/fpdf.php');
require_once "config/db.php";


    

$stmt = $conn->prepare("SELECT * FROM orders WHERE order_date =?");
    $stmt->execute([$_GET['q']]);
    $result = $stmt->fetchAll(); //แสดงข้อมูลทั้งหมด
    $total =0;
    foreach($result as $row)  {
     $total += $row['amount_paid'];
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
$pdf->Cell(59	,5,iconv( 'UTF-8','TIS-620','ยอดประจำวัน'),0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('angsa','',12);

$pdf->Cell(130	,5,iconv( 'UTF-8','TIS-620','ที่อยู่'),0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,iconv( 'UTF-8','TIS-620','259 หมู่ 1 ตำบลหนองบัว อำเภอภูเรือ จังหวัดเลย'),0,0);
$pdf->Cell(59	,5,iconv( 'UTF-8','TIS-620','วัน').'       '.$_GET['q'],0,0);


$pdf->Cell(130	,5,iconv( 'UTF-8','TIS-620','').'    '.'',0,0);
$pdf->Cell(25	,5,' ',0,0);
$pdf->Cell(34	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,iconv( 'UTF-8','TIS-620',''),0,0);
$pdf->Cell(34	,5,'',0,1);//end of line

//make a dummy empty cell as a vertical spacer

//invoice contents
$pdf->SetFont('angsa','',12);

$pdf->Cell(155	,5,iconv( 'UTF-8','TIS-620','วันที่'),1,0);
$pdf->Cell(34	,5,iconv( 'UTF-8','TIS-620','จำนวนเงิน'),1,1);//end of line

$pdf->SetFont('angsa','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

$pdf->Cell(155	,5,iconv( 'UTF-8','TIS-620',$_GET['q']),1,0);
$pdf->Cell(34	,5,$total.iconv( 'UTF-8','TIS-620','   บาท'),1,1,'R');//end of line



$pdf->Cell(155	,5,'',0,0);

$pdf->Cell(34	,5,iconv( 'UTF-8','TIS-620','รวมทั้งหมด').'   '.$total.iconv( 'UTF-8','TIS-620','   บาท'),1,1,'R');//end of line





















$pdf->Output();
?>
