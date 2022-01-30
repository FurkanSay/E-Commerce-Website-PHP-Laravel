<?php 
include 'inc/header.php'; 

if(isset($_POST['send'])){
    $sira = 1;

$baglanti = new mysqli("localhost", "root", "", "furkans6_a");

if ($baglanti->connect_errno > 0) {
    die("<b>Bağlantı Hatası:</b> " . $baglanti->connect_error);
}

$baglanti->set_charset("utf8");

$sorgu = $baglanti->prepare($text="SELECT pass,name FROM customers WHERE email ='".$_POST['email']."'");

if ($baglanti->errno > 0) {
    die("<b>Sorgu Hatası:</b> " . $baglanti->error);
}

//$sorgu->bind_param("i", $sira);
$sorgu->execute();

$sonuc = $sorgu->get_result();

$cikti = $sonuc->fetch_array();



$sorgu->close();
$baglanti->close();

include "classes/class.phpmailer.php";
    include "classes/class.smtp.php";
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'mernamerhana@gmail.com';
    $mail->Password = '123123123123as';
    $mail->SetFrom($mail->Username, 'merana merhaba');
    $mail->AddAddress($_POST['email'], $cikti["name"]);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'KONUSU';
    $content = '<div style="background: #eee; padding: 10px; font-size: 14px">'.base64_decode($cikti["pass"]).'</div>';
    $mail->MsgHTML($content);
if($mail->Send()) {
    echo "Your password has been successfully sent to your e-mail address.";
} else {
    // bir sorun var, sorunu ekrana bastıralım
    echo $mail->ErrorInfo;
}
}else{
header("deneme.php");
}






?>

 
<form action="" method="post">
    <div class="content">
        <div class="forget_panel">
                	<input name="email" placeholder="Email" type="text"/>
                    
                 <p class="note">Enter your e-mail to send your password to your e-mail.</p>
                
                    <div class="buttons"><div><button class="grey" name="send">Send</button></div></div>
                
                    </form>
        </div>
    </div>