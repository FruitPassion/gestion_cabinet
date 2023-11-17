<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">

<?php include 'partial/head.php'; ?>

<body>

<?php include 'partial/nav.php'; ?>

<form action="affichage.php" method="post">
    <p>Utilisateur :</p>
    <input type="text" name="nom_user"><br>
    <input type="submit" value="afficher">
</form>

<?php include 'partial/footer.php'; ?>

</html>
