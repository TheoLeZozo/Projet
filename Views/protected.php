<?php
$this->layout('template', ['title' => 'Page protégée']);

$username = (string)($user['username'] ?? '');
$userId   = (string)($user['id'] ?? '');
$stats    = $stats ?? [];

$totalPersos = (int)($stats['totalPersos'] ?? 0);
$ownedPersos = (int)($stats['ownedPersos'] ?? 0);
$completion  = (int)($stats['completion'] ?? 0);
$origins     = (int)($stats['origins'] ?? 0);
$elements    = (int)($stats['elements'] ?? 0);
$unitClasses = (int)($stats['unitClasses'] ?? 0);
$sessionLeft = (int)($stats['sessionLeft'] ?? 0);
?>

<div class="page-shell">
  <h1 class="page-title">Page protégée</h1>

  <div class="account-hero">
    <div class="account-hero-left">
      <div class="account-avatar" aria-hidden="true">
        <?= $this->e(mb_strtoupper(mb_substr($username !== '' ? $username : 'U', 0, 1))) ?>
      </div>
      <div>
        <div class="account-title">Connecté en tant que <strong><?= $this->e($username) ?></strong></div>
        <div class="account-sub">ID: <span class="mono"><?= $this->e($userId) ?></span> · Session: ~<?= $sessionLeft ?> min restantes</div>
      </div>
    </div>

    <div class="account-hero-right">
      <div class="account-progress" title="Progression de collection">
        <div class="account-progress-bar" style="width: <?= max(0, min(100, $completion)) ?>%"></div>
      </div>
      <div class="account-progress-text">
        Collection: <strong><?= $ownedPersos ?></strong> / <?= $totalPersos ?> (<?= $completion ?>%)
      </div>
    </div>
  </div>

  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-label">Persos total</div>
      <div class="stat-value"><?= $totalPersos ?></div>
      <div class="stat-hint">Dans ta base</div>
    </div>

    <div class="stat-card">
      <div class="stat-label">Ta collection</div>
      <div class="stat-value"><?= $ownedPersos ?></div>
      <div class="stat-hint">Persos possédés</div>
    </div>

    <div class="stat-card">
      <div class="stat-label">Completion</div>
      <div class="stat-value"><?= $completion ?>%</div>
      <div class="stat-hint">Objectif: 100% (bon courage)</div>
    </div>

    <div class="stat-card">
      <div class="stat-label">Origins</div>
      <div class="stat-value"><?= $origins ?></div>
      <div class="stat-hint">Disponibles</div>
    </div>

    <div class="stat-card">
      <div class="stat-label">Elements</div>
      <div class="stat-value"><?= $elements ?></div>
      <div class="stat-hint">Disponibles</div>
    </div>

    <div class="stat-card">
      <div class="stat-label">Classes</div>
      <div class="stat-value"><?= $unitClasses ?></div>
      <div class="stat-hint">UnitClass</div>
    </div>
  </div>

  <div class="account-actions">
    <a class="btn" href="index.php?action=my-collection">Ma collection</a>
    <a class="btn btn-ghost" href="index.php?action=home">Retour</a>
  </div>
</div>
