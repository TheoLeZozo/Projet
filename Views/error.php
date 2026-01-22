<?php
$this->layout('template', ['title' => $title ?? 'Erreur']);
?>

<div class="page-shell">
  <h1 class="page-title">Erreur <?= (int)($code ?? 500) ?></h1>
  <div class="form-card">
    <p class="perso-show-empty"><?= $this->e($message ?? 'Une erreur est survenue.') ?></p>
    <div class="perso-show-actions" style="margin-top:16px;">
      <a class="btn" href="index.php?action=home">Retour à l'accueil</a>
    </div>
  </div>
</div>
