<?php
$this->layout('template', ['title' => 'Mario Wiki - Home']);
?>

<h1>Collection <?= $this->e($gameName) ?></h1>

<?php if (!empty($message)): ?>
    <p style="color: blue; font-weight: bold;"><?= $this->e($message) ?></p>
<?php endif; ?>

<?php if (empty($listPersonnage)): ?>
    <p>Aucun personnage disponible.</p>
<?php else: ?>

    <div class="rarity-filters">
        <button data-filter="all" class="active">Toutes</button>
        <?php for ($i = 1; $i <= 6; $i++): ?>
            <button data-filter="<?= $i ?>">Rareté <?= $i ?></button>
        <?php endfor; ?>
    </div>

    <div class="personnages">
        <?php foreach ($listPersonnage as $personnage): ?>
            <?php
                $persoId = (int)$personnage->getId();
                $isOwned = in_array($persoId, $ownedIds ?? [], true);
            ?>

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

                <!-- Les boutons +/- sont sur la fiche perso (show) pour éviter de polluer les cartes -->

            </div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>
