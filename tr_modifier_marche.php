<?php
include "connexion.php";

if (isset($_POST['id_marche'])) {
    $id_marche = intval($_POST['id_marche']);
    $nom_marche = mysqli_real_escape_string($connexion, $_POST['nom_marche']);
    $description = mysqli_real_escape_string($connexion, $_POST['description']);
    $capacite = intval($_POST['capacite']);
    $adresse = mysqli_real_escape_string($connexion, $_POST['adresse']);
    $telephone = mysqli_real_escape_string($connexion, $_POST['telephone']);
    $id_ville = intval($_POST['id_ville']);

    $update_image_sql = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif'];

        if (in_array($extension, $allowed)) {
            $new_image_name = uniqid("marche_", true) . "." . $extension;
            $upload_path = "images/" . $new_image_name;
            if (move_uploaded_file($tmp_name, $upload_path)) {
                // Supprimer ancienne image
                $sql_old = "SELECT image FROM marche WHERE id_Marche = $id_marche";
                $res = mysqli_query($connexion, $sql_old);
                $old = mysqli_fetch_assoc($res);
                if (file_exists("images/".$old['image'])) unlink("images/".$old['image']);

                $update_image_sql = ", image='$new_image_name'";
            }
        }
    }

    // Requête UPDATE
    $sql = "UPDATE marche SET
            nom_marche='$nom_marche',
            description='$description',
            capacite='$capacite',
            adresse='$adresse',
            telephone='$telephone',
            id_ville='$id_ville'
            $update_image_sql
            WHERE id_Marche=$id_marche";

    if (mysqli_query($connexion, $sql)) {
        header("Location: index.php?success=update");
        exit();
    } else {
        die("Erreur SQL : ".mysqli_error($connexion));
    }

} else {
    header("Location: index.php");
    exit();
}
?>