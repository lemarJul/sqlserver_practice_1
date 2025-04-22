<?php
// Configuration de la connexion à SQL Server
$serverName = "localhost,1433";
$connectionOptions = [
    "Database" => "test_db", // Base de données par défaut
    "Uid" => "sa", // Utilisateur SQL Server
    "PWD" => "DecodeMyCode@123" // Mot de passe SQL Server
];

// Établir la connexion
try {
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }
} catch (Exception $e) {
    die("Erreur de connexion: " . $e->getMessage());
}
