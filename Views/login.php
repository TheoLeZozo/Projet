<?php $this->layout('template', ['title' => 'Connexion']); ?>

<section class="auth-wrap">
  <div class="auth-card form-card">
    <h1 class="auth-title">Connexion</h1>

    <?php if (!empty($error)): ?>
      <div class="msg msg-error">
        <strong>Erreur</strong><br>
        <span><?= htmlspecialchars($error) ?></span>
      </div>
    <?php endif; ?>

    <form method="post" action="index.php?action=login" class="auth-form">
      <label for="username">Username</label>
      <input id="username" name="username" autocomplete="username" required>

      <label for="password">Mot de passe</label>
      <input id="password" name="password" type="password" autocomplete="current-password" required>

      <button type="submit" class="btn btn-primary w-full">Se connecter</button>

      <p class="auth-hint">
        Pas de compte ? <a href="index.php?action=register">Créer un compte</a>
      </p>
    </form>
  </div>
</section>
