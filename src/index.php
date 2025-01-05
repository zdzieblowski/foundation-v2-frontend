<?php

require_once('configuration/configuration.php');
require_once('_frontend/common/methods.php');

if(!empty($_GET['coin'])) {
  $pool = $_GET['coin'];
  $pool_configuration_file = $pool.'/configuration.php';
  if(!file_exists($pool_configuration_file)) {
    $pool = '';
    header('Refresh:0; url=/');
  } else {
    require_once($pool_configuration_file);
    include('_frontend/pool.php');
  }
} else {
  include('_frontend/list.php');
}

?>
