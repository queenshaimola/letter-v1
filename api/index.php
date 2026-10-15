<?php

// Redirect storage to /tmp for Vercel serverless environment
$_ENV['APP_STORAGE'] = '/tmp';

require __DIR__ . '/../public/index.php';