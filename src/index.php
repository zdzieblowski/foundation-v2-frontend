<?php

require_once 'configurations/configuration.php';
require_once 'common/methods.php';

if(!empty($_GET['coin'])) {
  $pool = $_GET['coin'];
  $pool_configuration_file = 'configurations/'.$pool.'/configuration.php';
  if(!file_exists($pool_configuration_file)) {
    $pool = '';
    header('Refresh:0; url=/');
  } else {
    require_once($pool_configuration_file);
    include '_frontend/tms/pool.php';
  }
} else {
  include '_frontend/tms/list.php';
}

?>
