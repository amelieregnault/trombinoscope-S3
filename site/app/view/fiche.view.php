<div class="fiche">
    <div class="gauche">
        <figure class="big_photo">
            <?php
            if (isset($student['photo'])) {
                $photo = 'groupe' . $student['group'] . '/big/' . $student['photo'];
            } else {
                $photo = 'defaut.png';
            }
            ?>
            <img src="public/images/<?= $photo ?>" alt="photo de <?= $student['firstname'] ?> <?= $student['lastname'] ?>">
        </figure>
    </div>
    <div class="detail">
        <p class="nom"><?= $student['firstname'] ?> <span><?= $student['lastname'] ?></span></p>
        <p class="ddn"><?= $student['birthdate'] ?></p>
        <p class="groupe">groupe <span><?= $student['group'] ?></span></p>
        <p>
            <?= $student['description'] ?>
        </p>
    </div>
</div>