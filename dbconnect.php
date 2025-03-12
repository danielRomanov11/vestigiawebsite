<?php
$dsn = "pgsql:host=db.supabase.co;port=5432;dbname=yourdbname;";
$username = "postgres";
$password = "yourpassword";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
    echo "Connected to Supabase!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
