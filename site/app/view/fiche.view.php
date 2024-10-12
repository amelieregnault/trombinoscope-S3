<div class="fiche">
    <div class="gauche">
        <figure class="big_photo">
            <?php
            if ($student->hasPhoto()) {
                $photo = 'groupe' . $student->getGroupe() . '/big/' . $student->getPhoto();
            } else {
                $photo = 'defaut.png';
            }
            ?>
            <img src="public/images/<?= $photo ?>" alt="photo de <?= $student->getPrenom ?> <?= $student->getNom() ?>">
        </figure>
    </div>
    <div class="detail">
        <p class="nom"><?= $student->getPrenom() ?> <span><?= $student->getNom() ?></span></p>
        <p class="ddn"><?= $student->getDateNaissance() ?></p>
        <p class="groupe">groupe <span><?= $student->getGroupe() ?></span></p>
        <p>
            <?= $student->getDescription() ?>
        </p>
    </div>
</div>