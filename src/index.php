<?php

require_once 'configurations/configuration.php';
require_once 'common/methods.php';

include 'templates/'.$configuration['page_theme'].'/head.php';

if(!empty($_GET['pool'])) {
  $pool = $_GET['pool'];
  $pool_configuration_file = 'configurations/'.$pool.'/configuration.php';
  if(!file_exists($pool_configuration_file)) {
    $pool = '';
    header('Refresh:0; url=/');
  } else {
    require_once($pool_configuration_file);
    include 'templates/'.$configuration['page_theme'].'/pool.php';
  }
} else {
  include 'templates/'.$configuration['page_theme'].'/list.php';
}

?>
