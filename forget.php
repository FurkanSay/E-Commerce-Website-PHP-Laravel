<?php
include 'inc/header.php'; 
include 'passforget1.php';
$pf = new passforget1();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $mail = $_POST['mail'];
    $result= $pf->passforget($mail);
}

?>

<form action="" method="post">
    <div class="content">
        <div class="forget_panel">
                    <input name="email" placeholder="Email" type="text"/>
                    
                 <p class="note">Enter your e-mail to send your password to your e-mail.</p>
                
                    <div class="buttons"><div><button class="grey" name="send">Send</button></div></div>
                <?php 
                if (isset($result)) {
                    echo $result;
                }
                ?>
                    </form>
        </div>
    </div>