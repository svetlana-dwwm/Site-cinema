<?php get_header('Editer un utilisateur', 'admin'); ?>

<h1 class="mb-4">Editer un utilisateur</h1>

<form action="" method="post" novalidate>
    <div class="mb-4">
        <?php $error = checkEmptyFields('email'); ?>
        <label for="email" class="form-label">Adresse email : *</label>
        <input type="email" name="email" id="email" value="<?= getValue('email'); ?>" class="form-control <?= $error['class']; ?>">
        <?= $error['message']; ?>
        <?= $errorsMessage['email']; ?>
    </div>
    <div class="mb-4">
        <?php $error = checkEmptyFields('pwd'); ?>
        <label for="pwd" class="form-label">Mot de passe : *</label>
        <input type="password" name="pwd" id="pwd" value="aA1!jbedhdsbcfjhdsb" class="form-control <?= $error['class']; ?>">
        <p class="form-text mb-0">La regle de mot de passe</p>
        <?= $error['message']; ?>
        <?= $errorsMessage['pwd']; ?>

    </div>
    <div class="mb-4">
        <?php $error = checkEmptyFields('pwdConfirm'); ?>
        <label for="email" class="pwd-confirm">Confirmation du mot de passe : *</label>
        <input type="password" name="pwdConfirm" id="pwdConfirm" value="aA1!jbedhdsbcfjhds" class="form-control <?= $error['class']; ?>">
        <?= $error['message']; ?>
        <?= $errorsMessage['pwdConfirm']; ?>
    </div>
    <div>
        <input type="submit" class="btn-btn-success" value="Sauvegarder">
    </div>
</form>

<?php get_footer('admin'); ?>