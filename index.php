<?php
require_once __DIR__ . "/common/function.php";
require_once __DIR__ . "/controllers/HomeController.php";

$ctl = $_GET['ctl'] ?? '';

match ($ctl) {
    '', 'home' => (new HomeController)->index(),
    default => view("errors.404"),
};
