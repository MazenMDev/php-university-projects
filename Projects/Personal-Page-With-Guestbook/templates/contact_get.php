<section>
  <h2>Leave a public message</h2>
  <form action="" method="POST">
    <input type="hidden" name="csrf_token" value="<?= $data['csrf_token'] ?>">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea>
    <button type="submit">Send Message</button>
  </form>
</section>