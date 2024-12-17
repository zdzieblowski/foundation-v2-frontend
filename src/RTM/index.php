<?php
  $pool = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
  require_once('../_frontend/index.php');
?>
