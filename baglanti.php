<?php
$host = ""; //sunucu
$kullanici = ""; //kullanici adi
$sifre = ""; //sifre
$db = "";//veritabani ismi 

try {
     $db = new PDO("mysql:host=$host;dbname=$db;charset=utf8", "$kullanici", "$sifre");
} catch ( PDOException $e ){
     print $e->getMessage();
}
?>