<?php
include "connexion.php";

if (isset($_GET['id'])) {
    $id_marche = intval($_GET['id']);

    // Récupérer le nom de l'image pour la supprimer du dossier
    $sql = "SELECT image FROM marche WHERE id_Marche = $id_marche";
    $result = mysqli_query($connexion, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $marche = mysqli_fetch_assoc($result);
        $image_path = "images/" . $marche['image'];
        if (file_exists($image_path)) {
            unlink($image_path); // Supprime le fichier image
        }
    }

    // Supprimer le marché
    $sql = "DELETE FROM marche WHERE id_Marche = $id_marche";
    if (mysqli_query($connexion, $sql)) {
        header("Location: index.php?success=delete");
        exit();
    } else {
        die("Erreur SQL : " . mysqli_error($connexion));
    }

} else {
    header("Location: index.php");
    exit();
}
?>