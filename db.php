<?php
// db.php - InfinityFree MySQL connection for if0_39010553_employeesid

$host = 'if0_39010553_employeesid'; 
$dbname = 'if0_39010553_employeesid';
$username = 'if0_39010553'; // Replace with your InfinityFree username
$password = '4A2cLjh70faZy'; // Replace with your real password

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
}
?>
