<?php if(!empty($this->data['alert'])): ?>
    <div class="<?= $this->data['err'] ? 'alert alert-danger' : 'alert alert-success' ?>" role="alert">
        <?= $this->data['alert'] ?>
    </div>
<?php endif; ?>