<?php
try {
    $pdo = new PDO('mysql:host=mysql;dbname=iss_loops_local', 'iss_loops_user', 'iss_loops_password');
    echo "Conexión exitosa!\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
