<?php
session_start();

$mailerConfig = require_once 'configs/mailer.php';
global $mailerConfig;

require_once 'bootstrap.php';

// Khởi tạo ứng dụng
$app = new App\App();
