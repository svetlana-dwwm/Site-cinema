<?php get_header('Ajouter un film', 'admin'); ?>

<style>
    html,
    body,
    .vertical-center {
        height: 100%;
    }

    .form-signin {
        max-width: 330px;
        padding: 1rem;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>

<div class="d-flex align-items-center py-4 bg-body-tertiary vertical-center">
<form method="post" action="" class="form-signin w-100 m-auto" enctype="multipart/form-data">
    <h1 class="h3 mb-3 fw-normal text-center">Ajouter un film</h1>
    <div class="form-floating">
        <?php $error = checkEmptyFields('title'); ?>
        <input type="text" name="title" id="title" value="<?= getValue('title'); ?>" class="form-control <?= $error['class']; ?>" placeholder="Title">
        <label for="title">Title</label>
        <?= $error['message']; ?>
        <?= $errorMovie['title']; ?>
    </div>
    <div class="form-floating">
        <input type="text" name="date" id="date" class="form-control" placeholder="Date de sortie (YYYY-MM-DD)">
        <label for="date">Date de sortie (YYYY-MM-DD)</label>
        <?= $errorMovie['date']; ?>
    </div>
    <div class="form-floating">
        <input type="number" name="time" id="time" class="form-control" placeholder="Durée">
        <label for="time">Durée (min)</label>
    </div>
    <div class="">
        <select name="category" class="form-select" aria-label="Default select example">
            <option value="">Catégorie</option>
            <?php foreach ($categories as $category) { ?>
                <option value="<?= $category['name']; ?>"><?= $category['name']; ?></option>
            <?php } ?>
            </select>
    </div>
    <div class="form-floating">
        <input type="text" name="description" id="description" class="form-control" placeholder="Description">
        <label for="description">Description</label>
    </div>
    <div class="form-floating">
        <input type="text" name="casting" class="form-control" placeholder="Casting">
        <label for="casting">Casting</label>
    </div>
    <div class="form-floating">
        <input type="text" name="direction" class="form-control" placeholder="Direction">
        <label for="direction">Direction</label>
    </div>
    <div class="form-floating">
        <input type="number" step="0.1" max="10" name="note" class="form-control" id="note" placeholder="Note">
        <label for="note">Note (max: 10.0)</label>
    </div>
    <div class="form-floating">
        <input type="file" name="poster" class="form-control" id="poster" placeholder="Poster".
         accept=".jpg, .jpeg, .png" value="">
        <label for="poster">Poster</label>
    </div>
    <div class="form-floating">
        <input type="text" name="trailer" class="form-control" id="trailer" placeholder="Trailer">
        <label for="trailer">Trailer</label>
    </div>
    <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Ajouter</button>
  </form>
</div>
<br>
<br>
<br>

<?php get_footer('admin'); ?>