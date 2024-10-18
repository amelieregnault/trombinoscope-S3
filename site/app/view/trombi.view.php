<?php if (isset($nbPages) && $nbPages > 1) : ?>
  <ul>
    <?php for ($i = 1; $i <= $nbPages; $i++) : ?>
      <li>
        <?php if ($numPage === $i) : ?>
          <?= $i ?>
        <?php else : ?>
          <a href="index.php?page=trombinoscope&num=<?= $i ?>"><?= $i ?></a>
        <?php endif ?>
      </li>
    <?php endfor ?>
  </ul>
<?php endif ?>

<?php foreach ($students as $student): ?>
    <div class="carte">
      <a href="index.php?page=fiche&num=<?= $student->getId() ?>">
        <?php 
          if ($student->hasPhoto()) {
            $photo = 'groupe' . $student->getGroupe() . '/small/' . $student->getPhoto();
          } else {
            $photo = 'defaut.png';
          }
        ?>
        <figure class="photo"><img src="public/images/<?= $photo ?>" alt="photo de <?= $student->getPrenom() ?> <?= $student->getNom() ?>">
        </figure>
        <div class="infos">
          <p class="nom">
            <?= $student->getPrenom() ?> 
            <span><?= $student->getNom() ?></span>
          </p>
          <p class="ddn"><?= $student->getDateNaissance() ?></p>
          <p class="groupe">groupe <span><?= $student->getGroupe() ?></span></p>
        </div>
      </a>
    </div>
<?php endforeach ?>