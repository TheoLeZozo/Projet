<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->e($title ?? 'Mario Wiki') ?></title>
    <link rel="stylesheet" href="/Projet/public/css/main.css?v=<?= time() ?>">
</head>
<body>

<canvas id="bg-stars"></canvas>

<nav class="main-nav">
    <a href="index.php?action=home">Accueil</a>

    <?php if (\Services\AuthService::isLogged()): ?>
        <a href="index.php?action=my-collection">Ma collection</a>
        <a href="index.php?action=protected">Page protégée</a>
        <a href="index.php?action=add-perso">Ajouter un personnage</a>
        <a href="index.php?action=add-origin">Ajouter une origine</a>
        <a href="index.php?action=add-element">Ajouter un élément</a>
        <a href="index.php?action=add-unitclass">Ajouter une classe</a>
        <a href="index.php?action=logs">Logs</a>

        <a href="index.php?action=logout">
            Logout (<?= htmlspecialchars($_SESSION['user']['username'] ?? 'user') ?>)
        </a>
    <?php else: ?>
        <a href="index.php?action=login">Login</a>
        <a href="index.php?action=register">Register</a>
    <?php endif; ?>

</nav>



<?php $flash = \Helpers\Flash::get(); ?>
<?php if ($flash): ?>
  <?= $this->insert('message', ['message' => $flash]) ?>
<?php endif; ?>
<main class="cyber-main">
    <?= $this->section('content') ?>
</main>

<footer class="cyber-footer">
        Mario Wiki • Projet PHP
</footer>

<script>

const canvas = document.getElementById("bg-stars");
const ctx = canvas.getContext("2d", { alpha: true });

let w = 0, h = 0, dpr = 1;
function resize() {
    dpr = Math.min(window.devicePixelRatio || 1, 2);
    w = Math.floor(window.innerWidth);
    h = Math.floor(window.innerHeight);
    canvas.width = Math.floor(w * dpr);
    canvas.height = Math.floor(h * dpr);
    canvas.style.width = w + "px";
    canvas.style.height = h + "px";
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
}
window.addEventListener("resize", resize);
resize();

let scrollY = window.scrollY || 0;
window.addEventListener("scroll", () => { scrollY = window.scrollY || 0; }, { passive: true });

const mouse = { x: 0.5, y: 0.5, tx: 0.5, ty: 0.5 };
window.addEventListener("mousemove", (e) => {
    mouse.tx = e.clientX / Math.max(1, w);
    mouse.ty = e.clientY / Math.max(1, h);
}, { passive: true });

function rand(min, max) { return Math.random() * (max - min) + min; }
function clamp(v, a, b) { return Math.max(a, Math.min(b, v)); }


const layers = [
    { depth: 0.20, count: 90,  size: [0.6, 1.3], alpha: [0.08, 0.25], speed: 0.03 },
    { depth: 0.55, count: 140, size: [0.7, 1.8], alpha: [0.12, 0.45], speed: 0.06 },
    { depth: 0.95, count: 120, size: [0.9, 2.4], alpha: [0.18, 0.75], speed: 0.10 },
];

const stars = layers.map(L => Array.from({ length: L.count }, () => ({
    x: Math.random() * w,
    y: Math.random() * h,
    r: rand(L.size[0], L.size[1]),
    a: rand(L.alpha[0], L.alpha[1]),
    tw: rand(0.8, 1.8),
    ph: rand(0, Math.PI * 2),
    drift: rand(-0.5, 0.5)
})));


const meteors = [];
let meteorCooldown = 0;
function spawnMeteor() {

    const fromLeft = Math.random() < 0.5;
    const startX = fromLeft ? rand(-w * 0.2, w * 0.2) : rand(w * 0.6, w * 1.1);
    const startY = rand(-h * 0.2, h * 0.3);
    const angle = rand(Math.PI * 1.15, Math.PI * 1.35); 
    const speed = rand(900, 1400); 
    const len = rand(140, 260);
    meteors.push({
        x: startX,
        y: startY,
        vx: Math.cos(angle) * speed,
        vy: Math.sin(angle) * speed,
        life: rand(0.55, 0.9),
        ttl: 0,
        len
    });
}

function drawBackground() {

    const g = ctx.createRadialGradient(w * 0.35, h * 0.25, 0, w * 0.35, h * 0.25, Math.max(w, h));
    g.addColorStop(0, "rgba(25,40,75,0.55)");
    g.addColorStop(0.45, "rgba(8,12,28,0.65)");
    g.addColorStop(1, "rgba(2,3,10,0.92)");
    ctx.fillStyle = g;
    ctx.fillRect(0, 0, w, h);
}

