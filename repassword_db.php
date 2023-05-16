<?php 

    session_start();
	require_once('PHPMailer/PHPMailerAutoload.php');
    require_once 'config/db.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    
    if (isset($_POST['signin'])) {
        $email = $_POST['email'];
        if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: repassword.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: repassword.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: repassword.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: repassword.php");
        } else if (empty($c_password)) {
            $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
            header("location: repassword.php");
        } else if ($password != $c_password) {
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: repassword.php");
        } else {
            try {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $sql = $conn->prepare("UPDATE users SET password = :password WHERE email = :email ");
                $sql->bindParam(":email", $email);
                $sql->bindParam(":password", $passwordHash);
                $sql->execute();
                header("location: signin.php");
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    if (isset($_POST['submit_re'])) {
        $email = $_POST['email'];


      
        if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: signin.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: signin.php");
        } else {
            try {

                $check_data = $conn->prepare("SELECT * FROM users WHERE email = :email");
                $check_data->bindParam(":email", $email);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($email == $row['email']) {
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
                        $mail->Subject = "ขอเปลี่ยนรหัสผ่าน";  //หัวเรื่อง emal ที่ส่ง
                        $mail->Body = " 
                    <!DOCTYPE html>
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
                                                                                    <h1 style='margin: 0; color: #066c35; direction: ltr; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 21px; font-weight: 400; letter-spacing: 2px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><span class='tinyMce-placeholder'>ขอเปลี่ยนรหัสผ่าน</span></h1>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        <table class='text_block block-3' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                                            <tr>
                                                                                <td class='pad'>
                                                                                    <div style='font-family: Arial, sans-serif'>
                                                                                        <div class='txtTinyMce-wrapper' style='font-size: 14px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 21px; color: #393d47; line-height: 1.5;'>
                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  href='http://localhost/kmshop/repassword.php'  ><font size='9'>Repassword</font></a>
                                                                                            <p style='margin: 0; mso-line-height-alt: 21px;'></p>
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
                        $mail->AddAddress("$email","ลูกค้า"); //อีเมล์และชื่อผู้รับ
                        
                        //ส่วนของการแนบไฟล์ ซึ่งทดสอบแล้วแนบได้จริงทั้งไฟล์ .rar , .jpg , png ซึ่งคงมีหลายนามสกุลที่แนบได้
                        //ตรวจสอบว่าส่งผ่านหรือไม่
                        if ($mail->Send()){
                        echo "ข้อความของคุณได้ส่งพร้อมไฟล์แนบแล้วจ้า";
                        header("location: signin.php");
                        }else{
                        echo "การส่งไม่สำเร็จ";
                        }
                    } else {
                        $_SESSION['error'] = 'อีเมลผิด';
                        header("location: repassword1.php");
                    }
                } else {
                    $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                    header("location: repassword1.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

   


?>
