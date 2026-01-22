<<<<<<< HEAD
<?php
if (!isset($message) || $message === null) return;

$color = null;
$title = null;
$text = null;

if (is_object($message)) {
    if (property_exists($message, 'color')) $color = $message->color;
    if (property_exists($message, 'title')) $title = $message->title;
    if (property_exists($message, 'message')) $text = $message->message;

    if ($color === null && method_exists($message, 'getColor')) $color = $message->getColor();
    if ($title === null && method_exists($message, 'getTitle')) $title = $message->getTitle();
    if ($text === null && method_exists($message, 'getMessage')) $text = $message->getMessage();
} elseif (is_array($message)) {
    $color = $message['color'] ?? null;
    $title = $message['title'] ?? null;
    $text  = $message['message'] ?? null;
}

$color = is_string($color) ? $color : 'info';
$title = is_string($title) ? $title : 'Message';
$text  = is_string($text)  ? $text  : '';

$icon = match ($color) {
    'success' => '✓',
    'error'   => '!',
    default   => 'i',
};
?>

<div class="flash-wrap">
  <div class="msg msg-<?= $this->e($color) ?>" role="status" aria-live="polite">
    <div class="msg-icon" aria-hidden="true"><?= $this->e($icon) ?></div>
    <div class="msg-body">
      <div class="msg-title"><?= $this->e($title) ?></div>
      <div class="msg-text"><?= $this->e($text) ?></div>
    </div>
  </div>
</div>
=======
<?php if (!empty($message)): ?>
    <div class="message <?= $message->getColor() ?>">
        <h3><?= $message->getTitle() ?></h3>
        <p><?= $message->getMessage() ?></p>
    </div>
<?php endif; ?>
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
