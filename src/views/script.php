<script
    <?php foreach ($lesJS as $js): ?>
src = "<?= BASE_URL; ?>/public/assets/js/<?php echo $js; ?>.js"
    <?php endforeach; ?>

></script>