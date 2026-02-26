<?php
include "connexion.php";

// Afficher les erreurs (temporaire pour debug)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {

    // Vérifier que le dossier images existe
    $upload_dir = "images/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Sécurisation des données
    $nom_marche = mysqli_real_escape_string($connexion, $_POST['nom_marche']);
    $description = mysqli_real_escape_string($connexion, $_POST['description']);
    $capacite = intval($_POST['capacite']);
    $adresse = mysqli_real_escape_string($connexion, $_POST['adresse']);
    $telephone = mysqli_real_escape_string($connexion, $_POST['telephone']);
    $id_ville = intval($_POST['id_ville']);

    // Gestion image
    if (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {
        die("Erreur : fichier image manquant ou erreur upload");
    }

    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $size = $_FILES['image']['size'];


    // Vérifier extension
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    if (!in_array($extension, $allowed)) {
        die("Erreur : extension de fichier non autorisée");
    }

    // Renommer image
    $new_image_name = uniqid("marche_", true) . "." . $extension;
    $upload_path = $upload_dir . $new_image_name;

    // Déplacer image
    if (!move_uploaded_file($tmp_name, $upload_path)) {
        die("Erreur : impossible de déplacer le fichier image");
    }

    // Requête INSERT
    $requete = "INSERT INTO marche 
        (nom_marche, description, capacite, adresse, telephone, image, id_ville)
        VALUES 
        ('$nom_marche', '$description', '$capacite', '$adresse', '$telephone', '$new_image_name', '$id_ville')";

    if (mysqli_query($connexion, $requete)) {
        header("Location: create.php?success=1");
        exit();
    } else {
        die("Erreur SQL : " . mysqli_error($connexion));
    }

} else {
    header("Location: create.php");
    exit();
}
?>