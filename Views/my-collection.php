<?php
$this->layout('template', ['title' => 'Ma collection']);
?>

<h1><?= $this->e($gameName ?? 'Ma collection') ?></h1>

<?php if (!empty($message)): ?>
    <p style="color: blue; font-weight: bold;"><?= $this->e($message) ?></p>
<?php endif; ?>

<?php if (empty($listPersonnage)): ?>
    <p>Ta collection est vide.</p>
<?php else: ?>

    <div class="personnages">
        <?php foreach ($listPersonnage as $personnage): ?>
            <?php $persoId = (int)$personnage->getId(); ?>

            <div class="personnage-card compact rare-<?= (int)$personnage->getRarity() ?>">

                <a class="card-link" href="index.php?action=show-perso&id=<?= $persoId ?>">
                    <div class="perso-thumb">
                        <img
                            src="<?= $this->e($personnage->getImage()) ?>"
                            alt="<?= $this->e($personnage->getName()) ?>"
                            class="perso-img"
                        >
                    </div>

                    <div class="perso-name-badge">
                        <?= $this->e($personnage->getName()) ?>
                    </div>
                </a>

            </div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>
