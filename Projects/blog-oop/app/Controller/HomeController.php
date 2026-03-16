<?php

namespace App\Controller;

use Core\View;

class HomeController {
    public function index(): string {
      return View::render(
        template: "home/index",
        data: ["message" => "Welcome to the Home Page!"],
        layout: "main"
      );
    }
}