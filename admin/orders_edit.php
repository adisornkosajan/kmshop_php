<?php

session_start();
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: ..signin.php');
}
require_once "config/db.php";
require_once('PHPMailer/PHPMailerAutoload.php');
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $email = $_POST['email'];


    $stmt = $conn->query("SELECT * FROM orders WHERE id = $id");
    $stmt->execute();
    $data = $stmt->fetch();
    $num=0;

    if ($status == '8') {
        $sql = $conn->prepare("UPDATE orders SET  amount_paid = :num  WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":num", $num);
        $sql->execute();

        $sql = $conn->prepare("UPDATE can_claim SET  status = :status  WHERE order_id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":status", $status);
        $sql->execute();


    }

    if ($status == '9') {


        $sql = $conn->prepare("UPDATE can_claim SET  status = :status  WHERE order_id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":status", $status);
        $sql->execute();


    }
    


    $parcel_number = $_POST['parcel_number'];

    $sql = $conn->prepare("UPDATE orders SET status  = :status ,parcel_number = :parcel_number WHERE id = :id");
    $sql->bindParam(":id", $id);
    $sql->bindParam(":status", $status);
    $sql->bindParam(":parcel_number", $parcel_number);
    $sql->execute();

    if ($status == '3') {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls"; //ตรงส่วนนี้ผมไม่แน่ใจ ลองเปลี่ยนไปมาใช้งานได้
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;  //ตรงส่วนนี้ผมไม่แน่ใจ ลองเปลี่ยนไปมาใช้งานได้
        $mail->isHTML();
        $mail->CharSet = "utf-8"; //ตั้งเป็น UTF-8 เพื่อให้อ่านภาษาไทยได้
        $mail->Username = "sb6240259114@lru.ac.th"; //ให้ใส่ Gmail ของคุณเต็มๆเลย
        $mail->Password = "molmon0707"; // ใส่รหัสผ่าน
        $mail->SetFrom = ('kmshop@domaintest.com'); //ตั้ง email เพื่อใช้เป็นเมล์อ้างอิงในการส่ง ใส่หรือไม่ใส่ก็ได้ เพราะผมก็ไม่รู้ว่ามันแาดงให้เห็นตรงไหน
        $mail->FromName = "kmshop"; //ชื่อที่ใช้ในการส่ง
        $mail->Subject = "กำลังจัดส่งสินค้าของคุณ";  //หัวเรื่อง emal ที่ส่ง
        $mail->Body = "<!DOCTYPE html>
        <html xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office' lang='en'>
        
        <head>
            <title></title>
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
            <!--[if !mso]><!-->
            <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
            <!--<![endif]-->
            <style>
                * {
                    box-sizing: border-box;
                }
        
                body {
                    margin: 0;
                    padding: 0;
                }
        
                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: inherit !important;
                }
        
                #MessageViewBody a {
                    color: inherit;
                    text-decoration: none;
                }
        
                p {
                    line-height: inherit
                }
        
                .desktop_hide,
                .desktop_hide table {
                    mso-hide: all;
                    display: none;
                    max-height: 0px;
                    overflow: hidden;
                }
        
                @media (max-width:680px) {
                    .desktop_hide table.icons-inner {
                        display: inline-block !important;
                    }
        
                    .icons-inner {
                        text-align: center;
                    }
        
                    .icons-inner td {
                        margin: 0 auto;
                    }
        
                    .image_block img.big,
                    .row-content {
                        width: 100% !important;
                    }
        
                    .mobile_hide {
                        display: none;
                    }
        
                    .stack .column {
                        width: 100%;
                        display: block;
                    }
        
                    .mobile_hide {
                        min-height: 0;
                        max-height: 0;
                        max-width: 0;
                        overflow: hidden;
                        font-size: 0px;
                    }
        
                    .desktop_hide,
                    .desktop_hide table {
                        display: table !important;
                        max-height: none !important;
                    }
                }
            </style>
        </head>
        
        <body style='background-color: #fdfce9; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;'>
            <table class='nl-container' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fdfce9;'>
                <tbody>
                    <tr>
                        <td>
                            <table class='row row-1' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fefefe; color: #000000; width: 660px;' width='660'>
                                                <tbody>
                                                    <tr>
                                                        <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='image_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='width:100%;padding-right:0px;padding-left:0px;'>
                                                                        <div class='alignment' align='center' style='line-height:10px'><a href='www.example.com' target='_blank' style='outline:none' tabindex='-1'><img class='big' src='https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/860146_844237/KW_%281%29.png' style='display: block; height: auto; border: 0; width: 660px; max-width: 100%;' width='660' alt='A wooden walkway going through a flowers and gardening supplies.' title='A wooden walkway going through a flowers and gardening supplies.'></a></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='heading_block block-2' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:20px;padding-top:20px;text-align:center;width:100%;'>
                                                                        <h1 style='margin: 0; color: #066c35; direction: ltr; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 21px; font-weight: 400; letter-spacing: 2px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><span class='tinyMce-placeholder'>กำลังดำเนินการจัดส่ง</span></h1>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='text_block block-3' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                <tr>
                                                                    <td class='pad'>
                                                                        <div style='font-family: Arial, sans-serif'>
                                                                            <div class='txtTinyMce-wrapper' style='font-size: 14px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 21px; color: #393d47; line-height: 1.5;'>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>คุณ&nbsp; " . $data['name'] . "&nbsp;</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>" . $email . "&nbsp;</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>เลขพัสดุของคุณคือ&nbsp; &nbsp; &nbsp;". $data['parcel_number']."</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>สินค้าของคุณคือ &nbsp; &nbsp;" . $data['products']. "</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>ที่อยู่ &nbsp;" . $data['address'] . "</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>เบอร์โทร&nbsp;" . $data['phone'] . "</p>
                                                                                <p style='margin: 0; mso-line-height-alt: 21px;'>&nbsp;</p>
                                                                                <p style='margin: 0; mso-line-height-alt: 21px;'>&nbsp;</p>
                                                                                <p style='margin: 0; mso-line-height-alt: 21px;'>&nbsp;</p>
                                                                                <p style='margin: 0; mso-line-height-alt: 21px;'>&nbsp;</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class='row row-2' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fefefe; color: #000000; width: 660px;' width='660'>
                                                <tbody>
                                                    <tr>
                                                        <td class='column column-1' width='33.333333333333336%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='image_block block-2' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='width:100%;padding-right:0px;padding-left:0px;padding-top:5px;'>
                                                                        <div class='alignment' align='center' style='line-height:10px'><a href='www.example.com' target='_blank' style='outline:none' tabindex='-1'><img src='https://d1oco4z2z1fhwp.cloudfront.net/templates/default/4286/c2794aab-cfa7-4fae-bbad-2eb269568408.png' style='display: block; height: auto; border: 0; width: 220px; max-width: 100%;' width='220' alt='A gardening icon.' title='A gardening icon.'></a></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='heading_block block-3' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:10px;padding-top:10px;text-align:center;width:100%;'>
                                                                        <h1 style='margin: 0; color: #066c35; direction: ltr; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: normal; letter-spacing: 2px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><strong>GARDENING</strong></h1>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='text_block block-4' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:5px;'>
                                                                        <div style='font-family: Arial, sans-serif'>
                                                                            <div class='txtTinyMce-wrapper' style='font-size: 14px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 21px; color: #393d47; line-height: 1.5;'>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>Lorem ipsum dolor sit amet, consectetur.</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class='column column-2' width='33.333333333333336%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='image_block block-2' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-top:20px;width:100%;padding-right:0px;padding-left:0px;'>
                                                                        <div class='alignment' align='center' style='line-height:10px'><a href='www.example.com' target='_blank' style='outline:none' tabindex='-1'><img src='https://d1oco4z2z1fhwp.cloudfront.net/templates/default/4286/be830d70-a72a-4cd6-a19e-5a17aca814ef.png' style='display: block; height: auto; border: 0; width: 220px; max-width: 100%;' width='220' alt='A yardwork icon.' title='A yardwork icon.'></a></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='heading_block block-3' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:10px;padding-top:10px;text-align:center;width:100%;'>
                                                                        <h1 style='margin: 0; color: #066c35; direction: ltr; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: normal; letter-spacing: 2px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><strong>YARDWORK</strong></h1>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='text_block block-4' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:5px;'>
                                                                        <div style='font-family: Arial, sans-serif'>
                                                                            <div class='txtTinyMce-wrapper' style='font-size: 14px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 21px; color: #393d47; line-height: 1.5;'>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>Lorem ipsum dolor sit amet, consectetur.</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class='column column-3' width='33.333333333333336%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='image_block block-2' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-top:15px;width:100%;padding-right:0px;padding-left:0px;'>
                                                                        <div class='alignment' align='center' style='line-height:10px'><a href='www.example.com' target='_blank' style='outline:none' tabindex='-1'><img src='https://d1oco4z2z1fhwp.cloudfront.net/templates/default/4286/2059f731-6cf3-4555-8beb-f20d70439699.png' style='display: block; height: auto; border: 0; width: 220px; max-width: 100%;' width='220' alt='A landscaping icon. ' title='A landscaping icon. '></a></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='heading_block block-3' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:10px;padding-top:10px;text-align:center;width:100%;'>
                                                                        <h1 style='margin: 0; color: #066c35; direction: ltr; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: normal; letter-spacing: 2px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><strong>LANDSCAPING</strong></h1>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='text_block block-4' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:5px;'>
                                                                        <div style='font-family: Arial, sans-serif'>
                                                                            <div class='txtTinyMce-wrapper' style='font-size: 14px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 21px; color: #393d47; line-height: 1.5;'>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>Lorem ipsum dolor sit amet, consectetur.</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class='row row-3' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fdfce9;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fdfce9; color: #000000; width: 660px;' width='660'>
                                                <tbody>
                                                    <tr>
                                                        <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='social_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-top:20px;text-align:center;padding-right:0px;padding-left:0px;'>
                                                                        <div class='alignment' style='text-align:center;'>
                                                                            <table class='social-table' width='168px' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;'>
                                                                                <tr>
                                                                                    <td style='padding:0 5px 0 5px;'><a href='https://www.facebook.com/' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-color/facebook@2x.png' width='32' height='32' alt='Facebook' title='Facebook' style='display: block; height: auto; border: 0;'></a></td>
                                                                                    <td style='padding:0 5px 0 5px;'><a href='https://twitter.com/' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-color/twitter@2x.png' width='32' height='32' alt='Twitter' title='Twitter' style='display: block; height: auto; border: 0;'></a></td>
                                                                                    <td style='padding:0 5px 0 5px;'><a href='https://plus.google.com/' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-color/googleplus@2x.png' width='32' height='32' alt='Google+' title='Google+' style='display: block; height: auto; border: 0;'></a></td>
                                                                                    <td style='padding:0 5px 0 5px;'><a href='https://instagram.com/' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-color/instagram@2x.png' width='32' height='32' alt='Instagram' title='Instagram' style='display: block; height: auto; border: 0;'></a></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='text_block block-2' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                <tr>
                                                                    <td class='pad'>
                                                                        <div style='font-family: Arial, sans-serif'>
                                                                            <div class='txtTinyMce-wrapper' style='font-size: 14px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 21px; color: #818181; line-height: 1.5;'>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>Copyright 2021@Lawn & Garden</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>Company Info</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>You can <a href='{{ unsubscribe_link }}' target='_blank' rel='noopener' style='color: #99b86c;'>unsubscribe</a> at any time.</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class='row row-4' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 660px;' width='660'>
                                                <tbody>
                                                    <tr>
                                                        <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='icons_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='vertical-align: middle; padding-bottom: 5px; padding-top: 5px; text-align: center; color: #9d9d9d; font-family: inherit; font-size: 15px;'>
                                                                        <table width='100%' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                            <tr>
                                                                                <td class='alignment' style='vertical-align: middle; text-align: center;'>
                                                                                    <!--[if vml]><table align='left' cellpadding='0' cellspacing='0' role='presentation' style='display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'><![endif]-->
                                                                                    <!--[if !vml]><!-->
                                                                                    <table class='icons-inner' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;' cellpadding='0' cellspacing='0' role='presentation'>
                                                                                        <!--<![endif]-->
                                                                                        <tr>
                                                                                            <td style='vertical-align: middle; text-align: center; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 6px;'><a href='https://www.designedwithbee.com/?utm_source=editor&utm_medium=bee_pro&utm_campaign=free_footer_link' target='_blank' style='text-decoration: none;'><img class='icon' alt='Designed with BEE' src='https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/53601_510656/Signature/bee.png' height='32' width='34' align='center' style='display: block; height: auto; margin: 0 auto; border: 0;'></a></td>
                                                                                            <td style='font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 15px; color: #9d9d9d; vertical-align: middle; letter-spacing: undefined; text-align: center;'><a href='https://www.designedwithbee.com/?utm_source=editor&utm_medium=bee_pro&utm_campaign=free_footer_link' target='_blank' style='color: #9d9d9d; text-decoration: none;'>Designed with BEE</a></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table><!-- End -->
        </body>
        
        </html>"; //รายละเอียดที่ส่ง

        $mail->AddAddress("$email", "ลูกค้า"); //อีเมล์และชื่อผู้รับ

        //ส่วนของการแนบไฟล์ ซึ่งทดสอบแล้วแนบได้จริงทั้งไฟล์ .rar , .jpg , png ซึ่งคงมีหลายนามสกุลที่แนบได้
        //ตรวจสอบว่าส่งผ่านหรือไม่
        if ($mail->Send()) {
            echo "";
        } else {
            echo "";
        }
    } elseif ($status == '4') {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls"; //ตรงส่วนนี้ผมไม่แน่ใจ ลองเปลี่ยนไปมาใช้งานได้
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;  //ตรงส่วนนี้ผมไม่แน่ใจ ลองเปลี่ยนไปมาใช้งานได้
        $mail->isHTML();
        $mail->CharSet = "utf-8"; //ตั้งเป็น UTF-8 เพื่อให้อ่านภาษาไทยได้
        $mail->Username = "sb6240259114@lru.ac.th"; //ให้ใส่ Gmail ของคุณเต็มๆเลย
        $mail->Password = "molmon0707"; // ใส่รหัสผ่าน
        $mail->SetFrom = ('kmshop@domaintest.com'); //ตั้ง email เพื่อใช้เป็นเมล์อ้างอิงในการส่ง ใส่หรือไม่ใส่ก็ได้ เพราะผมก็ไม่รู้ว่ามันแาดงให้เห็นตรงไหน
        $mail->FromName = "kmshop"; //ชื่อที่ใช้ในการส่ง
        $mail->Subject = "จัดส่งสำเร็จแล้ว";  //หัวเรื่อง emal ที่ส่ง
        $mail->Body = "<!DOCTYPE html>
        <html xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office' lang='en'>
        
        <head>
            <title></title>
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
            <!--[if !mso]><!-->
            <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
            <!--<![endif]-->
            <style>
                * {
                    box-sizing: border-box;
                }
        
                body {
                    margin: 0;
                    padding: 0;
                }
        
                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: inherit !important;
                }
        
                #MessageViewBody a {
                    color: inherit;
                    text-decoration: none;
                }
        
                p {
                    line-height: inherit
                }
        
                .desktop_hide,
                .desktop_hide table {
                    mso-hide: all;
                    display: none;
                    max-height: 0px;
                    overflow: hidden;
                }
        
                @media (max-width:680px) {
                    .desktop_hide table.icons-inner {
                        display: inline-block !important;
                    }
        
                    .icons-inner {
                        text-align: center;
                    }
        
                    .icons-inner td {
                        margin: 0 auto;
                    }
        
                    .image_block img.big,
                    .row-content {
                        width: 100% !important;
                    }
        
                    .mobile_hide {
                        display: none;
                    }
        
                    .stack .column {
                        width: 100%;
                        display: block;
                    }
        
                    .mobile_hide {
                        min-height: 0;
                        max-height: 0;
                        max-width: 0;
                        overflow: hidden;
                        font-size: 0px;
                    }
        
                    .desktop_hide,
                    .desktop_hide table {
                        display: table !important;
                        max-height: none !important;
                    }
                }
            </style>
        </head>
        
        <body style='background-color: #fdfce9; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;'>
            <table class='nl-container' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fdfce9;'>
                <tbody>
                    <tr>
                        <td>
                            <table class='row row-1' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fefefe; color: #000000; width: 660px;' width='660'>
                                                <tbody>
                                                    <tr>
                                                        <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='image_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='width:100%;padding-right:0px;padding-left:0px;'>
                                                                        <div class='alignment' align='center' style='line-height:10px'><a href='www.example.com' target='_blank' style='outline:none' tabindex='-1'><img class='big' src='https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/860146_844237/KW_%281%29.png' style='display: block; height: auto; border: 0; width: 660px; max-width: 100%;' width='660' alt='A wooden walkway going through a flowers and gardening supplies.' title='A wooden walkway going through a flowers and gardening supplies.'></a></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='heading_block block-2' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:20px;padding-top:20px;text-align:center;width:100%;'>
                                                                        <h1 style='margin: 0; color: #066c35; direction: ltr; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 21px; font-weight: 400; letter-spacing: 2px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><span class='tinyMce-placeholder'>พัสดุถูกจัดส่งเสร็จสินแล้ว</span></h1>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='text_block block-3' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                <tr>
                                                                    <td class='pad'>
                                                                        <div style='font-family: Arial, sans-serif'>
                                                                            <div class='txtTinyMce-wrapper' style='font-size: 14px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 21px; color: #393d47; line-height: 1.5;'>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>คุณ&nbsp; " . $data['name'] . "&nbsp;</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>" . $email . "&nbsp;</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>เลขพัสดุของคุณคือ&nbsp; &nbsp; &nbsp;". $data['parcel_number']."</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>สินค้าของคุณคือ &nbsp; &nbsp;" . $data['products']. "</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>ที่อยู่ &nbsp;" . $data['address'] . "</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>เบอร์โทร&nbsp;" . $data['phone'] . "</p>
                                                                                <p style='margin: 0; mso-line-height-alt: 21px;'>&nbsp;</p>
                                                                                <p style='margin: 0; mso-line-height-alt: 21px;'>&nbsp;</p>
                                                                                <p style='margin: 0; mso-line-height-alt: 21px;'>&nbsp;</p>
                                                                                <p style='margin: 0; mso-line-height-alt: 21px;'>&nbsp;</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class='row row-2' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fefefe; color: #000000; width: 660px;' width='660'>
                                                <tbody>
                                                    <tr>
                                                        <td class='column column-1' width='33.333333333333336%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='image_block block-2' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='width:100%;padding-right:0px;padding-left:0px;padding-top:5px;'>
                                                                        <div class='alignment' align='center' style='line-height:10px'><a href='www.example.com' target='_blank' style='outline:none' tabindex='-1'><img src='https://d1oco4z2z1fhwp.cloudfront.net/templates/default/4286/c2794aab-cfa7-4fae-bbad-2eb269568408.png' style='display: block; height: auto; border: 0; width: 220px; max-width: 100%;' width='220' alt='A gardening icon.' title='A gardening icon.'></a></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='heading_block block-3' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:10px;padding-top:10px;text-align:center;width:100%;'>
                                                                        <h1 style='margin: 0; color: #066c35; direction: ltr; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: normal; letter-spacing: 2px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><strong>GARDENING</strong></h1>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='text_block block-4' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:5px;'>
                                                                        <div style='font-family: Arial, sans-serif'>
                                                                            <div class='txtTinyMce-wrapper' style='font-size: 14px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 21px; color: #393d47; line-height: 1.5;'>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>Lorem ipsum dolor sit amet, consectetur.</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class='column column-2' width='33.333333333333336%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='image_block block-2' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-top:20px;width:100%;padding-right:0px;padding-left:0px;'>
                                                                        <div class='alignment' align='center' style='line-height:10px'><a href='www.example.com' target='_blank' style='outline:none' tabindex='-1'><img src='https://d1oco4z2z1fhwp.cloudfront.net/templates/default/4286/be830d70-a72a-4cd6-a19e-5a17aca814ef.png' style='display: block; height: auto; border: 0; width: 220px; max-width: 100%;' width='220' alt='A yardwork icon.' title='A yardwork icon.'></a></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='heading_block block-3' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:10px;padding-top:10px;text-align:center;width:100%;'>
                                                                        <h1 style='margin: 0; color: #066c35; direction: ltr; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: normal; letter-spacing: 2px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><strong>YARDWORK</strong></h1>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='text_block block-4' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:5px;'>
                                                                        <div style='font-family: Arial, sans-serif'>
                                                                            <div class='txtTinyMce-wrapper' style='font-size: 14px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 21px; color: #393d47; line-height: 1.5;'>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>Lorem ipsum dolor sit amet, consectetur.</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class='column column-3' width='33.333333333333336%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='image_block block-2' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-top:15px;width:100%;padding-right:0px;padding-left:0px;'>
                                                                        <div class='alignment' align='center' style='line-height:10px'><a href='www.example.com' target='_blank' style='outline:none' tabindex='-1'><img src='https://d1oco4z2z1fhwp.cloudfront.net/templates/default/4286/2059f731-6cf3-4555-8beb-f20d70439699.png' style='display: block; height: auto; border: 0; width: 220px; max-width: 100%;' width='220' alt='A landscaping icon. ' title='A landscaping icon. '></a></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='heading_block block-3' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:10px;padding-top:10px;text-align:center;width:100%;'>
                                                                        <h1 style='margin: 0; color: #066c35; direction: ltr; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: normal; letter-spacing: 2px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><strong>LANDSCAPING</strong></h1>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='text_block block-4' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:5px;'>
                                                                        <div style='font-family: Arial, sans-serif'>
                                                                            <div class='txtTinyMce-wrapper' style='font-size: 14px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 21px; color: #393d47; line-height: 1.5;'>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>Lorem ipsum dolor sit amet, consectetur.</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class='row row-3' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fdfce9;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fdfce9; color: #000000; width: 660px;' width='660'>
                                                <tbody>
                                                    <tr>
                                                        <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='social_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-top:20px;text-align:center;padding-right:0px;padding-left:0px;'>
                                                                        <div class='alignment' style='text-align:center;'>
                                                                            <table class='social-table' width='168px' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;'>
                                                                                <tr>
                                                                                    <td style='padding:0 5px 0 5px;'><a href='https://www.facebook.com/' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-color/facebook@2x.png' width='32' height='32' alt='Facebook' title='Facebook' style='display: block; height: auto; border: 0;'></a></td>
                                                                                    <td style='padding:0 5px 0 5px;'><a href='https://twitter.com/' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-color/twitter@2x.png' width='32' height='32' alt='Twitter' title='Twitter' style='display: block; height: auto; border: 0;'></a></td>
                                                                                    <td style='padding:0 5px 0 5px;'><a href='https://plus.google.com/' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-color/googleplus@2x.png' width='32' height='32' alt='Google+' title='Google+' style='display: block; height: auto; border: 0;'></a></td>
                                                                                    <td style='padding:0 5px 0 5px;'><a href='https://instagram.com/' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-color/instagram@2x.png' width='32' height='32' alt='Instagram' title='Instagram' style='display: block; height: auto; border: 0;'></a></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='text_block block-2' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                <tr>
                                                                    <td class='pad'>
                                                                        <div style='font-family: Arial, sans-serif'>
                                                                            <div class='txtTinyMce-wrapper' style='font-size: 14px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 21px; color: #818181; line-height: 1.5;'>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>Copyright 2021@Lawn & Garden</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>Company Info</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>You can <a href='{{ unsubscribe_link }}' target='_blank' rel='noopener' style='color: #99b86c;'>unsubscribe</a> at any time.</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class='row row-4' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 660px;' width='660'>
                                                <tbody>
                                                    <tr>
                                                        <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='icons_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='vertical-align: middle; padding-bottom: 5px; padding-top: 5px; text-align: center; color: #9d9d9d; font-family: inherit; font-size: 15px;'>
                                                                        <table width='100%' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                            <tr>
                                                                                <td class='alignment' style='vertical-align: middle; text-align: center;'>
                                                                                    <!--[if vml]><table align='left' cellpadding='0' cellspacing='0' role='presentation' style='display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'><![endif]-->
                                                                                    <!--[if !vml]><!-->
                                                                                    <table class='icons-inner' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;' cellpadding='0' cellspacing='0' role='presentation'>
                                                                                        <!--<![endif]-->
                                                                                        <tr>
                                                                                            <td style='vertical-align: middle; text-align: center; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 6px;'><a href='https://www.designedwithbee.com/?utm_source=editor&utm_medium=bee_pro&utm_campaign=free_footer_link' target='_blank' style='text-decoration: none;'><img class='icon' alt='Designed with BEE' src='https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/53601_510656/Signature/bee.png' height='32' width='34' align='center' style='display: block; height: auto; margin: 0 auto; border: 0;'></a></td>
                                                                                            <td style='font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 15px; color: #9d9d9d; vertical-align: middle; letter-spacing: undefined; text-align: center;'><a href='https://www.designedwithbee.com/?utm_source=editor&utm_medium=bee_pro&utm_campaign=free_footer_link' target='_blank' style='color: #9d9d9d; text-decoration: none;'>Designed with BEE</a></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table><!-- End -->
        </body>
        
        </html>"; //รายละเอียดที่ส่ง
        $mail->AddAddress("$email", "ลูกค้า"); //อีเมล์และชื่อผู้รับ

        //ส่วนของการแนบไฟล์ ซึ่งทดสอบแล้วแนบได้จริงทั้งไฟล์ .rar , .jpg , png ซึ่งคงมีหลายนามสกุลที่แนบได้
        //ตรวจสอบว่าส่งผ่านหรือไม่
        if ($mail->Send()) {
            echo "";
        } else {
            echo "";
        }
    }elseif ($status == '1') {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls"; //ตรงส่วนนี้ผมไม่แน่ใจ ลองเปลี่ยนไปมาใช้งานได้
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;  //ตรงส่วนนี้ผมไม่แน่ใจ ลองเปลี่ยนไปมาใช้งานได้
        $mail->isHTML();
        $mail->CharSet = "utf-8"; //ตั้งเป็น UTF-8 เพื่อให้อ่านภาษาไทยได้
        $mail->Username = "sb6240259114@lru.ac.th"; //ให้ใส่ Gmail ของคุณเต็มๆเลย
        $mail->Password = "molmon0707"; // ใส่รหัสผ่าน
        $mail->SetFrom = ('kmshop@domaintest.com'); //ตั้ง email เพื่อใช้เป็นเมล์อ้างอิงในการส่ง ใส่หรือไม่ใส่ก็ได้ เพราะผมก็ไม่รู้ว่ามันแาดงให้เห็นตรงไหน
        $mail->FromName = "kmshop"; //ชื่อที่ใช้ในการส่ง
        $mail->Subject = "ยืนยันการสั่งซื้อสินค้าของคุณแล้ว";  //หัวเรื่อง emal ที่ส่ง
        $mail->Body = "<!DOCTYPE html>
        <html xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office' lang='en'>
        
        <head>
            <title></title>
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
            <!--[if !mso]><!-->
            <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
            <!--<![endif]-->
            <style>
                * {
                    box-sizing: border-box;
                }
        
                body {
                    margin: 0;
                    padding: 0;
                }
        
                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: inherit !important;
                }
        
                #MessageViewBody a {
                    color: inherit;
                    text-decoration: none;
                }
        
                p {
                    line-height: inherit
                }
        
                .desktop_hide,
                .desktop_hide table {
                    mso-hide: all;
                    display: none;
                    max-height: 0px;
                    overflow: hidden;
                }
        
                @media (max-width:680px) {
                    .desktop_hide table.icons-inner {
                        display: inline-block !important;
                    }
        
                    .icons-inner {
                        text-align: center;
                    }
        
                    .icons-inner td {
                        margin: 0 auto;
                    }
        
                    .image_block img.big,
                    .row-content {
                        width: 100% !important;
                    }
        
                    .mobile_hide {
                        display: none;
                    }
        
                    .stack .column {
                        width: 100%;
                        display: block;
                    }
        
                    .mobile_hide {
                        min-height: 0;
                        max-height: 0;
                        max-width: 0;
                        overflow: hidden;
                        font-size: 0px;
                    }
        
                    .desktop_hide,
                    .desktop_hide table {
                        display: table !important;
                        max-height: none !important;
                    }
                }
            </style>
        </head>
        
        <body style='background-color: #fdfce9; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;'>
            <table class='nl-container' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fdfce9;'>
                <tbody>
                    <tr>
                        <td>
                            <table class='row row-1' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fefefe; color: #000000; width: 660px;' width='660'>
                                                <tbody>
                                                    <tr>
                                                        <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='image_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='width:100%;padding-right:0px;padding-left:0px;'>
                                                                        <div class='alignment' align='center' style='line-height:10px'><a href='www.example.com' target='_blank' style='outline:none' tabindex='-1'><img class='big' src='https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/860146_844237/KW_%281%29.png' style='display: block; height: auto; border: 0; width: 660px; max-width: 100%;' width='660' alt='A wooden walkway going through a flowers and gardening supplies.' title='A wooden walkway going through a flowers and gardening supplies.'></a></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='heading_block block-2' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:20px;padding-top:20px;text-align:center;width:100%;'>
                                                                        <h1 style='margin: 0; color: #066c35; direction: ltr; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 21px; font-weight: 400; letter-spacing: 2px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><span class='tinyMce-placeholder'>ขอบคุณที่สั่งซื้อสินค้า</span></h1>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='text_block block-3' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                <tr>
                                                                    <td class='pad'>
                                                                        <div style='font-family: Arial, sans-serif'>
                                                                            <div class='txtTinyMce-wrapper' style='font-size: 14px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 21px; color: #393d47; line-height: 1.5;'>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>คุณ&nbsp; " . $data['name'] . "&nbsp;</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>" . $email . "&nbsp;</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>สินค้าของคุณคือ &nbsp; &nbsp;" . $data['products']. "</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>ที่อยู่ &nbsp;" . $data['address'] . "</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: left;'>เบอร์โทร&nbsp;" . $data['phone'] . "</p>
                                                                                <p style='margin: 0; mso-line-height-alt: 21px;'>&nbsp;</p>
                                                                                <p style='margin: 0; mso-line-height-alt: 21px;'>&nbsp;</p>
                                                                                <p style='margin: 0; mso-line-height-alt: 21px;'>&nbsp;</p>
                                                                                <p style='margin: 0; mso-line-height-alt: 21px;'>&nbsp;</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class='row row-2' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fefefe; color: #000000; width: 660px;' width='660'>
                                                <tbody>
                                                    <tr>
                                                        <td class='column column-1' width='33.333333333333336%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='image_block block-2' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='width:100%;padding-right:0px;padding-left:0px;padding-top:5px;'>
                                                                        <div class='alignment' align='center' style='line-height:10px'><a href='www.example.com' target='_blank' style='outline:none' tabindex='-1'><img src='https://d1oco4z2z1fhwp.cloudfront.net/templates/default/4286/c2794aab-cfa7-4fae-bbad-2eb269568408.png' style='display: block; height: auto; border: 0; width: 220px; max-width: 100%;' width='220' alt='A gardening icon.' title='A gardening icon.'></a></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='heading_block block-3' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:10px;padding-top:10px;text-align:center;width:100%;'>
                                                                        <h1 style='margin: 0; color: #066c35; direction: ltr; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: normal; letter-spacing: 2px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><strong>GARDENING</strong></h1>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='text_block block-4' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:5px;'>
                                                                        <div style='font-family: Arial, sans-serif'>
                                                                            <div class='txtTinyMce-wrapper' style='font-size: 14px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 21px; color: #393d47; line-height: 1.5;'>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>Lorem ipsum dolor sit amet, consectetur.</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class='column column-2' width='33.333333333333336%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='image_block block-2' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-top:20px;width:100%;padding-right:0px;padding-left:0px;'>
                                                                        <div class='alignment' align='center' style='line-height:10px'><a href='www.example.com' target='_blank' style='outline:none' tabindex='-1'><img src='https://d1oco4z2z1fhwp.cloudfront.net/templates/default/4286/be830d70-a72a-4cd6-a19e-5a17aca814ef.png' style='display: block; height: auto; border: 0; width: 220px; max-width: 100%;' width='220' alt='A yardwork icon.' title='A yardwork icon.'></a></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='heading_block block-3' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:10px;padding-top:10px;text-align:center;width:100%;'>
                                                                        <h1 style='margin: 0; color: #066c35; direction: ltr; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: normal; letter-spacing: 2px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><strong>YARDWORK</strong></h1>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='text_block block-4' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:5px;'>
                                                                        <div style='font-family: Arial, sans-serif'>
                                                                            <div class='txtTinyMce-wrapper' style='font-size: 14px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 21px; color: #393d47; line-height: 1.5;'>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>Lorem ipsum dolor sit amet, consectetur.</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class='column column-3' width='33.333333333333336%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='image_block block-2' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-top:15px;width:100%;padding-right:0px;padding-left:0px;'>
                                                                        <div class='alignment' align='center' style='line-height:10px'><a href='www.example.com' target='_blank' style='outline:none' tabindex='-1'><img src='https://d1oco4z2z1fhwp.cloudfront.net/templates/default/4286/2059f731-6cf3-4555-8beb-f20d70439699.png' style='display: block; height: auto; border: 0; width: 220px; max-width: 100%;' width='220' alt='A landscaping icon. ' title='A landscaping icon. '></a></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='heading_block block-3' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:10px;padding-top:10px;text-align:center;width:100%;'>
                                                                        <h1 style='margin: 0; color: #066c35; direction: ltr; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: normal; letter-spacing: 2px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><strong>LANDSCAPING</strong></h1>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='text_block block-4' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:5px;'>
                                                                        <div style='font-family: Arial, sans-serif'>
                                                                            <div class='txtTinyMce-wrapper' style='font-size: 14px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 21px; color: #393d47; line-height: 1.5;'>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>Lorem ipsum dolor sit amet, consectetur.</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class='row row-3' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fdfce9;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fdfce9; color: #000000; width: 660px;' width='660'>
                                                <tbody>
                                                    <tr>
                                                        <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='social_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='padding-top:20px;text-align:center;padding-right:0px;padding-left:0px;'>
                                                                        <div class='alignment' style='text-align:center;'>
                                                                            <table class='social-table' width='168px' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;'>
                                                                                <tr>
                                                                                    <td style='padding:0 5px 0 5px;'><a href='https://www.facebook.com/' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-color/facebook@2x.png' width='32' height='32' alt='Facebook' title='Facebook' style='display: block; height: auto; border: 0;'></a></td>
                                                                                    <td style='padding:0 5px 0 5px;'><a href='https://twitter.com/' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-color/twitter@2x.png' width='32' height='32' alt='Twitter' title='Twitter' style='display: block; height: auto; border: 0;'></a></td>
                                                                                    <td style='padding:0 5px 0 5px;'><a href='https://plus.google.com/' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-color/googleplus@2x.png' width='32' height='32' alt='Google+' title='Google+' style='display: block; height: auto; border: 0;'></a></td>
                                                                                    <td style='padding:0 5px 0 5px;'><a href='https://instagram.com/' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-color/instagram@2x.png' width='32' height='32' alt='Instagram' title='Instagram' style='display: block; height: auto; border: 0;'></a></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class='text_block block-2' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                <tr>
                                                                    <td class='pad'>
                                                                        <div style='font-family: Arial, sans-serif'>
                                                                            <div class='txtTinyMce-wrapper' style='font-size: 14px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 21px; color: #818181; line-height: 1.5;'>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>Copyright 2021@Lawn & Garden</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>Company Info</p>
                                                                                <p style='margin: 0; font-size: 14px; text-align: center;'>You can <a href='{{ unsubscribe_link }}' target='_blank' rel='noopener' style='color: #99b86c;'>unsubscribe</a> at any time.</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class='row row-4' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 660px;' width='660'>
                                                <tbody>
                                                    <tr>
                                                        <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                            <table class='icons_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                <tr>
                                                                    <td class='pad' style='vertical-align: middle; padding-bottom: 5px; padding-top: 5px; text-align: center; color: #9d9d9d; font-family: inherit; font-size: 15px;'>
                                                                        <table width='100%' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                            <tr>
                                                                                <td class='alignment' style='vertical-align: middle; text-align: center;'>
                                                                                    <!--[if vml]><table align='left' cellpadding='0' cellspacing='0' role='presentation' style='display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'><![endif]-->
                                                                                    <!--[if !vml]><!-->
                                                                                    <table class='icons-inner' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;' cellpadding='0' cellspacing='0' role='presentation'>
                                                                                        <!--<![endif]-->
                                                                                        <tr>
                                                                                            <td style='vertical-align: middle; text-align: center; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 6px;'><a href='https://www.designedwithbee.com/?utm_source=editor&utm_medium=bee_pro&utm_campaign=free_footer_link' target='_blank' style='text-decoration: none;'><img class='icon' alt='Designed with BEE' src='https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/53601_510656/Signature/bee.png' height='32' width='34' align='center' style='display: block; height: auto; margin: 0 auto; border: 0;'></a></td>
                                                                                            <td style='font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 15px; color: #9d9d9d; vertical-align: middle; letter-spacing: undefined; text-align: center;'><a href='https://www.designedwithbee.com/?utm_source=editor&utm_medium=bee_pro&utm_campaign=free_footer_link' target='_blank' style='color: #9d9d9d; text-decoration: none;'>Designed with BEE</a></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table><!-- End -->
        </body>
        
        </html>"; //รายละเอียดที่ส่ง
        $mail->AddAddress("$email", "ลูกค้า"); //อีเมล์และชื่อผู้รับ

        //ส่วนของการแนบไฟล์ ซึ่งทดสอบแล้วแนบได้จริงทั้งไฟล์ .rar , .jpg , png ซึ่งคงมีหลายนามสกุลที่แนบได้
        //ตรวจสอบว่าส่งผ่านหรือไม่
        if ($mail->Send()) {
            echo "";
        } else {
            echo "";
        }
    }

 
    



    if ($sql) {
        $_SESSION['success'] = "Data has been updated successfully";
        header("location: orders.php");
    } else {
        $_SESSION['error'] = "Data has not been updated successfully";
        header("location: Proflie.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>สถานะการจัดส่ง</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


<body id="page-top">

    <?php
    include 'admin_head.php';
    include 'admin_nva.php';


    ?>

    <table class="table table-bordered" id="dataTable" width="80%" cellspacing="0">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">สถานะการจัดส่ง</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="container mt-5">
                        <h1>แก้ไขข้อมูล</h1>
                        <hr>
                        <form action="orders_edit.php" method="post" enctype="multipart/form-data">
                            <?php
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $stmt = $conn->query("SELECT * FROM orders WHERE id = $id");
                                $stmt->execute();
                                $data = $stmt->fetch();
                            }
                            ?>
                            <div class="mb-3">
                                <label for="id" class="col-form-label">รหัสรายการสั่งซื้อ:</label>
                                <input type="text" readonly value="<?php echo $data['id']; ?>" required class="form-control" name="id">
                            </div>
                            <select name="status" class="form-control" >
                                <option value="" selected disabled><?php if($data['status']== 1 ){
                                            echo "ยืนยันการสั่งซื้อสินค้า";
                                        } elseif($data['status']== 2){
                                            echo "รอการจัดส่ง";
                                        } elseif($data['status']== 3){
                                            echo "กำลังดำเนินการจัดส่ง";
                                        } elseif($data['status']== 4){
                                            echo "พัสดุถูกจัดส่งเสร็จสินแล้ว";
                                        } elseif($data['status']== 5){
                                            echo "ยกเลิกสินค้า";
                                        } elseif($data['status']== 6){
                                            echo "ตรวจสอบข้อมูล";
                                        } elseif($data['status']== 7){
                                            echo "เคลมสินค้า";
                                        } elseif($data['status']== 8){
                                            echo "ยืนยันหลังจากเคลม";
                                        } elseif($data['status']== 9){
                                            echo "ไม่สามารถเคลมสินค้าได้";
                                        } elseif($data['status']== 10){
                                            echo "รอชำระเงิน";
                                        } 
                                        ?></option>
                                <option value="1">ยืนยันการสั่งซื้อสินค้า</option>
                                <option value="2">รอการจัดส่ง</option>
                                <option value="3">กำลังดำเนินการจัดส่ง</option>
                                <option value="4">พัสดุถูกจัดส่งเสร็จสินแล้ว</option>
                                <option value="5">ยกเลิกสินค้า</option>
                                <option value="8">ยืนยันหลังจากเคลม</option>
                                <option value="9">ไม่สามารถเคลมสินค้าได้</option>
                                <option value="10">รอชำระเงิน</option>
                                <option value="6">ตรวจสอบข้อมูล</option>
                            </select>
                            <input type="hidden" class="email" name="email" value="<?= $data['email'] ?>">

                            <div class="mb-3">
                                <label for="parcel_number" class="col-form-label">เลขพัสดุ</label>
                                <input type="text" value="<?php echo $data['parcel_number']; ?>" required class="form-control" name="parcel_number">
                            </div>
                            <hr>
                            <a href="orders.php" class="btn btn-outline-secondary">ย้อนกลับ</a>
                            <button type="submit" name="update" class="btn btn-outline-primary">อัพเดต</button>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
    </table>
    </div>
    <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">ขอให้วันนี้เป็นวันที่ดี</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                    <a class="btn btn-danger" href="logout.php">ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
</body>

</html>