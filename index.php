<?php
require_once __DIR__ . '/config.php';

// Récupérer les produits
$sql = "SELECT id, nom, description, prix, quantite, date_creation FROM produits ORDER BY id";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['result'])) {
    $message = htmlspecialchars($_GET['result']);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test PHP avec SQL Server</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1>Produits médicaux</h1>

        <?php if ($message): ?>
            <div class="info">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Date de création</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nom']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo number_format($row['prix'], 2); ?> €</td>
                        <td><?php echo $row['quantite']; ?></td>
                        <td><?php echo $row['date_creation']->format('Y-m-d H:i:s'); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2>Ajouter un produit</h2>
        <form action="ajouter_produit.php" method="post">
            <div>
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>
            </div>
            <div>
                <label for="prix">Prix:</label>
                <input type="number" id="prix" name="prix" step="0.01" required>
            </div>
            <div>
                <label for="quantite">Quantité:</label>
                <input type="number" id="quantite" name="quantite" required>
            </div>
            <button type="submit">Ajouter</button>
        </form>
    </div>
</body>

</html>
