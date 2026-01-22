<?php
/** @var \Models\Personnage|null $perso */
/** @var array $origins */
/** @var array $elements */
/** @var array $unitclasses */
$selectedElementIds = $selectedElementIds ?? [];
$isEdit = isset($perso) && $perso instanceof \Models\Personnage;

<<<<<<< HEAD
$pageTitle = $isEdit ? 'Modifier un personnage' : 'Add Perso';
=======
$pageTitle = $isEdit ? 'Modifier un personnage' : 'Ajouter un personnage';
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95

// Force le template (navbar + background + css du home)
$this->layout('template', [
    'title'    => $pageTitle,
    'gameName' => $pageTitle, // au cas où ton template utilise plutôt gameName
]);

$action = $isEdit
    ? 'edit-perso&id=' . (int)$perso->getId()
    : 'add-perso';

// Pour la pré-sélection de l’élément
$selectedElementId = $selectedElementId ?? null;

// Valeurs
$name        = $isEdit ? (string)$perso->getName() : '';
$rarity      = $isEdit ? (int)$perso->getRarity() : 1;
$image       = $isEdit ? (string)($perso->getImage() ?? '') : '';
$originId    = $isEdit ? (int)($perso->getOriginId() ?? 0) : 0;
$unitClassId = $isEdit ? (int)($perso->getUnitClassId() ?? 0) : 0;

$rarity = max(1, min(6, $rarity));
$rareClass = 'rare-' . $rarity;
?>

<div class="page-shell">
    <h1 class="page-title"><?= $this->e($pageTitle) ?></h1>

    <div class="form-card <?= $this->e($rareClass) ?>">
        <form class="perso-form" method="post" action="index.php?action=<?= $this->e($action) ?>">
            <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?= (int)$perso->getId() ?>">
            <?php endif; ?>

            <div>
                <label for="name">Nom</label>
                <input id="name" type="text" name="name" required value="<?= $this->e($name) ?>">
            </div>

            <div>
                <label for="rarity">Rareté (1 à 6)</label>
                <input id="rarity" type="number" name="rarity" min="1" max="6" required value="<?= (int)$rarity ?>">
            </div>

            <div class="full">
<<<<<<< HEAD
                <label for="url_img">Image (chemin en base)</label>
                <input id="url_img" class="img-path-input" type="text" name="url_img"
                       placeholder="ex: public/img/persos/mario.png"
                       value="<?= $this->e($image) ?>" readonly>

                <?php
                // Galerie d'images: on garde le stockage "chemin" en DB, mais on évite de le taper à la main.
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

                        // Chemin "web" stocké en base: public/img/...
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

                    <div class="img-grid" role="list">
                        <?php foreach ($images as $imgPath): ?>
                            <?php
                                $fileName = basename($imgPath);
                                $isSelected = ($imgPath === ($image ?? ''));
                            ?>
                            <button type="button"
                                    class="img-tile <?= $isSelected ? 'selected' : '' ?>"
                                    role="listitem"
                                    data-path="<?= $this->e($imgPath) ?>"
                                    data-name="<?= $this->e(strtolower($fileName)) ?>">
                                <img src="<?= $this->e($imgPath) ?>" alt="<?= $this->e($fileName) ?>">
                                <span><?= $this->e($fileName) ?></span>
                            </button>
                        <?php endforeach; ?>
                    </div>

                    <p class="img-help">
                        Clique une image: ça remplit automatiquement le champ ci-dessus (le chemin reste stocké en DB).
                    </p>
                </div>
            </div>


=======
                <label for="url_img">Image</label>
                <input id="url_img" type="text" name="url_img" placeholder="ex: public/img/Mario.webp" value="<?= $this->e($image) ?>">
            </div>

>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            <div>
                <label for="origin">Origine</label>
                <select id="origin" name="origin" required>
                    <option value="">-- Origine --</option>
                    <?php foreach ($origins as $o): $oid = (int)$o->getId(); ?>
                        <option value="<?= $oid ?>" <?= ($originId === $oid) ? 'selected' : '' ?>>
                            <?= $this->e($o->getName()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="unitclass">Classe</label>
                <select id="unitclass" name="unitclass" required>
                    <option value="">-- Classe --</option>
                    <?php foreach ($unitclasses as $c): $cid = (int)$c->getId(); ?>
                        <option value="<?= $cid ?>" <?= ($unitClassId === $cid) ? 'selected' : '' ?>>
                            <?= $this->e($c->getName()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="full">
                <label for="elements">Éléments</label>
                <select id="elements" name="elements[]" multiple required size="6">
                    <?php foreach ($elements as $e): $eid = (int)$e->getId(); ?>
                        <option value="<?= $eid ?>" <?= in_array($eid, $selectedElementIds, true) ? 'selected' : '' ?>>
                            <?= $this->e($e->getName()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit"><?= $isEdit ? 'Modifier' : 'Ajouter' ?></button>
        </form>
    </div>
</div>
<<<<<<< HEAD


<script>
(function () {
  const picker = document.querySelector('.img-picker');
  if (!picker) return;

  const targetSel = picker.getAttribute('data-target');
  const target = document.querySelector(targetSel);
  const filterInput = picker.querySelector('.img-filter');
  const clearBtn = picker.querySelector('.img-clear');
  const tiles = Array.from(picker.querySelectorAll('.img-tile'));

  function setValue(path) {
    if (!target) return;
    target.value = path || '';
    tiles.forEach(t => t.classList.toggle('selected', t.dataset.path === path));
  }

  tiles.forEach(tile => {
    tile.addEventListener('click', () => setValue(tile.dataset.path));
  });

  if (clearBtn) {
    clearBtn.addEventListener('click', () => {
      setValue('');
      if (filterInput) filterInput.value = '';
      tiles.forEach(t => (t.style.display = ''));
    });
  }

  if (filterInput) {
    filterInput.addEventListener('input', () => {
      const q = filterInput.value.trim().toLowerCase();
      tiles.forEach(t => {
        const name = t.dataset.name || '';
        t.style.display = (!q || name.includes(q)) ? '' : 'none';
      });
    });
  }
})();
</script>
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
