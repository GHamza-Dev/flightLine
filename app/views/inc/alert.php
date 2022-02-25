<?php if(!empty($data['alert'])): ?>
    <div class="<?= $data['err'] ? 'alert alert-danger' : 'alert alert-success' ?> mb-0" role="alert">
        <?= $data['alert'] ?>
    </div>
<?php endif; ?>