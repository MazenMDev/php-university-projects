<?php

namespace App\Controller;

class PostController {
  public function index() {
    return "List of all posts";
  }

  public function show($id) {
    return "Showing post with ID: $id";
  }
}