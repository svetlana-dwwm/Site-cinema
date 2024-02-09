<?php get_header('Se connecter', 'login'); ?>

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

    /* Honeypot */
    .hidden {   
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;
        height: 0;
        width: 0;
        z-index: -1;
    }
</style>

<div class="d-flex align-items-center py-4 bg-body-tertiary vertical-center">
<form method="post" class="form-signin w-100 m-auto">
    <h1 class="h3 mb-3 fw-normal text-center">Se connecter</h1>
    <div class="form-floating">
        <?php $error = checkEmptyFields('email'); ?>
        <input type="text" name="email" class="form-control <?= $error['class']; ?>" id="floatingInput" placeholder="Email">
        <label for="floatingInput">Email</label>
        <?= $error['message']; ?>
    </div>
    <div class="form-floating">
        <?php $error = checkEmptyFields('pwd'); ?>
        <input type="password" name="pwd" class="form-control <?= $error['class']; ?>" id="floatingPassword" placeholder="Mot de passe">
        <label for="floatingPassword">Mot de passe</label>
        <?= $error['message']; ?>
    </div>
    <input type="checkbox" name="fax_only" id="fax_only" value="1" class="hidden" autocomplete="off" />
    <button class="btn btn-primary w-100 py-2" type="submit">Connexion</button>
    <p class="mt-4 mb-3 text-body-secondary text-center">
        <a href="<?= $router->generate('lostPassword'); ?>">Mot de passe oublié ?</a>
    </p>
  </form>
</div>

<?php get_footer('login'); ?>