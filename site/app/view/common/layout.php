<?php include "app/view/common/header.php"; ?>

<?php if (isset($message)): ?>
<p><?= $message ?></p>
<?php endif ?>

<?php 
echo $content;

include "app/view/common/footer.php";