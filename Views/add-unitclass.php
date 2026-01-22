<?php
$this->layout('template', ['title' => 'Mario Wiki - Class']);

$isEdit = isset($unitclass) && $unitclass instanceof \Models\UnitClass && $unitclass->getId() !== null;

$valName = $isEdit ? $unitclass->getName() : '';
$valImg  = $isEdit ? $unitclass->getUrlImg() : '';
<<<<<<< HEAD
=======
// defaults for new UI features (safe when model doesn't have these properties)
$valColor = '#6cf4ff';
$valRarity = $isEdit && method_exists($unitclass, 'getRarity') ? $unitclass->getRarity() : 1;
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
?>

<div class="page-shell">
  <h1 class="page-title"><?= $isEdit ? 'Edit Class' : 'Add Class' ?></h1>
<<<<<<< HEAD

=======
  
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
  <div class="form-card">
    <form class="perso-form" method="post" action="index.php?action=<?= $isEdit ? 'edit-unitclass' : 'add-unitclass' ?>">
      <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= (int)$unitclass->getId() ?>">
      <?php endif; ?>

      <div class="full">
<<<<<<< HEAD
        <label>Name</label>
        <input name="name" value="<?= $this->e($valName) ?>" required>
      </div>

      <div class="full">
        <label for="url_img">Image (chemin en base)</label>
        <input id="url_img" class="img-path-input" name="url_img" value="<?= $this->e($valImg) ?>" required readonly>

        <?php
          $imgBaseDir = __DIR__ . '/../public/img';
          $images = [];
          if (is_dir($imgBaseDir)) {
            $rii = new RecursiveIteratorIterator(
              new RecursiveDirectoryIterator($imgBaseDir, FilesystemIterator::SKIP_DOTS)
            );
            foreach ($rii as $file) {
              /** @var SplFileInfo $file */
              if (!$file->isFile()) continue;
              $ext = strtolower($file->getExtension());
              if (!in_array($ext, ['png','jpg','jpeg','webp','gif','svg'], true)) continue;
              $relative = str_replace($imgBaseDir . DIRECTORY_SEPARATOR, '', $file->getPathname());
              $relative = str_replace(DIRECTORY_SEPARATOR, '/', $relative);
              $images[] = 'public/img/' . $relative;
            }
          }
          sort($images);
        ?>

        <div class="img-picker" data-target="#url_img">
          <div class="img-picker-head">
            <input class="img-filter" type="search" placeholder="Filtrer (nom de fichier)..." aria-label="Filtrer les images">
            <button type="button" class="btn btn-ghost img-clear">Effacer</button>
          </div>
          <div class="img-grid img-grid-tight" role="list">
            <?php foreach ($images as $imgPath): ?>
              <?php $fileName = basename($imgPath); $isSelected = ($imgPath === ($valImg ?? '')); ?>
              <button type="button" class="img-tile <?= $isSelected ? 'selected' : '' ?>" role="listitem"
                      data-path="<?= $this->e($imgPath) ?>" data-name="<?= $this->e(strtolower($fileName)) ?>">
                <img src="<?= $this->e($imgPath) ?>" alt="<?= $this->e($fileName) ?>">
                <span><?= $this->e($fileName) ?></span>
              </button>
            <?php endforeach; ?>
          </div>
          <p class="img-help">Clique une image pour remplir le champ automatiquement.</p>
        </div>
      </div>

      <button type="submit"><?= $isEdit ? 'Save changes' : 'Add class' ?></button>
