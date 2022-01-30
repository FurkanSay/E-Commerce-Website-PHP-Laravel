<?php


try {
     $db = new PDO("mysql:host=server4.poyrazhosting.com:2083;dbname=ytdownlo_mc", "ytdownlo_ad", "Furkan/0399");
} catch ( PDOException $e ){
     print $e->getMessage();
}

?>