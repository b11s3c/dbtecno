<?php
// Bu dosyayı parts/config.php olarak kopyalayıp kendi veritabanı bilgilerinizi girin.

$db_host = getenv('DB_HOST') ?: '127.0.0.1';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';
$db_name = getenv('DB_NAME') ?: 'dbtecnoc_db';
$db_port = (int) (getenv('DB_PORT') ?: 3306);

$baglanti = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);

if ($baglanti->connect_error) {
    die("Bağlantı hatası: " . $baglanti->connect_error);
}

$baglanti->set_charset("utf8mb4");
