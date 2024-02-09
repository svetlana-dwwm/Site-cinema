<?php get_header('Liste des films', 'admin'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer le film</title>
</head>

<body>
    <h1>Le film id<?= $_GET['id']; ?> est supprime</h1>
</body>

</html>

<?php get_footer('admin'); ?>