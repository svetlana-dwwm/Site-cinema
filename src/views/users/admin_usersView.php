<?php get_header('Utilisateurs', 'admin'); ?>


<h2>Les Utilisateurs</h2>


<table class="table table-dark table-striped">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">E-mail</th>
        <th scope="col">Created</th>
        <th scope="col">Updated</th>
        <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
        <th scope="col"><i class="fa-solid fa-trash"></i></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user) : ?>
        <tr>
        <th scope="row"><?= $user->id; ?></th>
        <td><?= htmlentities($user->email); ?></td>
        <td><?= $user->created; ?></td>
        <td><?= $user->updated; ?></td>
        <td>
            <a href="<?= $router->generate('editUser', ['id' => $user->id]); ?>" class="btn btn-success">Modifier</a></td>
        <td>
            <a href="<?= $router->generate('deleteUser', ['id' => $user->id]); ?>" class="btn btn-danger">Supprimer</a>
        </td>
        </tr>
    </tbody>
    <?php endforeach; ?>

<?php get_footer('admin'); ?>