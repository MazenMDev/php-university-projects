<?php
  function obfuscateEmail(string $email): string {
    $parts = explode('@', $email);
    $username = $parts[0];
    $domain = $parts[1] ?? '';
    $username = substr($username, 0, 2) . str_repeat('*', max(0, strlen($username) - 2));
    return "{$username}@{$domain}";
  }
  $entries = $data['messages'] ?? [];
?>

<section>
  <h2>Guest Messages</h2>
  <?php if (empty($entries)): ?>
    <p>No messages yet. Be the first to leave a message!</p>
  <?php else: ?>
    <ul class="guestbook-list">
      <?php foreach ($entries as $entry): ?>
        <li class="guestbook-entry">
          <p><strong><?= htmlspecialchars($entry['name'], ENT_QUOTES, 'UTF-8') ?></strong> (<?= htmlspecialchars(obfuscateEmail($entry['email']), ENT_QUOTES, 'UTF-8') ?>) said:</p>
          <p><?= nl2br(htmlspecialchars($entry['message'], ENT_QUOTES, 'UTF-8')) ?></p>
          <p class="timestamp"><?= date('F j, Y, g:i a', strtotime($entry['created_at'])) ?></p>
        </li>
        <hr>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</section>