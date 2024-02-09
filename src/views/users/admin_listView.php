<?php get_header('Liste des films', 'admin'); ?>

<table class="table table-dark table-striped">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
        <th scope="col"><i class="fa-solid fa-trash"></i></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($movies as $movie) : ?>
        <tr>
        <th scope="row"><?php echo htmlspecialchars($movie['id']); ?></th>
        <td><?php echo htmlspecialchars($movie['title']); ?></td>
        <td><a class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="<?php echo $router->generate('editMovie', ['id' => $movie['id']]); ?>">Modifier</a></td>
        <td>
            <a href="<?php echo $router->generate('deleteMovie', ['id' => $movie['id']]); ?>" class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Supprimer</a>
        </td>
        </tr>
    </tbody>
    <?php endforeach; ?>

    <div><img src="<?php $folder/*foreach ($images as $image) :
                     echo 'images/' . $image['filename']; 
                     endforeach;*/
                ?>" alt="">
    </div>

<?php get_footer('admin'); ?>

