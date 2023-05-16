<?
$emailto='contactus@yourdomain.com'; //อีเมล์ผู้รับ<br>
$subject=$_POST['header']; //หัวข้อ<br>
$header.= "Content-type: text/html; charset=utf-8\n";
$header.="from: ".$_POST['name']." E-mail : ".$_POST['mail']; //ชื่อและอีเมลผู้ส่ง<br>
$messages.= $_POST['text']."<br>"; //ข้อความ<br>
$messages.= "จาก ".$_POST['sender']."<br>"; //ข้อความ<br>
$send_mail = mail($emailto,$subject,$messages,$header);
if(!$send_mail)
{
echo"ยังไม่สามารถส่งเมลล์ได้ในขณะนี้";
}
else
{
echo "ส่งเมลล์สำเร็จ";
}
?>