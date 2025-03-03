<?php
require_once 'common/configuration.php';
require_once 'common/methods.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $page_configuration['html_language']; ?>">

  <?php
  if (!empty($_GET['pool'])) {
    $pool = $_GET['pool'];
    $pool_configuration_file = $page_configuration['directory_configurations'].'/'.$pool.'/configuration.php';
    if (!file_exists($pool_configuration_file)) {
      $pool = '';
      header('Refresh:0; url=/');
    } else {
      require_once($pool_configuration_file);
      $mode = 'router';
    }
  } else {
    $mode = 'select';
  }
  ?>

  <head>
    <link rel="stylesheet" type="text/css" href="<?php echo $page_configuration['directory_templates'].'/'.$page_configuration['page_template']; ?>/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
    <link rel="shortcut icon" href="<?php echo $page_configuration['directory_templates'].'/'.$page_configuration['page_template']; ?>/assets/favicon.ico">
    <link rel="icon" type="image/svg+xml" href="<?php echo $page_configuration['directory_templates'].'/'.$page_configuration['page_template']; ?>/assets/favicon.svg">
    <link rel="icon" type="image/png" href="<?php echo $page_configuration['directory_templates'].'/'.$page_configuration['page_template']; ?>/assets/favicon-96x96.png" sizes="96x96">
    <link rel="manifest" href="<?php echo $page_configuration['directory_templates'].'/'.$page_configuration['page_template']; ?>/assets/site.webmanifest">
    <meta name="apple-mobile-web-app-title" content="<?php echo $page_configuration['page_short_title']; ?>">
    <link rel="apple-touch-icon" href="<?php echo $page_configuration['directory_templates'].'/'.$page_configuration['page_template']; ?>/assets/apple-touch-icon.png" sizes="180x180">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
  <?php
  if (!empty($pool)) {
    $page_title = $page_configuration['page_title'].': '.$pool_configuration['title'];
  ?>
    <script src="common/methods.js"></script>
    <style>
      :root {
        --color-pool: <?php echo $pool_configuration['color']; ?>;
      }
    </style>
  <?php } else {
    $page_title = $page_configuration['page_title'];
  }
  ?>
    <title><?php echo $page_title; ?></title>
  </head>
  
  <body>  
    <?php include $page_configuration['directory_templates'].'/'.$page_configuration['page_template'].'/components/header.php'; ?>
    <div class="content_wrap">
      <div class="width_max">
        <div class="content">
          <?php include $page_configuration['directory_templates'].'/'.$page_configuration['page_template'].'/components/'.$mode.'.php'; ?>
        </div>
      </div>
    </div>  
    <?php include $page_configuration['directory_templates'].'/'.$page_configuration['page_template'].'/components/footer.php'; ?>
  </body>

</html>