function drawStars(t, dt) {

    mouse.x += (mouse.tx - mouse.x) * clamp(dt * 6, 0, 1);
    mouse.y += (mouse.ty - mouse.y) * clamp(dt * 6, 0, 1);
    const mx = (mouse.x - 0.5) * 2; 
    const my = (mouse.y - 0.5) * 2;

    for (let i = 0; i < layers.length; i++) {
        const L = layers[i];
        const arr = stars[i];
        const parallaxScroll = scrollY * (0.08 + L.depth * 0.12);
        const parallaxMouseX = mx * (12 + L.depth * 26);
        const parallaxMouseY = my * (8 + L.depth * 20);

        for (const s of arr) {

            s.x += (s.drift * L.speed) * (dt * 60);
            if (s.x < -10) s.x = w + 10;
            if (s.x > w + 10) s.x = -10;

            const y = (s.y + parallaxScroll * L.depth) % (h + 40) - 20;
            const x = (s.x + parallaxMouseX * L.depth + w) % w;
            const yy = y + parallaxMouseY * L.depth;

            const twinkle = 0.55 + 0.45 * Math.sin(t * s.tw + s.ph);
            const alpha = clamp(s.a * twinkle, 0, 1);

            ctx.beginPath();
            ctx.arc(x, yy, s.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(160,205,255,${alpha})`;
            ctx.fill();
        }
    }
}

function drawMeteors(dt) {
    meteorCooldown -= dt;
    if (meteorCooldown <= 0) {

        if (Math.random() < 0.99) {
            spawnMeteor();
        }
        meteorCooldown = rand(0, 1);
    }

    for (let i = meteors.length - 1; i >= 0; i--) {
        const m = meteors[i];
        m.ttl += dt;
        m.x += m.vx * dt;
        m.y += m.vy * dt;

        const lifeLeft = 1 - (m.ttl / m.life);
        if (lifeLeft <= 0 || m.x < -m.len || m.y < -m.len || m.x > w + m.len || m.y > h + m.len) {
            meteors.splice(i, 1);
            continue;
        }

        const tailX = m.x - (m.vx / Math.max(1, Math.hypot(m.vx, m.vy))) * m.len;
        const tailY = m.y - (m.vy / Math.max(1, Math.hypot(m.vx, m.vy))) * m.len;

        const grad = ctx.createLinearGradient(m.x, m.y, tailX, tailY);
        grad.addColorStop(0, `rgba(255,255,255,${0.85 * lifeLeft})`);
        grad.addColorStop(0.35, `rgba(160,210,255,${0.35 * lifeLeft})`);
        grad.addColorStop(1, "rgba(160,210,255,0)");

        ctx.strokeStyle = grad;
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(m.x, m.y);
        ctx.lineTo(tailX, tailY);
        ctx.stroke();


        ctx.fillStyle = `rgba(255,255,255,${0.7 * lifeLeft})`;
        ctx.beginPath();
        ctx.arc(m.x, m.y, 1.6, 0, Math.PI * 2);
        ctx.fill();
    }
}

let last = performance.now();
function tick(now) {
    const t = now / 1000;
    const dt = clamp((now - last) / 1000, 0, 0.05);
    last = now;

    ctx.clearRect(0, 0, w, h);
    drawBackground();
    drawStars(t, dt);
    drawMeteors(dt);

    requestAnimationFrame(tick);
}
requestAnimationFrame(tick);
</script>

<script>
document.querySelectorAll(".personnage-card").forEach(card => {
    card.addEventListener("mousemove", e => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const rotateX = ((y - rect.height / 2) / rect.height) * -20;
        const rotateY = ((x - rect.width / 2) / rect.width) * 20;

        card.style.transform =
            `perspective(1000px) translateY(-6px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    });

    card.addEventListener("mouseleave", () => {
        card.style.transform = "perspective(1000px) translateY(0)";
    });
});
</script>

<script>
const buttons = document.querySelectorAll(".rarity-filters button");
const cards = document.querySelectorAll(".personnage-card");

buttons.forEach(btn => {
    btn.addEventListener("click", () => {
        buttons.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        const filter = btn.dataset.filter;

        cards.forEach(card => {
            const match =
                filter === "all" ||
                card.classList.contains(`rare-${filter}`);

            if (match) {
                card.style.display = "";
                card.style.opacity = "1";
                card.style.transform = "scale(1)";
            } else {
                card.style.display = "none";
            }
        });
    });
});
</script>
</body>
</html>