=======
        <label>Name <span class="hint-icon" data-tip="Le nom doit contenir au moins 3 caractères">?</span></label>
        <input name="name" value="<?= $this->e($valName) ?>" required minlength="3" aria-describedby="name-help">
        <div id="name-help" class="validation-error" aria-live="polite" style="display:none">Le nom est trop court.</div>
      </div>

      <div class="full">
        <label>Image URL <span class="hint-icon" data-tip="Collez une URL d'image ou déposez un fichier image ci-dessous">?</span></label>
        <input id="img-url" name="url_img" value="<?= $this->e($valImg) ?>" required aria-describedby="img-help">
        <div id="img-help" class="validation-error" aria-live="polite" style="display:none">URL invalide ou image introuvable.</div>

        <div class="dropzone" id="dropzone" style="margin-top:12px">Déposez une image ici (drag & drop) ou cliquez pour sélectionner
          <input id="file-input" type="file" accept="image/*" style="display:none">
        </div>

        <div style="display:flex;gap:12px;margin-top:12px;align-items:center">
          <div class="img-preview" id="img-preview">
            <?php if (!empty($valImg)): ?>
              <img id="preview-img" src="<?= $this->e($valImg) ?>" alt="Preview">
            <?php else: ?>
              <img id="preview-img" src="/Projet/public/img/placeholder.png" alt="Preview">
            <?php endif; ?>
          </div>

          <div style="display:flex; flex-direction:column; gap:8px;">
            <div style="display:flex;gap:8px;align-items:center">
              <label style="margin:0">Aura color</label>
              <input id="aura-color" type="color" name="aura_color" value="<?= $this->e($valColor) ?>" title="Couleur d'aura" aria-label="Aura color">
              <div class="color-preview" id="color-preview" style="background: <?= $this->e($valColor) ?>"></div>
            </div>

            <div>
              <label style="margin:0">Rarity <span class="hint-icon" data-tip="Choisissez la rareté (1..6)">?</span></label>
              <div class="rarity-selector" role="radiogroup" aria-label="Select rarity" data-value="<?= (int)$valRarity ?>">
                <?php for ($r=1;$r<=6;$r++): ?>
                  <button type="button" class="<?= (int)$valRarity === $r ? 'active' : '' ?>" data-rarity="<?= $r ?>" aria-checked="<?= (int)$valRarity === $r ? 'true' : 'false' ?>"><?= $r ?></button>
                <?php endfor; ?>
              </div>
              <input type="hidden" name="rarity" id="rarity" value="<?= (int)$valRarity ?>">
            </div>
          </div>
        </div>
      </div>

      <div class="full" style="display:flex;gap:12px;align-items:center">
        <button type="submit" class="neon-btn"><?= $isEdit ? 'Save changes' : 'Add class' ?></button>
        <button type="button" id="clear-btn" class="btn btn-ghost">Clear</button>
        <div style="margin-left:auto;font-size:12px;opacity:.8">Shortcut: <strong>Ctrl+Enter</strong></div>
      </div>
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    </form>

    <div class="perso-show-actions">
      <a class="btn btn-ghost" href="index.php?action=home">Back</a>
    </div>
  </div>

  <h2 class="page-title" style="font-size:22px;margin-top:26px;">Existing Classes</h2>

  <div class="form-card">
    <?php if (empty($unitclasses ?? [])): ?>
      <p class="perso-show-empty">No classes yet.</p>
    <?php else: ?>
      <div class="perso-sheet-grid" style="grid-template-columns:1fr 1fr;">
        <?php foreach (($unitclasses ?? []) as $u): ?>
          <div class="meta-box">
            <div class="meta-value">
              <img class="meta-icon" src="<?= $this->e($u->getUrlImg()) ?>" alt="">
              <?= $this->e($u->getName()) ?>
              <span style="opacity:.7">#<?= (int)$u->getId() ?></span>
            </div>

            <div class="perso-show-actions" style="margin-top:12px;">
              <a class="btn" href="index.php?action=edit-unitclass&id=<?= (int)$u->getId() ?>">Edit</a>
              <a class="btn btn-danger"
                 href="index.php?action=del-unitclass&id=<?= (int)$u->getId() ?>"
                 onclick="return confirm('Delete this class?');">Delete</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<<<<<<< HEAD

<script>
(function () {
  const picker = document.querySelector('.img-picker');
  if (!picker) return;

  const targetSel = picker.getAttribute('data-target');
  const target = targetSel ? document.querySelector(targetSel) : null;
  const filter = picker.querySelector('.img-filter');
  const clearBtn = picker.querySelector('.img-clear');
  const tiles = Array.from(picker.querySelectorAll('.img-tile'));

  function selectTile(tile) {
    tiles.forEach(t => t.classList.remove('selected'));
    tile.classList.add('selected');
    if (target) target.value = tile.getAttribute('data-path') || '';
  }

  tiles.forEach(tile => tile.addEventListener('click', () => selectTile(tile)));

  if (filter) {
    filter.addEventListener('input', () => {
      const q = (filter.value || '').trim().toLowerCase();
      tiles.forEach(t => {
        const name = t.getAttribute('data-name') || '';
        t.style.display = (q === '' || name.includes(q)) ? '' : 'none';
      });
    });
  }

  if (clearBtn) {
    clearBtn.addEventListener('click', () => {
      tiles.forEach(t => t.classList.remove('selected'));
      if (target) target.value = '';
      if (filter) {
        filter.value = '';
        filter.dispatchEvent(new Event('input'));
      }
    });
  }
})();
</script>
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
