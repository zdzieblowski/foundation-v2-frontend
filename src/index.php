<?php
require_once 'configurations/configuration.php';
require_once 'common/methods.php';
?>

<!DOCTYPE html>
<html lang="<?php echo $configuration['html_language']; ?>">

<?php
if (!empty($_GET['pool'])) {
  $pool = $_GET['pool'];
  $pool_configuration_file = 'configurations/' . $pool . '/configuration.php';

  if (!file_exists($pool_configuration_file)) {
    $pool = '';
    header('Refresh:0; url=/');
  } else {
    require_once($pool_configuration_file);
    $mode = 'pool';
  }
} else {
  $mode = 'list';
}
include 'templates/' . $configuration['page_template'] . '/html.php';
?>

<body>
  
  <?php
  include 'templates/' . $configuration['page_template'] . '/head.php';
  ?>

  <div class="content">
    <div class="width_limit">
      <div class="content_content">
        <?php
        include 'templates/' . $configuration['page_template'] . '/' . $mode . '.php';
        ?>
      </div>
    </div>
  </div>
  
  <?php
  include 'templates/' . $configuration['page_template'] . '/foot.php';
  ?>

</body>

</html>
