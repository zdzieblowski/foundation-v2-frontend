<?php
require_once 'common/configuration.php';
require_once 'common/methods.php';
?>

<!DOCTYPE html>
<html lang="<?php echo $page_configuration['html_language']; ?>">

<?php
if (!empty($_GET['pool'])) {
  $pool = $_GET['pool'];
  $pool_configuration_file = $page_configuration['directory_configurations'] . '/' . $pool . '/configuration.php';

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
include $page_configuration['directory_templates'] . '/' . $page_configuration['page_template'] . '/head.php';
?>

<body>
  
  <?php include $page_configuration['directory_templates'] . '/' . $page_configuration['page_template'] . '/header.php'; ?>

  <div class="content_wrap">
    <div class="width_max">
      <div class="content">
        <?php include $page_configuration['directory_templates'] . '/' . $page_configuration['page_template'] . '/' . $mode . '.php'; ?>
      </div>
    </div>
  </div>
  
  <?php include $page_configuration['directory_templates'] . '/' . $page_configuration['page_template'] . '/footer.php'; ?>

</body>

</html>
