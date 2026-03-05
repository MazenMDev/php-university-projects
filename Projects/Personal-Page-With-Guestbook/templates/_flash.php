<?php
$messages = getFlashMessages();
?>

<?php if (!empty($messages)): ?>
  <div class="flash-messages">
    <?php foreach ($messages as $type => $message): ?>
      <div class="flash-message flash-<?= htmlspecialchars($type) ?>">
        <?= htmlspecialchars($message) ?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>