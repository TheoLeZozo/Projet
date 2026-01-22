<?php $this->layout('template', ['title' => 'Mario Wiki - ' . $this->e($personnage->getName())]); ?>

<h1 class="page-title">Character Sheet</h1>

<div class="perso-sheet rare-<?= (int)$personnage->getRarity() ?>">
  <div class="perso-sheet-left">
    <div class="perso-sheet-imgwrap">
      <img class="perso-sheet-img"
           src="<?= $this->e($personnage->getImage()) ?>"
           alt="<?= $this->e($personnage->getName()) ?>">
    </div>
  </div>

  <div class="perso-sheet-right">
    <h2 class="perso-sheet-name"><?= $this->e($personnage->getName()) ?></h2>

    <div class="perso-sheet-grid">
      <div class="meta-box">
        <span class="meta-label">ID</span>
        <span class="meta-value"><?= (int)$personnage->getId() ?></span>
      </div>

      <div class="meta-box">
        <span class="meta-label">Rarity</span>
        <span class="meta-value"><?= (int)$personnage->getRarity() ?></span>
      </div>

      <div class="meta-box">
        <span class="meta-label">Origin</span>
        <span class="meta-value meta-with-icon">
          <?php if (!empty($origin)) : ?>
            <img class="meta-icon" src="<?= $this->e($origin->getUrlImg()) ?>" alt="<?= $this->e($origin->getName()) ?>">
            <?= $this->e($origin->getName()) ?>
          <?php else : ?>
            -
          <?php endif; ?>
        </span>
      </div>

      <div class="meta-box">
        <span class="meta-label">Class</span>
        <span class="meta-value meta-with-icon">
          <?php if (!empty($unitClass)) : ?>
            <img class="meta-icon" src="<?= $this->e($unitClass->getUrlImg()) ?>" alt="<?= $this->e($unitClass->getName()) ?>">
            <?= $this->e($unitClass->getName()) ?>
          <?php else : ?>
            -
          <?php endif; ?>
        </span>
      </div>
    </div>

    <h3 class="perso-sheet-subtitle">Elements</h3>

    <div class="perso-elements">
      <?php if (empty($personnage->getElements())): ?>
        <span class="pill">No elements</span>
      <?php else: ?>
        <?php foreach ($personnage->getElements() as $element): ?>
          <span class="pill">
            <img class="pill-icon" src="<?= $this->e($element->getUrlImg()) ?>" alt="<?= $this->e($element->getName()) ?>">
            <?= $this->e($element->getName()) ?>
          </span>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div class="perso-sheet-actions">
      <?php if (\Services\AuthService::isLogged()): ?>
        <form class="collection-form collection-form-inline" method="post" action="index.php?action=toggle-collection">
          <input type="hidden" name="id" value="<?= (int)$personnage->getId() ?>">
          <button type="submit" class="collection-btn <?= !empty($isOwned) ? 'owned' : '' ?>">
            <span class="collection-icon" aria-hidden="true"><?= !empty($isOwned) ? '−' : '+' ?></span>
            <span class="collection-text"><?= !empty($isOwned) ? 'Retirer de ma collection' : 'Ajouter à ma collection' ?></span>
          </button>
        </form>
      <?php endif; ?>

      <a class="btn" href="index.php?action=edit-perso&id=<?= (int)$personnage->getId() ?>">Edit</a>

      <a class="btn btn-danger"
        href="index.php?action=del-perso&id=<?= (int)$personnage->getId() ?>"
        onclick="return confirm('Delete this character ?');">
        Delete
      </a>

      <a class="btn btn-ghost" href="index.php?action=home">Back</a>
    </div>
  </div>
</div>
