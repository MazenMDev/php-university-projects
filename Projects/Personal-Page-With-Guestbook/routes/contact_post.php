<?php

  $name = $_POST["name"] ?? '';
  $email = $_POST["email"] ?? '';
  $message = $_POST['message'] ??'';

  if (empty($name) || empty($email) || empty($message)) {
    badRequest('All fields are required.');
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    badRequest('Invalid email address.');
  }

  $pdo = getDBConnection();
  $inserted = insertMessage($pdo, $name, $email, $message);

  if ($inserted) {
    $safeName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    addFlashMessage("success", "Thank you, {$safeName}, for your message!");
  } else {
    addFlashMessage("error", "Sorry, we couldn't save your message. Please try again later.");
  }
  
  redirect("guestbook"); 