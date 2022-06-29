<?php if ($this->temErro($campo)): ?>
    <div class="alert danger">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?= $this->getErro($campo) ?>
    </div>
<?php endif ?>
