<?php
include "connexion.php";

$requeteVille = "SELECT * FROM ville";
$executionVille = mysqli_query($connexion, $requeteVille);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un nouveau marché</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>



<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-body">

                    <h4 class="mb-4 text-primary fw-bold text-center">
                        Ajouter un nouveau marché
                    </h4>

                    <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            Marché ajouté avec succès !
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            Une erreur est survenue. Veuillez réessayer.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="tr_ajouter_marche.php" method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nom du marché</label>
                            <input type="text" class="form-control" name="nom_marche" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea class="form-control" name="description" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Capacité</label>
                            <input type="number" class="form-control" name="capacite" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Adresse</label>
                            <input type="text" class="form-control" name="adresse" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Téléphone</label>
                            <input type="tel" class="form-control" name="telephone" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Image du marché</label>
                            <input type="file" class="form-control" name="image" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                                <label class="form-label fw-bold">Ville</label>
                                <select class="form-select" name="id_ville" required>
                                    <option value="">-- Choisir une ville --</option>

                                    <?php while ($ville = mysqli_fetch_assoc($executionVille)): ?>
                                        <option value="<?php echo $ville['id_ville']; ?>">
                                            <?php echo htmlspecialchars($ville['nom_ville']); ?>
                                        </option>
                                    <?php endwhile; ?>

                                </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" name="submit">
                                Ajouter le marché
                            </button>
                        </div><br><br>


                        <a href="index.php" class="btn btn-success">
                                Retour
                        </a><br> <br><br>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>