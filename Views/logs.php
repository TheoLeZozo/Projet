<?php $this->layout('template', ['title' => 'Logs']); ?>

<h1 class="page-title">Logs</h1>

<div class="form-card">
  <form method="get" action="index.php" class="form">
    <input type="hidden" name="action" value="logs">

    <label class="label">Mois / Année</label>
    <select name="file" class="input">
      <?php if (empty($files)): ?>
        <option value="">Aucun fichier de log</option>
      <?php else: ?>
        <?php foreach ($files as $f): ?>
          <option value="<?= $this->e($f['file']) ?>" <?= ($selected === $f['file']) ? 'selected' : '' ?>>
            <?= $this->e($f['label']) ?> (<?= $this->e($f['file']) ?>)
          </option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>

    <button class="btn" type="submit">Afficher</button>
    <a class="btn" href="index.php?action=home">Back</a>
  </form>
</div>

<div class="form-card" style="margin-top: 18px;">
  <h2 class="section-title">Contenu</h2>

  <pre class="log-box" style="white-space: pre-wrap; max-height: 520px; overflow: auto; padding: 14px; border-radius: 12px;">
<?= $this->e($content !== '' ? $content : "Aucun log pour l'instant.\n(Commence par créer / modifier / supprimer un truc 😌)") ?>
  </pre>
</div>
