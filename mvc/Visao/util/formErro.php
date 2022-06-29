<?php if ($this->temErro($campo)): ?>
    <span class="msg msg-error z-depth-3 scale-transition"><?= $this->getErro($campo) ?></span>
<?php endif ?>
