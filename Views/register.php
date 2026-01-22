<?php $this->layout('template', ['title' => 'Créer un compte']); ?>

<section class="auth-wrap">
  <div class="auth-card form-card">
    <h1 class="auth-title">Créer un compte</h1>

    <form method="post" action="index.php?action=register" class="auth-form">
      <label for="username">Username</label>
      <input id="username" type="text" name="username" minlength="3" autocomplete="username" required>

      <label for="password">Mot de passe</label>
      <input id="password" type="password" name="password" minlength="6" autocomplete="new-password" required>

      <label for="confirm">Confirmer</label>
      <input id="confirm" type="password" name="confirm" minlength="6" autocomplete="new-password" required>

      <button type="submit" class="btn btn-primary w-full">Créer</button>

      <p class="auth-hint">
        Déjà un compte ? <a href="index.php?action=login">Se connecter</a>
      </p>
    </form>
  </div>
</section>
