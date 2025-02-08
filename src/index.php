<?php
require_once 'configurations/configuration.php';
require_once 'common/methods.php';
?>

<!DOCTYPE html>
<html lang="<?php echo $configuration['html_language']; ?>">

<?php

function includePageElements($target, $configuration) {
  include 'templates/'.$configuration['page_template'].'/head.php';
  include 'templates/'.$configuration['page_template'].'/'.$target.'.php';
  include 'templates/'.$configuration['page_template'].'/foot.php';
}

if(!empty($_GET['pool'])) {
  $pool = $_GET['pool'];
  $pool_configuration_file = 'configurations/'.$pool.'/configuration.php';

  if(!file_exists($pool_configuration_file)) {
    $pool = '';
    header('Refresh:0; url=/');
  } else {
    require_once($pool_configuration_file);
    includePageElements('pool', $configuration);
  }
} else {
  includePageElements('list', $configuration);
}
?>

</html>
