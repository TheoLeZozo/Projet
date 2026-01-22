<?php
$this->layout('template', ['title' => 'Mario Wiki - Origin']);

$isEdit = isset($origin) && $origin instanceof \Models\Origin && $origin->getId() !== null;

$valName = $isEdit ? $origin->getName() : '';
$valImg  = $isEdit ? $origin->getUrlImg() : '';
?>

<div class="page-shell">
  <h1 class="page-title"><?= $isEdit ? 'Edit Origin' : 'Add Origin' ?></h1>

  <div class="form-card">
    <form class="perso-form" method="post" action="index.php?action=<?= $isEdit ? 'edit-origin' : 'add-origin' ?>">
      <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= (int)$origin->getId() ?>">
      <?php endif; ?>

      <div class="full">
        <label>Name</label>
        <input name="name" value="<?= $this->e($valName) ?>" required>
      </div>

      <div class="full">
<<<<<<< HEAD
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
=======
        <label>Image URL</label>
        <input name="url_img" value="<?= $this->e($valImg) ?>" required>
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
      </div>

      <button type="submit"><?= $isEdit ? 'Save changes' : 'Add origin' ?></button>
    </form>

    <div class="perso-show-actions">
      <a class="btn btn-ghost" href="index.php?action=home">Back</a>
    </div>
  </div>

  <h2 class="page-title" style="font-size:22px;margin-top:26px;">Existing Origins</h2>

  <div class="form-card">
    <?php if (empty($origins ?? [])): ?>
      <p class="perso-show-empty">No origins yet.</p>
    <?php else: ?>
      <div class="perso-sheet-grid" style="grid-template-columns:1fr 1fr;">
        <?php foreach (($origins ?? []) as $o): ?>
          <div class="meta-box">
            <div class="meta-value">
              <img class="meta-icon" src="<?= $this->e($o->getUrlImg()) ?>" alt="">
              <?= $this->e($o->getName()) ?>
              <span style="opacity:.7">#<?= (int)$o->getId() ?></span>
            </div>

            <div class="perso-show-actions" style="margin-top:12px;">
              <a class="btn" href="index.php?action=edit-origin&id=<?= (int)$o->getId() ?>">Edit</a>
              <a class="btn btn-danger"
                 href="index.php?action=del-origin&id=<?= (int)$o->getId() ?>"
                 onclick="return confirm('Delete this origin?');">Delete</a>
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
