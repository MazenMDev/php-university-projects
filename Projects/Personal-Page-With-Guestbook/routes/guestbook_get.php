<?php
  $messages = getMessages(getDBConnection());
  // throw new RuntimeException("Failed to retrieve guest messages.");
  // echo $hey;

  renderView("guestbook_get", ['messages' => $messages]);




