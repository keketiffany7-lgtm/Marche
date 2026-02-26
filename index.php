<?php
include "connexion.php";

// Vérifier la connexion
if (!$connexion) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Requête
$requete = "SELECT * FROM marche";
$execution = mysqli_query($connexion, $requete);

if (!$execution) {
    die("Erreur dans la requête : " . mysqli_error($connexion));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Les marchés</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>



<div class="container mt-5 pt-5">
    <h4 class="mb-4 text-primary fw-bold">Liste des marchés</h4>

     <a href="create.php" class="btn btn-success">
        + Ajouter un marché
    </a><br> <br><br>

    <div class="row">
        <?php while ($marche = mysqli_fetch_assoc($execution)): ?>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    
                    <img src="images/<?php echo htmlspecialchars($marche['image']); ?>" 
                         class="card-img-top"
                         style="height:200px; object-fit:cover;">

                    <div class="card-body">
                        <h5 class="card-title text-primary">
                            <?php echo htmlspecialchars($marche['nom_marche']); ?>
                        </h5>

                        <p class="card-text">
                            <?php echo htmlspecialchars($marche['description']); ?>
                        </p>

                        <p><strong>Capacité :</strong> <?php echo htmlspecialchars($marche['capacite']); ?></p>
                        <p><strong>Adresse :</strong> <?php echo htmlspecialchars($marche['adresse']); ?></p>
                        <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($marche['telephone']); ?></p>
                    </div>

                    <div class="card-footer text-center">
                        <a class="btn btn-warning btn-sm"
                           href="modifie_marche.php?id=<?php echo $marche['id_marche']; ?>">
                           Modifier
                        </a>

                        <a class="btn btn-danger btn-sm"
                           onclick="return confirm('Êtes-vous sûr ?')"
                           href="supprimer_marche.php?id=<?php echo $marche['id_marche']; ?>">
                           Supprimer
                        </a>
                    </div>

                </div>
            </div>

        <?php endwhile; ?>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>