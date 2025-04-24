<?php
//cookoie settings to clear
$secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
session_set_cookie_params([
    'lifetime' => 0,        
    'path'     => '/',     
    'domain'   => '',       
    'secure'   => $secure,  
    'httponly' => true,
    'samesite' => 'Lax'     
]);


session_start();

//database
$host     = "localhost";
$dbname   = 'u_240134699_db';
$username = 'u-240134699';
$password = '5aG7E4F9zzrZ4Og';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
