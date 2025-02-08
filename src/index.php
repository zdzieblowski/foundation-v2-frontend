<?php
require_once 'configurations/configuration.php';
require_once 'common/methods.php';
?>

<!DOCTYPE html>
<html lang="<?php echo $configuration['html_language']; ?>">

<?php
if(!empty($_GET['pool'])) {
  $pool = $_GET['pool'];
  $pool_configuration_file = 'configurations/'.$pool.'/configuration.php';

  include 'templates/'.$configuration['page_template'].'/head.php';

  if(!file_exists($pool_configuration_file)) {
    $pool = '';
    header('Refresh:0; url=/');
  } else {
    require_once($pool_configuration_file);
    include 'templates/'.$configuration['page_template'].'/pool.php';
  }
} else {
  include 'templates/'.$configuration['page_template'].'/list.php';
}
?>

</html>
