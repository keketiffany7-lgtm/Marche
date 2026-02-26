<?php
include "connexion.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_marche = intval($_GET['id']);

// Récupérer les données du marché
$sql = "SELECT * FROM marche WHERE id_Marche = $id_marche";
$result = mysqli_query($connexion, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    die("Marché introuvable !");
}
$marche = mysqli_fetch_assoc($result);

// Récupérer les villes pour le select
$sql_villes = "SELECT * FROM ville";
$executionVille = mysqli_query($connexion, $sql_villes);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le marché</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5 pt-5">
    <h4 class="text-primary fw-bold mb-4">Modifier le marché</h4>

    <form action="tr_modifier_marche.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_marche" value="<?php echo $marche['id_marche']; ?>">

        <div class="mb-3">
            <label class="form-label fw-bold">Nom du marché</label>
            <input type="text" name="nom_marche" class="form-control"
                   value="<?php echo htmlspecialchars($marche['nom_marche']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Description</label>
            <textarea name="description" class="form-control" rows="3" required><?php echo htmlspecialchars($marche['description']); ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Capacité</label>
            <input type="number" name="capacite" class="form-control"
                   value="<?php echo $marche['capacite']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Adresse</label>
            <input type="text" name="adresse" class="form-control"
                   value="<?php echo htmlspecialchars($marche['adresse']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Téléphone</label>
            <input type="tel" name="telephone" class="form-control"
                   value="<?php echo htmlspecialchars($marche['telephone']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Ville</label>
            <select name="id_ville" class="form-select" required>
                <?php while ($ville = mysqli_fetch_assoc($executionVille)): ?>
                    <option value="<?php echo $ville['id_ville']; ?>"
                        <?php if ($ville['id_ville'] == $marche['id_ville']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($ville['nom_ville']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Changer l'image (optionnel)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            <small>Image actuelle : <?php echo $marche['image']; ?></small>
        </div>

        <button type="submit" class="btn btn-primary">Modifier le marché</button>
    </form>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>