<?php foreach ($breakdown as $type => $value): ?>
    <?php if ($value != 0): ?>
        <?= $type ?>: <?= $value ?><br/>
    <?php endif; ?>
<?php endforeach; ?>
