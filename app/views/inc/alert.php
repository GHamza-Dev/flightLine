<?php if(!empty($data['alert'])): ?>
    <div class="<?= $data['err'] ? 'alert alert-danger' : 'alert alert-success' ?>" role="alert">
        <?= $data['alert'] ?>
    </div>
<?php endif; ?>