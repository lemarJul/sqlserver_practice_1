<?php
require_once __DIR__ . '/config.php';

// Création d'une base de données de test
$sql = "IF NOT EXISTS (SELECT * FROM sys.databases WHERE name = 'test_db')
BEGIN
    CREATE DATABASE test_db;
END;";

$result = sqlsrv_query($conn, $sql);
if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Sélectionner la base de données
$sql = "USE test_db;";
sqlsrv_query($conn, $sql);

// Créer une table de test
$sql = "IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='produits' AND xtype='U')
BEGIN
    CREATE TABLE produits (
        id INT PRIMARY KEY IDENTITY(1,1),
        nom NVARCHAR(100) NOT NULL,
        description NVARCHAR(MAX),
        prix DECIMAL(10,2) NOT NULL,
        quantite INT DEFAULT 0,
        date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
    );
END;";

$result = sqlsrv_query($conn, $sql);
if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Insérer des données de test
$sql = "IF NOT EXISTS (SELECT TOP 1 * FROM produits)
BEGIN
    INSERT INTO produits (nom, description, prix, quantite)
    VALUES
    ('Moniteur de signes vitaux', 'Moniteur pour surveiller les signes vitaux du patient', 1299.99, 10),
    ('Défibrillateur portable', 'Appareil portable pour traiter les arrêts cardiaques', 2499.50, 5),
    ('Stéthoscope électronique', 'Stéthoscope avec amplification numérique', 199.99, 25);
END;";

$result = sqlsrv_query($conn, $sql);
if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

echo "Base de données et données de test créées avec succès!";
