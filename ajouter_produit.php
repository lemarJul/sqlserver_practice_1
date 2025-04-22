<?php
require_once __DIR__ . '/config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Récupérer et valider les données du formulaire
        $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
        $description = isset($_POST['description']) ? trim($_POST['description']) : '';
        $prix = isset($_POST['prix']) ? floatval($_POST['prix']) : 0;
        $quantite = isset($_POST['quantite']) ? intval($_POST['quantite']) : 0;


        // Validation basique
        if (empty($nom) || $prix <= 0 || $quantite < 0) {
            throw new Exception("Données invalides. Veuillez vérifier vos entrées.");
        }

        // Préparer et exécuter la requête
        $sql = "INSERT INTO produits (nom, description, prix, quantite) VALUES (?, ?, ?, ?)";
        $params = array($nom, $description, $prix, $quantite);

        $stmt = sqlsrv_query($conn, $sql, $params);
        if ($stmt === false) {
            throw new Exception(print_r(sqlsrv_errors(), true));
        }

        // Redirection avec message de succès
        header("Location: /index.php?result=" . urlencode("Produit ajouté avec succès !"));
        exit;
    } catch (Exception $e) {
        header("Location: /index.php?result=" . urlencode("Erreur: " . $e->getMessage()));
        exit;
    }
}
