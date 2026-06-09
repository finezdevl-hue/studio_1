<?php
require_once '../db.php';
include_once("sendmail/class.phpmailer.php");

if(is_null(trim($_POST['name'])) || is_null(trim($_POST['phone'])) || is_null(trim($_POST['email'])))               
         {
            http_response_code(500);
            echo "Oops! Something went wrong, we couldn't send your message.";
            return;
         }

$name = htmlentities($_POST['name'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
$phone = htmlentities($_POST['phone'], ENT_QUOTES);
$phone = "+" . str_replace("+", "", $phone);
$service = htmlentities($_POST['service'], ENT_QUOTES);
$location = htmlentities($_POST['location'], ENT_QUOTES);
$message = htmlentities($_POST['message'], ENT_QUOTES);
$url='';
$host='smtp.gmail.com';
$username='fineztechnologies@gmail.com';
$password='gdlxyptftlwxcbrw';
$fromname='Contact alert from Finez';
$subject = "studio  :: Contact Enquiry";
$contact_email = get_setting($conn, 'contact_email');
$emailsCC = array($contact_email ? $contact_email : "finezseo@gmail.com");






$mail = new PHPMailer;
$mail->isHTML(true);           
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = $host;  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;// Enable SMTP authentication
$mail->SMTPSecure = 'ssl'; // For gmail smtp only
$mail->Port = "465";// For gmail smtp only
$mail->Username = $username;                 // SMTP username
$mail->Password = $password; 
$mail->From = $username;
$mail->FromName = $fromname;
$mail->addAddress($username, $subject);
$mail->isHTML(true);                                 // Set email format to HTML



$mail->Body = "<!DOCTYPE html>
<html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'>
<head>
     <meta charset='utf-8'><meta name='viewport' content='width=device-width,initial-scale=1'><meta name='x-apple-disable-message-reformatting'><title></title>
    <style>div,h1,p,td{font-family:Arial,sans-serif}@media screen and (max-width:530px){.unsub{display:block;padding:8px;margin-top:14px;border-radius:6px;background-color:#555;text-decoration:none!important;font-weight:700}.col-lge{max-width:100%!important}}@media screen and (min-width:531px){.col-sml{max-width:27%!important}.col-lge{max-width:73%!important}}</style>
</head>
<body style='margin:0;padding:0;word-spacing:normal;background-color:#e3e3e3;'>
    <div role='article' aria-roledescription='email' lang='en' style='text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#e3e3e3;'>
        <table role='presentation' style='width:100%;border:none;border-spacing:0;'>
            <tr>
                <td align='center' style='padding:0;'>
                    <!--[if mso]>
                    <table role='presentation' align='center' style='width:600px;'>
                    <tr>
                    <td>
                    <![endif]-->
                    <table role='presentation' style='width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;'>
                        <!--Header Start-->
                        <tr>
                            <td style='padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;'>
     <!--Need customer domain here-->                <a href='zillalstudio.com' target='_blank' style='text-decoration:none;'><img src='https://zillalstudio.com/mailapi/images/logo.png' width='165' alt='Logo' style='width:165px;max-width:80%;height:auto;border:none;text-decoration:none;color:#ffffff;'></a>
                            </td>
                        </tr>
                        <tr><td style=padding:30px;background-color:#fff><h1 style=margin-top:0;margin-bottom:16px;font-size:26px;line-height:32px;font-weight:700;letter-spacing:-.02em>Got An Enquiry Email!</h1><p style=margin:0>Please contact the customer ASAP
                        <!--Header End-->

                        <tr><td style='padding:35px 30px 11px 30px;font-size:0;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);'><div class='col-sml' style='display:inline-block;width:100%;max-width:145px;vertical-align:top;text-align:left;font-family:Arial,sans-serif;font-size:14px;color:#363636;'>
                                    <img src='https://zillalstudio.com/mailapi/images/customer.png' width='40' alt='' style='width:40px;max-width:80%;margin-bottom:20px;'>
                                </div>
                               
                                <div class='col-lge' style='display:inline-block;width:100%;max-width:395px;vertical-align:top;padding-bottom:20px;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;'>
                                    <p style='margin-top:0;margin-bottom:12px;'> ".$name."</p>
                                    </div></td></tr>

                        <tr><td style='padding:35px 30px 11px 30px;font-size:0;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);'><div class='col-sml' style='display:inline-block;width:100%;max-width:145px;vertical-align:top;text-align:left;font-family:Arial,sans-serif;font-size:14px;color:#363636;'>
                                    <img src='https://zillalstudio.com/mailapi/images/email.png' width='40' alt='' style='width:40px;max-width:80%;margin-bottom:20px;'>
                                </div>
                               
                                <div class='col-lge' style='display:inline-block;width:100%;max-width:395px;vertical-align:top;padding-bottom:20px;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;'>
                                    <p style='margin-top:0;margin-bottom:12px;'>email ".$email."</p>
                                    <p style='margin:0;'><a href='mailto:".$email."' style='background: #ff3884; text-decoration: none; padding: 10px 25px; color: #ffffff; border-radius: 4px; display:inline-block; mso-padding-alt:0;text-underline-color:#ff3884'>
                                           <span style='mso-text-raise:10pt;font-weight:bold;'>".$email."</span>
                        </a></p></div></td></tr>



                        <tr><td style='padding:35px 30px 11px 30px;font-size:0;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);'><div class='col-sml' style='display:inline-block;width:100%;max-width:145px;vertical-align:top;text-align:left;font-family:Arial,sans-serif;font-size:14px;color:#363636;'>
                                    <img src='https://zillalstudio.com/mailapi/images/call.png' width='40' alt='' style='width:40px;max-width:80%;margin-bottom:20px;'>
                                </div>
                               
                                <div class='col-lge' style='display:inline-block;width:100%;max-width:395px;vertical-align:top;padding-bottom:20px;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;'>
                                    <p style='margin-top:0;margin-bottom:12px;'>Please call to this number ".$phone."</p>
                                    <p style='margin:0;'><a href='tel:".$phone."' style='background: #ff3884; text-decoration: none; padding: 10px 25px; color: #ffffff; border-radius: 4px; display:inline-block; mso-padding-alt:0;text-underline-color:#ff3884'>
                                           <span style='mso-text-raise:10pt;font-weight:bold;'>".$phone."</span>
                        </a></p></div></td></tr>

                        <tr><td style='padding:35px 30px 11px 30px;font-size:0;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);'><div class='col-sml' style='display:inline-block;width:100%;max-width:145px;vertical-align:top;text-align:left;font-family:Arial,sans-serif;font-size:14px;color:#363636;'>
                                    <img src='https://zillalstudio.com/mailapi/images/location.png' width='40' alt='' style='width:40px;max-width:80%;margin-bottom:20px;'>
                                </div>
                               
                            
                               
                                <div class='col-lge' style='display:inline-block;width:100%;max-width:395px;vertical-align:top;padding-bottom:20px;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;'>
                                    <p style='margin-top:0;margin-bottom:12px;'> Location: ".$location."</p>
                                    </div></td></tr>

                        <tr><td style='padding:35px 30px 11px 30px;font-size:0;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);'><div class='col-sml' style='display:inline-block;width:100%;max-width:145px;vertical-align:top;text-align:left;font-family:Arial,sans-serif;font-size:14px;color:#363636;'>
                                    <img src='https://zillalstudio.com/mailapi/images/location.png' width='40' alt='' style='width:40px;max-width:80%;margin-bottom:20px;'>
                                </div>
                               
                                <div class='col-lge' style='display:inline-block;width:100%;max-width:395px;vertical-align:top;padding-bottom:20px;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;'>
                                    <p style='margin-top:0;margin-bottom:12px;'> Service Required: ".$service."</p>
                                    </div></td></tr>
                        
                        <tr><td style='padding:35px 30px 11px 30px;font-size:0;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);'><div class='col-sml' style='display:inline-block;width:100%;max-width:145px;vertical-align:top;text-align:left;font-family:Arial,sans-serif;font-size:14px;color:#363636;'>
                                    <img src='https://zillalstudio.com/mailapi/images/message.png' width='40' alt='' style='width:40px;max-width:80%;margin-bottom:20px;'>
                                </div>
                               
                                <div class='col-lge' style='display:inline-block;width:100%;max-width:395px;vertical-align:top;padding-bottom:20px;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;'>
                                    <p style='margin-top:0;margin-bottom:12px;'> Message: ".$message."</p>
                                    </div></td></tr>
                  
                        



                        <!--Footer Start-->
                        <tr><td style='padding:30px;font-size:24px;line-height:28px;font-weight:bold;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);'></td></tr><tr><td style='padding:10px;background-color:#ffffff;'><p style='margin:0;font-size:14px'>Finez Technologies LLP is a web designing company based in Kochi. Finding the finest marketing tools appropriate for your business or venture has always been our priority.</p></td></tr><tr><td style='padding:2px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;'>
                                <p style='padding:0 0 2px 2px;'><a href='https://www.fineztechnologies.com' target='_blank' style='text-decoration:none;'><img src='https://fineztechnologies.com/mailapi/images/logo.png' width='150' alt='f' style='display:inline-block;color:#cccccc;'>
                                    </a></p><p style='padding-bottom:2px;font-size:14px;'> Visit Our website<br><a class='unsub' href='https://www.fineztechnologies.com/' target='_blank' style='color:#cccccc;text-decoration:underline;'>www.fineztechnologies.com</a></p><p style='padding-bottom:2px'><a href='https://www.facebook.com/fineztech' target='_blank' style='text-decoration:none;'><img src='https://fineztechnologies.com/mailapi/images/facebook.png' width='30' height='30' alt='f' style='display:inline-block;color:#cccccc;'></a><a href='https://www.instagram.com/finez.tech' target='_blank' style='text-decoration:none;'><img src='https://fineztechnologies.com/mailapi/images/instagram.png' width='30' height='30' alt='t' style='display:inline-block;color:#cccccc;'></a></p></td></tr>
                    
                         <!--Footer End-->
                        </table>
                 
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
";


$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
foreach ($emailsCC as $em) {
  $mail->AddCC($em, $subject);    
}
$mail->Subject=$subject;
if(!$mail->send()) {
    http_response_code(500);   
    echo "Oops! Something went wrong, we couldn't send your message.";
} else {
    http_response_code(200); 
    echo "Thank You! Your message has been sent.";
    
}




?>
